<?php
class Zone extends CI_Controller {


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

		$booking_data = $this->seat_model->load_booking_seat();

		$this->phxview->RenderView('zone', $booking_data);
		$this->phxview->RenderLayout('default');
	}

	function submit(){
		redirect('booking');
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

}