<?php
class Transfer extends CI_Controller {


	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		//load model
		$this->load->model('tranfer_model','',TRUE);

		$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
		$this->output->set_header('Cache-Control: max-age=-1281, public, must-revalidate, proxy-revalidate', FALSE);
		$this->output->set_header('Pragma: no-cache');
	}

	function index(){
		if(!is_user_session_exist($this))
			redirect('member/login?rurl='.uri_string());

		$rules = array(
					array(
						'field'		=> 'code',
						'label'		=> 'รหัสจอง',
						'rules'		=> 'trim|required|min_length[14]|max_length[14]|xss_clean'
					),
					array(
						'field'		=> 'time',
						'label'		=> 'เวลาที่โอนเงิน',
						'rules'		=> 'trim|required|exact_length[5]'
					),
					array(
						'field'		=> 'pay_money',
						'label'		=> 'จำนวนเงินที่โอน',
						'rules'		=> 'trim|required|numeric'
					)
				);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == FALSE) {
			$this->phxview->RenderView('transfer');
			$this->phxview->RenderLayout('default');
		} else {
			$res = $this->tranfer_model->money_tranfer();
			
			echo $res["success"];
			
			/*
			if($res->success == 'true'){
				redirect('booking/complete', 'refresh');
			}else{
				
			}*/
			
		}
	}

}
