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

	<link href="<?= base_url('/css/style.css'.$sv) ?>" type="text/css" rel="stylesheet" />
	<link href="<?= base_url('/css/member.css'.$sv) ?>" type="text/css" rel="stylesheet" />
	<link href="<?= base_url('/css/menu.css'.$sv) ?>" type="text/css" rel="stylesheet" />
	<link href="<?= base_url('/css/popup.css'.$sv) ?>" type="text/css" rel="stylesheet" />
	<link href="<?= base_url('/css/early.css'.$sv) ?>" type="text/css" rel="stylesheet" />

	<script type="text/javascript" src="<?= base_url('/js/common.js'.$sv) ?>"></script>

</head>

<body>
	<div id="container">
		<?=$this->load->view('includes/inc-member-menu','', TRUE)?>
		<?=$view?>
		<span id="footer" style="position:absolute; bottom:20px; right:30px; display:block; width:207px; height:16px; background:transparent url('<?= base_url("/images/common/foot-contact.png") ?>') no-repeat; text-indent:-9000px;">ติดต่อสอบถาม 02-938-5959</span>
	</div>

	<div id="boxes">
		<div id="common-popup" class="window">
			<div id="content">
<h3 style="text-align:center;">ขั้นตอนการซื้อบัตร Early Bird / Presale</h3>
<h4 style="text-align:center;">SBS MTV K-POP FESTIVAL 2013 LIVE IN BANGKOK (20 OCTOBER 2013)<h4>
<ol style="font-weight:normal; font-size:smaller;">
	<li>เข้าสู่ <a style="color:black; text-decoration:underline;" href="<?= site_url('') ?>">www.boostplus.co.th</a> เลือก SBS MTV K-POP FESTIVAL 2013 LIVE IN BANGKOK</li>
	<li>ทำการ Register เพื่อเข้าสู่ระบบโดยต้องกรอกข้อมูลให้ครบถ้วนทุกช่อง เมื่อ Register เรียบร้อยแล้ว ผู้จองจะต้องทำการ Log in ก่อนทุกครั้งโดยใช้ Username และ Password ของตนเองเท่านั้น</li>
	<li>เมื่อเข้าระบบเรียบร้อยแล้ว เลือกหัวข้อ &quot;ซื้อบัตร&quot; โดยผู้จองสามารถเลือกโซนตามที่ต้องการได้ โดยในการจองหนึ่ง Account สามารถเลือกจำนวนการจองได้ไม่เกินจำนวน 6 ที่</li>
	<li>เมื่อกรอกรายละเอียดการจอง พร้อมเลือกจำนวนการจองเรียบร้อยแล้ว ระบบจะแจ้งรหัสการจอง , จำนวนเงินที่ต้องชำระ (ค่าธรรมเนียนการออกบัตร 20 บาทต่อใบ) , เลขที่บัญชีและธนาคารที่ต้องโอนเงิน และกำหนดเวลาที่ต้องโอนเงิน (กรุณาโอนเงิน ภายในระยะเวลา 6 ชั่วโมงภายหลังจากลงทะเบียน หากมีการแก้ไขข้อมูลสามารถแก้ไขได้ในระยะเวลาดังกล่าว) **กรุณา Save รายละเอียดการจองไว้ เพื่อความสะดวกในการทำรายการ*</li>
	<li>ยอดเงินที่ต้องชำระจะต้องมีเศษสตางค์ เพื่อสะดวกในการตรวจสอบ กรุณาโอนเงินตามยอดที่แจ้ง</li>
	<li>หลังจากโอนเงินเรียบร้อยแล้ว กรุณาแจ้งข้อมูลการโอนเงินกลับมาภายใน 6 ชั่วโมง หลังจากที่ทำการจอง พร้อมอัพโหลดสลิปการโอนเงิน มาที่ <a style="color:black; text-decoration:underline;" href="<?= site_url('sbsmtv2013') ?>">www.boostplus.co.th/sbsmtv2013</a> เลือกหัวข้อ &quot;แจ้งโอนเงิน&quot;  (โดยต้อง Log in เข้าสู่ระบบก่อนทุกครั้ง) หากเกินระยะเวลาดังกล่าวทางผู้จัดจะไม่รับผิดชอบในกรณีใดๆทั้งสิ้น</li>
	<li>48 ชั่วโมงหลังการแจ้งการโอนเงิน ขอให้ผู้จองเข้ามาตรวจสอบสถานะการจองอีกครั้งใน <a style="color:black; text-decoration:underline;" href="<?= site_url('sbsmtv2013') ?>">www.boostplus.co.th/sbsmtv2013</a> เลือกหัวข้อ &quot;ตรวจสอบสถานะบัตร&quot; (โดยต้อง Log in เข้าสู่ระบบก่อนทุกครั้ง) หากพบว่าข้อมูลไม่ถูกต้องกรุณาแจ้งกลับมายังเจ้าหน้าที่ตามเบอร์ติดต่อที่ระบุไว้ด้านล่าง</li>
	<li>กรุณา Print ใบจองเก็บไว้เป็นหลักฐาน เพื่อใช้แลกรับบัตรแข็งเข้างาน</li>
	<li>ผู้จองสามารถมารับบัตรแข็งได้ในวันอาทิตย์ที่ 20 ตุลาคม 2556 ตั้งแต่ เวลา 13.00 น. บริเวณหน้างาน โดยนำหลักฐานการจองบัตร (ใบยืนยันการจอง) ในรอบ Early Bird และ PreSale ผ่านทางช่องทางออนไลน์ พร้อมบัตรประชาชนตามชื่อที่ระบุในใบจอง มาเป็นหลักฐานในการรับบัตร</li>
</ol>

<h4 style="text-align:center;">ติดต่อสอบถามโทร 02-938-5959 ต่อ 130 , 084-342-2230 และ 089-811-1801</h4>
<div style="text-align:center;"><a style="color:black; text-decoration:underline;" href="<?= base_url('images/pdf/term_condition.pdf') ?>" target="_blank">ดาวน์โหลดข้อกำหนดและเงื่อนไข</a></div>

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