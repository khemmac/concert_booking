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
								$chair_id = $row_name . $chair['no'];
								$chiar_position = $chair['position'];

								if($chair['no']>0):
									?>
										<a href="#<?= $chair_id ?>" title="<?= strtoupper($chair_id) ?>" id="b-<?= $chair_id ?>" class="pos pos-<?= $chiar_position ?>"></a>
										<?= form_checkbox(array(
											'name'=>'seat[]', 'id'=>$chair_id, 'value'=>$chair_id,
											'style'=>'left:'.(($chair['no'] * 15)+700).'px;'
										)) ?>
									<?php
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