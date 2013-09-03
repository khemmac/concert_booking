<?php
class Zone_early extends CI_Controller {


	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		// load model
		$this->load->model('booking_model','',TRUE);
		$this->load->model('seat_model','',TRUE);

		$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
		$this->output->set_header('Cache-Control: max-age=-1281, public, must-revalidate, proxy-revalidate', FALSE);
		$this->output->set_header('Pragma: no-cache');
	}

	function index(){
		if(!is_user_session_exist($this))
			redirect('member/login?rurl='.uri_string());
		$user_id = get_user_session_id($this);

		$reach_limit = $this->booking_model->reach_limit($user_id);
		if($reach_limit){
			redirect('booking/check?popup=seat-limit-popup');
			return;
		}

		// check condition
		$booking_id = $id = end($this->uri->segments);
		if(is_numeric($booking_id)){
			// load booking
			$this->db->limit(1);
			$query = $this->db->get_where('booking', array(
				'id'=>$booking_id,
				'status'=>1
			));
			if($query->num_rows()<=0){
				// prepare booking data
				$booking_id = $this->booking_model->prepare($user_id);
				redirect('zone_early/'.$booking_id);
				return;
			}
		}else{
			// prepare booking data
			$booking_id = $this->booking_model->prepare($user_id);
			redirect('zone_early/'.$booking_id);
			return;
		}


		$booking_data = $this->seat_model->load_booking_seat($booking_id);
		// populate data
		$result = array(
			'booking_id'=>$booking_id,
			'zones'=>array(),
			'seats'=>array(),
			'price'=>0
		);
		foreach($booking_data AS $b_data){
			$exist = false;
			foreach($result['zones'] AS $r_zone){
				if($b_data['zone_name']==$r_zone){
					$exist = true; break;
				}
			}
			if(!$exist)
				array_push($result['zones'], $b_data['zone_name']);

			array_push($result['seats'], $b_data['seat_name']);

			$result['price']+=$b_data['price'];
		}

		$this->phxview->RenderView('zone-early', $result);
		$this->phxview->RenderLayout('default');
	}

	function submit(){
		if(!is_user_session_exist($this))
			redirect('member/login');
		$user_id = get_user_session_id($this);

		$booking_id = $this->input->post('booking_id');
		$booking_data = $this->seat_model->load_booking_seat($booking_id);

		if(count($booking_data)>0)
			redirect('booking/'.$booking_id);
		else
			redirect('zone_early/'.$booking_id.'?popup=zone-blank-seat-popup');
	}

	function soldout(){
		$this->phxview->RenderView('zone-early-soldout');
		$this->phxview->RenderLayout('default');
	}

}