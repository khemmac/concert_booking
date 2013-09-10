<div id="content-body" class="page-transfer">
	<?=$this->load->view('includes/inc-main-menu','', TRUE)?>

	<div id="form">
		<?= form_open_multipart(); ?>
		<?php
			$days = array();
			for($i=13;$i<=21;$i++)
				$days[$i] = $i;


			$years = array();
			for($i=2013;$i>=2013;$i--)
				$years[$i] = ($i+543);

			$hours = array();
			for($i=0;$i<24;$i++){
				$v = str_pad($i, 2, '0', STR_PAD_LEFT);
				$hours[$v] = $v;
			}
			$minutes = array();
			for($i=0;$i<60;$i++){
				$v = str_pad($i, 2, '0', STR_PAD_LEFT);
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
					'options'	=> array(/*'1'=>'มกราคม', '2'=>'กุมภาพันธ์', '3'=>'มีนาคม',
										'4'=>'เมษายน', '5'=>'พฤษภาคม', '6'=>'มิถุนายน',
										'7'=>'กรกฎาคม', '8'=>'สิงหาคม', */'9'=>'กันยายน'/*,
										'10'=>'ตุลาคม', '11'=>'พฤศจิกายน', '12'=>'ธันวาคม'*/)
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
					'name'		=> 'pay_money_satang',
					'maxlength'	=> '2',
					'class'		=> 'pay_money_satang'
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
						'id'		=> 'b-submit',
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
		$('#b-submit').click(function(e){
			e.preventDefault();

			var bd = $('select[name=transfer_date]').val(),
				bm = $('select[name=transfer_month]').val(),
				by = $('select[name=transfer_year]').val();
			if(!common.form.isValidDate(by,bm,bd)){
				alert('วันที่ผิดพลาด กรุณาตรวจสอบอีกครั้ง');
				return false;
			}

			var code = $.trim($('input[name=code]').val()),
				pay_money = $.trim($('input[name=pay_money]').val()),
				pay_money_satang = $.trim($('input[name=pay_money_satang]').val()),
				slip = $.trim($('input[name=slip]').val());

			if(code!='' && pay_money!='' && pay_money_satang!='' && slip!=''){
				$('#transfer-confirm-popup .p-code').text(code);
				$('#transfer-confirm-popup .p-date').text($('select[name=transfer_date]').val()+' '+$('select[name=transfer_month] option:selected').text()+' '+$('select[name=transfer_year]').val());
				$('#transfer-confirm-popup .p-time').text($('select[name=transfer_hh]').val()+':'+$('select[name=transfer_mm]').val());
				$('#transfer-confirm-popup .p-pay').text(pay_money+'.'+pay_money_satang);
				$('#transfer-confirm-popup .p-bank').text($('select[name=bank_name]').val());

				// show popup before submit
				common.popup.show(null, '#transfer-confirm-popup');
				return false;
			}else{
				$('#form form').submit();
			}

		});

		$('#transfer-confirm-popup a.ok').unbind('click').bind('click', function(e){
			e.preventDefault();
			$('#form form').submit();
		});

		common.combo.create($('select[name=transfer_date]'),	'sexy-combo-transfer_date');
		common.combo.create($('select[name=transfer_month]'),	'sexy-combo-transfer_month');
		common.combo.create($('select[name=transfer_year]'),	'sexy-combo-transfer_year');
		common.combo.create($('select[name=transfer_hh]'),	'sexy-combo-transfer_hh');
		common.combo.create($('select[name=transfer_mm]'),	'sexy-combo-transfer_mm');
		common.combo.create($('select[name=bank_name]'),		'sexy-combo-bank_name');

		// number only
		$('input[name=pay_money]').numeric({ decimal: false, negative: false });
		$('input[name=pay_money_satang]').numeric({ decimal: false, negative: false });

		//common.popup.show(null, '#transfer-confirm-popup');

	});
</script>
