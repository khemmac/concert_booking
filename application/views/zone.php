<div id="content-body" class="page-zone">
	<?=$this->load->view('includes/inc-main-menu','', TRUE)?>

	<div id="content">
		<?= form_open('zone/submit'); ?>
		<?= form_submit(array(
				'id'		=> 'submit',
				'value'		=> '',
				'class'		=> 'submit'
			));
		?>
		<?= form_close() ?>
	</div>
	<img usemap="#zone-map" src="<?= base_url("/images/common/blank.gif") ?>" style="width:486px; height:390px; position:absolute; top:203px; left:73px;" />
	<map name="zone-map">
		<area shape="polygon" coords="112,0,237,0,237,390,112,390,0,280,0,110" href="<?= site_url('seat') ?>" alt="A1">
		<area shape="polygon" coords="370,0,249,0,249,390,370,390,486,280,486,110" href="<?= site_url('seat') ?>" alt="A2">
	</map>
</div>
