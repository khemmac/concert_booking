<?php
class Booking extends CI_Controller {


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
			'booking_id'=>((!empty($booking_data) && count($booking_data)>0)?$booking_data[0]['booking_id']:0),
			'booking_list'=>$booking_data
		));
		$this->phxview->RenderLayout('default');
	}

	function booking_submit(){
		if(!is_user_session_exist($this))
			redirect('member/login');
		$user_id = get_user_session_id($this);

		// get booking round
		$booking_round = $this->booking_model->get_booking_round();

		// call sp
		$sql = "CALL sp_booking_confirm (?, ?)";
		$parameters = array($user_id, $booking_round);
		$query = $this->db->query($sql, $parameters);

		if($query->num_rows()>0){
			$r_data = $query->first_row('array');
			redirect('booking/complete/'.$r_data['@booking_id']);
		}else
			redirect('zone');
	}

	function complete(){
		if(!is_user_session_exist($this))
			redirect('member/login');
		$user_id = get_user_session_id($this);

		$booking_id = $this->uri->segment(3);

		if(empty($booking_id) || !is_numeric($booking_id))
			redirect('booking/check');

		// load profile data
		$this->db->select('thName,code');
		$this->db->where('id', $user_id);
		$this->db->limit(1);
		$query = $this->db->get('person');
		$person_data = $query->first_row('array');

		// load booking data
		$this->db->where('id', $booking_id);
		$this->db->limit(1);
		$query = $this->db->get('booking');
		$booking_data = $query->first_row('array');

		// seat data
		$sql = "SELECT
s.zone_id, z.name AS zone_name
, s.id AS seat_id, s.name AS seat_name
, s.booking_id, b.person_id, b.status
, z.price
FROM seat s
JOIN zone z ON s.zone_id=z.id
JOIN booking b ON s.booking_id=b.id AND b.person_id=? AND b.status=2
WHERE  s.booking_id=?
ORDER BY seat_id ASC";
		$query = $this->db->query($sql, array($user_id, $booking_id));
		$booking_list = $query->result_array();
		$zone_distinct_list = array();
		foreach($booking_list AS $b_obj){
			$exist = false;
			foreach($zone_distinct_list AS $z){
				if($b_obj['zone_name']==$z){
					$exist = true; break;
				}
			}
			if(!$exist)
				array_push($zone_distinct_list, $b_obj['zone_name']);
		}

		$this->phxview->RenderView('booking-complete', array(
			'person'=>$person_data,
			'zone_list'=>$zone_distinct_list,
			'booking_data'=>$booking_data,
			'booking_list'=>$booking_list
		));
		$this->phxview->RenderLayout('default');
	}

	function check(){
		if(!is_user_session_exist($this))
			redirect('member/login');
		$user_id = get_user_session_id($this);

		$this->form_validation->set_rules(array(
			array(
				'field'		=> 'code',
				'label'		=> 'รหัสจอง',
				'rules'		=> 'trim|required|exact_length[14]|xss_clean|callback_check_booking_code'
			)
		));

		if ($this->form_validation->run() == FALSE)
		{
			$this->phxview->RenderView('booking-check');
			$this->phxview->RenderLayout('default');
		}else{
			$this->db->select('id');
			$this->db->limit(1);
			$this->db->where(array(
				'person_id'=>$user_id,
				'code'=>$this->input->post('code')
			));
			$query = $this->db->get('booking');
			$result = $query->first_row('array');

			redirect('booking/complete/'.$result['id']);
		}
	}

	// call back for validator
	public function check_booking_code($code)
	{
		$user_id = get_user_session_id($this);

		$this->db->select('id,status');
		$this->db->limit(1);
		$this->db->where(array(
			'person_id'=>$user_id,
			'code'=>$this->input->post('code')
		));
		$query = $this->db->get('booking');

		if($query->num_rows()>0){
			$o = $query->first_row('array');
			$status = $o['status'];
			if($status==1){
				$this->form_validation->set_message('check_booking_code', 'ท่านต้องยืนยันการจอง');
				return false;
			}else if($status==99){
				$this->form_validation->set_message('check_booking_code', 'การจองนี้เลยเวลาชำระเงินไปแล้วค่ะ');
				return false;
			}else{
				return true;
			}
		}else{
			$this->form_validation->set_message('check_booking_code', 'ไม่พบรหัสการจอง');
			return false;
		}
	}

}