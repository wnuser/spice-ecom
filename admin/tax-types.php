<?php

session_start();
include('includes/config.php');



if(isset($_POST['add_tax'])) {
    
    
   $tax_name=mysqli_real_escape_string($con,$_POST['tax_name']);
   $tax_percentage=mysqli_real_escape_string($con,$_POST['tax_percentage']);
   $tax_status=mysqli_real_escape_string($con,$_POST['tax_status']);
   
   $update_tax_status=mysqli_query($con,"INSERT INTO `tax_master` (`tax_name`, `tax_percentage`, `status`, `create_date`) VALUES ('$tax_name', '$tax_percentage', '$tax_status', CURDATE())");
   
   if($update_tax_status==true) {
    
        echo "<script>alert('Success ! Tax updated.');location.href='tax-types.php';</script>";   
       
   } else {
       
        echo "<script>alert('Oops ! Something went wrong.');location.href='tax-types.php';</script>"; 
       
   }
    
}

if(isset($_POST['edit_tax'])) {
    
   $rec_id=mysqli_real_escape_string($con,$_POST['rec_id']);    
   $tax_name=mysqli_real_escape_string($con,$_POST['tax_name']);
   $tax_percentage=mysqli_real_escape_string($con,$_POST['tax_percentage']);
   $tax_status=mysqli_real_escape_string($con,$_POST['tax_status']);
   
   $update_tax_status=mysqli_query($con,"update tax_master set tax_name='".$tax_name."',tax_percentage='".$tax_percentage."',status='".$tax_status."' where id='".$rec_id."' and is_active='1'");
   
   if($update_tax_status==true) {
    
    echo "<script>alert('Success ! Tax updated.');location.href='tax-types.php';</script>";   
       
   } else {
       
        echo "<script>alert('Oops ! Something went wrong.');location.href='tax-types.php';</script>"; 
       
   }
    
}

if(isset($_POST['delete_tax'])) {
    
   $rec_id=mysqli_real_escape_string($con,$_POST['rec_id']);   
   
   
   $update_tax_status=mysqli_query($con,"update tax_master set is_active='0' where id='".$rec_id."' and is_active='1'");
   
   if($update_tax_status==true) {
    
    echo "<script>alert('Success ! Tax Deleted.');location.href='tax-types.php';</script>";   
       
   } else {
       
        echo "<script>alert('Oops ! Something went wrong.');location.href='tax-types.php';</script>"; 
       
   }
    
}


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Online Order - Settings</title>
		
		<!-- Favicon -->
		<!--<link rel="shortcut icon" href="assets/img/favicon.png">-->
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
		
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
		
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
						<div class="row">
							<div class="col-sm-6">
								<h3 class="page-title">Settings</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
									</li>
									<li class="breadcrumb-item active">Tax Types</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
				
					<div class="row">
						<div class="col-xl-3 col-md-4">
						
							<!-- Settings Menu -->
						     
						     <?php include('includes/setting_sidebar.php'); ?>
						     
							<!-- /Settings Menu -->
							
						</div>
						
						<div class="col-xl-9 col-md-8">
							<div class="card card-table">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title">Tax Types</h5>
										</div>
										<div class="col-auto">
											<a href="javascript:void(0);" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#add_tax">Add New Tax</a>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover mb-0">
											<thead class="thead-light">
												<tr>
													<th>Tax Name </th>
													<th>Tax Percentage (%) </th>
													<th>Status</th>
													<th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>
											<?php 
											
											$tax_master=mysqli_query($con,"select * from tax_master where is_active='1'");
											while($tax_master_row=mysqli_fetch_array($tax_master))
											{
											?>    
											
												<!-- Edit Tax Modal -->
                            					<div id="edit_tax_<?php echo $tax_master_row['id']; ?>" class="modal custom-modal fade" role="dialog">
                            						<div class="modal-dialog modal-dialog-centered" role="document">
                            							<div class="modal-content">
                            								<div class="modal-header">
                            									<h5 class="modal-title">Edit Tax</h5>
                            									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            										<span aria-hidden="true">&times;</span>
                            									</button>
                            								</div>
                            								<div class="modal-body">
                            									<form method="post">
                            										<div class="form-group">
                            											<label>Tax Name <span class="text-danger">*</span></label>
                            											<input type="hidden" name="rec_id" value="<?php echo $tax_master_row['id']; ?>">
                            											<input class="form-control" value="<?php echo $tax_master_row['tax_name']; ?>" type="text" name="tax_name" id="tax_name">
                            										</div>
                            										<div class="form-group">
                            											<label>Tax Percentage (%)  <span class="text-danger">*</span></label>
                            											<input class="form-control" value="<?php echo $tax_master_row['tax_percentage']; ?>" type="text" name="tax_percentage" id="tax_percentage">
                            										</div>
                            										<div class="form-group">
                            											<label>Status <span class="text-danger">*</span></label>
                            											<select class="form-control" id="tax_status" name="tax_status">
                            												<option value="1" <?php if($tax_master_row['status']=='1') { ?> selected <?php } ?>>Active</option>
                            												<option value="0" <?php if($tax_master_row['status']=='0') { ?> selected <?php } ?>>Inactive</option>
                            											</select>
                            										</div>
                            										<div class="submit-section">
                            											<button class="btn btn-primary submit-btn" name="edit_tax">Save</button>
                            										</div>
                            									</form>
                            								</div>
                            							</div>
                            						</div>
                            					</div>
                            					<!-- /Edit Tax Modal -->
                            					
                            					<!-- Delete Tax Modal -->
                            					<div class="modal custom-modal fade" id="delete_tax_<?php echo $tax_master_row['id']; ?>" role="dialog">
                            						<div class="modal-dialog modal-dialog-centered">
                            							<div class="modal-content">
                            								<div class="modal-body">
                            									<form method="post">    
                            									<div class="modal-icon text-center mb-3">
                            										<i class="fas fa-trash-alt text-danger"></i>
                            									</div>
                            									<input type="hidden" name="rec_id" value="<?php echo $tax_master_row['id']; ?>">
                            									<div class="modal-text text-center">
                            										<h2>Delete Tax</h2>
                            										<p>Are you sure want to delete?</p>
                            									</div>
                            								</div>
                            								<div class="modal-footer text-center">
                            									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            									<button type="submit" name="delete_tax" class="btn btn-primary">Delete</button>
                            								</div>
                            								</form>
                            							</div>
                            						</div>
                            					</div>
                            					<!-- /Delete Tax Modal -->
											
											
												<tr>
													<td><?php echo $tax_master_row['tax_name']; ?></td>
													<td><?php echo $tax_master_row['tax_percentage']; ?>%</td>
													<td>
													<?php
													if($tax_master_row['status']=='1')
													{
													?>    
														<span class="badge bg-success-light">Active</span>
													<?php } else { ?>
														<span class="badge bg-danger-light">Inactive</span>
													<?php } ?>
													</td>
													<td class="text-right">
														<a href="#" data-toggle="modal" data-target="#edit_tax_<?php echo $tax_master_row['id']; ?>" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Edit</a> 
														<a href="#" data-toggle="modal" data-target="#delete_tax_<?php echo $tax_master_row['id']; ?>" class="btn btn-sm btn-white text-danger mr-2"><i class="far fa-trash-alt mr-1"></i>Delete</a>
													</td>
												</tr>
											<?php } ?>	
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Add Tax Modal -->
					<div id="add_tax" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add Tax</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form method="post">
										<div class="form-group">
											<label>Tax Name <span class="text-danger">*</span></label>
											<input class="form-control" type="text" name="tax_name" id="tax_name">
										</div>
										<div class="form-group">
											<label>Tax Percentage (%) <span class="text-danger">*</span></label>
											<input class="form-control" type="text" name="tax_percentage" id="tax_percentage">
										</div>
										<div class="form-group">
											<label>Status <span class="text-danger">*</span></label>
											<select class="select" id="tax_status" name="tax_status">
												<option value="1">Active</option>
												<option value="0">Inactive</option>
											</select>
										</div>
										<div class="submit-section">
											<button class="btn btn-primary submit-btn" name="add_tax">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- /Add Tax Modal -->
					
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
		
		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>

	</body>
</html>