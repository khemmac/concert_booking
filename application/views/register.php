<div id="content-body" class="page-register">
	<?=$this->load->view('includes/inc-main-menu','', TRUE)?>

	<div id="form">
		<?= form_open(); ?>
		<?php
			$days = array();
			for($i=1;$i<=31;$i++)
				$days[$i] = $i;

			$year_start = 2013;
			$years = array();
			for($i=$year_start;$i>=$year_start-89;$i--)
				$years[$i] = ($i+543);

			$forms = array(
				array(
					'name'		=> 'username',
					'maxlength'	=> '20',
					'class'		=> 'username'
				),
				array(
					'name'		=> 'password',
					'type'		=> 'password',
					'class'		=> 'password',
					'maxlength'	=> '100'
				),
				array(
					'name'		=> 'passwordConf',
					'type'		=> 'password',
					'class'		=> 'password-confirm',
					'maxlength'	=> '100'
				),
				array(
					'name'		=> 'question',
					'class'		=> 'question',
					'type'		=> 'dropdown',
					'options'	=> array('สัตว์เลี้ยงตัวแรกของคุณชื่ออะไร?'=>'สัตว์เลี้ยงตัวแรกของคุณชื่ออะไร?')
				),
				array(
					'name'		=> 'answer',
					'class'		=> 'answer',
					'maxlength'	=> '255'
				),
				array(
					'name'		=> 'code',
					'class'		=> 'code',
					'maxlength'	=> '13'
				),
				array(
					'name'		=> 'thName',
					'class'		=> 'thName',
					'maxlength'	=> '255'
				),
				array(
					'name'		=> 'enName',
					'class'		=> 'enName',
					'maxlength'	=> '255'
				),
				array(
					'name'		=> 'nickName',
					'class'		=> 'nickName',
					'maxlength'	=> '100'
				),
				array(
					'name'		=> 'sex',
					'class'		=> 'sex',
					'type'		=> 'dropdown',
					'options'	=> array('M'=>'ชาย', 'F'=>'หญิง')
				),
				array(
					'name'		=> 'birth_date',
					'class'		=> 'birth_date',
					'type'		=> 'dropdown',
					'options'	=> $days
				),
				array(
					'name'		=> 'birth_month',
					'class'		=> 'birth_month',
					'type'		=> 'dropdown',
					'options'	=> array('1'=>'มกราคม', '2'=>'กุมภาพันธ์', '3'=>'มีนาคม',
										'4'=>'เมษายน', '5'=>'พฤษภาคม', '6'=>'มิถุนายน',
										'7'=>'กรกฎาคม', '8'=>'สิงหาคม', '9'=>'กันยายน',
										'10'=>'ตุลาคม', '11'=>'พฤศจิกายน', '12'=>'ธันวาคม')
				),
				array(
					'name'		=> 'birth_year',
					'class'		=> 'birth_year',
					'type'		=> 'dropdown',
					'options'	=> $years,
					'value'		=> $year_start-5
				),
				array(
					'name'		=> 'address',
					'class'		=> 'address',
					'maxlength'	=> '1000'
				),
				array(
					'name'		=> 'tel',
					'class'		=> 'tel',
					'maxlength'	=> '20'
				),
				array(
					'name'		=> 'email',
					'class'		=> 'email',
					'maxlength'	=> '255'
				),
				array(
					'name'		=> 'job',
					'class'		=> 'job',
					'maxlength'	=> '255'
				),
				array(
					'name'		=> 'job_area',
					'class'		=> 'job_area',
					'maxlength'	=> '255'
				),
				array(
					'name'		=> 'favorite_artist',
					'class'		=> 'favorite_artist',
					'maxlength'	=> '255'
				)
			);

			form_helper_generate_form($forms);

		?>
		<ul id="form-button">
			<li>
				<?= form_submit(array(
						'id'		=> 'submit',
						'value'		=> '',
						'class'		=> 'submit'
					));
				?>
			</li>
			<li><a href="<?= site_url('index') ?>"></a></li>
		</ul>
		<?= form_close() ?>
	</div>

</div>
<script type="text/javascript">
	$(function(){
		$('#submit').click(function(){
			var bd = $('select[name=birth_date]').val(),
				bm = $('select[name=birth_month]').val(),
				by = $('select[name=birth_year]').val();
			if(!common.isValidDate(by,bm,bd)){
				alert('วันที่ผิดพลาด กรุณาตรวจสอบอีกครั้ง');
				return false;
			}

			setTimeout(function(){
				$(this).attr('disabled', 'disabled');
			}, 1);
		});

		common.combo.create($('select[name=question]'),		'sexy-combo-question');
		common.combo.create($('select[name=sex]'),			'sexy-combo-sex');
		common.combo.create($('select[name=birth_date]'),	'sexy-combo-birth_date');
		common.combo.create($('select[name=birth_month]'),	'sexy-combo-birth_month');
		common.combo.create($('select[name=birth_year]'),	'sexy-combo-birth_year');

	});
</script>
