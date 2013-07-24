<?php
class Member extends CI_Controller {


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
		redirect('member/login');
	}

	function login(){
		$this->phxview->RenderView('login');
		$this->phxview->RenderLayout('default');
	}

	function logout(){
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
			$this->phxview->RenderView('register');
			$this->phxview->RenderLayout('default');
		}else{
			redirect('index');
		}
	}

	function register(){
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
						'rules'		=> 'trim|required|md5'
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
						'label'		=> 'ชื่อ - นามสกุล (ภาษาอังกฤษ)',
						'rules'		=> 'trim|required'
					),
					array(
						'field'		=> 'nickName',
						'label'		=> 'ชื่อเล่น',
						'rules'		=> 'trim|required'
					),
					array(
						'field'		=> 'sex',
						'label'		=> 'ชื่อเล่น',
						'rules'		=> 'trim|required'
					),
					array(
						'field'		=> 'birth_date',
						'label'		=> 'วัน',
						'rules'		=> 'trim|required'
					),
					array(
						'field'		=> 'birth_month',
						'label'		=> 'เดือน',
						'rules'		=> 'trim|required'
					),
					array(
						'field'		=> 'birth_year',
						'label'		=> 'ปี',
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
						'label'		=> 'E-mail',
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
		if ($this->form_validation->run() == FALSE)
		{
			$this->phxview->RenderView('register');
			$this->phxview->RenderLayout('default');
		}else{
			redirect('register_success');
		}

	}

}