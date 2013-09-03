<?php
	$sv = '?v=1.0';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Pragma" content="no-cache" />
	<title>Concert Booking</title>
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
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id, condimentum at, laoreet mattis, massa. Sed eleifend nonummy diam. Praesent mauris ante, elementum et, bibendum at, posuere sit amet, nibh. Duis tincidunt lectus quis dui viverra vestibulum. Suspendisse vulputate aliquam dui. Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend arcu velit quis lacus. Morbi magna magna, tincidunt a, mattis non, imperdiet vitae, tellus. Sed odio est, auctor ac, sollicitudin in, consequat vitae, orci. Fusce id felis. Vivamus sollicitudin metus eget eros.
Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In posuere felis nec tortor. Pellentesque faucibus. Ut accumsan ultricies elit. Maecenas at justo id velit placerat molestie. Donec dictum lectus non odio. Cras a ante vitae enim iaculis aliquam. Mauris nunc quam, venenatis nec, euismod sit amet, egestas placerat, est. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras id elit. Integer quis urna. Ut ante enim, dapibus malesuada, fringilla eu, condimentum quis, tellus. Aenean porttitor eros vel dolor. Donec convallis pede venenatis nibh. Duis quam. Nam eget lacus. Aliquam erat volutpat. Quisque dignissim congue leo.
Mauris vel lacus vitae felis vestibulum volutpat. Etiam est nunc, venenatis in, tristique eu, imperdiet ac, nisl. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In iaculis facilisis massa. Etiam eu urna. Sed porta. Suspendisse quam leo, molestie sed, luctus quis, feugiat in, pede. Fusce tellus. Sed metus augue, convallis et, vehicula ut, pulvinar eu, ante. Integer orci tellus, tristique vitae, consequat nec, porta vel, lectus. Nulla sit amet diam. Duis non nunc. Nulla rhoncus dictum metus. Curabitur tristique mi condimentum orci. Phasellus pellentesque aliquam enim. Proin dui lectus, cursus eu, mattis laoreet, viverra sit amet, quam. Curabitur vel dolor ultrices ipsum dictum tristique. Praesent vitae lacus. Ut velit enim, vestibulum non, fermentum nec, hendrerit quis, leo. Pellentesque rutrum malesuada neque.
Nunc tempus felis vitae urna. Vivamus porttitor, neque at volutpat rutrum, purus nisi eleifend libero, a tempus libero lectus feugiat felis. Morbi diam mauris, viverra in, gravida eu, mattis in, ante. Morbi eget arcu. Morbi porta, libero id ullamcorper nonummy, nibh ligula pulvinar metus, eget consectetuer augue nisi quis lacus. Ut ac mi quis lacus mollis aliquam. Curabitur iaculis tempus eros. Curabitur vel mi sit amet magna malesuada ultrices. Ut nisi erat, fermentum vel, congue id, euismod in, elit. Fusce ultricies, orci ac feugiat suscipit, leo massa sodales velit, et scelerisque mi tortor at ipsum. Proin orci odio, commodo ac, gravida non, tristique vel, tellus. Pellentesque nibh libero, ultricies eu, sagittis non, mollis sed, justo. Praesent metus ipsum, pulvinar pulvinar, porta id, fringilla at, est.
Phasellus felis dolor, scelerisque a, tempus eget, lobortis id, libero. Donec scelerisque leo ac risus. Praesent sit amet est. In dictum, dolor eu dictum porttitor, enim felis viverra mi, eget luctus massa purus quis odio. Etiam nulla massa, pharetra facilisis, volutpat in, imperdiet sit amet, sem. Aliquam nec erat at purus cursus interdum. Vestibulum ligula augue, bibendum accumsan, vestibulum ut, commodo a, mi. Morbi ornare gravida elit. Integer congue, augue et malesuada iaculis, ipsum dui aliquet felis, at cursus magna nisl nec elit. Donec iaculis diam a nisi accumsan viverra. Duis sed tellus et tortor vestibulum gravida. Praesent elementum elit at tellus. Curabitur metus ipsum, luctus eu, malesuada ut, tincidunt sed, diam. Donec quis mi sed magna hendrerit accumsan. Suspendisse risus nibh, ultricies eu, volutpat non, condimentum hendrerit, augue. Etiam eleifend, metus vitae adipiscing semper, mauris ipsum iaculis elit, congue gravida elit mi egestas orci. Curabitur pede.
Maecenas aliquet velit vel turpis. Mauris neque metus, malesuada nec, ultricies sit amet, porttitor mattis, enim. In massa libero, interdum nec, interdum vel, blandit sed, nulla. In ullamcorper, est eget tempor cursus, neque mi consectetuer mi, a ultricies massa est sed nisl. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Proin nulla arcu, nonummy luctus, dictum eget, fermentum et, lorem. Nunc porta convallis pede.
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