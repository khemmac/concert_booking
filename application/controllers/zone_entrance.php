<?php
class Zone_entrance extends CI_Controller {


	function __construct()
	{
		parent::__construct();

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
		$user_obj = get_user_session($this);

		$is_usertest = (($user_obj['username']=='testsbs1' || $user_obj['username']=='testsbs2'
			|| $user_obj['username']=='testsbs3' || $user_obj['username']=='testsbs4'
			|| $user_obj['username']=='testsbs5'
			));

		// load user
		if($user_obj['type']==2){
			redirect('zone');
		}else if($user_obj['type']==1){
			if(!period_helper_close()){
				if(period_helper_presale() || $is_usertest)
					redirect('zone_presale');
				else if(period_helper_early() || $is_usertest)
					redirect('zone_early');
				else
					redirect('sbs2013');
			}else
				redirect('zone/close');
		}

	}

}