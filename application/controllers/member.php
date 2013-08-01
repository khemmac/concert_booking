<?php
class Member extends CI_Controller {


	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		// load model
		$this->load->model('person_model','',TRUE);

		$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
		$this->output->set_header('Cache-Control: max-age=-1281, public, must-revalidate, proxy-revalidate', FALSE);
		$this->output->set_header('Pragma: no-cache');
	}

	function index(){
		redirect('member/login');
	}

	function login(){
		$rules = array(
					array(
						'field'		=> 'username',
						'label'		=> 'Username',
						'rules'		=> 'trim|required|min_length[5]|max_length[12]|xss_clean'
					),
					array(
						'field'		=> 'password',
						'label'		=> 'Password',
						'rules'		=> 'trim|required|md5|xss_clean|callback_check_user_pass'
					)
				);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == FALSE)
		{
			$this->phxview->RenderView('login');
			$this->phxview->RenderLayout('default');
		} else {
			redirect('index', 'refresh');
		}
	}

	function logout(){
		delete_user_session($this);
		redirect('index', 'refresh');
	}

	function register(){
		$rules = $this->person_model->get_register_rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE)
		{
			$this->phxview->RenderView('register');
			$this->phxview->RenderLayout('default');
		}else{
			$this->person_model->save();

			redirect('register_success');
		}
	}
	// http://ellislab.com/codeigniter/user-guide/libraries/form_validation.html#callbacks
	public function username_check($username)
	{
		$this->db->select('id');
		$this->db->from('person');
		$this->db->where('username', $username);
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() > 0) {
			$this->form_validation->set_message('username_check', 'มีคนใช้ %s &quot;'.$username.'&quot; แล้ว ลองใช้ชื่ออื่น');
			return false;
		} else {
			return true;
		}
	}

	//http://www.codefactorycr.com/login-with-codeigniter-php.html
	public function check_user_pass($password)
	{
		//Field validation succeeded.  Validate against database
		$username = $this->input->post('username');

		//query the database
		$result = $this->person_model->login($username, $password);

		if(!empty($result)){
			$sess_array = array();
			foreach($result as $row){
				$sess_array = array(
					'id' => $row->id,
					'username' => $row->username
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return true;
		}else{
			$this->form_validation->set_message('check_user_pass', '&quot;Username&quot; หรือ &quot;รหัสผ่าน&quot; ไม่ถูกต้อง');
			return false;
		}
	}

	function render_email(){
		$this->phxview->RenderView('email/register-success');
		$this->phxview->RenderLayout('empty');
	}



} // end class


