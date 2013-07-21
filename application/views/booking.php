<div id="content-body" class="page-booking">
	<?=$this->load->view('includes/inc-menu-2','', TRUE)?>

	<div id="content">
		<div id="header">
			<span id="name">test test</span>
			<span id="code">3029103938291</span>
			<span id="booking-code">XB3920</span>
		</div>
		<?= form_open('controller/form_booking/booking'); ?>
		<?= form_submit(array(
				'id'		=> 'submit',
				'value'		=> 'Submit',
				'class'		=> 'submit'
			));
		?>
		<?= form_close() ?>
	</div>
</div>
