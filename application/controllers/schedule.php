<?php
class Schedule extends CI_Controller {


	function __construct()
	{
		parent::__construct();

		$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
		$this->output->set_header('Cache-Control: max-age=-1281, public, must-revalidate, proxy-revalidate', FALSE);
		$this->output->set_header('Pragma: no-cache');
	}

	function index(){
		$this->load->helper('path');
		$cache_path = set_realpath(APPPATH.'logs/schedule');

		$fname =  date('m-d-H-i-s').'.txt';
		$fh = fopen($cache_path . $fname, 'w');
		$str = 'schedule has call'.PHP_EOL;
		fwrite($fh, $str);
		fclose($fh);

		echo 'success';
	}

}