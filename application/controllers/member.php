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
						'rules'		=> 'trim|required|min_length[6]|max_length[255]|matches[passwordConf]|md5'
					),
					array(
						'field'		=> 'passwordConf',
						'label'		=> 'ยืนยัน รหัสผ่าน',
						'rules'		=> 'trim|required|md5'
					),
					array(
						'field'		=> 'question',
						'label'		=> 'คำถามกันลืมรัหสผ่าน',
						'rules'		=> 'trim|required'
					),
					array(
						'field'		=> 'answer',
						'label'		=> 'คำตอบ',
						'rules'		=> 'trim|required|max_length[255]'
					),
					array(
						'field'		=> 'code',
						'label'		=> 'รหัสบัตรประชาชน',
						'rules'		=> 'trim|required|min_length[13]|max_length[13]'
					),
					array(
						'field'		=> 'thName',
						'label'		=> 'ชื่อ - นามสกุล',
						'rules'		=> 'trim|required|max_length[255]'
					),
					array(
						'field'		=> 'enName',
						'label'		=> 'ชื่อ - นามสกุล (ภาษาอังกฤษ)',
						'rules'		=> 'trim|required|max_length[255]'
					),
					array(
						'field'		=> 'nickName',
						'label'		=> 'ชื่อเล่น',
						'rules'		=> 'trim|required|max_length[100]'
					),
					array(
						'field'		=> 'sex',
						'label'		=> 'เพศ',
						'rules'		=> 'trim|required|max_length[1]'
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
						'rules'		=> 'trim|required|max_length[1000]'
					),
					array(
						'field'		=> 'tel',
						'label'		=> 'เบอร์ติดต่อ',
						'rules'		=> 'trim|required|max_length[20]'
					),
					array(
						'field'		=> 'email',
						'label'		=> 'E-mail',
						'rules'		=> 'trim|required|valid_email|max_length[255]'
					),
					array(
						'field'		=> 'job',
						'label'		=> 'อาชีพ',
						'rules'		=> 'trim|required|max_length[255]'
					),
					array(
						'field'		=> 'job_area',
						'label'		=> 'สถานที่ทำงาน/เรียน',
						'rules'		=> 'trim|required|max_length[255]'
					),
					array(
						'field'		=> 'favorite_artist',
						'label'		=> 'ศิลปินคนโปรด',
						'rules'		=> 'trim|required|max_length[255]'
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
			$formData = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'code' => $this->input->post('code'),
				'thName' => $this->input->post('thName'),
				'enName' => $this->input->post('enName'),
				'nickName' => $this->input->post('nickName'),
				'sex' => $this->input->post('sex'),
				'birthDate' => $this->input->post('birth_year').'-'.$this->input->post('birth_month').'-'.$this->input->post('birth_date'),
				'address' => $this->input->post('address'),
				'tel' => $this->input->post('tel'),
				'email' => $this->input->post('email'),
				'job' => $this->input->post('job'),
				'job_area' => $this->input->post('job_area'),
				'favorite_artist' => $this->input->post('favorite_artist')
			);

			$this->db->set('createDate', 'NOW()', false);
			$this->db->insert('person', $formData);

			redirect('register_success');
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


} // end class