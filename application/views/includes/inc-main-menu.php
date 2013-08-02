<?php
	$p=(isset($_GET['page']))?$_GET['page']:uri_string();
?>
<?php if(is_user_session_exist($this)): ?>
<ul id="menu-2">
	<li><a href="#" class="menu-boost"></a></li>
	<li><a href="#" class="menu-facebook"></a></li>
	<li><a href="<?= site_url('zone') ?>" class="menu-1"></a></li>
	<li><a href="<?= site_url('transfer') ?>" class="menu-2"></a></li>
	<li><a href="<?= site_url('booking/check') ?>" class="menu-3"></a></li>
	<li><a href="#condition" class="menu-4"></a></li>
</ul>
<?php elseif($p=='member/register' || $p=='member/register_success'): ?>
<ul id="menu-3">
	<li><a href="#" class="menu-boost"></a></li>
	<li class="menu-register"></li>
</ul>
<?php else: ?>
<ul id="menu-1">
	<li><a href="#" class="menu-boost"></a></li>
	<li><a href="#" class="menu-facebook"></a></li>
	<li><a href="#condition" class="menu-1"></a></li>
	<li><a href="#" class="menu-2"></a></li>
</ul>
<?php endif; ?>