<div id="content-body" class="page-booking-complete">
	<?=$this->load->view('includes/inc-main-menu','', TRUE)?>

	<div id="content">
		<div class="header">
			<span class="name"><?= $person['thName'] ?></span>
			<span class="code"><?= $person['code'] ?></span>
			<span class="booking-code"><?= $booking_data['code'] ?></span>
		</div>
		<table class="list" cellpadding="0" cellspacing="0" border="0">
			<tr class="thead">
				<!--td style="width:18px;" class="bg-left"></td>
				<td style="width:71px;" class="no">รายการ</td>
				<td style="width:85px;" class="zone">โซนที่นั่ง</td>
				<td style="width:110px;" class="seat-no">เลขที่นั่ง</td>
				<td style="width:78px;" class="seat-count">จำนวนที่นั่ง</td>
				<td style="width:94px;" class="item-price">ราคาต่อหน่วย</td>
				<td style="width:85px;" class="price">ราคา</td>
				<td style="width:124px;" class="status">สถานะ</td>
				<td style="width:16px;" class="bg-right"></td-->

				<td style="width:19px;" class="bg-left"></td>
				<td style="width:81px;" class="no">รายการ</td>
				<td style="width:84px;" class="zone">โซนที่นั่ง</td>
				<td style="width:119px;" class="seat-no">เลขที่นั่ง</td>
				<td style="width:95px;" class="seat-count">จำนวนที่นั่ง</td>
				<td style="width:96px;" class="item-price">ราคาต่อหน่วย</td>
				<td style="width:80px;" class="price">ราคา</td>
				<td style="width:132px;" class="status">สถานะ</td>
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
	function get_sum_price($seat_list){
		$r = 0;
		foreach($seat_list AS $o_seat){
			$r += $o_seat['price'];
		}
		return $r;
	}
	foreach($zone_list AS $key_z => $z):
		$seat_list = get_seat_by_zone($booking_list, $z);
		$zone_price = get_zone_price($booking_list, $z);
?>
			<tr class="tbody <?= ($key_z==0)?'first':'' ?>">
				<td class="bg-left"></td>
				<td class="no"><?= $key_z+1 ?></td>
				<td class="zone"><?= strtoupper($z) ?></td>
				<td class="seat-no"><?= strtoupper(implode(', ', $seat_list)) ?></td>
				<td class="seat-count"><?= count($seat_list) ?></td>
				<td class="item-price"><?= number_format($zone_price) ?></td>
				<td class="price"><?= number_format($zone_price * count($seat_list)) ?></td>
				<?php if($key_z==0): ?>
					<td class="status" rowspan="<?= count($zone_list) + 4 ?>" valign="top" align="center" style="padding:5px;">
					<?php if($booking_data['status']==4): ?>
						ชำระเงินแล้ว
						วันที่ xx/xx/xx
						เวลา 00:00
					<?php elseif($booking_data['status']==3): ?>
						รอเจ้าหน้าที่ตรวจสอบการโอนเงิน
						วันที่ xx/xx/xx
						เวลา 00:00
					<?php elseif($booking_data['status']==2): ?>
						กรุณาชำระเงิน
						<br />ภายในวันที่ <?= util_helper_format_date(util_helper_add_six_hour($booking_data['booking_date'])) ?>
						ก่อนเวลา <?= util_helper_format_time(util_helper_add_six_hour($booking_data['booking_date'])) ?>
					<?php else: ?>
						-
					<?php endif; ?>
					</td>
				<?php endif; ?>
				<td class="bg-right"></td>
			</tr>
<?php endforeach; ?>
			<tr class="tbody">
				<td class="bg-left"></td>
				<td colspan="5" class="sum-price" align="right">ราคารวม</td>
				<td class="price"><?= number_format(get_sum_price($booking_list)) ?></td>
				<td class="bg-right"></td>
			</tr>
			<tr class="tbody">
				<td class="bg-left"></td>
				<td colspan="5" class="sum-price" align="right">เงินตรวจสอบโอน</td>
				<td class="price">0.<?= str_pad(substr($booking_data['id'], -2), 2, '0', STR_PAD_LEFT) ?></td>
				<td class="bg-right"></td>
			</tr>
			<tr class="tbody">
				<td class="bg-left"></td>
				<td colspan="5" class="sum-price" align="right">จำนวนเงินสำหรับทำบัตรแข็ง</td>
				<td class="price">20</td>
				<td class="bg-right"></td>
			</tr>
			<tr class="tbody last">
				<td class="bg-left"></td>
				<td colspan="5" class="sum-price" align="right">ราคารวมทั้งหมด</td>
				<td class="price"><strong><?= number_format($booking_data['total_money'], 2) ?></strong></td>
				<td class="bg-right"></td>
			</tr>
			<tr class="tfoot">
				<td colspan="9"></td>
			</tr>
<?php if($booking_data['status']==4): ?>
			<tr class="tfoot-text">
				<td colspan="9" valign="top" align="center">
					<div style="margin-top:124px; height:100px; color:red; text-indent: -3000px;">
						กรุณาพิมพ์หลักฐานฉบับนี้ไว้ พร้อมบัตรประชาชนตัวจริง เพื่อนำมารับบัตรจริงรุ่น Limited Edition
						เฉพาะ 2,000 ใบแรกเท่านั้นในวันที่ xx/xx/xxxx เวลา 00:00 น. ณ xxxxxxxxxxxxxx
						และส่วนที่เหลือกรุณาเก็บหลักฐานนี้ไว้เพื่อนำมารับบัตรจริง
						โดยวันและสถานที่จะแจ้งให้ทราบอีกครั้ง
					</div>
				</td>
			</tr>
			<tr class="tfoot-buttons">
				<td colspan="9" align="center">
<?= form_open('controller/form_booking/booking-complete'); ?>
					<ul>
						<li>
							<a href="<?= site_url('pdf/print_booking_complete/'.$booking_data['id']).'?print=1' ?>" class="submit" id="submit" target="_blank"></a>
						</li>
						<li>
							<a href="<?= site_url('pdf/print_booking_complete/'.$booking_data['id']) ?>" class="cancel"></a>
						</li>
					</ul>
<?= form_close() ?>
				</td>
			</tr>
			<tr>
				<td colspan="9" style="height:10px;"></td>
			</tr>
<?php else: ?>
			<tr>
				<td colspan="9" style="height:300px;"></td>
			</tr>
<?php endif; ?>
		</table>

	</div>
</div>
