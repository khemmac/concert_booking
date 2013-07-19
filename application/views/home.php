<?php
	$errors_message = $this->session->flashdata('errors_message');
?>
<div id="container" class="page-home">
	<?=$this->load->view('includes/inc-menu-1','', TRUE)?>

	<div id="content">
		<div id="box"></div>
		<!--a href="presale" class="b-presale"></a-->
		<a href="early" class="b-early"></a>
	</div>
</div>
