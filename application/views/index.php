<div id="content-body" class="page-index">
	<?=$this->load->view('includes/inc-main-menu','', TRUE)?>

	<div id="content">
	<?php
		if(!is_user_session_exist($this)):
	?>
		<a href="<?= site_url('member/login') ?>"
			style="position:absolute; bottom:50px; left:264px; display:block; text-indent:-3000px; background:transparent url('<?= base_url('images'.(language_helper_is_en($this)?'/en':'').'/home/buttons.gif') ?>') no-repeat 0px -104px; width:482px; height:53px;"
			>ซื้อบัตร Presale</a>
	<?php endif; ?>
	</div>
</div>

<?=$this->load->view('includes/inc-term-condition','', TRUE)?>