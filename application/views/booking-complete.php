<div id="content-body" class="page-booking-complete">
	<?=$this->load->view('includes/inc-menu-2','', TRUE)?>

	<div id="content">
		<div class="header">
			<span class="name">test test</span>
			<span class="code">3029103938291</span>
			<span class="booking-code">XB3920</span>
		</div>
		<table class="list" cellpadding="0" cellspacing="0" border="0">
			<thead>
				<tr>
					<td style="width:71px;" colspan="2">รายการ</td>
					<td style="width:85px;">โซนที่นั่ง</td>
					<td style="width:110px;">เลขที่นั่ง</td>
					<td style="width:78px;">จำนวนที่นั่ง</td>
					<td style="width:94px;">ราคาต่อหน่วย</td>
					<td style="width:85px;">ราคา</td>
					<td style="width:114px;" colspan="2">สถานะ</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="bg-left"></td>
					<td class="no">1</td>
					<td class="zone">A1</td>
					<td class="seat-no">001, 022, 023, 100</td>
					<td class="seat-count">4</td>
					<td class="item-price">6,000</td>
					<td class="price">24,000</td>
					<td class="status" rowspan="6" valign="top" style="padding:5px; width:114px;">ชำระเงินแล้ว
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
				<tr>
					<td class="bg-left"></td>
					<td class="no">2</td>
					<td class="zone">A1</td>
					<td class="seat-no">001, 022, 023, 100</td>
					<td class="seat-count">4</td>
					<td class="item-price">6,000</td>
					<td class="price">24,000</td>
					<td class="bg-right"></td>
				</tr>
				<tr>
					<td class="bg-left"></td>
					<td class="no">3</td>
					<td class="zone">A1</td>
					<td class="seat-no">001, 022, 023, 100</td>
					<td class="seat-count">4</td>
					<td class="item-price">6,000</td>
					<td class="price">24,000</td>
					<td class="bg-right"></td>
				</tr>
				<tr>
					<td class="bg-left"></td>
					<td class="no">4</td>
					<td class="zone">A1</td>
					<td class="seat-no">001, 022, 023, 100</td>
					<td class="seat-count">4</td>
					<td class="item-price">6,000</td>
					<td class="price">24,000</td>
					<td class="bg-right"></td>
				</tr>
				<tr>
					<td class="bg-left"></td>
					<td class="no">5</td>
					<td class="zone">A1</td>
					<td class="seat-no">001, 022, 023, 100</td>
					<td class="seat-count">4</td>
					<td class="item-price">6,000</td>
					<td class="price">24,000</td>
					<td class="bg-right"></td>
				</tr>
				<tr>
					<td class="bg-left"></td>
					<td class="no">6</td>
					<td class="zone">A1</td>
					<td class="seat-no">001, 022, 023, 100</td>
					<td class="seat-count">4</td>
					<td class="item-price">6,000</td>
					<td class="price">24,000</td>
					<td class="bg-right"></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="9">footer</td>
				</tr>
				<tr>
					<td colspan="9" class="footer">footer</td>
				</tr>
				<tr>
					<td colspan="9" class="buttons">
<?= form_open('controller/form_booking/booking-complete'); ?>
						<ul>
							<li>
								<?= form_submit(array(
										'id'		=> 'submit',
										'value'		=> 'Submit',
										'class'		=> 'submit'
									));
								?>
							</li>
							<li>
								<a href="seat" class="cancel">Cancel</a>
							</li>
						</ul>
<?= form_close() ?>
					</td>
				</tr>
			</tfoot>
		</table>

	</div>
</div>
