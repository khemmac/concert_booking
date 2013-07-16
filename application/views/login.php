<?php
	$errors_message = $this->session->flashdata('errors_message');
?>
<div id="container" class="page-login">
	<ul id="menu">
		<li><a href="#" class="menu-boost">Boost plus</a></li>
		<li><a href="#" class="menu-facebook">Facebook</a></li>
		<li><a href="#" class="menu-1">เลือกโซนที่นั่ง</a></li>
		<li><a href="#" class="menu-2">แจ้งโอนเงิน</a></li>
		<li><a href="#" class="menu-3">ตรวจสอบสถานะบัตร</a></li>
		<li><a href="#" class="menu-4">ข้อกำหนดและเงื่อนไข</a></li>
	</ul>

	<ul id="sub-menu">
		<li><a href="login" class="sub-menu-login">Login</a></li>
		<li><a href="register" class="sub-menu-register">Register</a></li>
	</ul>

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
