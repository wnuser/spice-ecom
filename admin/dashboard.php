<?php 

include('includes/config.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Online Order - Dashboard</title>
		
		<!-- Favicon -->
		<!--<link rel="shortcut icon" href="assets/img/favicon.png">-->
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
		
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		
	  <style>
	  
	  .dash-title { color:#455560; }   
	  .dash-count { margin-left: 40px; }   
	  .dash-counts p { color:#455560; }   
	      
	  </style>	
		
	</head>
	<body>
	
		<!-- Main Wrapper -->
		<div class="main-wrapper">
		    
		    
		    <?php include('includes/header.php'); ?>
			
			<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">
            
					<div class="row">
					    
					    <?php 
					    
					    $order_counts=mysqli_num_rows(mysqli_query($con,"select * from orders_table where status='1'"));
					    $order_total=mysqli_fetch_array(mysqli_query($con,"select sum(total_price) as total_price from orders where is_active='1'"));
					    ?>
					    
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
							 	 <a href="reportsall.php">       
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-1">
											<i class="fas fa-cart-arrow-down"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title">Orders</div>
											<div class="dash-counts">
												<p><?php echo $order_counts; ?></p>
											</div>
										</div>
										<!--<div class="dash-count">-->
										<!--	<div class="dash-title">Total</div>-->
										<!--	<div class="dash-counts">-->
										<!--		<p>£ <?php echo  number_format($order_total['total_price'],2); ?></p>-->
										<!--	</div>-->
										<!--</div>-->
									</div>
								 </a>	
								</div>
							</div>
						</div>
						
						<?php 
					    
					    $purchase_counts=mysqli_num_rows(mysqli_query($con,"select * from invoiceinfo_clb where is_active='1'"));
					    $purchase_total=mysqli_fetch_array(mysqli_query($con,"select sum(grand_total) as grand_total from invoiceinfo_clb where is_active='1'"));
					    ?>
						
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
								  <a href="purchase_reportsall.php">   
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<i class="fas fa-shopping-cart"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title">Purchase</div>
											<div class="dash-counts">
												<p><?php echo $purchase_counts; ?></p>
											</div>
										</div>
										<!--<div class="dash-count">-->
										<!--	<div class="dash-title">Total</div>-->
										<!--	<div class="dash-counts">-->
										<!--		<p>£ <?php echo  number_format($purchase_total['grand_total'],2); ?></p>-->
										<!--	</div>-->
										<!--</div>-->
									</div>
								 </a>	
								</div>
							</div>
						</div>
						
					    <?php 
					    
					    $sales_counts=mysqli_num_rows(mysqli_query($con,"select * from orders where status='4' and is_active='1'"));
					    $sales_total=mysqli_fetch_array(mysqli_query($con,"select sum(total_price) as total_price from orders where status='4' and is_active='1'"));
					    ?>
						
						
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
								   <a href="sales_order.php">    
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-3">
											<i class="fas fa-shopping-bag"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title">Sales</div>
											<div class="dash-counts">
												<p><?php echo $sales_counts; ?></p>
											</div>
										</div>
										<!--<div class="dash-count">-->
										<!--	<div class="dash-title">Total</div>-->
										<!--	<div class="dash-counts">-->
										<!--		<p>£ <?php echo number_format($sales_total['total_price'],2); ?></p>-->
										<!--	</div>-->
										<!--</div>-->
									</div>
								  </a>	
								</div>
							</div>
						</div>
						
					   <?php 
					    
					    $expenses_counts=mysqli_num_rows(mysqli_query($con,"select * from expenses_receipt where is_active='1'"));
					    $expenses_total=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as amount from expenses_receipt where is_active='1'"));
					    ?>	
						
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
								   <a href="expenses_reportsall.php">    
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-4">
											<i class="far fa-file"></i>
										</span> 
										<div class="dash-count">
											<div class="dash-title">Expenses</div>
											<div class="dash-counts">
												<p><?php echo $expenses_counts; ?></p>
											</div>
										</div>
										<!--<div class="dash-count">-->
										<!--	<div class="dash-title">Total</div>-->
										<!--	<div class="dash-counts">-->
										<!--		<p>£ <?php echo  number_format($expenses_total['amount'],2); ?></p>-->
										<!--	</div>-->
										<!--</div>-->
									</div>
								  </a>	
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
								   <a href="javascript:void(0)">    
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-6">
											<i class="fas fa-chart-bar"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title">Accounts</div>
											<div class="dash-counts">
												<p>00</p>
											</div>
										</div>
									</div>
								  </a>	
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
								   <a href="javascript:void(0)">    
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-7">
											<i class="fas fa-database"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title">Stock</div>
											<div class="dash-counts">
												<p>00</p>
											</div>
										</div>
									</div>
								  </a>	
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
								   <a href="javascript:void(0)">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-8">
											<i class="fas fa-globe"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title">Website Management</div>
											<div class="dash-counts">
												<p>00</p>
											</div>
										</div>
									</div>
								  </a>	
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
								  <a href="javascript:void(0)">    
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-5">
											<i class="fas fa-filter"></i>
										</span> 
										<div class="dash-count">
											<div class="dash-title">Data & Report</div>
											<div class="dash-counts">
												<p>00</p>
											</div>
										</div>
									</div>
								  </a>	
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
								  <a href="javascript:void(0)">    
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-5">
											<i class="fas fa-suitcase"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title">Marketing</div>
											<div class="dash-counts">
												<p>00</p>
											</div>
										</div>
									</div>
								  </a>	
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
								   <a href="javascript:void(0)">    
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-8">
											<i class="fas fa-users"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title">HRM</div>
											<div class="dash-counts">
												<p>00</p>
											</div>
										</div>
									</div>
								  </a>	
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
								  <a href="javascript:void(0)">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-7">
											<i class="fas fa-file-alt"></i>
										</span>
										<div class="dash-count">
											<div class="dash-title">CRM</div>
											<div class="dash-counts">
												<p>00</p>
											</div>
										</div>
									</div>
								  </a>	
								</div>
							</div>
						</div>
					
					</div>
					
				</div>
			</div>
			<!-- /Page Wrapper -->
			
		</div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
		<script src="assets/js/jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Feather Icon JS -->
		<script src="assets/js/feather.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		
		<!-- Chart JS -->
		<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
		<script src="assets/plugins/apexchart/chart-data.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>

	</body>
</html>