<?php
	$errors_message = $this->session->flashdata('errors_message');
	print_r($errors_message);
?>
<div id="content-body" class="page-transfer">
	<?=$this->load->view('includes/inc-menu-2','', TRUE)?>

	<div id="form">
		<?= form_open('controller/form_booking/transfer'); ?>
		<?php
			$days = array();
			for($i=1;$i<=31;$i++)
				$days[$i] = $i;


			$years = array();
			for($i=2013;$i>=2013;$i--)
				$years[$i] = ($i+543);

			$forms = array(
				array(
					'name'		=> 'code',
					'maxlength'	=> '20',
					'class'		=> 'code'
				),
				array(
					'name'		=> 'transfer_date',
					'class'		=> 'transfer_date',
					'type'		=> 'dropdown',
					'options'	=> $days
				),
				array(
					'name'		=> 'transfer_month',
					'class'		=> 'transfer_month',
					'type'		=> 'dropdown',
					'options'	=> array('1'=>'มกราคม', '2'=>'กุมภาพันธ์', '3'=>'มีนาคม',
										'4'=>'เมษายน', '5'=>'พฤษภาคม', '6'=>'มิถุนายน',
										'7'=>'กรกฎาคม', '8'=>'สิงหาคม', '9'=>'กันยายน',
										'10'=>'ตุลาคม', '11'=>'พฤศจิกายน', '12'=>'ธันวาคม')
				),
				array(
					'name'		=> 'transfer_year',
					'class'		=> 'transfer_year',
					'type'		=> 'dropdown',
					'options'	=> $years
				),
				array(
					'name'		=> 'time',
					'maxlength'	=> '5',
					'class'		=> 'time'
				),
				array(
					'name'		=> 'pay_money',
					'maxlength'	=> '50',
					'class'		=> 'pay_money'
				),
				array(
					'name'		=> 'bank_name',
					'class'		=> 'bank_name',
					'type'		=> 'dropdown',
					'options'	=> array(
						'ธนาคารกรุงเทพ'=>'ธนาคารกรุงเทพ',
						'ธนาคารกรุงศรีอยุธยา'=>'ธนาคารกรุงศรีอยุธยา',
						'ธนาคารกสิกรไทย'=>'ธนาคารกสิกรไทย',
						'ธนาคารกรุงไทย'=>'ธนาคารกรุงไทย',
						'ธนาคารไทยพาณิชย์'=>'ธนาคารไทยพาณิชย์',
						'ธนาคารทหารไทย'=>'ธนาคารทหารไทย',
						'ธนาคารออมสิน'=>'ธนาคารออมสิน',
						'ธนาคารธนชาต'=>'ธนาคารธนชาต',
						'ธนาคารยูโอบี'=>'ธนาคารยูโอบี',
						'ธนาคารเกียรตินาคิน'=>'ธนาคารเกียรตินาคิน',
						'ธนาคารซีไอเอ็มบีไทย'=>'ธนาคารซีไอเอ็มบีไทย',
						'ธนาคารทิสโก้'=>'ธนาคารทิสโก้',
						//'ธนาคารไทยเครดิตเพื่อรายย่อย'=>'ธนาคารไทยเครดิตเพื่อรายย่อย',
						'ธนาคารแลนด์ แอนด์ เฮาส์ เพื่อรายย่อย'=>'ธนาคารแลนด์ แอนด์ เฮาส์ เพื่อรายย่อย',
						'ธนาคารสแตนดาร์ดชาร์เตอร์ด (ไทย)'=>'ธนาคารสแตนดาร์ดชาร์เตอร์ด (ไทย)',
						//'ธนาคารพัฒนาวิสาหกิจขนาดกลางและขนาดย่อมแห่งประเทศไทย'=>'ธนาคารพัฒนาวิสาหกิจขนาดกลางและขนาดย่อมแห่งประเทศไทย',
						'ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร'=>'ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร',
						//'ธนาคารเพื่อการส่งออกและนำเข้าแห่งประเทศไทย'=>'ธนาคารเพื่อการส่งออกและนำเข้าแห่งประเทศไทย',
						'ธนาคารอาคารสงเคราะห์'=>'ธนาคารอาคารสงเคราะห์',
						'ธนาคารอิสลามแห่งประเทศไทย'=>'ธนาคารอิสลามแห่งประเทศไทย'
					)
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
						'value'		=> '',
						'class'		=> 'submit'
					));
				?>
			</li>
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

		comboDate = $('select[name=transfer_date]');
		comboDate.sexyCombo({
			triggerSelected: true,
			skin: 'custom',
			initCallback: function() {
				comboDate.parent('.combo').addClass('sexy-combo-transfer_date');
			}
		});

		comboMonth = $('select[name=transfer_month]');
		comboMonth.sexyCombo({
			triggerSelected: true,
			skin: 'custom',
			initCallback: function() {
				comboMonth.parent('.combo').addClass('sexy-combo-transfer_month');
			}
		});

		comboYear = $('select[name=transfer_year]');
		comboYear.sexyCombo({
			triggerSelected: true,
			skin: 'custom',
			initCallback: function() {
				comboYear.parent('.combo').addClass('sexy-combo-transfer_year');
			}
		});

		comboBankName = $('select[name=bank_name]');
		comboBankName.sexyCombo({
			triggerSelected: true,
			skin: 'custom',
			initCallback: function() {
				comboBankName.parent('.combo').addClass('sexy-combo-bank_name');
			}
		});
	});
</script>
