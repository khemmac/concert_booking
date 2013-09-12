<?php
	$sv = '?v=1.0';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Pragma" content="no-cache" />
	<title>SBS MTV 2013</title>
	<script type="text/javascript"> var __base_url = '<?= base_url() ?>'; </script>
	<script type="text/javascript"> var __site_url = '<?= site_url('/') ?>'; </script>

	<script type="text/javascript" src="<?= base_url('/js/lib/jquery.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/js/lib/jquery.bgiframe.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/js/lib/jquery.numeric.js') ?>"></script>

	<script type="text/javascript" src="<?= base_url('/js/lib/jquery.qtip/jquery.qtip.min.js') ?>"></script>
	<link href="<?= base_url('/js/lib/jquery.qtip/jquery.qtip.min.css') ?>" type="text/css" rel="stylesheet" />
<!--
	<script type="text/javascript" src="<?= base_url('/js/lib/jquery.tipsy/jquery.tipsy.js') ?>"></script>
	<link href="<?= base_url('/js/lib/jquery.tipsy/tipsy.css') ?>" type="text/css" rel="stylesheet" />
-->
	<script type="text/javascript" src="<?= base_url('/js/lib/jquery.sexy-combo/jquery.sexy-combo-2.1.2.pack.js') ?>"></script>
	<link href="<?= base_url('/js/lib/jquery.sexy-combo/sexy-combo.css') ?>" type="text/css" rel="stylesheet" />
	<link href="<?= base_url('/js/lib/jquery.sexy-combo/skins/custom/custom.css') ?>" type="text/css" rel="stylesheet" />

	<link href="<?= base_url('/css'.(language_helper_is_en($this)?'/en':'').'/style.css'.$sv) ?>" type="text/css" rel="stylesheet" />
	<link href="<?= base_url('/css'.(language_helper_is_en($this)?'/en':'').'/member.css'.$sv) ?>" type="text/css" rel="stylesheet" />
	<link href="<?= base_url('/css'.(language_helper_is_en($this)?'/en':'').'/menu.css'.$sv) ?>" type="text/css" rel="stylesheet" />
	<link href="<?= base_url('/css'.(language_helper_is_en($this)?'/en':'').'/popup.css'.$sv) ?>" type="text/css" rel="stylesheet" />
	<link href="<?= base_url('/css'.(language_helper_is_en($this)?'/en':'').'/early.css'.$sv) ?>" type="text/css" rel="stylesheet" />

	<script type="text/javascript" src="<?= base_url('/js/common.js'.$sv) ?>"></script>

</head>

<body>
	<div id="container">
		<?=$this->load->view('includes/inc-language-menu','', TRUE)?>
		<?=$this->load->view('includes/inc-member-menu','', TRUE)?>
		<?=$view?>
		<span id="footer" style="position:absolute; bottom:20px; right:30px; display:block; width:207px; height:16px; background:transparent url('<?= base_url("/images".(language_helper_is_en($this)?'/en':'')."/common/foot-contact.png") ?>') no-repeat; text-indent:-9000px;">ติดต่อสอบถาม 02-938-5959</span>
	</div>

	<div id="boxes">
		<div id="common-popup" class="window">
			<div id="content">
<?php if(language_helper_is_en($this)): ?>
<h3 style="text-align:center;">Early Bird booking process</h3>
<h4 style="text-align:center;">(Only Zone A3: Festival ticket 6,000 Baht)<h4>
<h4 style="text-align:center;">Saturday 14<sup>th</sup> September at 8:30 am. – 11.30 pm.<h4>
<h4 style="text-align:center;">Early Bird booking privilege Early Bird<h4>
<h4 style="text-align:center;">บัตรLimited Edition / Fast Track (รายละเอียดเพิ่มเติมจะแจ้งให้ทราบอีกครั้ง)<h4>
<ol style="font-weight:normal; font-size:smaller;">
	<li>Enter <a style="color:black; text-decoration:underline;" href="<?= site_url('') ?>">www.boostplus.co.th</a> Choose SBS K-POP FESTIVAL 2013 LIVE IN BANGKOK</li>
	<li>Register for Early Bird booking by completing the required information</li>
	<li>Please log in with existing username and password every time. After logging in, choose “Booking”, and choose Zone A3. A maximum of 6 seats can be purchased per customer.
**After submitting, no changes or modification can be made under any circumstances.</li>
	<li>When the booking form is completed, the system will inform you the booking reference no., booking and payment details (which includes a charge of 20 Baht/ticket).</li>
	<li>Please note that your transfer must be made *at actual informed total balance (including Satang) within 4 hours after submitting.</li>
	<li>After your transfer is made, please submit your proof of transfer (payment slip) by uploading on to “Payment Confirmation” at www.boostplus.co.th within 4 hours.</li>
	<li>After 48 hours of confirming your payment, your booking status can be tracking at “Booking Status” button on www.boostplus.co.th *If you find any error/incorrect information please contact us through provided contact below.</li>
	<li>Please print out the confirmation document and payment slip to get the original ticket(s) at the venue</li>
	<li>You can receive your ticket(s) on Sunday 20th October 2013 at the venue (the detail will be inform) by presenting your Early Bird/ Pre- Sale online booking confirmation document along with your ID card in order to secure your ticket.</li>
</ol>
<h5>
Caution:
Only Festival ticket, we reserve the right to refuse to issue a replacement ticket for lost or stolen.
</h5>

<?php else: ?>
<h3 style="text-align:center;">ขั้นตอนการซื้อบัตร Early Bird</h3>
<h4 style="text-align:center;">(เฉพาะโซนA3 บัตรยืนราคา6,000 บาท)<h4>
<h4 style="text-align:center;">วันเสาร์ที่14 กันยายน 2556 ตั้งแต่เวลา 8.30 – 23.30 น.<h4>
<h4 style="text-align:center;">สิทธิพิเศษสำหรับผู้ซื้อบัตร Early Bird<h4>
<h4 style="text-align:center;">บัตรLimited Edition / Fast Track (รายละเอียดเพิ่มเติมจะแจ้งให้ทราบอีกครั้ง)<h4>
<ol style="font-weight:normal; font-size:smaller;">
	<li>เข้าสู่ <a style="color:black; text-decoration:underline;" href="<?= site_url('') ?>">www.boostplus.co.th</a> เลือก SBS K-POP FESTIVAL 2013 LIVE IN BANGKOK</li>
	<li>ทำการ Register เพื่อเข้าสู่ระบบโดยต้องกรอกข้อมูลให้ครบถ้วนทุกช่องเมื่อ Register เรียบร้อยแล้วผู้จองจะต้องทำการ Log in ก่อนทุกครั้งโดยใช้ Username และPassword ของตนเองเท่านั้น</li>
	<li>เมื่อเข้าระบบเรียบร้อยแล้วเลือกหัวข้อ“ซื้อบัตร”กดเลือกโซน A3 โดยการจองหนึ่งครั้งสามารถเลือกจำนวนการจองได้ไม่เกินจำนวน 6 ที่ **หากกดยืนยันการจองแล้วผู้จองไม่สามารถแก้ไขได้ในทุกกรณี</li>
	<li>เมื่อกรอกรายละเอียดการจองเรียบร้อยแล้วระบบจะแจ้งรหัสการจอง, จำนวนเงิน , เลขที่บัญชีและธนาคารที่ต้องโอนเงิน (ค่าธรรมเนียมออกบัตร 20 บาทต่อใบ)</li>
	<li>กรุณาโอนเงินภายในระยะเวลา 4 ชั่วโมงภายหลังจากกดยืนยันการจองยอดเงินที่ต้องชำระจะต้องมีเศษสตางค์เพื่อสะดวกในการตรวจสอบกรุณาโอนเงินตามยอดที่แจ้ง**หากไม่โอนเงินภายในระยะเวลาดังกล่าวจะถือว่าท่านสละสิทธิ์การจองทางผู้จัดจะไม่รับผิดชอบในกรณีใดๆทั้งสิ้น</li>
	<li>หลังจากโอนเงินเรียบร้อยแล้วกรุณาแจ้งข้อมูลการโอนเงินกลับมาภายใน4ชั่วโมงพร้อมอัพโหลดสลิปการโอนเงินมาที่ <a style="color:black; text-decoration:underline;" href="<?= site_url('') ?>">www.boostplus.co.th</a> เลือกหัวข้อ“แจ้งโอนเงิน”</li>
	<li>หลังการแจ้งการโอนเงิน48 ชั่วโมงขอให้ผู้จองเข้ามาตรวจสอบสถานะการจองอีกครั้งใน <a style="color:black; text-decoration:underline;" href="<?= site_url('') ?>">www.boostplus.co.th</a> เลือกหัวข้อ“ตรวจสอบสถานะบัตร”หากพบว่าข้อมูลไม่ถูกต้องกรุณาแจ้งกลับมายังเจ้าหน้าที่ตามเบอร์ติดต่อที่ระบุไว้ให้</li>
	<li>กรุณา print ใบจองเก็บไว้เป็นหลักฐานเพื่อใช้แลกรับบัตรจริงในวันงาน</li>
	<li>ผู้จองสามารถมารับบัตรจริงได้ในวันอาทิตย์ที่ 20 ตุลาคม 2556 บริเวณหน้างาน(เวลาและสถานที่จะแจ้งให้ทราบอีกครั้ง)โดยนำหลักฐานการจองบัตร(ใบยืนยันการจอง) ในรอบEarly Bird และPre Saleผ่านทางช่องทางออนไลน์พร้อมบัตรประชาชนตามชื่อที่ระบุในใบจองมาเป็นหลักฐานในการรับบัตร</li>
</ol>
<ul style="list-style:none;">
	<li>
<strong style="text-decoration:underline; font-size:smaller;">ข้อควรระวัง</strong>
<br />
<span style="font-weight:normal; font-size:smaller;">
	กรณีรับบัตรเข้างานแล้ว ถ้าลูกค้าทำบัตรโซนยืนสูญหาย ทางผู้จัดงานไม่รับผิดชอบ ต่อความเสียหาย และไม่สามารถออกบัตรใหม่ให้กับลูกค้าได้ ลูกค้าต้องซื้อบัตร เข้างานใหม่เท่านั้น
</span></li>
</ul>


<?php endif; ?>

<?php if(language_helper_is_en($this)): ?>
<h4 style="text-align:center;">Contact 02-938-5959 - 130 , 084-342-2230 and 089-811-1801</h4>
<?php else: ?>
<h4 style="text-align:center;">ติดต่อสอบถามโทร 02-938-5959 ต่อ 130 , 084-342-2230 และ 089-811-1801</h4>
<?php endif; ?>
<div style="text-align:center;">
	<img src="<?= base_url('images/common/condition-logo.gif') ?>" style="border:0px;" />
	<br />
	<a style="color:black; text-decoration:underline;" href="<?= base_url('images/pdf/term_condition'.(language_helper_is_en($this)?'_en':'').'.pdf?v=1') ?>" target="_blank"><?= language_helper_is_en($this)?'Download conditions.':'ดาวน์โหลดข้อกำหนดและเงื่อนไข' ?></a>
</div>

			</div>
			<input type="checkbox" name="chk-dont-show-popup" id="chk-dont-show-popup" />
			<label for="chk-dont-show-popup" id="lbl-dont-show-popup">อย่าแสดงอีก</label>
			<a href="#close" class="close"></a>
		</div>

		<div id="seat-limit-popup" class="window">
			<a href="#close" class="close"></a>
		</div>

		<div id="seat-no-select-popup" class="window">
			<a href="#ok" class="ok"></a>
			<a href="#close" class="close"></a>
		</div>

		<div id="zone-confirm-clear-popup" class="window">
			<a href="#ok" class="ok"></a>
			<a href="#close" class="close"></a>
		</div>
		<div id="zone-blank-seat-popup" class="window">
			<a href="#close" class="close"></a>
		</div>
		<div id="zone-booked-limit-popup" class="window">
			<a href="#close" class="close"></a>
		</div>

		<div id="zone-soldout-popup" class="window">
			<a href="#close" class="close"></a>
		</div>

		<div id="contact-us-popup" class="window">
			<a href="#close" class="close"></a>
		</div>

		<div id="booking-submit-complete-popup" class="window">
			<a href="#close" class="close"></a>
		</div>

		<div id="transfer-confirm-popup" class="window">
			<span style="top:70px;" class="p-code">xxxxxxxxxxxxxx</span>
			<span style="top:96px;" class="p-date">xxxxxxxxxxxxxx</span>
			<span style="top:121px;" class="p-time">xxxxxxxxxxxxxx</span>
			<span style="top:149px;" class="p-pay">xxxxxxxxxxxxxx</span>
			<span style="top:176px;" class="p-bank">xxxxxxxxxxxxxx</span>
			<a href="#ok" class="ok"></a>
			<a href="#close" class="close"></a>
		</div>

		<div id="mask"></div>
	</div>
<?php
	$popup = $this->input->get('popup');
	if(!empty($popup)):
?>
<script type="text/javascript"> $(function(){ common.popup.show(null, '#<?= $popup ?>'); }); </script>
<?php endif; ?>
</body>
</html>