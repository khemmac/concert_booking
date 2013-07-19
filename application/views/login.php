<?php
	$errors_message = $this->session->flashdata('errors_message');
?>
<div id="content-body" class="page-login">
	<?=$this->load->view('includes/inc-menu-1','', TRUE)?>

	<div id="dialog">
		<?= form_open('controller/form_member/login'); ?>
		<?php
			$username = array(
				'name'		=> 'username',
				'maxlength'	=> '20',
				'class'		=> 'username',
				'value'		=> ''
			);
			if(!empty($errors_message['username'])){
				$username['qtip-data'] = $errors_message['username'];
			}
			echo form_input($username);

			$password = array(
				'name'		=> 'password',
				'type'		=> 'password',
				'class'		=> 'password',
				'maxlength'	=> '100',
				'value'		=> ''
			);
			if(!empty($errors_message['password'])){
				$password['qtip-data'] = $errors_message['password'];
			}
			echo form_input($password);
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
