<?php
   $activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<div class="widget settings-menu">
	<ul>
		<li class="nav-item">
			<a href="profile.php" class="nav-link <?= ($activePage == 'profile') ? 'active':''; ?>">
				<i class="far fa-user"></i> <span>Profile Settings</span>
			</a>
		</li>
		<li class="nav-item">
			<a href="preferences.php" class="nav-link <?= ($activePage == 'preferences') ? 'active':''; ?>">
				<i class="fas fa-cog"></i> <span>Preferences</span>
			</a>
		</li>
		<li class="nav-item">
			<a href="tax-types.php" class="nav-link <?= ($activePage == 'tax-types') ? 'active':''; ?>">
				<i class="far fa-check-square"></i> <span>Tax Types</span>
			</a>
		</li>
	
		<li class="nav-item">
			<a href="change-password.php" class="nav-link <?= ($activePage == 'change-password') ? 'active':''; ?>">
				<i class="fas fa-unlock-alt"></i> <span>Change Password</span>
			</a>
		</li>
	</ul>
</div>