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
				$years[$i] = language_helper_is_th($this)?($i+543):$i;

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
					'maxlength'	=> '50'
				),
				array(
					'name'		=> 'passwordConf',
					'type'		=> 'password',
					'class'		=> 'password-confirm',
					'maxlength'	=> '50'
				),
				array(
					'name'		=> 'question',
					'class'		=> 'question',
					'type'		=> 'dropdown',
					'options'	=> array('สัตว์เลี้ยงตัวแรกของคุณชื่ออะไร?'=>language_helper_is_th($this)?'สัตว์เลี้ยงตัวแรกของคุณชื่ออะไร?':'Your first pet\'s name?',
										'เพื่อนสนิทสมัยวัยรุ่นของคุณชื่ออะไร?'=>language_helper_is_th($this)?'เพื่อนสนิทสมัยวัยรุ่นของคุณชื่ออะไร?':'What is your teenage best friend\'s name?',
										'อาหารจานแรกที่คุณหัดทำคืออะไร?'=>language_helper_is_th($this)?'อาหารจานแรกที่คุณหัดทำคืออะไร?':'What is the first dish you cooked?',
										'คุณขึ้นเครื่องบินไปที่ไหนครั้งแรก?'=>language_helper_is_th($this)?'คุณขึ้นเครื่องบินไปที่ไหนครั้งแรก?':'What is the destination you fly to?'
									)
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
					'options'	=> array('M'=>language_helper_is_th($this)?'ชาย':'Male', 'F'=>language_helper_is_th($this)?'หญิง':'Female')
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
					'options'	=> array('1'=>language_helper_is_th($this)?'มกราคม':'January',
										'2'=>language_helper_is_th($this)?'กุมภาพันธ์':'Febuary',
										'3'=>language_helper_is_th($this)?'มีนาคม':'March',
										'4'=>language_helper_is_th($this)?'เมษายน':'April',
										'5'=>language_helper_is_th($this)?'พฤษภาคม':'May',
										'6'=>language_helper_is_th($this)?'มิถุนายน':'June',
										'7'=>language_helper_is_th($this)?'กรกฎาคม':'July',
										'8'=>language_helper_is_th($this)?'สิงหาคม':'August',
										'9'=>language_helper_is_th($this)?'กันยายน':'September',
										'10'=>language_helper_is_th($this)?'ตุลาคม':'October',
										'11'=>language_helper_is_th($this)?'พฤศจิกายน':'November',
										'12'=>language_helper_is_th($this)?'ธันวาคม':'December'
									)
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
					'maxlength'	=> '10'
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

			foreach($forms as $f):
				echo '<span class="req req-'.$f['name'].'">*</span>';
			endforeach;
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
		// number only
		$('input[name=code]').numeric({ decimal: false, negative: false });

		$('#submit').click(function(){
			var bd = $('select[name=birth_date]').val(),
				bm = $('select[name=birth_month]').val(),
				by = $('select[name=birth_year]').val();
			if(!common.form.isValidDate(by,bm,bd)){
				alert(language_helper_is_th($this)?'วันที่ผิดพลาด กรุณาตรวจสอบอีกครั้ง':'Date is invalid please try again.');
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

		// number only
		$('input[name=tel]').numeric({ decimal: false, negative: false });
	});
</script>
