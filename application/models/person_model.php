<?php
Class Person_model extends CI_Model
{
	function login($username, $password){
		$this->db->select('id, username');
		$this->db->from('person');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() == 1) {
			set_user_session($this, $query->first_row('array'));
			return $query->result();
		} else {
			return false;
		}
	}

	function save(){
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

	function get_register_rules(){
		return array(
			array(
				'field'		=> 'username',
				'label'		=> 'User name',
				'rules'		=> 'trim|required|min_length[5]|max_length[12]|xss_clean|callback_username_check'
			),
			array(
				'field'		=> 'password',
				'label'		=> 'รหัสผ่าน',
				'rules'		=> 'trim|required|min_length[6]|max_length[100]|xss_clean|matches[passwordConf]|md5'
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
	}

}