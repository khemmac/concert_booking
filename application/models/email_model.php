<?php
Class Email_model extends CI_Model
{
	function send_register_success($user_data){
		$mail_body = $this->load->view('email/register-success', '', true);

		$this->load->library('email');

		$this->email->initialize(array(
			'mailtype'=>'html'
		));

		$this->email->from('khemmac@gmail.com', 'Bootplus');
		$this->email->to('khemmac@gmail.com');
		$this->email->bcc('khemmac@hotmail.com');

		$this->email->subject('ยินดีต้อนรับผู้จองบัตร Early Bird &amp; Presale');
		$mail_body = $this->load->view('email/register-success', '', true);
		$this->email->message($mail_body);

		$this->email->send();

		echo $this->email->print_debugger();
	}
}
