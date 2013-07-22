<?php
class Form_booking extends CI_Controller {


	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');
		$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
	}

	public function zone(){
		redirect('seat');
	}

	public function seat(){
		redirect('booking');
	}

	public function booking(){
		redirect('booking-complete');
	}

	public function transfer(){
		redirect('transfer-check');
	}

	public function check(){
		redirect('booking-complete');
	}

}

?>