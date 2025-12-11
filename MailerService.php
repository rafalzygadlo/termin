<?php

namespace App\Service;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailerService
{
    /**
     * Wysyła e-mail z linkiem do resetowania hasła.
     */
    public function sendPasswordResetEmail(string $recipientEmail, string $token): bool
    {
        // Zmień 'localhost' na domenę swojej aplikacji
        $resetLink = "https://localhost/password/reset?token=" . $token;
        $subject = "Resetowanie hasła";
        $body = "Aby zresetować hasło, kliknij w poniższy link (ważny przez 15 minut):<br><a href='{$resetLink}'>{$resetLink}</a>";

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = $_ENV['MAIL_HOST'] ?? 'mailhog';
            $mail->Port       = $_ENV['MAIL_PORT'] ?? 1025;
            // Odkomentuj, jeśli używasz autentykacji SMTP
            // $mail->SMTPAuth   = true;
            // $mail->Username   = $_ENV['MAIL_USER'];
            // $mail->Password   = $_ENV['MAIL_PASS'];
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'] ?? 'no-reply@termin.dev', $_ENV['MAIL_FROM_NAME'] ?? 'Termin App');
            $mail->addAddress($recipientEmail);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->CharSet = 'UTF-8';

            return $mail->send();
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }
}