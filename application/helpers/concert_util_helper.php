<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	//secure your snippet from external access
	function util_helper_add_one_day($dt_str) {
		$date = date_create($dt_str);
		date_add($date, date_interval_create_from_date_string('+ 1 days'));
		return $date;
	}

	function util_helper_add_six_hour($dt_str) {
		$date = date_create($dt_str);
		date_add($date, date_interval_create_from_date_string('+ 6 hours'));
		return $date;
	}

	function util_helper_format_date($dt){
		return date_format($dt, 'd/m/Y');
	}

	function util_helper_format_time($dt){
		return date_format($dt, 'H:i');
	}