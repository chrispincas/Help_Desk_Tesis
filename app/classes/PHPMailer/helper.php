<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer.php';
require_once 'SMTP.php';
require_once 'Exception.php';

class Mailer extends PHPMailer{
  
  function __construct(){
    parent::__construct();
    $this->mail = new PHPMailer(true);
  }

  function sendMail($recipe,$cc=[],$bcc=[],$subject,$body){
    try {
      //Server settings
      $this->mail->SMTPDebug = SMTP::DEBUG_OFF;
      $this->mail->isSMTP();
      $this->mail->Host       = constant('HOST_SMTP');
      $this->mail->SMTPAuth   = true;
      $this->mail->Username   = constant('USER_SMTP');
      $this->mail->Password   = constant('PASS_SMTP');
      $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $this->mail->Port       = constant('PORT_SMTP');
    
      //Recipients
      $this->mail->setFrom('noc@wificolombia.net', 'Sistema Unificado WiFiColombia');
      $this->mail->addAddress($recipe);
      
      foreach ($cc as $mail) {
        $this->mail->addCC($mail);
      }

      foreach ($bcc as $mail) {
        $this->mail->addBCC($mail);
      }
      //Content
      $this->mail->isHTML(true);
      $this->mail->Subject = $subject;
      $this->mail->Body    = $body;
      $this->mail->send();
    } catch (Exception $e) {
      error_log("Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}");
    }
  }

}


?>