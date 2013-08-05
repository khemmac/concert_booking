<?php
class Seat extends CI_Controller {


	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
		$this->output->set_header('Cache-Control: max-age=-1281, public, must-revalidate, proxy-revalidate', FALSE);
		$this->output->set_header('Pragma: no-cache');
	}

	function index(){
		if(!is_user_session_exist($this))
			redirect('member/login');

		$zone_name = $this->uri->segment(2);

		$zone = zone_helper_get_zone($zone_name);

		// find zone
		if(empty($zone_name) || empty($zone))
			redirect('zone');

		// load booking datas
		// ...

		// populating data
		$zone_data = array(
			'zone'=>$zone['name'][0],
			'class'=>$zone['name'][1],
			'blog'=>$zone['name'][2]
		);
		$zone_data['name'] = $zone['name'];
		$zone_data['max_col'] = $zone['max_col'];

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
			$zone_data['seats'][$row_name] = array();
			foreach ($zone['position'] AS $p_row_name => $position_seat) {
				// check row is match
				if($row_name==$p_row_name){
					$row_seat = split_seat($row_seat);
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
/*
						if(empty($pos_seat[$row_seat_key])){
							echo 'Could not find position at : '.$row_name.' - '.$row_seat_key;
							echo '<br />';
							echo 'ROW ('.$row_name.') : ';
							print_r($row_seat);
							echo '<hr />';
							echo 'POSITION ('.$row_name.') : ';
							print_r($pos_seat);
						}
						array_push($zone_data['seats'][$row_name], array(
							'no'=>$row_seat_value,
							'position'=>$pos_seat[$row_seat_key]
						));
*/
					}
					break;
				}
			}
		}

		//print_r($zone_data);
		//return;

		$this->phxview->RenderView('seat', array(
			'zone'=>$zone_data
		));
		$this->phxview->RenderLayout('default');
	}

	function submit(){
		print_r($this->input->post('seat'));
		//redirect('zone');
	}

}