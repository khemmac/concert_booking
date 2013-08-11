<?php
class Seat extends CI_Controller {


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
		$this->benchmark->mark('overall_start');

		if(!is_user_session_exist($this))
			redirect('member/login');

		$user_id = get_user_session_id($this);

		$zone_name = $this->uri->segment(2);

		$zone = zone_helper_get_zone($zone_name);

		// find zone
		if(empty($zone_name) || empty($zone))
			redirect('zone');

		// populating result data
		$zone_data = array(
			'zone'=>$zone['name'][0],
			'class'=>$zone['name'][1],
			'blog'=>$zone['name'][2]
		);
		$zone_data['name'] = $zone['name'];
		$zone_data['max_col'] = $zone['max_col'];

		$this->benchmark->mark('get_db_start');
		// get seat from db
		$db_seats = $this->seat_model->load_seat_by_zone($zone_name);
		$zone_data['id'] = $db_seats[0]['zone_id'];
		$booking_seats = $this->seat_model->load_booking_seat();

		$last_index = 0;
		foreach($db_seats AS $k_seat => $seat){
			$is_own = 0;
			for($i=$last_index;$i<count($booking_seats);$i++){
				$o_seat = $booking_seats[$i];
				if($seat['seat_id']==$o_seat['seat_id']){
					$is_own = ($o_seat['status']==1 && $seat['person_id']==$user_id);
					$last_index++;
					break;
				}
			}
			$db_seats[$k_seat]['is_own'] = $is_own;
		}

		$this->benchmark->mark('get_db_end');

		echo 'get_db : '.$this->benchmark->elapsed_time('get_db_start', 'get_db_end').'<hr />';

		$this->benchmark->mark('populate_seat_start');

		// private function
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
		//$row_seat = split_seat($zone['seat']['q']);
		//$pos_seat = split_seat($zone['seat']['q']);
		//print_r(split_seat($zone['seat']['q']));
		//echo '<hr />';
		//print_r(split_seat($zone['position']['q']));
		//return;

		$zone_data['seats'] = array();

		foreach($zone['seat'] AS $row_name => $row_seat){
			if(empty($row_seat) || strlen(trim($row_seat))<=0)
				continue;

			$zone_data['seats'][$row_name] = array();
			foreach ($zone['position'] AS $p_row_name => $position_seat) {
				// check row is match
				if($row_name==$p_row_name){
					// ข้อมูลที่นั่งในแถว
					$row_seat = split_seat($row_seat);
					// ข้อมูลที่ตำแหน่งที่นั่ง
					$pos_seat = split_seat($position_seat);

					for($i=1;$i<=$zone_data['max_col'];$i++){
						$position_match = false;
						$result_no = -1;
						$result_position = $i;

						foreach($row_seat AS $row_seat_key => $row_seat_value)
						{
							// $row_seat_key คือ index ของตำแหน่งที่นั่ง
							// $row_seat_value คือ ตำแหน่งที่นั่ง

							if(empty($pos_seat[$row_seat_key])){
								echo 'Could not find position at : '.$row_name.' - '.$row_seat_key;
								echo '<br />';
								echo 'ROW ('.$row_name.') : ';
								print_r($row_seat);
								echo '<hr />';
								echo 'POSITION ('.$row_name.') : ';
								print_r($pos_seat);
							}

							if($i==$pos_seat[$row_seat_key]){
								$position_match = true;
								$result_no = $row_seat_value;
								$result_position = $pos_seat[$row_seat_key];
								break;
							}
						}
						array_push($zone_data['seats'][$row_name], array(
							'no'=>$result_no,
							'position'=>$result_position
						));
					}
					break;
				}
			}
		}
		$this->benchmark->mark('populate_seat_end');
		echo 'populate_seat : '.$this->benchmark->elapsed_time('populate_seat_start', 'populate_seat_end').'<hr />';

		foreach($db_seats AS $db_seat){
			$db_seat_name = $db_seat['seat_name'];
			$db_row_name = substr($db_seat_name, 0, 1);

			foreach($zone_data['seats'] AS $row_name => $row_seats){
				if($db_row_name==$row_name){
					foreach($row_seats AS $seat_key => $seat){
						if($seat['no']!=-1){
							if($db_seat_name==$row_name.$seat['no']){
								$zone_data['seats'][$row_name][$seat_key]['id'] = $db_seat['seat_id'];
								$zone_data['seats'][$row_name][$seat_key]['is_booked'] = $db_seat['is_booked'];
								$zone_data['seats'][$row_name][$seat_key]['is_soldout'] = $db_seat['is_soldout'];
								$zone_data['seats'][$row_name][$seat_key]['is_own'] = $db_seat['is_own'];
								break;
							}
						}
					}
					break;
				}
			}
		}
		$zone_data['current_booking_count'] = 0;
		for($i=0;$i<count($booking_seats);$i++){
			$zone_data['current_booking_count']++;
		}

		//print_r($zone_data);
		//return;

		$this->phxview->RenderView('seat', array(
			'zone'=>$zone_data
		));
		$this->phxview->RenderLayout('default');

		$this->benchmark->mark('overall_end');

		echo 'overall : '.$this->benchmark->elapsed_time('overall_start', 'overall_end').'<hr />';
	}

	function submit(){
		if(!is_user_session_exist($this))
			redirect('member/login');
		$user_id = get_user_session_id($this);

		$zone_id= $this->input->post('zone_id');
		$zone_name = $this->input->post('zone_name');
		// find zone
		if(empty($zone_id) || empty($zone_name))
			redirect('zone');

		$seat_array = $this->input->post('seat');
		// find zone
		if(empty($seat_array) || count($seat_array)==0)
			redirect('seat/'.$zone_name);

		// ดึงแค่ข้อมูลที่นั่งที่ถูกจองภายใต้ zone นั้นๆ
		$this->db->select('count(id) AS cnt');
		$this->db->where('zone_id <>', $zone_id);
		$this->db->where_not_in('id', $seat_array);
		$this->db->where('booking_id=(SELECT b.id FROM booking b WHERE b.person_id='.$this->db->escape($user_id).' LIMIT 1)');
		$query = $this->db->get('seat');
		$count_not_in_zone = $query->first_row()->cnt;

		if($count_not_in_zone + count($seat_array)>6){
			redirect('seat/'.$zone_name.'?popup=seat-limit-popup');
			return;
		}else{
			// call sp
			$sql = "CALL sp_booking (?,?,?)";
			$parameters = array($user_id, $zone_id, implode(',', $seat_array));
			$query = $this->db->query($sql, $parameters);

			redirect('zone');
		}

	}

}