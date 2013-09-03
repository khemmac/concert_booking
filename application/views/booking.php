<div id="content-body" class="page-booking">
	<?=$this->load->view('includes/inc-main-menu','', TRUE)?>

	<div id="content">
		<div class="header">
			<span class="name"><?= $person['thName'] ?></span>
			<span class="code"><?= $person['code'] ?></span>
			<span class="booking-code"><?= $booking_code ?></span>
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
				<td class="price">0.<?= str_pad(substr($booking_id, -2), 2, '0', STR_PAD_LEFT) ?></td>
				<td class="bg-right"></td>
			</tr>
			<tr class="tbody last">
				<td class="bg-left"></td>
				<td colspan="5" class="sum-price" align="right">ราคารวมทั้งหมด</td>
				<td class="price"><strong><?= number_format(get_sum_price($booking_list)) ?>.<?= str_pad(substr($booking_id, -2), 2, '0', STR_PAD_LEFT) ?></strong></td>
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
<?= form_open('booking/booking_submit'); ?>
	<?= form_hidden('booking_id', $booking_id) ?>
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
							<a href="<?= site_url('zone/'.$booking_id) ?>" class="cancel">Cancel</a>
						</li>
					</ul>
<?= form_close() ?>
				</td>
			</tr-->
		</table>

	</div>
</div>
