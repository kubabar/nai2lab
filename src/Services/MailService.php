<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    private PHPMailer $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->configure();
    }

    private function configure(): void
    {
        $this->mailer->isSMTP();
        $this->mailer->Host = $_ENV['MAIL_HOST'];
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $_ENV['MAIL_USERNAME'];
        $this->mailer->Password = $_ENV['MAIL_PASSWORD'];
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = $_ENV['MAIL_PORT'];
        $this->mailer->CharSet = 'UTF-8';

        $this->mailer->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);
    }

    public function sendContactMessage(string $name, string $email, string $subject, string $message): bool
    {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress($_ENV['MAIL_TO']);
            $this->mailer->addReplyTo($email, $name);

            $this->mailer->isHTML(true);
            $this->mailer->Subject = "Wiadomość z formularza kontaktowego: " . $subject;

            $htmlBody = "
                <h2>Nowa wiadomość z formularza kontaktowego</h2>
                <p><strong>Od:</strong> {$name} ({$email})</p>
                <p><strong>Temat:</strong> {$subject}</p>
                <hr>
                <h3>Treść wiadomości:</h3>
                <p>" . nl2br(htmlspecialchars($message)) . "</p>
                <hr>
                <p><small>Wiadomość wysłana: " . date('Y-m-d H:i:s') . "</small></p>
            ";

            $this->mailer->Body = $htmlBody;
            $this->mailer->AltBody = strip_tags(str_replace('<br>', "\n", $htmlBody));

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            error_log("Mail Error: {$this->mailer->ErrorInfo}");
            return false;
        }
    }
}
