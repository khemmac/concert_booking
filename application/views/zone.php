<div id="content-body" class="page-zone">
	<?=$this->load->view('includes/inc-main-menu','', TRUE)?>

	<div id="content">
		<img usemap="#zone-map" src="<?= base_url("/images/zone/map.png") ?>" style="width:525px; height:554px; position:absolute;" />
		<map name="zone-map">
			<area shape="polygon" coords="454,263,489,258,491,274,455,274" href="<?= site_url('seat/n1f') ?>" title="N1F">
			<area shape="polygon" coords="455,280,491,279,490,296,454,290" href="<?= site_url('seat/n1g') ?>" title="N1G">
			<area shape="polygon" coords="453,296,488,301,483,316,450,306" href="<?= site_url('seat/n1h') ?>" title="N1H">
			<area shape="polygon" coords="448,313,483,322,475,338,444,322" href="<?= site_url('seat/n1i') ?>" title="N1I">
			<area shape="polygon" coords="441,328,472,343,464,356,435,335" href="<?= site_url('seat/n1j') ?>" title="N1J">
			<area shape="polygon" coords="432,341,461,361,451,373,426,348" href="<?= site_url('seat/n1k') ?>" title="N1K">
			<area shape="polygon" coords="422,353,448,378,443,383,419,356" href="<?= site_url('seat/n1l') ?>" title="N1L">
			<area shape="polygon" coords="436,378,441,385,433,392,428,384" href="<?= site_url('seat/e1a') ?>" title="E1A">
			<area shape="polygon" coords="396,385,426,386,432,393,410,408" href="<?= site_url('seat/e1b') ?>" title="E1B">
			<area shape="polygon" coords="381,385,393,386,407,410,378,423,366,394" href="<?= site_url('seat/e1c') ?>" title="E1C">
			<area shape="polygon" coords="352,400,363,395,375,424,362,429" href="<?= site_url('seat/e1d') ?>" title="E1D">
			<area shape="polygon" coords="337,405,348,401,359,431,345,435" href="<?= site_url('seat/e1e') ?>" title="E1E">
			<area shape="polygon" coords="321,410,334,406,343,436,328,439" href="<?= site_url('seat/e1f') ?>" title="E1F">
			<area shape="polygon" coords="306,413,319,410,325,440,311,443" href="<?= site_url('seat/e1g') ?>" title="E1G">
			<area shape="polygon" coords="290,415,303,413,309,444,293,445" href="<?= site_url('seat/e1h') ?>" title="E1H">
			<area shape="polygon" coords="274,416,289,415,290,445,276,446" href="<?= site_url('seat/e1i') ?>" title="E1I">
			<area shape="polygon" coords="258,415,273,416,273,446,258,446" href="<?= site_url('seat/e1i') ?>" title="E1J">
			<area shape="polygon" coords="243,415,257,416,256,447,240,446" href="<?= site_url('seat/e1k') ?>" title="E1K">
			<area shape="polygon" coords="228,414,242,415,238,445,222,443" href="<?= site_url('seat/e1l') ?>" title="E1L">
			<area shape="polygon" coords="212,411,226,413,220,444,204,441" href="<?= site_url('seat/e1m') ?>" title="E1M">
			<area shape="polygon" coords="197,407,210,411,203,440,187,436" href="<?= site_url('seat/e1n') ?>" title="E1N">
			<area shape="polygon" coords="181,401,195,406,185,436,170,431" href="<?= site_url('seat/e1o') ?>" title="E1O">
			<area shape="polygon" coords="167,396,180,401,168,431,152,425" href="<?= site_url('seat/e1p') ?>" title="E1P">
			<area shape="polygon" coords="120,408,135,385,149,385,165,395,150,424" href="<?= site_url('seat/e1q') ?>" title="E1Q">
			<area shape="polygon" coords="132,385,118,407,96,392,103,385" href="<?= site_url('seat/e1r') ?>" title="E1R">
			<area shape="polygon" coords="100,384,94,392,86,384,93,377" href="<?= site_url('seat/e1s') ?>" title="E1S">
			<area shape="polygon" coords="104,352,110,357,84,384,79,378" href="<?= site_url('seat/s1a') ?>" title="S1A">
			<area shape="polygon" coords="93,340,103,349,76,375,66,362" href="<?= site_url('seat/s1b') ?>" title="S1B">
			<area shape="polygon" coords="54,343,87,327,93,336,63,358" href="<?= site_url('seat/s1c') ?>" title="S1C">
			<area shape="polygon" coords="44,321,80,311,85,323,52,340" href="<?= site_url('seat/s1d') ?>" title="S1D">
			<area shape="polygon" coords="38,301,75,296,78,308,44,318" href="<?= site_url('seat/s1e') ?>" title="S1E">
			<area shape="polygon" coords="36,279,74,280,74,291,38,296" href="<?= site_url('seat/s1e') ?>" title="S1F">
			<area shape="polygon" coords="38,259,73,264,72,274,33,273" href="<?= site_url('seat/s1g') ?>" title="S1G">
		</map>
		<?= form_open('zone/submit'); ?>
		<ul class="submit-container">
			<li><?= form_submit(array(
				'id'		=> 'submit',
				'value'		=> '',
				'class'		=> 'submit'
			)); ?></li>
		</ul>
		<?= form_close() ?>

		<div id="booking-info" style="border:0px solid #f00; position:absolute; top:330px; right:16px; width:271px; height:117px;">
			<table cellpadding="2" cellspacing="0" border="0" style="color:white;">
				<tr>
					<td align="right">โซน :</td>
					<td><?= (count($zones)>0)?strtoupper(implode(', ', $zones)):'-' ?></td>
				</tr>
				<tr>
					<td align="right">ที่นั่ง :</td>
					<td><?= (count($seats)>0)?strtoupper(implode(', ', $seats)):'-' ?></td>
				</tr>
				<tr>
					<td align="right">ราคารวม :</td>
					<td><?= number_format($price) ?> B.-</td>
				</tr>
			</table>
		</div>
	</div>
</div>
