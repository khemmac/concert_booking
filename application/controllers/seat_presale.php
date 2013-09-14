<?php
class Seat_presale extends CI_Controller {


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
		$booking_type = 2;

		$this->benchmark->mark('overall_start');

		if(!is_user_session_exist($this))
			redirect('member/login?rurl='.uri_string());
		$user_id = get_user_session_id($this);

		// ถ้า user มีการจองไปแล้วให้ redirect ไปที่หน้าตรวจสอบสถานะ
		$has_booked = $this->booking_model->has_booked($user_id, $booking_type);
		if($has_booked){
			redirect('booking/check?popup=zone-booked-limit-popup');
			return;
		}

		$zone_name = $this->uri->segment(2);
		$zone = zone_helper_get_zone($zone_name);

		$valid_zone = array('a1','a2','a4','a5','d1','b1','b2','b3','b4','b5','d2','c1','c2','c3');
		if(!in_array(strtolower($zone_name), $valid_zone))
			redirect('zone_presale');

		// find zone
		if(empty($zone_name) || empty($zone))
			redirect('zone_presale');

		$this->db->limit(1);
		$query = $this->db->get_where('zone', array(
			'name'=>$zone_name
		));
		if($query->num_rows()<=0)
			redirect('zone_presale');

		$zone_data = $query->first_row('array');

		// load blank seat
		$this->db->select('id');
		$this->db->limit(6);
		$this->db->where('booking_id IS NULL');
		$query = $this->db->get_where('seat', array(
			'zone_id'=>3,
			'is_booked'=>0
		));
		$result = $query->result_array();
		$query->free_result();
		// ถ้า seat ที่ว่างมีน้อยกว่าที่เลือก
		if(count($result)<6){
			redirect('seat_presale/soldout/'.$zone_name);
		}

		// check booking id
		$booking_id = 0;
		$booking_id = $this->booking_model->prepare($user_id, $booking_type);

		$this->phxview->RenderView('seat-presale', array(
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
		$booking_id = $this->input->post('booking_id');
		if(!is_numeric($booking_id)){
			redirect('seat_presale');
			return;
		}

		// check seat_count
		$seat_count = $this->input->post('seat_count');
		if($seat_count<=0){
			redirect('seat_presale');
			return;
		}

		$zone_id= $this->input->post('zone_id');
		$zone_name = $this->input->post('zone_name');
		// check zone
		if(empty($zone_id) || empty($zone_name))
			redirect('zone_presale');

		// check limit
		$this->db->select('count(id) AS cnt');
		$this->db->where('booking_id IN (SELECT booking.id FROM booking WHERE person_id='.$user_id.')');
		$query = $this->db->get('seat');
		$cnt_result = $query->first_row('array');
		$cnt = $cnt_result['cnt'];
		if($cnt + $seat_count > $booking_limit){
			redirect('seat_presale/'.$zone_name.'?popup=seat-limit-popup');
			return;
		}

		// load blank seat ตรวจหาว่ามีที่เหลือพอหรือไม่
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
		if(count($result)<6){
			redirect('zone_presale/'.$zone_name.'/soldout');
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

			redirect('zone_presale');
		}

	}

	function soldout(){
		$zone_name = $this->uri->segment(3);
		$this->phxview->RenderView('seat-presale-soldout', array(
			'zone'=>array('name'=>$zone_name)
		));
		$this->phxview->RenderLayout('default');
	}

}