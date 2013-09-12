<?php
class Seat_early extends CI_Controller {


	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		// load model
		$this->load->model('cache_model','',TRUE);
		$this->load->model('booking_model','',TRUE);
		$this->load->model('seat_model','',TRUE);

		$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
		$this->output->set_header('Cache-Control: max-age=-1281, public, must-revalidate, proxy-revalidate', FALSE);
		$this->output->set_header('Pragma: no-cache');
	}

	function index(){
		// fix disable session user
		delete_user_session($this);
		redirect('sbs2013');
		return;

		$this->benchmark->mark('overall_start');

		if(!is_user_session_exist($this))
			redirect('member/login?rurl='.uri_string());

		$user_id = get_user_session_id($this);

		$zone_name = 'a3';

		$zone = zone_helper_get_zone($zone_name);

		// find zone
		if(empty($zone_name) || empty($zone))
			redirect('zone_early');

		// check booking id
		$booking_id = $this->uri->segment(2);
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
				redirect('seat_early/'.$booking_id);
				return;
			}
		}else{
			// prepare booking data
			$booking_id = $this->booking_model->prepare($user_id);
			redirect('seat_early/'.$booking_id);
			return;
		}

		$this->db->limit(1);
		$query = $this->db->get_where('zone', array(
			'name'=>$zone_name
		));
		$zone_data = $query->first_row('array');

		$this->phxview->RenderView('seat-early', array(
			'booking_id'=>$booking_id,
			'zone'=>$zone_data
		));
		$this->phxview->RenderLayout('default');

	}

	function submit(){
		if(!is_user_session_exist($this))
			redirect('member/login');
		$user_id = get_user_session_id($this);

		// define global var
		$booking_limit = $this->booking_model->get_booking_limit();

		// check booking id
		$booking_id = $zone_id= $this->input->post('booking_id');
		if(!is_numeric($booking_id)){
			redirect('seat_early');
			return;
		}

		// check seat_count
		$seat_count = $this->input->post('seat_count');
		if($seat_count<=0){
			redirect('seat_early/'.$booking_id);
			return;
		}

		$zone_id= $this->input->post('zone_id');
		$zone_name = $this->input->post('zone_name');
		// check zone
		if(empty($zone_id) || empty($zone_name))
			redirect('zone_early/'.$booking_id);

		// check limit
		$this->db->select('count(id) AS cnt');
		$this->db->where('booking_id IN (SELECT booking.id FROM booking WHERE person_id='.$user_id.')');
		$query = $this->db->get('seat');
		$cnt_result = $query->first_row('array');
		$cnt = $cnt_result['cnt'];
		if($cnt + $seat_count > $booking_limit){
			redirect('seat_early/'.$booking_id.'?popup=seat-limit-popup');
			return;
		}

		// load blank seat
		$this->db->select('id');
		$this->db->limit(6);
		$this->db->where('booking_id IS NULL');
		$query = $this->db->get_where('seat', array(
			'zone_id'=>$zone_id,
			'is_booked'=>0
		));
		$result = $query->result_array();
		$query->free_result();
		// ถ้า seat มีมากกว่าที่เลือก
		if(count($result)<=0){
			redirect('zone_early/soldout');
		}else{
			$loop_limit = (count($result)<=$seat_count)?count($result):$seat_count;

			$ids = array();
			for($i=0;$i<$loop_limit;$i++){
				array_push($ids, $result[$i]['id']);
			}
			$this->db->where_in('id',$ids);
			$this->db->update('seat', array(
				'booking_id'=>$booking_id,
				'is_booked'=>1
			));

			redirect('zone_early/'.$booking_id);
		}

	}

}