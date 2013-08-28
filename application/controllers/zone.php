<?php
class Zone extends CI_Controller {


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
		$user_id = get_user_session_id($this);

		$reach_limit = $this->booking_model->reach_limit($user_id);
		if($reach_limit){
			redirect('booking/check');
			return;
		}

		$booking_data = $this->seat_model->load_booking_seat();
		// populate data
		$result = array(
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

		$this->phxview->RenderView('zone', $result);
		$this->phxview->RenderLayout('default');
	}

	function submit(){
		if(!is_user_session_exist($this))
			redirect('member/login');
		$user_id = get_user_session_id($this);

		$booking_data = $this->seat_model->load_booking_seat();

		if(count($booking_data)>0)
			redirect('booking');
		else
			redirect('zone?popup=zone-blank-seat-popup');
	}

	function generate(){
		function split_seat($s){
			$result = array();
			$pitted_seat = explode(',', $s);
			foreach($pitted_seat as $value){
				$ordered_seat = explode('-', $value);
				$ordered_start = $ordered_seat[0];
				if(!empty($ordered_seat[1])){
					$ordered_end = $ordered_seat[1];
					for($i=$ordered_start; $i<=$ordered_end; $i++){
						array_push($result, $i);
					}
				}else{
					array_push($result, $ordered_start);
				}
			}
			return $result;
		}

		$this->db->trans_start();
		$this->db->query('alter table seat DROP FOREIGN KEY r_zone_seart_1_M');
		$this->db->query('TRUNCATE TABLE zone');
		$this->db->query('TRUNCATE TABLE seat');
		$this->db->query('Alter table seat add Constraint r_zone_seart_1_M Foreign Key (zone_id) references zone (id) on delete  restrict on update  restrict;');

		$zones = zone_helper_get_zone();
		foreach($zones AS $zone){
			$zone_name = $zone['name'];

			$price = 0;
			if($zone_name[1]=='1')
				$price = 6000;
			else if($zone_name[1]=='2')
				$price = 5000;
			else if($zone_name[1]=='3')
				$price = 3000;
			$this->db->set('name', $zone_name);
			$this->db->set('price', $price);
			$this->db->set('createDate', 'NOW()', false);
			$this->db->insert('zone');

			$zone_id = $this->db->insert_id();
			echo '<h3>'.$zone_id.'</h3>';

			echo $zone_name.'<hr />';
			foreach($zone['seat'] AS $row_name => $row_seat){
				//$zone_data['seats'][$row_name] = array();
				foreach ($zone['position'] as $p_row_name => $position_seat) {
					// check row is match
					if($row_name==$p_row_name){
						$row_seat = split_seat($row_seat);
						$pos_seat = split_seat($position_seat);
						foreach($row_seat AS $row_seat_key => $row_seat_value)
						{
							$seat_name = $row_name.$row_seat_value;
							echo $seat_name.'<hr />';
							$this->db->set('zone_id', $zone_id);
							$this->db->set('name', $seat_name);
							$this->db->set('is_booked', 0);
							$this->db->set('is_soldout', 0);
							$this->db->set('createDate', 'NOW()', false);
							$this->db->insert('seat');
							//array_push($zone_data['seats'][$row_name], array(
							//	'no'=>$row_seat_value,
							//	'position'=>$pos_seat[$row_seat_key]
							//));
						}
						break;
					}
				}
			}
			//break;
		}

		$this->db->trans_complete();
	}

	function create_cache(){
		$this->benchmark->mark('cache_start');

		$this->load->helper('path');
		$cache_path = set_realpath(APPPATH.'cache/zone');
		echo '<hr />';

		echo  APPPATH.'<br />';

		$this->db->select('id, name');
		$query_zone = $this->db->get('zone');
		foreach($query_zone->result() AS $zone){
			$fh = fopen($cache_path.$zone->name.'-'.$zone->id.'.txt', 'w');

			$sql = "SELECT
s.zone_id, z.name AS zone_name
, s.id AS seat_id, s.name AS seat_name
, s.is_booked, s.booking_id, s.is_soldout
, b.person_id, b.status
FROM seat s
LEFT JOIN booking b ON s.booking_id=b.id
JOIN zone z ON s.zone_id=z.id
WHERE s.zone_id=(SELECT z.id FROM zone z WHERE z.name=? LIMIT 1)
ORDER BY s.id ASC";
			$query_seat = $this->db->query($sql, array($zone->name));
			$result_seat = $query_seat->result_array();

			$str = '';
			foreach($result_seat AS $seat){
				$str.=$seat['seat_id'].'|'.$seat['is_booked'].'|'
						.$seat['booking_id'].'|'.$seat['is_soldout'].'|'
						.$seat['person_id'].'|'.$seat['status'].PHP_EOL;
			}
			fwrite($fh, $str);
			fclose($fh);
		}

		$this->benchmark->mark('cache_end');
		echo 'cache : '.$this->benchmark->elapsed_time('cache_start', 'cache_end').'<hr />';

	}

}