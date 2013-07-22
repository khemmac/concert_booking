<div id="content-body" class="page-booking">
	<?=$this->load->view('includes/inc-menu-2','', TRUE)?>

	<div id="content">
		<div class="header">
			<span class="name">test test</span>
			<span class="code">3029103938291</span>
			<span class="booking-code">XB3920</span>
		</div>
		<table class="list" cellpadding="0" cellspacing="0" border="0">
			<tr class="thead">
				<td style="width:24px;" class="bg-left"></td>
				<td style="width:92px;" class="no">รายการ</td>
				<td style="width:99px;" class="zone">โซนที่นั่ง</td>
				<td style="width:138px;" class="seat-no">เลขที่นั่ง</td>
				<td style="width:111px;" class="seat-count">จำนวนที่นั่ง</td>
				<td style="width:113px;" class="item-price">ราคาต่อหน่วย</td>
				<td style="width:98px;" class="price">ราคา</td>
				<td style="width:21px;" class="bg-right"></td>
			</tr>
			<tr class="tbody first">
				<td class="bg-left"></td>
				<td class="no">1</td>
				<td class="zone">A1</td>
				<td class="seat-no">001, 022, 023, 100</td>
				<td class="seat-count">4</td>
				<td class="item-price">6,000</td>
				<td class="price">24,000</td>
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
				<td colspan="8">footer</td>
			</tr>
			<tr class="tfoot-text">
				<td colspan="8">footer</td>
			</tr>
			<tr class="tfoot-buttons" align="center">
				<td colspan="8">
<?= form_open('controller/form_booking/booking'); ?>
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
							<a href="seat" class="cancel">Cancel</a>
						</li>
					</ul>
<?= form_close() ?>
				</td>
			</tr-->
		</table>

	</div>
</div>
