<?php
	$errors_message = $this->session->flashdata('errors_message');
	print_r($errors_message);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Pragma" content="no-cache" />
	<title>Concert Booking</title>

	<script type="text/javascript" src="<?= base_url('/js/lib/jquery.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('/js/lib/jquery.bgiframe.min.js') ?>"></script>

	<script type="text/javascript" src="<?= base_url('/js/lib/jquery.qtip/jquery.qtip.min.js') ?>"></script>
	<link href="<?= base_url('/js/lib/jquery.qtip/jquery.qtip.min.css') ?>" type="text/css" rel="stylesheet" />

	<script type="text/javascript" src="<?= base_url('/js/lib/jquery.sexy-combo/jquery.sexy-combo-2.1.2.pack.js') ?>"></script>
	<link href="<?= base_url('/js/lib/jquery.sexy-combo/sexy-combo.css') ?>" type="text/css" rel="stylesheet" />
	<link href="<?= base_url('/js/lib/jquery.sexy-combo/skins/custom/custom.css') ?>" type="text/css" rel="stylesheet" />

	<link href="<?= base_url('/css/style.css') ?>" type="text/css" rel="stylesheet" />
	<link href="<?= base_url('/css/style-menu.css') ?>" type="text/css" rel="stylesheet" />

	<script type="text/javascript">
		$(function(){
			// show qtip
			$('input[qtip-data]').qtip({
				content: { attr: 'qtip-data' },
				show: {
					when: false, // Don't specify a show event
					ready: true // Show the tooltip when ready
				},
				hide: 'keyup', // hide when key on input
				//hide: false, // Don't specify a hide event
				position: {
					my: 'center left',
					at: 'center right',
					adjust: { x: 5 }
				},
				style: {
					classes: 'qtip-red'
				}
			});
		});
	</script>
</head>

<body>
	<div id="container">
		<?=$this->load->view('includes/inc-member-menu','', TRUE)?>
		<?=$view?>

		<!--div id="common-popup-container">
			<div id="common-popup">
				<div id="content"></div>
				<input type="checkbox" name="chk-dont-show-popup" id="chk-dont-show-popup" />
				<a href="#" id="b-close-common-popup"></a>
			</div>
		</div-->

	</div>

</body>
</html>