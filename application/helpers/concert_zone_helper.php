<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



	function zone_helper_get_zone($zone_name) {
		$zone = array(
			array(
				'name'=>'e1a',
				'seat'=>array(
					'q'=>'1-13',
					'r'=>'1-13',
					's'=>'1-13',
					't'=>'1-13',
					'u'=>'1-13',
					'v'=>'1-13'
				)
			),
			array(
				'name'=>'e1b',
				'seat'=>array(
					'j'=>'1-2',
					'k'=>'1-4',
					'l'=>'1-6',
					'm'=>'1-8',
					'n'=>'1-10',
					'p'=>'1-12',
					'q'=>'1-20',
					'r'=>'1-20',
					's'=>'1-20',
					't'=>'1-20',
					'u'=>'1-20',
					'v'=>'1-20'
				)
			)
		);
		return $zone;
	}