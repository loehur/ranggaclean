<?php

require 'app/Library/PHPMailer/src/PHPMailer.php';
require 'app/Library/PHPMailer/src/SMTP.php';
require 'app/Library/PHPMailer/src/Exception.php';

require 'app/Config/Mail_Config.php';

class M_Mailer
{
    private $mail;
    public function __construct()
    {
        $this->mail = new PHPMailer\PHPMailer1\PHPMailer();
    }

    public function sendMail($sendTo, $subject, $body)
    {
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->Host = $this->Host;
        $this->mail->Port = $this->Port;
        $this->mail->SMTPSecure     = $this->SMTPSecure;
        $this->mail->Username = $this->Username;
        $this->mail->Password = $this->Password;
        $this->mail->From = $this->From;
        $this->mail->FromName = $this->FromName;
        $this->mail->addAddress($sendTo);
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
        $this->mail->send();
    }
}
