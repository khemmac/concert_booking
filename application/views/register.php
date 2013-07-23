<?php
	$errors_message = $this->session->flashdata('errors_message');
?>
<div id="content-body" class="page-register">
	<?=$this->load->view('includes/inc-menu-3','', TRUE)?>

	<div id="form">
		<?= form_open('controller/form_member/register'); ?>
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

			foreach ($forms as $key => $value) {
				if(!empty($errors_message[$value['name']])){
					$value['qtip-data'] = $errors_message[$value['name']];
				}
				if(!empty($value['type']) && $value['type']=='password')
					echo form_password($value);
				else if(!empty($value['type']) && $value['type']=='dropdown'){
					if(!empty($value['value']))
						echo form_dropdown($value['name'], $value['options'], $value['value']);
					else
						echo form_dropdown($value['name'], $value['options']);
				}else
					echo form_input($value);
			}

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
			<li><a href="index"></a></li>
		</ul>
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

		var onSexyBlur = function(parent){
			parent.find('input[type="text"]').on('blur', function(){
				$(this).val(parent.find('select>option:selected').text());
			});
		};

		comboQuestion = $('select[name=question]');
		comboQuestion.sexyCombo({
			triggerSelected: true,
			skin: 'custom',
			initCallback: function() {
				comboQuestion.parent('.combo').addClass('sexy-combo-question');
			}
		});

		comboSex = $('select[name=sex]');
		comboSex.sexyCombo({
			triggerSelected: true,
			skin: 'custom',
			initCallback: function() {
				var parent = comboSex.parent('.combo');
				parent.addClass('sexy-combo-sex');
				onSexyBlur(parent);
			}
		});

		comboDate = $('select[name=birth_date]');
		comboDate.sexyCombo({
			triggerSelected: true,
			skin: 'custom',
			initCallback: function() {
				var parent = comboDate.parent('.combo');
				parent.addClass('sexy-combo-birth_date');
				onSexyBlur(parent);
			}
		});

		comboMonth = $('select[name=birth_month]');
		comboMonth.sexyCombo({
			triggerSelected: true,
			skin: 'custom',
			initCallback: function() {
				var parent = comboMonth.parent('.combo');
				parent.addClass('sexy-combo-birth_month');
				onSexyBlur(parent);
			}
		});

		comboYear = $('select[name=birth_year]');
		comboYear.sexyCombo({
			triggerSelected: true,
			skin: 'custom',
			initCallback: function() {
				var parent = comboYear.parent('.combo');
				parent.addClass('sexy-combo-birth_year');
				onSexyBlur(parent);
			}
		});
	});
</script>
