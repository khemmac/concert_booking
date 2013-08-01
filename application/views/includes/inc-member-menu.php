<?php $sess_user_id = get_user_session_id($this); ?>
<ul id="member-sub-menu">
	<?php if(!empty($sess_user_id) && $sess_user_id>0): ?>
	<li><a class="menu-logout" href="<?= site_url('member/logout') ?>"></a></li>
	<li><a class="menu-profile" href="<?= site_url('member/profile') ?>"></a></li>
	<?php else: ?>
	<li><a class="menu-login" href="<?= site_url('member/login') ?>"></a></li>
	<li><a class="menu-register" href="<?= site_url('member/register') ?>"></a></li>
	<?php endif; ?>
</ul>