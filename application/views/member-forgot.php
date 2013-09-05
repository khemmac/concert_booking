<div id="content-body" class="page-forgot">
	<?=$this->load->view('includes/inc-main-menu','', TRUE)?>

	<div id="dialog">
		<?= form_open(); ?>
		<?php
			$forms = array(
				array(
					'name'		=> 'username',
					'maxlength'	=> '200',
					'class'		=> 'username',
					'value'		=> ''
				),
				array(
					'name'		=> 'question',
					'class'		=> 'question',
					'type'		=> 'dropdown',
					'options'	=> array('สัตว์เลี้ยงตัวแรกของคุณชื่ออะไร?'=>'สัตว์เลี้ยงตัวแรกของคุณชื่ออะไร?',
										'เพื่อนสนิทสมัยวัยรุ่นของคุณชื่ออะไร?'=>'เพื่อนสนิทสมัยวัยรุ่นของคุณชื่ออะไร?',
										'อาหารจานแรกที่คุณหัดทำคืออะไร?'=>'อาหารจานแรกที่คุณหัดทำคืออะไร?',
										'คุณขึ้นเครื่องบินไปที่ไหนครั้งแรก?'=>'คุณขึ้นเครื่องบินไปที่ไหนครั้งแรก?'
									)
				),
				array(
					'name'		=> 'answer',
					'class'		=> 'answer',
					'maxlength'	=> '255'
				),
				array(
					'name'		=> 'password',
					'class'		=> 'password',
					'maxlength'	=> '50',
					'readonly'	=> 'readonly'
				)
			);
			form_helper_generate_form($forms);
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
