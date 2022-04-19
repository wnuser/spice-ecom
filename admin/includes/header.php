<?php
   $activePage = basename($_SERVER['PHP_SELF'], ".php");
?>

<!-- Header -->
    <div class="header">
        <!-- Logo -->
		<div class="header-left">
			<a href="#" class="logo">
				<img src="images/logo.png" alt="Logo">
			</a>
			<a href="#" class="logo logo-small">
				<img src="images/logo.png" alt="Logo" style="width:90px;" width="30" height="30">
			</a>
		</div>
		<!-- /Logo -->
		<!-- Sidebar Toggle -->
		<a href="javascript:void(0);" id="toggle_btn">
			<i class="fas fa-bars"></i>
		</a>
		
		<a class="mobile_btn" id="mobile_btn">
			<i class="fas fa-bars"></i>
		</a>
		<!-- /Mobile Menu Toggle -->
	    <!-- Header Menu -->
			<ul class="nav user-menu">
				<!-- User Menu -->
				<li class="nav-item dropdown has-arrow main-drop">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img">
							<img src="assets/img/profiles/avatar-01.jpg" alt="">
							<span class="status online"></span>
						</span>
						<span>Admin</span>
					</a>
					<div class="dropdown-menu">
						<!--<a class="dropdown-item" href="profile.html"><i data-feather="user" class="mr-1"></i> Profile</a>-->
						<!--<a class="dropdown-item" href="settings.html"><i data-feather="settings" class="mr-1"></i> Settings</a>-->
						<a class="dropdown-item" href="logout.php"><i data-feather="log-out" class="mr-1"></i> Logout</a>
					</div>
				</li>
				<!-- /User Menu -->
			</ul>
		<!-- /Header Menu -->
	</div>
<!-- /Header -->
	<!-- Sidebar -->
	<div class="sidebar" id="sidebar">
		<div class="sidebar-inner slimscroll">
			<div id="sidebar-menu" class="sidebar-menu">
				<ul>
					<li class="menu-title"><span>Main</span></li>
					<li class="<?= ($activePage == 'dashboard') ? 'active':''; ?>">
						<a href="dashboard.php"><i data-feather="clipboard"></i> <span>Dashboard</span></a>
					</li>
					<li class="<?= ($activePage == 'settings' || $activePage == 'preferences' || $activePage == 'tax-types' || $activePage == 'change-password') ? 'active':''; ?>">
						<a href="settings.php"><i data-feather="settings"></i> <span>Settings</span></a>
					</li>
					
					<li class="submenu <?= ($activePage == 'deals' || $activePage == 'view_deals' || $activePage == 'edit_deals') ? 'active':''; ?>">
						<a href="#"><i data-feather="credit-card"></i> <span> Deals</span> <span class="menu-arrow"></span></a>
						<ul>
							<li><a class="<?= ($activePage == 'deals') ? 'active':''; ?>" href="deals.php">Add Product</a></li>
							<li><a class="<?= ($activePage == 'view_deals' || $activePage == 'edit_deals') ? 'active':''; ?>" href="view_deals.php">Manage Products</a></li>
							<li><a class="<?= ($activePage == 'manage_deal') ? 'active' : ''; ?>" href="manage_deal.php">Manage Deal</a></li>
						</ul>
    			    </li>
					
					
					<li class="<?= ($activePage == 'spices') ? 'active':''; ?>">
						<a href="spices.php"><i data-feather="file-text"></i> <span>Spices</span></a>
					</li>

					<li class="<?= ($activePage == 'manage_recipe') ? 'active':''; ?>">
						<a href="manage_recipe.php"><i data-feather="file-text"></i> <span>Manage Recipes</span></a>
					</li>
					

					<li class="submenu <?= ($activePage == 'cusines' || $activePage == 'products' ||$activePage == 'world_cuisines' || $activePage == 'view_world_cuisines' || $activePage == 'edit_world_cuisines') ? 'active':''; ?>">
						<a href="#"><i data-feather="credit-card"></i> <span> World Cuisines</span> <span class="menu-arrow"></span></a>
						<ul>
						    <li><a class="<?= ($activePage == 'cusines') ? 'active':''; ?>" href="cusines.php">Cuisines</a></li>
    						<li><a class="<?= ($activePage == 'products') ? 'active':''; ?>" href="products.php">Cuisines Categories</a></li>
							<li><a class="<?= ($activePage == 'world_cuisines') ? 'active':''; ?>" href="world_cuisines.php">Add Product</a></li>
							<li><a class="<?= ($activePage == 'view_world_cuisines' || $activePage == 'edit_world_cuisines') ? 'active':''; ?>" href="view_world_cuisines.php">Manage Products</a></li>
						</ul>
    			    </li>
					
					<li class="submenu <?= ($activePage == 'seasoning_categories' || $activePage == 'seasoning_mix' || $activePage == 'view_seasoning_mix' || $activePage == 'edit_seasoning_mix') ? 'active':''; ?>">
						<a href="#"><i data-feather="credit-card"></i> <span> Seasoning Mix</span> <span class="menu-arrow"></span></a>
						<ul>
						    <li><a class="<?= ($activePage == 'seasoning_categories') ? 'active':''; ?>" href="seasoning_categories.php">Categories</a></li>
							<li><a class="<?= ($activePage == 'seasoning_mix') ? 'active':''; ?>" href="seasoning_mix.php">Add Product</a></li>
							<li><a class="<?= ($activePage == 'view_seasoning_mix' || $activePage == 'edit_seasoning_mix') ? 'active':''; ?>" href="view_seasoning_mix.php">Manage Products</a></li>
						</ul>
    			    </li>
    			    
					
					<li class="<?= ($activePage == 'reportsall' || $activePage == 'invoice_edit' || $activePage == 'reportinvoice') ? 'active':''; ?>">
						<a href="reportsall.php"><i data-feather="shopping-cart"></i> <span>Orders</span></a>
					</li>
    			   
    			   <li class="<?= ($activePage == 'sales_order') ? 'active':''; ?>">
						<a href="sales_order.php"><i data-feather="shopping-bag"></i> <span>Sales</span></a>
					</li>
					
					<li class="submenu <?= ($activePage == 'purchase_invoice' || $activePage == 'purchase_reportsall' || $activePage == 'purchase_invoice_edit' || $activePage == 'purchase_reportinvoice') ? 'active':''; ?>">
						<a href="#"><i data-feather="credit-card"></i> <span> Purchase</span> <span class="menu-arrow"></span></a>
						<ul>
							<li><a class="<?= ($activePage == 'purchase_invoice') ? 'active':''; ?>" href="purchase_invoice.php">New Purchase</a></li>
							<li><a class="<?= ($activePage == 'purchase_reportsall') ? 'active':''; ?>" href="purchase_reportsall.php">Manage Purchase</a></li>
						</ul>
    			    </li>
    			    
    			    <li class="submenu <?= ($activePage == 'expenses_receipt' || $activePage == 'expenses_reportsall' || $activePage == 'expenses_reportsall' || $activePage == 'expenses_reportinvoice') ? 'active':''; ?>">
						<a href="#"><i data-feather="briefcase"></i> <span> Expenses</span> <span class="menu-arrow"></span></a>
						<ul>
							<li><a class="<?= ($activePage == 'expenses_receipt') ? 'active':''; ?>" href="expenses_receipt.php">New Expenses</a></li>
							<li><a class="<?= ($activePage == 'expenses_reportsall') ? 'active':''; ?>" href="expenses_reportsall.php">Manage Expenses</a></li>
						</ul>
    			    </li>
    			    
    			    <li class="<?= ($activePage == 'stock') ? 'active':''; ?>">
						<a href="stock.php"><i data-feather="layers"></i> <span>Stock</span></a>
					</li>
					
					<li class="<?= ($activePage == 'stock_report') ? 'active':''; ?>">
						<a href="stock_report.php"><i data-feather="filter"></i> <span>Stock Report</span></a>
					</li>
					
						<li class="<?= ($activePage == 'proft_loss') ? 'active':''; ?>">
						<a href="proft_loss.php"><i data-feather="bar-chart"></i> <span>Profit & Loss</span></a>
					</li>
				
				</ul>
			</div>
		</div>
	</div>
	<!-- /Sidebar -->