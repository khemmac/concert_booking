<?php
	$zone_name = $zone['name'];
?>
<script type="text/javascript">
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
</script>
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
<style type="text/css">
	<?php if($zone_name=='e1a'): ?>
	#seat-container { top:232px; left:163px; width:505px; height:243px; }
	.row { width:395px; left:55px; }
	.row-q { top:137px; }
	.row-r { top:112px; }
	.row-t { top:64px; }
	.row-s { top:89px; }
	.row-u { top:40px; }
	.row-v { top:17px; }

	.pos-1 { left:1px; }
	.pos-2 { left:33px; }
	.pos-3 { left:64px; }
	.pos-4 { left:95px; }
	.pos-5 { left:126px; }
	.pos-6 { left:157px; }
	.pos-7 { left:188px; }
	.pos-8 { left:220px; }
	.pos-9 { left:251px; }
	.pos-10 { left:282px; }
	.pos-11 { left:313px; }
	.pos-12 { left:345px; }
	.pos-13 { left:375px; }
	<?php elseif($zone_name=='e1b'): ?>
	#seat-container { top:162px; left:58px; width:721px; height:404px; }
	.row { width:613px; left:55px; }
	.row-j { top:282px; }
	.row-k { top:258px; }
	.row-l { top:234px; }
	.row-m { top:210px; }
	.row-n { top:185px; }
	.row-p { top:161px; }
	.row-q { top:137px; }
	.row-r { top:112px; }
	.row-t { top:64px; }
	.row-s { top:89px; }
	.row-u { top:40px; }
	.row-v { top:17px; }

	.pos-1 { left:1px; }
	.pos-2 { left:33px; }
	.pos-3 { left:64px; }
	.pos-4 { left:95px; }
	.pos-5 { left:126px; }
	.pos-6 { left:157px; }
	.pos-7 { left:188px; }
	.pos-8 { left:220px; }
	.pos-9 { left:251px; }
	.pos-10 { left:282px; }
	.pos-11 { left:313px; }
	.pos-12 { left:345px; }
	.pos-13 { left:375px; }
	.pos-14 { left:407px; }
	.pos-15 { left:438px; }
	.pos-16 { left:469px; }
	.pos-17 { left:500px; }
	.pos-18 { left:531px; }
	.pos-19 { left:562px; }
	.pos-20 { left:593px; }
	<?php endif; ?>
</style>
