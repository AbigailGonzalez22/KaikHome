<?php

require_once BASE_PATH . '/vendor/phpmailer/src/Exception.php';
require_once BASE_PATH . '/vendor/phpmailer/src/PHPMailer.php';
require_once BASE_PATH . '/vendor/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

class Mailer
{
    /**
     * @param string $to Uno o varios emails separados por coma.
     */
    public static function send(string $to, string $subject, string $body, string $replyTo, string $replyToName): bool
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = SMTP_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = SMTP_USER;
            $mail->Password   = SMTP_PASS;
            $mail->SMTPSecure = SMTP_ENCRYPTION;
            $mail->Port       = SMTP_PORT;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom(FROM_EMAIL, 'Kaik Home');
            foreach (explode(',', $to) as $address) {
                $address = trim($address);
                if ($address !== '') {
                    $mail->addAddress($address);
                }
            }
            $mail->addReplyTo($replyTo, $replyToName);

            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->isHTML(false);

            $mail->send();
            return true;
        } catch (PHPMailerException $e) {
            error_log('Mailer error: ' . $mail->ErrorInfo);
            return false;
        }
    }
}
