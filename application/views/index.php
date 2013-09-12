<div id="content-body" class="page-index">
	<?=$this->load->view('includes/inc-main-menu','', TRUE)?>

	<div id="content">
	<?php
		if(!is_user_session_exist($this)):
	?>
		<a href="<?= site_url('member/register') ?>"
			style="position:absolute; bottom:20px; left:264px; display:block; text-indent:-3000px; background:transparent url('<?= base_url('images'.(language_helper_is_en($this)?'/en':'').'/index/b-register.png') ?>') no-repeat; width:482px; height:77px;"
			>ลงทะเบียน</a>
	<?php endif; ?>
	</div>
</div>

<?=$this->load->view('includes/inc-term-condition','', TRUE)?>