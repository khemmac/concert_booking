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
		require_once('./application/libraries/Mail/Mail.php');

/*
		require("./application/libraries/phpmailer/class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้
		$mail->Host     = "ssl://smtp.gmail.com"; //  mail server ของเรา
		$mail->Port     = "465";
		$mail->SMTPAuth = true;     //  เลือกการใช้งานส่งเมล์ แบบ SMTP
		$mail->Username = "khemmac@gmail.com";   //  account e-mail ของเราที่ต้องการจะส่ง
		$mail->Password = "g-,=k9b";  //  รหัสผ่าน e-mail ของเราที่ต้องการจะส่ง

		$mail->From     = "khemmac@gmail.com";  //  account e-mail ของเราที่ใช้ในการส่งอีเมล
		$mail->FromName = "ติดต่อ : Starsocceronline "; //  ชื่อผู้ส่งที่แสดง เมื่อผู้รับได้รับเมล์ของเรา
		$mail->AddAddress('khemmac@gmail.com');
		//$mail->AddBCC('khemmac@gmail.com');
		$mail->IsHTML(true);                  // ถ้า E-mail นี้ มีข้อความในการส่งเป็น tag html ต้องแก้ไข เป็น true
		$mail->Subject     =  'aaaaa';        // หัวข้อที่จะส่ง(ไม่ต้องแก้ไข)
		$mail->Body     = 'bbbbbb';                   // ข้อความ ที่จะส่ง(ไม่ต้องแก้ไข)
		$result = $mail->send();
		echo json_encode(array(
			'success'=>true,
			'data'=>$result
*/
		$config = Array(
			'protocol'	=> 'smtp',
			'smtp_host'	=> 'ssl://smtp.gmail.com',
			'smtp_port'	=> 465,
			'smtp_user'	=> 'khemmac@gmail.com',
			'smtp_pass'	=> 'g-,=k9b',
			'mailtype'	=> 'html',
			'charset'	=> 'utf8'
		);
		$this->load->library('email');
		$this->email->initialize($config);

		$this->email->from('khemmac@gmail.com', 'Bootplus');
		$this->email->to('aon.iti10@gmail.com');
		$this->email->bcc('khemmac@hotmail.com,aon_iti10@hotmail.com,khemmac@gmail.com');

		$this->email->subject('ยินดีต้อนรับผู้จองบัตร Early Bird & Presale');
		$mail_body = 'test hello';//$this->load->view('email/register-success', array('username'=>1111111, 'password'=>2222222222), true);
		$this->email->message($mail_body);

		$this->email->send();
		echo $this->email->print_debugger();

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