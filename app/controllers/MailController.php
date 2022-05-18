<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once 'classes/PHPMailer/PHPMailer.php';
require_once 'classes/PHPMailer/SMTP.php';

class MailController extends SessionController{

	private $host;
	private $port;
	private $ssl;
	private $username;
	private $password;
	private $from;

	public function __construct(){
		parent::__construct();
		$this->host = HOST_SMTP;
		$this->port = PORT_SMTP;
		$this->ssl = SSL_SMTP;
		$this->username = USER_SMTP;
		$this->password = PASS_SMTP;
		$this->from = MAIL_FROM;
	}
	
	public function sendMail($to, $subject, $html){
	
		$mail = new PHPMailer(true);
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Host = $this->host;
		$mail->Port = $this->port;
		$mail->SMTPSecure = $this->ssl;
		$mail->SMTPAuth = true;
		$mail->Username = $this->username;
		$mail->Password = $this->password;
		$mail->setFrom($this->from);
		$mail->addAddress($to);
		//$mail->addBCC("jnieto@wificolombia.net");
		$mail->Subject = $subject;
		//$mail->msgHTML($body);
		$mail->msgHTML($html);
		if (!$mail->send()) {
			return false;
			error_log("Error: " . $mail->ErrorInfo);
		}else {
			return true;
		}
	
	}
}
?>