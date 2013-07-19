<?php
	$errors_message = $this->session->flashdata('errors_message');
?>
<div id="content-body" class="page-register">
	<ul id="menu">
		<li><a href="#" class="menu-boost">Boost plus</a></li>
		<li class="menu-register">สมัครสมาชิก</li>
	</ul>

	<div id="form">
		<?= form_open('controller/form_member/register'); ?>
		<?php
			$days = array();
			for($i=1;$i<=31;$i++)
				$days[$i] = $i;


			$years = array();
			for($i=2013;$i>=2013-89;$i--)
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
					'options'	=> $years
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
				else if(!empty($value['type']) && $value['type']=='dropdown')
					echo form_dropdown($value['name'], $value['options']);
				else
					echo form_input($value);
			}

		?>
		<ul id="form-button">
			<li>
				<?= form_submit(array(
						'id'		=> 'submit',
						'value'		=> 'Submit',
						'class'		=> 'submit'
					));
				?>
			</li>
			<li><a href="index">กลับหน้าหลัก</a></li>
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

		comboSex = $('select[name=sex]');
		comboSex.sexyCombo({
			triggerSelected: true,
			skin: 'custom',
			initCallback: function() {
				comboSex.parent('.combo').addClass('sexy-combo-sex');
			}
		});

		comboDate = $('select[name=birth_date]');
		comboDate.sexyCombo({
			triggerSelected: true,
			skin: 'custom',
			initCallback: function() {
				comboDate.parent('.combo').addClass('sexy-combo-birth_date');
			}
		});

		comboMonth = $('select[name=birth_month]');
		comboMonth.sexyCombo({
			triggerSelected: true,
			skin: 'custom',
			initCallback: function() {
				comboMonth.parent('.combo').addClass('sexy-combo-birth_month');
			}
		});

		comboYear = $('select[name=birth_year]');
		comboYear.sexyCombo({
			triggerSelected: true,
			skin: 'custom',
			initCallback: function() {
				comboYear.parent('.combo').addClass('sexy-combo-birth_year');
			}
		});
	});
</script>
