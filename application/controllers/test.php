<?php
class Test extends CI_Controller {


	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		// load model
		$this->load->model('email_model','',TRUE);
		$this->load->model('booking_model','',TRUE);

		$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
		$this->output->set_header('Cache-Control: max-age=-1281, public, must-revalidate, proxy-revalidate', FALSE);
		$this->output->set_header('Pragma: no-cache');
	}

	function index(){
		echo 'Index of test controller';
	}

	function send_mail(){
		$this->email_model->send_register_success(array('username'=>'ssssss','password'=>'bbbbbbbb','email'=>'khemmac@gmail.com'));
	}

	function check_port(){
		$fp = fsockopen('ssl://smtp.googlemail.com', 465, $errno, $errstr, 5);
		if (!$fp) {
			// port is closed or blocked
			echo 'ERROR NO : '.$errno;
			echo '<hr />';
			echo 'ERROR MSG : '.$errstr;
		} else {
			// port is open and available
			echo 'PORT IS OPEN';
			fclose($fp);
		}
	}

	function render_mail(){
		$data = $this->booking_model->prepare_print_data(1, 17);

		$this->load->view('email/booking-submit-success', $data);
	}

	function booking_prepare(){
		$user_id = get_user_session_id($this);

		$booking_id = $this->booking_model->prepare($user_id);

		echo $booking_id;
	}

}