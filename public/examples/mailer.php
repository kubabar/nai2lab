<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

// Load .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Check if button was pressed
if (isset($_POST['send_email'])) {

    $mail = new PHPMailer(true);

    try {
        $currentDate = date("Y-m-d H:i:s");

        $mail->isSMTP();
        $mail->Host       = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['MAIL_USERNAME'];
        $mail->Password   = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $_ENV['MAIL_PORT'];

        // Recipients
        $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);
        $mail->addAddress('example@example.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Test Email $currentDate";
        $mail->Body    = "<p>This is a test email sent on:</p>
                          <p>$currentDate</p>";
        $mail->AltBody = "This is a test email sent on: $currentDate";

        $mail->send();
        $status = "Email sent successfully on $currentDate!";
    } catch (Exception $e) {
        $status = "Email failed: {$mail->ErrorInfo}";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Send Test Email</title>
</head>
<body>

<h2>Send Test Email</h2>

<form method="POST">
    <button type="submit" name="send_email">Send Email</button>
</form>

<?php if (isset($status)): ?>
    <p><strong><?php echo $status; ?></strong></p>
<?php endif; ?>

</body>
</html>
