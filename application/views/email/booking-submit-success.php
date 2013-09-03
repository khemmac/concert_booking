<div style="background:#000000 url(<?= base_url('images/email/bg-register.jpg') ?>); width:800px; height:650px;">
	<table cellpadding="0" cellspacing="0" width="100%" border="1">
		<tr>
			<td align="center">
				<table cellpadding="5" cellspacing="0" width="80%" border="1">
					<tr>
						<td style="color:white;">คุณ <?= $person['thName'] ?></td>
						<td align="center" style="color:white;" rowspan="2"><strong style="font-weight:bold;">รหัสการจอง</strong><br /><?= $booking_data['code'] ?></td>
					</tr>
					<tr>
						<td style="color:white;">รหัสบัตรประชาชน <?= $person['code'] ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr><td height="20"></td></tr>
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
					</tr>
					<tr>
						<td>รายการ</td>
						<td>โซนที่นั่ง</td>
						<td>เลขที่นั่ง</td>
						<td>จำนวนที่นั่ง</td>
						<td>ราคาต่อหน่วย</td>
						<td>ราคา</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
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
</div>