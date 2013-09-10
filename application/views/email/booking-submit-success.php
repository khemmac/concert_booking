<div style="background-color:#000000; width:800px;">
	<table cellpadding="0" cellspacing="0" width="100%" border="0">
		<tr>
			<td align="center"><h1 style="color:white;">หลักฐานการจองบัตร SBS MTV 2013</h1></td>
		</tr>
		<tr>
			<td align="center">
				<table cellpadding="5" cellspacing="0" width="80%" border="0">
					<tr>
						<td style="color:white;">คุณ <?= $person['thName'] ?></td>
						<td align="center" style="color:white;" rowspan="2"><strong style="font-weight:bold;">รหัสการจอง</strong><br /><?= $booking_data['code'] ?></td>
					</tr>
					<tr>
						<td style="color:white;">รหัสบัตรประชาชน <?= $person['code'] ?></td>
					</tr>
					<tr>
						<td style="color:white;" colspan="2">อีเมล์ <?= $person['email'] ?></td>
					</tr>
					<tr>
						<td style="color:white;" colspan="2">เบอร์โทรศัพท์ <?= $person['tel'] ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr><td height="30"></td></tr>
		<tr>
			<td align="center">
				<table cellpadding="4" cellspacing="0" width="90%" border="1" style="background-color:black;">
					<tr>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">รายการ</td>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">โซนที่นั่ง</td>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">เลขที่นั่ง</td>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">จำนวนที่นั่ง</td>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">ราคาต่อหน่วย</td>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">ราคา</td>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">สถานะ</td>
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
					<tr>
						<td style="background-color:white;" align="center"><?= $key_z+1 ?></td>
						<td style="background-color:white;" align="center"><?= strtoupper($z) ?></td>
						<td style="background-color:white;" align="center"><?= strtoupper(implode(', ', $seat_list)) ?></td>
						<td style="background-color:white;" align="center"><?= count($seat_list) ?></td>
						<td style="background-color:white;" align="center"><?= number_format($zone_price) ?></td>
						<td style="background-color:white;" align="center"><?= number_format($zone_price * count($seat_list)) ?></td>
					<?php if($key_z==0): ?>
						<td style="background-color:white;" align="center" rowspan="<?= count($zone_list) + 4 ?>" valign="top" style="padding:5px;">
							กรุณาชำระเงิน
							<br />ภายในวันที่ <?= util_helper_format_date(util_helper_add_six_hour(new DateTime())) ?>
							<br />ก่อนเวลา <?= util_helper_format_time(util_helper_add_six_hour(new DateTime())) ?>
						</td>
					<?php endif; ?>
					</tr>
<?php endforeach; ?>
					<tr>
						<td style="background-color:white;" align="right" colspan="5">ราคารวม</td>
						<td style="background-color:white;" align="center"><?= number_format(get_sum_price($booking_list)) ?></td>
					</tr>
					<tr>
						<td style="background-color:white;" align="right" colspan="5">เงินตรวจสอบโอน</td>
						<td style="background-color:white;" align="center">0.<?= str_pad(substr($booking_data['id'], -2), 2, '0', STR_PAD_LEFT) ?></td>
					</tr>
					<tr>
						<td style="background-color:white;" align="right" colspan="5">ค่าธรรมเนียมการออกบัตร (20 บาทต่อใบ)</td>
						<td style="background-color:white;" align="center">20</td>
					</tr>
					<tr>
						<td style="background-color:white;" align="right" colspan="5">ราคารวมทั้งหมด</td>
						<td style="background-color:white;" align="center"><strong><?= number_format(get_sum_price($booking_list) + 20) ?>.<?= str_pad(substr($booking_data['id'], -2), 2, '0', STR_PAD_LEFT) ?></strong></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="20"></td>
		</tr>
		<tr>
			<td align="center">
				<table cellpadding="5" cellspacing="0" border="0" width="95%">
					<tr>
						<td style="color:white;">
							<h3>เงื่อนไขการชำระเงิน</h3>
							<ol>
								<li>กรุณาชำระผ่านธนาคารดังต่อไปนี้
									<ul>
										<li>ธนาคารกรุงเทพ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										สาขาลาดพร้าว
										&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;
										บัญชีกระแสรายวัน เลขที่บัญชี
										1293162580
										</li>
										<li>ธนาคารกสิกรไทย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										สาขาลาดพร้าวซอย10
										&nbsp;&nbsp;&nbsp;
										บัญชีกระแสรายวัน เลขที่บัญชี
										7521020754
										</li>
										<li>ธนาคารไทยพาณิชย์&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										สาขาลาดพร้าวซอย10
										&nbsp;&nbsp;&nbsp;
										บัญชีกระแสรายวัน เลขที่บัญชี
										0473035812
										</li>
									</ul>
								</li>
								<li>ชำระเงินภายใน 6 ชั่วโมง</li>
								<li>กรุณานำหลักฐานการชำระเงินมายืนยันการแจ้งโอนเงิน ผ่านทาง <a href="http://www.boostplus.co.th" target="_blank">www.boostplus.co.th</a> ในหัวข้อแจ้งโอนเงิน
								</li>
								<li>หากแจ้งโอนเงินเรียบร้อยแล้ว กรุณาตรวจสอบสถานะการจอง หลังจากแจ้งโอนเงินในเวลาประมาณ 24 ชม.</li>
							</ol>
						</td>
					</tr>
					<tr><td height="20"></td></tr>
				    <tr>
				    	<td style="background-color:#ffa01f;" align="center">* หมายเหตุ  สามารถตรวจสอบสถานะการโอนเงินได้ผ่านทางหัวข้อ &quot;ตรวจสอบสถานะบัตร&quot;</td>
				    </tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="30" align="right"><span style="color:#444444">ติดต่อสอบถาม 02-938-5959</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
	</table>
<!--
	<table cellpadding="0" cellspacing="0" width="100%" border="0">
		<tr>
			<td height="100">&nbsp;</td>
		</tr>
		<tr>
			<td height="28">
				<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
					<tr>
						<td width="190"></td>
						<td align="center" style="background-color:#18171c;">
							<strong style="color:white;">ผลการลงทะเบียนของคุณ</strong>
						</td>
						<td width="190"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="30">&nbsp;</td>
		</tr>
		<tr>
			<td height="50" align="center">
				<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
					<tr>
						<td width="190"></td>
						<td align="center" style="background-color:#ffffff;">
							ยินดีต้อนรับผู้จองบัตร Early Bird &amp; Presale นะคะ
							<br />
							Username และ Password ของท่านคือ
						</td>
						<td width="190"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="40">&nbsp;</td>
		</tr>
		<tr>
			<td height="50" align="center">
				<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
					<tr>
						<td width="190"></td>
						<td align="center" style="background-color:#18171c;">
							<strong style="color:white;">Username : <?= $username ?></strong>
							<br /><br />
							<strong style="color:white;">Password : <?= $password ?></strong>
						</td>
						<td width="190"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="290">&nbsp;</td>
		</tr>
		<tr>
			<td height="30" align="right"><span style="color:#444444">ติดต่อสอบถาม 02-938-5959</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
	</table>
-->
</div>