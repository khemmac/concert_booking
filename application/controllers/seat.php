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

		$zones = array(
			array(
				'name'=>'e1a',
				'seat'=>array(
					'q'=>'1,2,3,4,5,6,7,8',
					'r'=>'1-13',
					's'=>'1-13',
					't'=>'1-13',
					'u'=>'1-13',
					'v'=>'1-13'
				),
				'position'=>array(
					'q'=>'5,6,7,8,9,10,11,12',
					'r'=>'1-13',
					's'=>'1-13',
					't'=>'1-13',
					'u'=>'1-13',
					'v'=>'1-13'
				)
			)
		);

		// find zone
		if(empty($zones) || count($zones)<=0)
			redirect('zone');

		// load booking datas
		// ...

		// populating data
		$zone = $zones[0];
		$zone_data = array(
			'zone'=>$zone['name'][0],
			'class'=>$zone['name'][1],
			'blog'=>$zone['name'][2]
		);
		$zone_data['name'] = $zone['name'];

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
			foreach ($zone['position'] as $p_row_name => $position_seat) {
				// check row is match
				if($row_name==$p_row_name){
					$row_seat = split_seat($row_seat);
					$pos_seat = split_seat($position_seat);
					foreach($row_seat AS $row_seat_key => $row_seat_value)
					{
						array_push($zone_data['seats'][$row_name], array(
							'no'=>$row_seat_value,
							'position'=>$pos_seat[$row_seat_key]
						));
					}
					break;
				}
			}
		}

		$this->phxview->RenderView('seat', array(
			'zone'=>$zone_data
		));
		$this->phxview->RenderLayout('default');
	}

	function submit(){
		redirect('zone');
	}

}