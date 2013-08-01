
<div id="content-body" class="page-login">
	<?=$this->load->view('includes/inc-menu-1','', TRUE)?>

	<div id="dialog">
		<?= form_open(); ?>
		<?php
			$forms = array(
				array(
					'name'		=> 'username',
					'maxlength'	=> '20',
					'class'		=> 'username',
					'value'		=> ''
				),
				array(
					'name'		=> 'password',
					'type'		=> 'password',
					'class'		=> 'password',
					'maxlength'	=> '100',
					'value'		=> ''
				)
			);
			foreach ($forms as $key => $value) {
				$form_error = form_error($value['name']);
				if(!empty($form_error)){
					$value['qtip-data'] = $form_error;
				}
				$__set_value = set_value($value['name']);

				if(!empty($value['type']) && $value['type']=='password'){
					echo form_password($value);
				}else{
					if(!empty($__set_value))
						$value['value'] = $__set_value;
					echo form_input($value);
				}
			};
		?>
		<ul id="sub-menu">
			<li><a href="register" class="sub-menu-1"></a></li>
			<li><a href="forgot" class="sub-menu-2"></a></li>
		</ul>
		<?= form_submit(array(
				'id'		=> 'submit',
				'value'		=> 'Submit',
				'class'		=> 'submit'
			));
		?>
		<?= form_close() ?>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('.page-login #submit').click(function(){
			setTimeout(function(){
				$(this).attr('disabled', 'disabled');
			}, 1);
		});
	});
</script>
