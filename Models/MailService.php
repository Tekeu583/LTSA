<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../vendor/autoload.php'; // Assurez-vous d'avoir installé PHPMailer via Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService {
    private $mail;
    // Envoyer un email
    public function sendEmail($to, $subject, $body) {
        try {

            global $mail_config;
            
            $this->mail = new PHPMailer(true);
            
            // Configuration du serveur SMTP
            $this->mail->isSMTP();
            $this->mail->Host = $mail_config['host'];
            $this->mail->SMTPAuth = true;
            $this->mail->Username = $mail_config['username'];
            $this->mail->Password = $mail_config['password'];
            $this->mail->SMTPSecure = $mail_config['encryption'];
            $this->mail->Port = $mail_config['port'];
            
            // Configuration de l'expéditeur
            $this->mail->setFrom($mail_config['from_email'], $mail_config['from_name']);
            
            // Activer le mode HTML
            $this->mail->isHTML(true);
            $this->mail->CharSet = 'UTF-8';
            $this->mail->clearAddresses();
            $this->mail->addAddress($to);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            
            return $this->mail->send();
        } catch (Exception $e) {
            error_log("Erreur lors de l'envoi de l'email une donnée manque: " . $this->mail->ErrorInfo);
            return false;
        }
    }

    
}
?>