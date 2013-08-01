<?php
	if(!is_user_session_exist($this))
		redirect('member/login');
?>
<div id="content-body" class="page-booking-complete">
	<?=$this->load->view('includes/inc-main-menu','', TRUE)?>

	<div id="content">
		<div class="header">
			<span class="name">test test</span>
			<span class="code">3029103938291</span>
			<span class="booking-code">1A109220000071</span>
		</div>
		<table class="list" cellpadding="0" cellspacing="0" border="0">
			<tr class="thead">
				<td style="width:18px;" class="bg-left"></td>
				<td style="width:71px;" class="no">รายการ</td>
				<td style="width:85px;" class="zone">โซนที่นั่ง</td>
				<td style="width:110px;" class="seat-no">เลขที่นั่ง</td>
				<td style="width:78px;" class="seat-count">จำนวนที่นั่ง</td>
				<td style="width:94px;" class="item-price">ราคาต่อหน่วย</td>
				<td style="width:85px;" class="price">ราคา</td>
				<td style="width:124px;" class="status">สถานะ</td>
				<td style="width:16px;" class="bg-right"></td>
			</tr>
			<tr class="tbody first">
				<td class="bg-left"></td>
				<td class="no">1</td>
				<td class="zone">A1</td>
				<td class="seat-no">001, 022, 023, 100</td>
				<td class="seat-count">4</td>
				<td class="item-price">6,000</td>
				<td class="price">24,000</td>
				<td class="status" rowspan="6" valign="top" style="padding:5px;">ชำระเงินแล้ว
					วันที่ xx/xx/xx
					เวลา 00:00
					/
					<br />
					กรุณาชำระเงินภายใน
					วันที่ xx/xx/xx
					ก่อนเวลา 00:00
				</td>
				<td class="bg-right"></td>
			</tr>
			<tr class="tbody">
				<td class="bg-left"></td>
				<td class="no">2</td>
				<td class="zone">A1</td>
				<td class="seat-no">001, 022, 023, 100</td>
				<td class="seat-count">4</td>
				<td class="item-price">6,000</td>
				<td class="price">24,000</td>
				<td class="bg-right"></td>
			</tr>
			<tr class="tbody">
				<td class="bg-left"></td>
				<td class="no">3</td>
				<td class="zone">A1</td>
				<td class="seat-no">001, 022, 023, 100</td>
				<td class="seat-count">4</td>
				<td class="item-price">6,000</td>
				<td class="price">24,000</td>
				<td class="bg-right"></td>
			</tr>
			<tr class="tbody">
				<td class="bg-left"></td>
				<td class="no">4</td>
				<td class="zone">A1</td>
				<td class="seat-no">001, 022, 023, 100</td>
				<td class="seat-count">4</td>
				<td class="item-price">6,000</td>
				<td class="price">24,000</td>
				<td class="bg-right"></td>
			</tr>
			<tr class="tbody">
				<td class="bg-left"></td>
				<td class="no">5</td>
				<td class="zone">A1</td>
				<td class="seat-no">001, 022, 023, 100</td>
				<td class="seat-count">4</td>
				<td class="item-price">6,000</td>
				<td class="price">24,000</td>
				<td class="bg-right"></td>
			</tr>
			<tr class="tbody last">
				<td class="bg-left"></td>
				<td class="no">6</td>
				<td class="zone">A1</td>
				<td class="seat-no">001, 022, 023, 100</td>
				<td class="seat-count">4</td>
				<td class="item-price">6,000</td>
				<td class="price">24,000</td>
				<td class="bg-right"></td>
			</tr>

			<tr class="tfoot">
				<td colspan="9"></td>
			</tr>
			<tr class="tfoot-text">
				<td colspan="9"></td>
			</tr>
			<tr class="tfoot-buttons">
				<td colspan="9" align="center">
<?= form_open('controller/form_booking/booking-complete'); ?>
					<ul>
						<li>
							<?= form_submit(array(
									'id'		=> 'submit',
									'value'		=> '',
									'class'		=> 'submit'
								));
							?>
						</li>
						<li>
							<a href="<?= site_url('pdf/print1') ?>" target="_blank" class="cancel">Cancel</a>
						</li>
					</ul>
<?= form_close() ?>
				</td>
			</tr>
			<tr>
				<td colspan="9" style="height:10px;"></td>
			</tr>
		</table>

	</div>
</div>
