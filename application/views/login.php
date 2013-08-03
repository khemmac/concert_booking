<div id="content-body" class="page-login">
	<?=$this->load->view('includes/inc-main-menu','', TRUE)?>

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
			form_helper_generate_form($forms);
		?>
		<ul id="sub-menu">
			<li><a href="register" class="sub-menu-1"></a></li>
			<li><a href="forgot" class="sub-menu-2"></a></li>
		</ul>
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
		$('.page-login #submit').click(function(){
			setTimeout(function(){
				$(this).attr('disabled', 'disabled');
			}, 1);
		});
	});
</script>
