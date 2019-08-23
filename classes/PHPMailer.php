<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'C:\xampp\composer\vendor\autoload.php';

class Mail extends PHPMailer {
    public function sendEmail() {
        try {
   
            $this->setFrom('black666galaxy666unicorn@gmail.com', 'Shop Portfolio');
            $this->addAddress('palpatine@empire.com', 'Emperor');
            $this->Subject = 'Thank you for your order!';
            $this->Body = 'Here is the our bank account. Please pay withi a week.
            ';
            
            /* SMTP parameters. */
            
            /* Tells PHPMailer to use SMTP. */
            $this->isSMTP();
            
            /* SMTP server address. */
            $this->Host = 'smtp.gmail.com';
         
            /* Use SMTP authentication. */
            $this->SMTPAuth = TRUE;
            
            /* Set the encryption system. */
            $this->SMTPSecure = 'tls';
            
            /* SMTP authentication username. */
            $this->Username = 'black666galaxy666unicorn@gmail.com';
            
            /* SMTP authentication password. */
            $this->Password = 'miyavilove';
            
            /* Set the SMTP port. */
            $this->Port = 587;
            
            /* Finally send the mail. */
            $this->send();
         }
         catch (Exception $e) {
            echo $e->errorMessage();
         }
         catch (\Exception $e){
            echo $e->getMessage();
         }   
    }
}