<?php

session_start();
include('includes/config.php');


if(isset($_POST['delete_products'])) {
    
   $rec_id=mysqli_real_escape_string($con,$_POST['rec_id']);   
   
   
   $delete_tax_status=mysqli_query($con,"update our_products set is_active='0' where id='".$rec_id."' and is_active='1'");
   
    if($delete_tax_status==true) {
       
        $_SESSION['alert_msg']='<strong>Success!</strong> World Cuisines Product Deleted.';
       
   } else {
       
        $_SESSION['alert_msg']='<strong>Oops!</strong> Something went wrong.';
       
   }
    
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Eternal Seasoning - View World Cuisines</title>
		
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
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
		
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
		
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
								<h3 class="page-title">World Cuisines</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashbaord.php">Dashboard</a></li>
									<li class="breadcrumb-item active">View World Cuisines</li>
								</ul>
							</div>
							<div class="col-auto">
								<a href="world_cuisines.php" class="btn btn-primary">
									<i class="fas fa-plus"></i>&nbsp;Add World Cuisines
								</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
						    
						  <?php if(isset($_POST['add_products']) || isset($_POST['edit_products']) || isset($_GET['delete_products'])) { ?>
						
						     <div class="alert alert-primary alert-dismissible fade show" role="alert">
								<?php echo $_SESSION['alert_msg']; ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							 </div>
							 
						   <?php } ?>
						   
						    
							<div class="card card-table"> 
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-center table-hover datatable">
											<thead class="thead-light">
												<tr>
													<th>S.No</th>
													<th>Product Name</th>
													<th>Quantity</th>
													<th>Price</th>
													<th>Ingredients</th>
													<th>Status</th>
													<th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>
											<?php 
											$i=1;
											$product_details=mysqli_query($con,"select * from our_products where prd_type='3' and is_active='1'");
											while($product_details_row=mysqli_fetch_array($product_details))
											{
											?>    
                            					
                        					<!-- Delete Tax Modal -->
                        					<div class="modal custom-modal fade" id="delete_product_<?php echo $product_details_row['id']; ?>" role="dialog">
                        						<div class="modal-dialog modal-dialog-centered">
                        							<div class="modal-content">
                        								<div class="modal-body">
                        									<form method="post" autocomplete="off">    
                        									<div class="modal-icon text-center mb-3">
                        										<i class="fas fa-trash-alt text-danger"></i>
                        									</div>
                        									<input type="hidden" name="rec_id" value="<?php echo $product_details_row['id']; ?>">
                        									<div class="modal-text text-center">
                        										<h2>Delete Product</h2>
                        										<p>Are you sure want to delete?</p>
                        									</div>
                        								</div>
                        								<div class="modal-footer text-center">
                        									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        									<button type="submit" name="delete_products" class="btn btn-primary">Delete</button>
                        								</div>
                        								</form>
                        							</div>
                        						</div>
                        					</div>
                        					<!-- /Delete Tax Modal -->
											
												<tr>
													<td><?php echo $i; ?></td>
													<td>
														<h2 class="table-avatar">
															<a href="javascript:void(0)"><img class="avatar avatar-sm mr-2 avatar-img rounded-circle" src="assets/img/deals/<?php echo $product_details_row['product_image']; ?>" alt="User Image"> <?php echo $product_details_row['product_name']; ?></a>
														</h2>
													</td>
													<td><?php echo $product_details_row['prd_qty']; ?></td>
													<td><?php echo $product_details_row['price']; ?></td>
													<td><?php echo $product_details_row['recepie_ingredient']; ?></td>
													<td>
													<?php if($product_details_row['status']=='1') { ?>    
													
													    <span class="badge badge-pill bg-success-light">Active</span>
													    
													<?php } else { ?>
													
													    <span class="badge badge-pill bg-danger-light">Inactive</span>
													    
													<?php } ?>
													</td>
													<td class="text-right">
														<a href="edit_world_cuisines.php?cuisine_id=<?php echo $product_details_row['id']; ?>" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Edit</a> 
														<a href="#" data-toggle="modal" data-target="#delete_product_<?php echo $product_details_row['id']; ?>" class="btn btn-sm btn-white text-danger mr-2"><i class="far fa-trash-alt mr-1"></i>Delete</a>
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
		
		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>

		<!-- Datepicker Core JS -->
		<script src="assets/plugins/moment/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Datatables JS -->
		<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/datatables/datatables.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		
		<script>
           
        $('#product_select1,#product_select2').select2(); 
        
        </script>

	</body>
</html>