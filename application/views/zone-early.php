<div id="content-body" class="page-zone-early">
	<?=$this->load->view('includes/inc-main-menu','', TRUE)?>

	<div id="content">
		<img usemap="#zone-map" src="<?= base_url("/images/zone/plan-early.gif") ?>" style="width:590px; height:623px; position:absolute; left:32px;" />
		<a href="<?= site_url('seat_early/'.$booking_id) ?>" title="A3"
			style="display:block; position:absolute; top:238px; left:308px; width:36px; height:28px;"></a>

		<?= form_open('zone_early/submit'); ?>
		<?= form_hidden('booking_id', $booking_id) ?>
		<ul class="submit-container">
			<li><?= form_submit(array(
				'id'		=> 'submit',
				'value'		=> '',
				'class'		=> 'submit'
			)); ?></li>
		</ul>
		<?= form_close() ?>

		<div id="remark-info"></div>

		<div id="booking-info" style="border:0px solid #f00; position:absolute; top:330px; right:16px; width:271px; height:117px;">
			<table cellpadding="2" cellspacing="0" border="0" style="color:white;">
				<tr>
					<td align="right">โซน :</td>
					<td>
<?php
	if(count($zones)>0):
		$zones_arr = array();
		foreach($zones AS $z):
			array_push($zones_arr, anchor('seat/'.$z, strtoupper($z), 'title="'.$z.'"'));
		endforeach;
		echo implode(', ', $zones_arr);
	endif;
?>
					</td>
				</tr>
				<tr>
					<td align="right">บัตร :</td>
					<td><?= (count($seats)>0)?count($seats):'-' ?> ใบ</td>
				</tr>
				<tr>
					<td align="right">ราคารวม :</td>
					<td><?= number_format($price) ?> B.-</td>
				</tr>
			</table>
		</div>
	</div>
</div>