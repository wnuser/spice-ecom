<?php
session_start();
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Online Order - Customers</title>
		
		<!-- Favicon -->
		<!--<link rel="shortcut icon" href="assets/img/favicon.png">-->
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
		
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	
		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
		<?php include('includes/header.php'); ?>
			
			<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Customers</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
									</li>
									<li class="breadcrumb-item active">Customers</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
							
							<div class="card card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-center table-hover datatable">
											<thead class="thead-light">
												<tr>
												    <th>S.No</th>
													<th>Customer</th>
													<th>Email</th>
													<th>Address</th>
													<th>Country</th>
													<th>Zip Code</th>
													<th>Registered On</th>
													<th>Status</th>
													<th class="text-right">Actions</th>
												</tr>
											</thead>
											<tbody>
											<?php 
											$i=0;
											$customers_details=mysqli_query($con,"select * from customers_details where is_active='1'");
											while($customers_details_row=mysqli_fetch_array($customers_details))
											{
											?>    
												<tr>
													<td>
														<h2 class="table-avatar">
															<a href="javascript:void(0)" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-02.jpg" alt="User Image"></a>
															<a href="javascript:void(0)"><?php echo $customers_details_row['customer_name']; ?> <span><?php echo $customers_details_row['phone']; ?></span></a>
														</h2>
													</td>
													<td><?php echo $customers_details_row['email_id']; ?></td>
													<td>
													<?php if($customers_details_row['address1']!='') { echo $customers_details_row['address1']; } ?>    
													<?php if($customers_details_row['address2']!='') { echo $customers_details_row['address2']; } ?>    
													</td>
													<td><?php echo $customers_details_row['country']; ?></td>
														<td><?php echo $customers_details_row['zip_code']; ?></td>
													<td>
													 <?php if($customers_details_row['status']=='1') { ?>   
													    <span class="badge badge-pill bg-success-light">Active</span>
													 <?php } else { ?>
													    <span class="badge badge-pill bg-danger-light">Active</span>
													 <?php } ?>
													</td>
													<td class="text-right">
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Edit</a> 
														<a href="javascript:void(0);" class="btn btn-sm btn-white text-danger mr-2"><i class="far fa-trash-alt mr-1"></i>Delete</a>
													</td>
												</tr>
											<?php $i=$i+1; } ?>	
											</tbody>
										</table>
									</div>
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
		
		<!-- Datatables JS -->
		<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/datatables/datatables.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>

	</body>
</html>