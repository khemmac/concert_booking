<div id="content-body" class="page-plan">
	<?=$this->load->view('includes/inc-main-menu','', TRUE)?>

	<div id="content">
		<img id="all" src="<?= base_url("/images/zone/plan-all.gif") ?>" style="width:590px; height:624px; position:absolute; top:100px; left:86px;" />
		<img id="early" src="<?= base_url("/images/zone/plan-early.gif") ?>" style="width:590px; height:623px; position:absolute; top:100px; left:86px; display:none;" />
		<img id="presale" src="<?= base_url("/images/zone/plan-presale.gif") ?>" style="width:590px; height:624px; position:absolute; top:100px; left:86px; display:none;" />
		<img id="fanzone" src="<?= base_url("/images/zone/plan-fanzone.gif") ?>" style="width:590px; height:624px; position:absolute; top:100px; left:86px; display:none;" />

		<ul id="b-container">
			<li class="b-all-container"><a href="#all" class="b-all-active">ทั้งหมด</a></li>
			<li class="b-early-container"><a href="#early" class="b-early">ทั้งหมด</a></li>
			<li class="b-presale-container"><a href="#presale" class="b-presale">ทั้งหมด</a></li>
			<li class="b-fanzone-container"><a href="#fanzone" class="b-fanzone">ทั้งหมด</a></li>
		</ul>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		var imgs = $('#content img'),
			buttons = $('#b-container a');
		buttons.click(function(e){
			e.preventDefault();

			var el = $(this),
				href=$(this).attr('href');

			buttons.each(function(i,o){
				var cls = $(o).attr('class');
				$(o).removeClass(cls).addClass(cls.replace('-active',''));
			});
			imgs.hide();

			$(href).show();

			el.attr('class', el.attr('class')+'-active');

		});
	});
</script>
