<?php
class Index extends CI_Controller {


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
		//$this->phxview->RenderView('index');
		//$this->phxview->RenderLayout('default');
		$this->phxview->RenderView('landing-all');
		$this->phxview->RenderLayout('empty');
	}

	function sbsmtv2013(){
		redirect('sbs2013');
	}

	function sbs2013(){
		//if(period_helper_pre_register() || period_helper_pass_pre_register()){
			$this->phxview->RenderView('index');
			$this->phxview->RenderLayout('default');
		//}else{
		//$this->phxview->RenderView('landing');
		//$this->phxview->RenderLayout('empty');
		//}
	}

	function index2(){
		redirect('sbs2013');
	}

	function index3(){
		$this->phxview->RenderView('home');
		$this->phxview->RenderLayout('default');
	}

	function index4(){
		$this->phxview->RenderView('home-presale');
		$this->phxview->RenderLayout('default');
	}

}