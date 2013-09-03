<?php
Class Person_model extends CI_Model
{
	function login($username, $password){
		$this->db->select('id, username, thName, enName');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->limit(1);

		$query = $this->db->get('person');

		if($query->num_rows() == 1) {
			set_user_session($this, $query->first_row('array'));
			return $query->result();
		} else {
			return false;
		}
	}

	function insert(){
		$this->db->select('username');
		$this->db->where('username', $this->input->post('username'));
		$query = $this->db->get('person');
		$this->db->limit(1);

		if($query->num_rows() > 0)
			throw new Exception('username "'.$this->input->post('username').'" is exists.');

		$formData = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'question' => $this->input->post('question'),
			'answer' => $this->input->post('answer'),
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
	}

	function update(){
		$user_id = get_user_session_id($this);
		$this->db->where('id', $user_id);

		$formData = array(
			'question' => $this->input->post('question'),
			'answer' => $this->input->post('answer'),
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
		$password_old = $this->input->post('password_old');
		$password_new = $this->input->post('password_new');
		if(!empty($password_old) && !empty($password_new))
			$formData['password'] = $password_new;

		$this->db->set('updateDate', 'NOW()', false);
		$this->db->update('person', $formData);
	}

	function get_register_rules(){
		return array(
			array(
				'field'		=> 'username',
				'label'		=> 'User name',
				'rules'		=> 'trim|required|min_length[5]|max_length[12]|xss_clean|callback_check_register_username'
			),
			array(
				'field'		=> 'password',
				'label'		=> 'รหัสผ่าน',
				'rules'		=> 'trim|required|min_length[6]|max_length[50]|xss_clean|matches[passwordConf]|md5'
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
				'rules'		=> 'trim|required|integer|exact_length[13]'
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
				'rules'		=> 'trim|required|integer|max_length[20]'
			),
			array(
				'field'		=> 'email',
				'label'		=> 'E-mail',
				'rules'		=> 'trim|required|valid_email|max_length[255]'
			),
			array(
				'field'		=> 'job',
				'label'		=> 'อาชีพ',
				'rules'		=> 'trim|max_length[255]'
			),
			array(
				'field'		=> 'job_area',
				'label'		=> 'สถานที่ทำงาน/เรียน',
				'rules'		=> 'trim|max_length[255]'
			),
			array(
				'field'		=> 'favorite_artist',
				'label'		=> 'ศิลปินคนโปรด',
				'rules'		=> 'trim|required|max_length[255]'
			)
		);
	}

	function get_profile_rules(){
		return array(
			array(
				'field'		=> 'password_old',
				'label'		=> 'รหัสผ่านเดิม',
				'rules'		=> 'trim|xss_clean|md5|callback_check_profile_pass_old'
			),
			array(
				'field'		=> 'password_new',
				'label'		=> 'รหัสผ่านใหม่',
				'rules'		=> 'trim|min_length[6]|max_length[50]|xss_clean|md5|callback_check_profile_pass_new'
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
				'rules'		=> 'trim|required|integer|exact_length[13]'
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
				'rules'		=> 'trim|required|integer|max_length[20]'
			),
			array(
				'field'		=> 'email',
				'label'		=> 'E-mail',
				'rules'		=> 'trim|required|valid_email|max_length[255]'
			),
			array(
				'field'		=> 'job',
				'label'		=> 'อาชีพ',
				'rules'		=> 'trim|max_length[255]'
			),
			array(
				'field'		=> 'job_area',
				'label'		=> 'สถานที่ทำงาน/เรียน',
				'rules'		=> 'trim|max_length[255]'
			),
			array(
				'field'		=> 'favorite_artist',
				'label'		=> 'ศิลปินคนโปรด',
				'rules'		=> 'trim|required|max_length[255]'
			)
		);
	}

}