<ul id="member-sub-menu">
	<?php
		if(is_user_session_exist($this)):
			$user_session_obj = get_user_session($this);
	?>
	<li><a class="menu-profile" href="<?= site_url('member/profile') ?>"></a></li>
	<li><a class="menu-logout" href="<?= site_url('member/logout') ?>"></a></li>
	<li class="menu-sep">|</li>
	<li class="menu-name">
		<?= language_helper_is_th($this)?'ยินดีต้อนรับคุณ':'Welcome' ?>
		<?= language_helper_is_th($this)?$user_session_obj['thName']:$user_session_obj['enName'] ?>
	</li>
	<?php else: ?>
		<?php if(!period_helper_close()): // ถ้ายังไม่ปิด ?>
	<li><a class="menu-register" href="<?= site_url('member/register') ?>"></a></li>
	<li><a class="menu-login" href="<?= site_url('member/login') ?>"></a></li>
		<?php endif; ?>
	<?php endif; ?>
</ul>