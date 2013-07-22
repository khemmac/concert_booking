<?php
class Form_member extends CI_Controller {


	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');
		$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
	}

	public function db(){
		$query = $this->db->get('bluecard');
		$result = $query->result_array();
		echo json_encode($result);
	}

	public function register(){

		$rules = array(
					array(
						'field'		=> 'username',
						'label'		=> 'User name',
						'rules'		=> 'trim|required|min_length[5]|max_length[12]|xss_clean|callback_username_check'
					),
					array(
						'field'		=> 'password',
						'label'		=> 'รหัสผ่าน',
						'rules'		=> 'trim|required|matches[passwordConf]|md5'
					),
					array(
						'field'		=> 'passwordConf',
						'label'		=> 'ยืนยัน รหัสผ่าน',
						'rules'		=> 'trim|required'
					),
					array(
						'field'		=> 'code',
						'label'		=> 'รหัสบัตรประชาชน',
						'rules'		=> 'trim|required|min_length[13]|max_length[13]'
					),
					array(
						'field'		=> 'thName',
						'label'		=> 'ชื่อ - นามสกุล',
						'rules'		=> 'trim|required'
					),
					array(
						'field'		=> 'enName',
						'label'		=> 'ชื่อ - นามสกุล (Eng)',
						'rules'		=> 'trim|required'
					),
					array(
						'field'		=> 'nickName',
						'label'		=> 'ชื่อเล่น',
						'rules'		=> 'trim|required'
					),
					array(
						'field'		=> 'address',
						'label'		=> 'ที่อยุ่ปัจจุบัน',
						'rules'		=> 'trim|required'
					),
					array(
						'field'		=> 'tel',
						'label'		=> 'เบอร์ติดต่อ',
						'rules'		=> 'trim|required'
					),
					array(
						'field'		=> 'email',
						'label'		=> 'Email',
						'rules'		=> 'trim|required|valid_email'
					),
					array(
						'field'		=> 'job',
						'label'		=> 'อาชีพ',
						'rules'		=> 'trim|required'
					),
					array(
						'field'		=> 'job_area',
						'label'		=> 'สถานที่ทำงาน/เรียน',
						'rules'		=> 'trim|required'
					),
					array(
						'field'		=> 'favorite_artist',
						'label'		=> 'ศิลปินคนโปรด',
						'rules'		=> 'trim|required'
					)
				);
		foreach($rules as $item){
			$this->form_validation->set_rules($item['field'], $item['label'], $item['rules']);
		}
/*
		$this->form_validation->set_rules('username', 'Username',
			'trim|required|min_length[5]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('password', 'Password',
			'trim|required|matches[passconf]|md5');
		$this->form_validation->set_rules('passconf', 'Password Confirmation',
			'trim|required');
		$this->form_validation->set_rules('email', 'Email',
			'trim|required|valid_email');
*/
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('errors', validation_errors());

			$error_message = array();
			foreach($rules as $item){
				$msg = form_error($item['field']);
				if(!empty($msg))
					$error_message[$item['field']] = $msg;
			}
			$this->session->set_flashdata('errors_message', $error_message);
			redirect('register');
		}else{
			redirect('register_success');
		}
	}

	public function login(){

		$rules = array(
					array(
						'field'		=> 'username',
						'label'		=> 'Username',
						'rules'		=> 'trim|required|min_length[5]|max_length[12]|xss_clean'
					),
					array(
						'field'		=> 'password',
						'label'		=> 'Password',
						'rules'		=> 'trim|required|md5'
					)
				);
		foreach($rules as $item){
			$this->form_validation->set_rules($item['field'], $item['label'], $item['rules']);
		}

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('errors', validation_errors());

			$error_message = array();
			foreach($rules as $item){
				$msg = form_error($item['field']);
				if(!empty($msg))
					$error_message[$item['field']] = $msg;
			}
			//print_r($error_message);
			//return;
			$this->session->set_flashdata('errors_message', $error_message);
			redirect('login');
		}else{
			redirect('login_success');
		}
	}

	// http://ellislab.com/codeigniter/user-guide/libraries/form_validation.html#callbacks
	public function username_check($str)
	{
		if ($str == 'test')
		{
			$this->form_validation->set_message('username_check', 'The %s field can not be the word "test"');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function logout(){
		redirect('index');
	}

}

?>