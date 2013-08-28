<?php
Class Email_model extends CI_Model
{
	function send_register_success($user_data){

		require("./application/libraries/phpmailer/class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->CharSet		= "utf-8";
		$mail->Host			= "ssl://smtp.gmail.com";
		$mail->Port			= "465";
		$mail->SMTPAuth		= true;
		$mail->Username		= "khemmac@gmail.com";
		$mail->Password		= "g-,=k9b";

		$mail->From			= "khemmac@gmail.com";
		$mail->FromName		= "Boostplus";
		$mail->AddAddress($user_data['email']);
		$mail->AddBCC('khemmac@hotmail.com');
		$mail->AddBCC('khemmac@gmail.com');
		$mail->AddBCC('aon.iti10@gmail.com');
		$mail->AddBCC('aon_iti10@hotmail.com');
		$mail->IsHTML(true);
		$mail->Subject		=  'ยินดีต้อนรับผู้จองบัตร Early Bird & Presale';
		$mail->Body			= $this->load->view('email/register-success', $user_data, true);
		$result = $mail->send();

		//echo $this->email->print_debugger();
	}
}
