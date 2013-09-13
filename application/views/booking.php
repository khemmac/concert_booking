<div id="content-body" class="page-booking">
	<?=$this->load->view('includes/inc-main-menu','', TRUE)?>

	<div id="content">
		<div class="header">
			<span class="name"><?= $person['thName'] ?></span>
			<span class="code"><?= $person['code'] ?></span>
			<span class="booking-code"><?= $booking_data['code'] ?></span>
		</div>
		<table class="list" cellpadding="0" cellspacing="0" border="0">
			<tr class="thead">
				<td style="width:19px;" class="bg-left"></td>
				<td style="width:81px;" class="no">รายการ</td>
				<td style="width:127px;" class="zone">โซนที่นั่ง</td>
				<!--td style="width:133px;" class="seat-no">เลขที่นั่ง</td-->
				<td style="width:133px;" class="seat-count">จำนวนที่นั่ง</td>
				<td style="width:133px;" class="item-price">ราคาต่อหน่วย</td>
				<td style="width:80px;" class="price">ราคา</td>
				<td style="width:133px;" class="status">สถานะ</td>
				<td style="width:17px;" class="bg-right"></td>
			</tr>
<?php
	function get_seat_by_zone($seat_list, $z_name){
		$r = array();
		foreach($seat_list AS $o_seat){
			if($o_seat['zone_name']==$z_name)
				array_push($r, $o_seat['seat_name']);
		}
		return $r;
	}
	function get_zone_price($seat_list, $z_name){
		foreach($seat_list AS $o_seat){
			if($o_seat['zone_name']==$z_name)
				return $o_seat['price'];
		}
		return 0;
	}

	$sum_price = cal_helper_get_sum_price($booking_list);
	$card_fee = cal_helper_get_card_fee($booking_list);
	$discount = cal_helper_get_discount($booking_data['type'], $booking_list);
	$total = cal_helper_get_total_price($booking_data['type'], $booking_list);
	foreach($zone_list AS $key_z => $z):
		$seat_list = get_seat_by_zone($booking_list, $z);
		$zone_price = get_zone_price($booking_list, $z);

?>
			<tr class="tbody <?= ($key_z==0)?'first':'' ?>">
				<td class="bg-left"></td>
				<td class="no"><?= $key_z+1 ?></td>
				<td class="zone"><?= strtoupper($z) ?></td>
				<!--td class="seat-no"><?= strtoupper(implode(', ', $seat_list)) ?></td-->
				<td class="seat-count"><?= count($seat_list) ?></td>
				<td class="item-price"><?= number_format($zone_price) ?></td>
				<td class="price"><?= number_format($zone_price * count($seat_list)) ?></td>
				<?php if($key_z==0): ?>
					<td class="status" align="center" rowspan="<?= count($zone_list) + (4+((!empty($discount) && $discount>0)?1:0)) ?>" valign="middle" style="padding:5px;">
						กรุณาชำระเงิน
						<?php if($booking_data['type']==3): ?>
						<br />ภายในวันที่ 20/09/2013
						<br />ก่อนเวลา 18.00
						<?php elseif($booking_data['type']==2): ?>
						<br />ภายในวันที่ <?= util_helper_format_date(util_helper_add_six_hour(new DateTime())) ?>
						<br />ก่อนเวลา <?= util_helper_format_time(util_helper_add_six_hour(new DateTime())) ?>
						<?php else: ?>
						<br />ภายในวันที่ <?= util_helper_format_date(util_helper_add_four_hour(new DateTime())) ?>
						<br />ก่อนเวลา <?= util_helper_format_time(util_helper_add_four_hour(new DateTime())) ?>
						<?php endif; ?>
					</td>
				<?php endif; ?>
				<td class="bg-right"></td>
			</tr>
<?php endforeach; ?>
			<tr class="tbody">
				<td class="bg-left"></td>
				<td colspan="4" class="sum-price" align="right">ราคารวม</td>
				<td class="price"><?= number_format($sum_price) ?></td>
				<td class="bg-right"></td>
			</tr>
			<tr class="tbody">
				<td class="bg-left"></td>
				<td colspan="4" class="sum-price" align="right">เงินตรวจสอบโอน</td>
				<td class="price">0.<?= str_pad(substr($booking_data['id'], -2), 2, '0', STR_PAD_LEFT) ?></td>
				<td class="bg-right"></td>
			</tr>
			<tr class="tbody">
				<td class="bg-left"></td>
				<td colspan="4" class="sum-price" align="right">ค่าธรรมเนียมการออกบัตร (20 บาทต่อใบ)</td>
				<td class="price"><?= number_format($card_fee) ?></td>
				<td class="bg-right"></td>
			</tr>
			<?php if(!empty($discount) && $discount>0): ?>
				<tr class="tbody">
					<td class="bg-left"></td>
					<td colspan="4" class="sum-price" align="right">ส่วนลด <?= cal_helper_get_discount_detail($booking_data['type'], $booking_list) ?></td>
					<td class="price"><?= number_format($discount) ?></td>
					<td class="bg-right"></td>
				</tr>
			<?php endif; ?>
			<tr class="tbody last">
				<td class="bg-left"></td>
				<td colspan="4" class="sum-price" align="right">ราคารวมทั้งหมด</td>
				<td class="price"><strong><?= number_format($total) ?>.<?= str_pad(substr($booking_data['id'], -2), 2, '0', STR_PAD_LEFT) ?></strong></td>
				<td class="bg-right"></td>
			</tr>
			<tr class="tfoot">
				<td colspan="8">footer</td>
			</tr>
			<tr class="tfoot-text tfoot-text-fanzone">
				<td colspan="8">footer</td>
			</tr>
			<tr class="tfoot-buttons" align="center">
				<td colspan="8">
<?= form_open('booking/booking_submit'); ?>
	<?= form_hidden('booking_id', $booking_data['id']) ?>
					<ul>
						<li class="submit-ctnr">
							<?= form_submit(array(
									'id'		=> 'submit',
									'value'		=> '',
									'class'		=> 'submit'
								));
							?>
						</li>
						<!--li class="pdf-ctnr">
							<a href="<?= site_url('pdf/print_booking/'.$booking_data['id']) ?>" class="pdf"></a>
						</li-->
						<li class="cancel-ctnr">
							<a href="<?= site_url('zone_entrance') ?>" class="cancel"></a>
						</li>
					</ul>
<?= form_close() ?>
				</td>
			</tr>
		</table>

	</div>
</div>
