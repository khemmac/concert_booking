<?php
	$errors_message = $this->session->flashdata('errors_message');
?>
<div id="content-body" class="page-booking-check">
	<?=$this->load->view('includes/inc-menu-2','', TRUE)?>

	<div id="dialog">
		<?= form_open('controller/form_booking/check'); ?>
		<?php
			$code = array(
				'name'		=> 'code',
				'maxlength'	=> '20',
				'class'		=> 'code',
				'value'		=> ''
			);
			if(!empty($errors_message['code'])){
				$username['qtip-data'] = $errors_message['code'];
			}
			echo form_input($code);
		?>
		<?= form_submit(array(
				'id'		=> 'submit',
				'value'		=> '',
				'class'		=> 'submit'
			));
		?>
		<?= form_close() ?>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('#submit').click(function(){
			setTimeout(function(){
				$(this).attr('disabled', 'disabled');
			}, 1);
		});
	});
</script>
