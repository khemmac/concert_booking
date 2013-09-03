<?php
Class Email_model extends CI_Model
{
	protected function send_mailer($reciever, $subject, $body){
		require("./application/libraries/phpmailer/class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->CharSet		= "utf-8";
		$mail->Host			= "ssl://smtp.gmail.com";
		$mail->Port			= "465";
		$mail->SMTPAuth		= true;
		$mail->Username		= "SBS.MTV.2013@gmail.com";
		$mail->Password		= "boost1234";

		$mail->From			= "SBS.MTV.2013@gmail.com";
		$mail->FromName		= "Boostplus";
		$mail->AddAddress($reciever);
		$mail->AddBCC('khemmac@hotmail.com');
		$mail->AddBCC('khemmac@gmail.com');
		$mail->AddBCC('aon.iti10@gmail.com');
		$mail->AddBCC('aon_iti10@hotmail.com');
		$mail->IsHTML(true);
		$mail->Subject		=  $subject;
		$mail->Body			= $body;
		$result = $mail->send();
	}

	public function send_register_success($user_data){
		$reciever = $user_data['email'];
		$subject = 'ยินดีต้อนรับผู้จองบัตร Early Bird & Presale';
		$body = $this->load->view('email/register-success', $user_data, true);
		$this->send_mailer($reciever, $subject, $body);
	}
}
