<div id="content-body" class="page-seat">
	<?=$this->load->view('includes/inc-menu-2','', TRUE)?>

	<div id="content">
		<?= form_open('seat/submit'); ?>
		<?= form_submit(array(
				'id'		=> 'submit',
				'value'		=> 'Submit',
				'class'		=> 'submit'
			));
		?>
		<?= form_close() ?>
	</div>
</div>
