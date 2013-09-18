<?php
class Zone_presale extends CI_Controller {


	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		// load model
		$this->load->model('booking_model','',TRUE);
		$this->load->model('seat_model','',TRUE);
		$this->load->model('early_model','',TRUE);

		$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
		$this->output->set_header('Cache-Control: max-age=-1281, public, must-revalidate, proxy-revalidate', FALSE);
		$this->output->set_header('Pragma: no-cache');
	}

	function index(){
		if(period_helper_close()){
			redirect('zone/close');
			return;
		}

		$booking_type = 2;

		if(!is_user_session_exist($this))
			redirect('member/login?rurl='.uri_string());
		$user_id = get_user_session_id($this);

		// ถ้า user มีการจองไปแล้วให้ redirect ไปที่หน้าตรวจสอบสถานะ
		$has_booked = $this->booking_model->has_booked($user_id, $booking_type);
		if($has_booked){
			redirect('booking/check?popup=zone-booked-limit-popup');
			return;
		}

		$reach_limit = $this->booking_model->reach_limit($user_id);
		if($reach_limit){
			redirect('booking/check?popup=seat-limit-popup');
			return;
		}

		// get current booking id
		$booking_id = 0;
		$booking_id = $this->booking_model->prepare($user_id, $booking_type);

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

			$result['price']+=$b_data['price']-500;
		}

		$this->phxview->RenderView('zone-presale', $result);
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
			redirect('zone_presale?popup=zone-blank-seat-popup');
	}

}