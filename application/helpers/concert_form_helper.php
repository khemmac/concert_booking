<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	//secure your snippet from external access
	function form_helper_generate_form($forms) {
		foreach ($forms as $key => $value) {
			$form_error = form_error($value['name']);
			if(!empty($form_error)){
				$value['qtip-data'] = $form_error;
			}

			$__set_value = set_value($value['name']);

			if(!empty($value['type']) && $value['type']=='password'){
				echo form_password($value);
			}else if(!empty($value['type']) && $value['type']=='dropdown'){
				if(!empty($__set_value))
					$value['value'] = $__set_value;

				if(!empty($value['value']))
					echo form_dropdown($value['name'], $value['options'], $value['value']);
				else
					echo form_dropdown($value['name'], $value['options']);
			}else{
				if(!empty($__set_value))
					$value['value'] = $__set_value;
				echo form_input($value);
			}
		}
	}