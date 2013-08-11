<?php
class Booking extends CI_Controller {


	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		// load model
		$this->load->model('seat_model','',TRUE);

		$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
		$this->output->set_header('Cache-Control: max-age=-1281, public, must-revalidate, proxy-revalidate', FALSE);
		$this->output->set_header('Pragma: no-cache');
	}

	function index(){
		if(!is_user_session_exist($this))
			redirect('member/login');

		// load booking data
		$user_id = get_user_session_id($this);
		$booking_data = $this->seat_model->load_booking_seat();

		// load profile data
		$this->db->select('thName,code');
		$this->db->where('id', $user_id);
		$this->db->limit(1);
		$query = $this->db->get('person');

		$person_data = $query->first_row('array');

		$zone_distinct_list = array();
		foreach($booking_data AS $b_obj){
			$exist = false;
			foreach($zone_distinct_list AS $z){
				if($b_obj['zone_name']==$z){
					$exist = true; break;
				}
			}
			if(!$exist)
				array_push($zone_distinct_list, $b_obj['zone_name']);
		}


		$this->phxview->RenderView('booking', array(
			'person'=>$person_data,
			'zone_list'=>$zone_distinct_list,
			'booking_list'=>$booking_data
		));
		$this->phxview->RenderLayout('default');
	}

	function complete(){
		if(!is_user_session_exist($this))
			redirect('member/login');

		$this->phxview->RenderView('booking-complete.php');
		$this->phxview->RenderLayout('default');
	}

	function check(){
		if(!is_user_session_exist($this))
			redirect('member/login');

		$this->phxview->RenderView('booking-check');
		$this->phxview->RenderLayout('default');
	}

}