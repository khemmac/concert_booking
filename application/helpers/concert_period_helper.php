<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	//secure your snippet from external access
	function period_helper_is_test(){
		return $_SERVER["SERVER_NAME"]=='localhost';
	}

	function period_helper_pre_register() {
		$is_test = period_helper_is_test();
		$cur_time = strtotime("now");
		if($is_test){
			return false;
		}else{
			return (($cur_time >= strtotime('2013-09-12 08:00:00')) && ($cur_time <= strtotime('2013-09-13 09:00:00')));
		}
	}
	function period_helper_pass_pre_register() {
		$is_test = period_helper_is_test();
		$cur_time = strtotime("now");
		if($is_test){
			return true;
		}else{
			return (($cur_time >= strtotime('2013-09-13 09:00:00')));
		}
	}

	function period_helper_fanzone() {
		$is_test = period_helper_is_test();
		$cur_time = strtotime("now");
		if($is_test){
			return true;
		}else{
			return (($cur_time >= strtotime('2013-09-13 09:00:00')) && ($cur_time <= strtotime('2013-09-20 12:00:00')));
		}
	}

	function period_helper_early() {
		$is_test = period_helper_is_test();
		$cur_time = strtotime("now");
		if($is_test){
			return true;
		}else{
			return (($cur_time >= strtotime('2013-09-14 08:30:00')) && ($cur_time <= strtotime('2013-09-14 23:30:00')));
		}
	}

	function period_helper_presale() {
		$is_test = period_helper_is_test();
		$cur_time = strtotime("now");
		if($is_test){
			return true;
		}else{
			return (($cur_time >= strtotime('2013-09-15 08:30:00')) && ($cur_time <= strtotime('2013-09-18 12:00:00')));
		}
	}