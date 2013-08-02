<?php
class Booking extends CI_Controller {


	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
		$this->output->set_header('Cache-Control: max-age=-1281, public, must-revalidate, proxy-revalidate', FALSE);
		$this->output->set_header('Pragma: no-cache');
	}

	function index(){
		if(!is_user_session_exist($this))
			redirect('member/login');

		$this->phxview->RenderView('booking');
		$this->phxview->RenderLayout('default');
	}

	function complete(){
		if(!is_user_session_exist($this))
			redirect('member/login');

		$this->phxview->RenderView('booking-complete.php');
		$this->phxview->RenderLayout('default');
	}

	function check(){
		if(!is_user_session_exist($this))
			redirect('member/login');

		$this->phxview->RenderView('booking-check');
		$this->phxview->RenderLayout('default');
	}

}