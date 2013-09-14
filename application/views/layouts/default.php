<?php
	$sv = '?v=1.5';
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
		<?= $this->load->view('includes/partials/dialog-condition','', TRUE) ?>

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

		<div id="zone-fanzone-minimum-popup" class="window">
			<a href="#close" class="close"></a>
		</div>

		<div id="zone-early-success-popup" class="window">
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

		<div id="login-fanzone-only-popup" class="window">
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