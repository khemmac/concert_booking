<?php
class Test extends CI_Controller {


	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		// load model
		$this->load->model('email_model','',TRUE);

		$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
		$this->output->set_header('Cache-Control: max-age=-1281, public, must-revalidate, proxy-revalidate', FALSE);
		$this->output->set_header('Pragma: no-cache');
	}

	function index(){
		echo 'Index of test controller';
	}

	function send_mail(){

		$this->load->library('email');

		$this->email->initialize(array(
			'mailtype'  => 'html',
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'khemmac@gmail.com',
			'smtp_pass' => 'g-,=k9b',
			'charset'   => 'utf8'
		));

		$this->email->from('khemmac@gmail.com', 'Bootplus');
		$this->email->to('khemmac@gmail.com');
		$this->email->bcc('khemmac@hotmail.com,aon_iti10@hotmail.com,aon.iti10@gmail.com');

		$this->email->subject('ยินดีต้อนรับผู้จองบัตร Early Bird & Presale');
		$mail_body = $this->load->view('email/register-success', array('username'=>1111111, 'password'=>2222222222), true);
		$this->email->message($mail_body);

		$this->email->send();

		echo $this->email->print_debugger();
	}

	function check_port(){
		$fp = fsockopen('127.0.0.1', 465, $errno, $errstr, 5);
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
		$this->load->view('email/register-success');
	}

}