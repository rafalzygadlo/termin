<?php

namespace App\Model;

use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PasswordReset
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Tworzy token do resetowania hasła dla danego użytkownika.
     * @return string|null Zwraca token w przypadku sukcesu lub null, jeśli użytkownik nie istnieje.
     */
    public function createResetToken(string $email): ?string
    {
        // 1. Sprawdź, czy użytkownik istnieje (załóżmy, że masz tabelę `users`)
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch() === false) {
            // Celowo nie informujemy, że email nie istnieje
            return null;
        }

        // 2. Wygeneruj bezpieczny token
        $token = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $token);
        $expiresAt = date('Y-m-d H:i:s', strtotime('+15 minutes')); // Krótki czas życia tokenu

        // 3. Zapisz hash tokenu w bazie
        $this->pdo->prepare("DELETE FROM password_resets WHERE user_email = ?")->execute([$email]);
        $stmt = $this->pdo->prepare(
            "INSERT INTO password_resets (user_email, token_hash, expires_at) VALUES (?, ?, ?)"
        );
        $stmt->execute([$email, $tokenHash, $expiresAt]);

        return $token;
    }

    /**
     * Weryfikuje token i zwraca email, jeśli jest poprawny.
     */
    public function findByToken(string $token): ?array
    {
        $tokenHash = hash('sha256', $token);

        $stmt = $this->pdo->prepare(
            "SELECT * FROM password_resets WHERE token_hash = ? AND expires_at > NOW()"
        );
        $stmt->execute([$tokenHash]);
        $resetData = $stmt->fetch();

        return $resetData ?: null;
    }

    /**
     * Aktualizuje hasło użytkownika i usuwa token.
     */
    public function completeReset(string $token, string $newPassword): bool
    {
        $resetData = $this->findByToken($token);
        if ($resetData === null) {
            return false;
        }

        // Zaktualizuj hasło użytkownika (załóżmy tabelę `users`)
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->execute([$hashedPassword, $resetData['user_email']]);

        // Usuń użyty token
        $stmt = $this->pdo->prepare("DELETE FROM password_resets WHERE user_email = ?");
        $stmt->execute([$resetData['user_email']]);

        return true;
    }
}