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
		<?= form_hidden('zone_id', $zone['id']) ?><?= form_hidden('zone_name', $zone['name']) ?>
			<div id="seat-container" style="background-image: url('<?= base_url('images/seat/plan/'.$zone_name.'.png'); ?>')">
				<div id="chair-container">
					<?php
						$row_index = 1;
						foreach(array_reverse($zone['seats']) AS $row_name=>$chair_list):
					?>
						<div class="row row-<?= $row_name ?> row-index-<?= $row_index ?>">
					<?php
							$row_index++;

							foreach($chair_list AS $chair_key => $chair):
								if($chair['no']>0):
									$chair_id = $chair['id'];
									$chair_no = $row_name . $chair['no'];
									$chiar_position = $chair['position'];
									if(($chair['is_booked']==1 && $chair['is_own']==0) || $chair['is_soldout']==1):
										echo '<div class="booked pos pos-'.$chiar_position.'"></div>';
									else:
									?>
										<a href="#<?= $chair_no ?>" title="<?= strtoupper($chair_no) ?>" id="b-<?= $chair_no ?>" class="pos pos-<?= $chiar_position ?> <?= ($chair['is_own']==1)?'active':'' ?>"></a>
										<?= form_checkbox(array(
											'name'=>'seat[]', 'id'=>$chair_no, 'value'=>$chair_id,
											'checked'=>($chair['is_own']==1),
											'style'=>'left:'.(($chair['no'] * 15)+650).'px;'
										)) ?>
									<?php
									endif;
								else:
									?>
										<div class="pos pos-<?= $chiar_position ?>"></div>
									<?php
								endif;
							endforeach;
					?>
						</div>
					<?php
						endforeach;
					?>
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

		<div id="stage"></div>
	</div>
</div>
<?=$this->load->view('includes/seat/'.$zone_name,'', TRUE)?>

<script type="text/javascript" src="<?= base_url('js/seat.js') ?>"></script>
<script type="text/javascript">
	$(function(){
		var seat = new Seat({ current:<?= $zone['current_booking_count'] ?> });
	});
</script>
<?php
	$popup = $this->input->get('popup');
	if(!empty($popup)):
?>
<script type="text/javascript"> $(function(){ common.popup.show(null, '#<?= $popup ?>'); }); </script>
<?php endif; ?>
