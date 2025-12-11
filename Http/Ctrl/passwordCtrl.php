<?php

namespace Http\Ctrl;

use Core\View;
use Model\PasswordReset;
use Core\Ctrl;
use Core\Msg;
use Core\Database; 

// Zakładam, że masz bazowy kontroler, z którego możesz dziedziczyć
class PasswordCtrl extends Ctrl
{
    
    public function do(): void
    {
        if ($this->isPost()) 
        {
            $email = $_POST['email'] ?? null;
            if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $passwordResetModel = new PasswordReset(DB::instance());
                $token = $passwordResetModel->createResetToken($email);

                // Jeśli token został utworzony (użytkownik istnieje), wyślij e-mail
                if ($token) {
                    $mailer = new MailerService();
                    $mailer->sendPasswordResetEmail($email, $token);
                }
            }
            // Zawsze pokazuj tę samą wiadomość, aby nie ujawniać istnienia e-maila
            Msg::add('Jeśli podany adres e-mail istnieje w naszym systemie, wysłaliśmy na niego instrukcje.');
            $this->redirect('/password/request'); // Przekieruj, aby uniknąć ponownego wysłania formularza
        }

        $this->render('password/request');
    }

   
    public function reset(): void
    {
        $token = $_GET['token'] ?? null;
        $passwordReset = new PasswordReset(DB::instance());

        $resetData = $token ? $passwordReset->findByToken($token) : null;

        if (!$resetData) {
            Msg::add('Link do resetowania hasła jest nieprawidłowy lub wygasł. Poproś o nowy.');
            $this->redirect('/password/request');
            return;
        }

        if ($this->isPost()) {
            $password = $_POST['password'];
            $passwordConfirm = $_POST['password_confirm'];

            if (strlen($password) < 8) {
                Msg::add('Hasło musi mieć co najmniej 8 znaków.');
            } elseif ($password !== $passwordConfirm) {
                Msg::add('Podane hasła nie są identyczne.');
            } else {
                if ($passwordReset->completeReset($token, $password)) {
                    Msg::add('Hasło zostało pomyślnie zmienione. Możesz się teraz zalogować.');
                    $this->redirect('/login'); // Przekieruj na stronę logowania
                } else {
                    Msg::add('Wystąpił nieoczekiwany błąd. Spróbuj ponownie.');
                    $this->redirect('/password/request');
                }
                return;
            }
        }

        $this->render('password/reset', ['token' => $token]);
    }

    public function index()
    {
        (new View)->Render('password/index');
    } 
}