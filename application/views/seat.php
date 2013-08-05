<?php
	$zone_name = $zone['name'];
?>
<script type="text/javascript" src="<?= base_url('js/seat.js') ?>"></script>
<!--script type="text/javascript">
	$(function(){
		$('#seat-container a').bind('click', function(e){
			e.preventDefault();
			var el = $(this),
				chk_box = $(el.attr('href')),
				is_disabled = chk_box.is(':disabled');
			if(is_disabled) return false;

			var is_checked = chk_box.is(':checked');
			if(is_checked){
				el.removeClass('active');
			}else{
				el.addClass('active');
			}

			chk_box.attr("checked", !chk_box.attr("checked"));
		});
	});
</script-->
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
			<?php
				$row_index = 0;
				foreach($zone['seats'] AS $row_name=>$chair_list):
			?>
				<div class="row row-<?= $row_name ?>">
			<?php
					$row_index++;
					foreach($chair_list AS $chair_key => $chair):
						$chair_id = $row_name . $chair['no'];
						$chiar_position = $chair['position'];
			?>
				<a href="#<?= $chair_id ?>" title="<?= strtoupper($chair_id) ?>" id="b-<?= $chair_id ?>" class="pos-<?= $chiar_position ?>"></a>
				<?= form_checkbox(array(
					'name'=>'seat[]', 'id'=>$chair_id, 'value'=>$chair_id,
					'style'=>'left:'.(($chair['no'] * 15)+700).'px;'
				)) ?>
			<?php
					endforeach;
			?>
				</div>
			<?php
				endforeach;
			?>
			</div>
		<?= form_submit(array(
				'id'		=> 'submit',
				'value'		=> '',
				'class'		=> 'submit'
			));
		?>
		<?= form_close() ?>

		<div id="stage"></div>
	</div>
</div>
<?=$this->load->view('includes/seat/'.$zone_name,'', TRUE)?>