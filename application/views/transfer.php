<div id="content-body" class="page-transfer">
	<?=$this->load->view('includes/inc-main-menu','', TRUE)?>

	<div id="form">
		<?= form_open_multipart(); ?>
		<?php
			$days = array();
			for($i=1;$i<=31;$i++)
				$days[$i] = $i;


			$years = array();
			for($i=2013;$i>=2013;$i--)
				$years[$i] = ($i+543);

			$hours = array();
			for($i=0;$i<24;$i++){
				$v = str_pad($i, 2, '0');
				$hours[$v] = $v;
			}
			$minutes = array();
			for($i=0;$i<60;$i++){
				$v = str_pad($i, 2, '0');
				$minutes[$v] = $v;
			}

			$forms = array(
				array(
					'name'		=> 'code',
					'maxlength'	=> '7',
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
					'name'		=> 'transfer_hh',
					'class'		=> 'transfer_hh',
					'type'		=> 'dropdown',
					'options'	=> $hours
				),
				array(
					'name'		=> 'transfer_mm',
					'class'		=> 'transfer_mm',
					'type'		=> 'dropdown',
					'options'	=> $minutes
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
						//'ธนาคารกรุงศรีอยุธยา'=>'ธนาคารกรุงศรีอยุธยา',
						'ธนาคารกสิกรไทย'=>'ธนาคารกสิกรไทย',
						//'ธนาคารกรุงไทย'=>'ธนาคารกรุงไทย',
						'ธนาคารไทยพาณิชย์'=>'ธนาคารไทยพาณิชย์'/*,
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
						 */
					)
				),
				array(
					'name'		=> 'slip',
					'type'		=> 'upload',
					'class'		=> 'slip'
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
		</ul>
		<?= form_close() ?>
	</div>

</div>
<script type="text/javascript">
	$(function(){
		$('#submit').click(function(){
			var bd = $('select[name=transfer_date]').val(),
				bm = $('select[name=transfer_month]').val(),
				by = $('select[name=transfer_year]').val();
			if(!common.isValidDate(by,bm,bd)){
				alert('วันที่ผิดพลาด กรุณาตรวจสอบอีกครั้ง');
				return false;
			}

			setTimeout(function(){
				$(this).attr('disabled', 'disabled');
			}, 1);
		});

		common.combo.create($('select[name=transfer_date]'),	'sexy-combo-transfer_date');
		common.combo.create($('select[name=transfer_month]'),	'sexy-combo-transfer_month');
		common.combo.create($('select[name=transfer_year]'),	'sexy-combo-transfer_year');
		common.combo.create($('select[name=transfer_hh]'),	'sexy-combo-transfer_hh');
		common.combo.create($('select[name=transfer_mm]'),	'sexy-combo-transfer_mm');
		common.combo.create($('select[name=bank_name]'),		'sexy-combo-bank_name');

	});
</script>
