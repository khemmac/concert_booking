<?php
	$zone_name = $zone['name'];
?>
<div id="content-body" class="page-seat">
	<?=$this->load->view('includes/inc-main-menu','', TRUE)?>

	<div id="content">
		<div id="zone-info">
			<ul>
				<li>Zone&nbsp;&nbsp;&nbsp;&nbsp;<?= strtoupper($zone['zone']) ?></li>
				<li>Class&nbsp;&nbsp;&nbsp;<?= strtoupper($zone['class']) ?></li>
				<li>Blog&nbsp;&nbsp;&nbsp;&nbsp;<?= strtoupper($zone['blog']) ?></li>
			</ul>
		</div>

		<?= form_open('seat/submit'); ?>
		<?= form_hidden('booking_id', $booking_id) ?>
		<?= form_hidden('zone_id', $zone['id']) ?>
		<?= form_hidden('zone_name', $zone['name']) ?>
			<div id="seat-container" style="background-image: url('<?= base_url('images/seat/plan/'.$zone_name.'.png'); ?>')">
				<div id="chair-container">
					<?=$this->load->view('includes/partials/seat-chair','', TRUE)?>
				</div>
			</div>
			<ul class="submit-container">
				<li><?= form_submit(array(
						'id'		=> 'submit',
						'value'		=> '',
						'class'		=> 'submit'
					)); ?></li>
			</ul>
		<?= form_close() ?>

		<ul class="b-back-ctnr">
			<li><a href="<?= site_url('zone') ?>" title="เลือกโซนที่นั่งอื่นๆ" class="b-back-zone"></a></li>
		</ul>

		<div id="stage"></div>
	</div>
</div>
<?=$this->load->view('includes/seat/'.$zone_name,'', TRUE)?>

<script type="text/javascript" src="<?= base_url('js/seat.js') ?>"></script>
<script type="text/javascript">
	$(function(){
		var seat = new Seat({
			limit:<?= $zone['limit'] ?>,
			current:<?= $zone['current_booking_count'] ?>
		});
	});
</script>
