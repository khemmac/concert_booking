<?php
class Transfer extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		//load model
		$this->load->model('tranfer_model','',TRUE);

		$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
		$this->output->set_header('Cache-Control: max-age=-1281, public, must-revalidate, proxy-revalidate', FALSE);
		$this->output->set_header('Pragma: no-cache');
	}

	function index(){
		if(!is_user_session_exist($this))
			redirect('member/login?rurl='.uri_string());
		$file_path = FCPATH."fileuploads/";
		$rules = array(
					array(
						'field'		=> 'code',
						'label'		=> 'รหัสจอง',
						'rules'		=> 'trim|required|min_length[7]|max_length[7]|xss_clean||callback_check_code_valid'
					),
					array(
						'field'		=> 'pay_money',
						'label'		=> 'จำนวนเงินที่โอน',
						'rules'		=> 'trim|required|numeric'
					)
				);
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == FALSE) {
			$this->phxview->RenderView('transfer');
			$this->phxview->RenderLayout('default');
		} else {
			$img_name ="";
			/*if(isset($_FILES['slip']['name'])){
				$date = new DateTime();
				$time = $date->getTimestamp();
				$path = $_FILES['slip']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				$img_name = $time.'.'.$ext;
				move_uploaded_file($_FILES['slip']['tmp_name'],$file_path.$img_name);
			}*/
			
			$this->tranfer_model->money_tranfer($img_name);
			redirect('booking/complete', 'refresh');
		}
	}

	function check_code_valid(){
		$result = $this->tranfer_model->loadBooking();
		//if(!empty($result)){
		if($result->num_rows() > 0) {
			return true;
		}else{
			$this->form_validation->set_message('check_code_valid', 'ไม่พบข้อมูลรหัสจองนี้!');
			return false;
		}
	}

}
