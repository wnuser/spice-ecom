<?php

session_start();
include('includes/config.php');

if(isset($_POST['add_products'])) {
    
    
   $product_name=mysqli_real_escape_string($con,$_POST['product_name']);
   $product_category=mysqli_real_escape_string($con,$_POST['product_category']);
   $product_price=mysqli_real_escape_string($con,$_POST['product_price']);
   $product_status=mysqli_real_escape_string($con,$_POST['product_status']);
  
   
     $product_image=$_FILES['product_image']['name'];
  
      if($product_image!=''){
          
         $random =  rand(1000,9999);
                
         $tmpFilePath = $_FILES['product_image']['tmp_name'];
        
         //save the filename
         $shortname = date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['product_image']['name']));
        
         //save the url and the file
         $filePath = "assets/img/products/" . date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['product_image']['name']));
         
         move_uploaded_file($tmpFilePath, $filePath);    
          
   } 
   
   $insert_products=mysqli_query($con,"INSERT INTO `featured_items` (`product_name`, `category`, `price`, `product_image`, `status`, `create_date`) 
   VALUES ('$product_name', '$product_category', '$product_price', '$shortname', '$product_status', CURDATE())");
   
   if($insert_products==true) {
    
        echo "<script>alert('Success ! Featured Item Inserted.');location.href='featured_items.php';</script>";   
       
   } else {
       
        echo "<script>alert('Oops ! Something went wrong.');location.href='featured_items.php';</script>"; 
       
   }
    
}


if(isset($_POST['edit_products'])) {
    
   $rec_id=mysqli_real_escape_string($con,$_POST['rec_id']);    
   
   $product_name=mysqli_real_escape_string($con,$_POST['product_name']);
   $product_category=mysqli_real_escape_string($con,$_POST['product_category']);
   $product_price=mysqli_real_escape_string($con,$_POST['product_price']);
   $product_status=mysqli_real_escape_string($con,$_POST['product_status']);
   
   $product_details=mysqli_fetch_array(mysqli_query($con,"select * from featured_items where id='".$rec_id."' and status='1' and is_active='1'"));
   
   $shortname='';
   
    $product_image=$_FILES['product_image']['name'];
  
      if($product_image!=''){
          
         $random =  rand(1000,9999);
                
         $tmpFilePath = $_FILES['product_image']['tmp_name'];
        
         //save the filename
         $shortname = date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['product_image']['name']));
        
         //save the url and the file
         $filePath = "assets/img/products/" . date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['product_image']['name']));
         
         move_uploaded_file($tmpFilePath, $filePath);    
              
       } else {
        
         $shortname=$product_details['product_image'];
           
      }
   
   
   $update_tax_status=mysqli_query($con,"update featured_items set product_name='".$product_name."',category='".$product_category."',product_image='".$shortname."',price='".$product_price."',status='".$product_status."' where id='".$rec_id."' and is_active='1'");
   
   if($update_tax_status==true) {
    
    echo "<script>alert('Success ! Featured Item updated.');location.href='featured_items.php';</script>";   
       
   } else {
       
        echo "<script>alert('Oops ! Something went wrong.');location.href='featured_items.php';</script>"; 
       
   }
    
}

if(isset($_POST['delete_products'])) {
    
   $rec_id=mysqli_real_escape_string($con,$_POST['rec_id']);   
   
   
   $update_tax_status=mysqli_query($con,"update featured_items set is_active='0' where id='".$rec_id."' and is_active='1'");
   
   if($update_tax_status==true) {
    
    echo "<script>alert('Success ! Featured Item Deleted.');location.href='featured_items.php';</script>";   
       
   } else {
       
        echo "<script>alert('Oops ! Something went wrong.');location.href='featured_items.php';</script>"; 
       
   }
    
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Online Order - Featured Items</title>
		
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
								<h3 class="page-title">Featured Items</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashbaord.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Add Featured Items</li>
								</ul>
							</div>
							<div class="col-auto">
								<a href="javascript:void(0)" data-toggle="modal" data-target="#add_product"  class="btn btn-primary">
									<i class="fas fa-plus"></i>&nbsp;Add Items
								</a>
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
													<th>Product Name</th>
													<th>Category</th>
													<th>Price</th>
													<th>Status</th>
													<th>Create Date</th>
													<th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>
											<?php 
											$i=1;
											$product_details=mysqli_query($con,"select * from featured_items where is_active='1'");
											while($product_details_row=mysqli_fetch_array($product_details))
											{
											    
											$category_details=mysqli_fetch_array(mysqli_query($con,"select * from master_category where id='".$product_details_row['category']."' and status='1' and is_active='1'"));   
											    
											?>    
											
											
											<!-- Edit Tax Modal -->
                            					<div id="edit_product_<?php echo $product_details_row['id']; ?>" class="modal custom-modal fade" role="dialog">
                            						<div class="modal-dialog modal-dialog-centered" role="document">
                            							<div class="modal-content">
                            								<div class="modal-header">
                            									<h5 class="modal-title">Edit Ittems</h5>
                            									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            										<span aria-hidden="true">&times;</span>
                            									</button>
                            								</div>
                            								<div class="modal-body">
                            									<form method="post" enctype="multipart/form-data">
                            										<div class="form-group">
                            											<label>Product Name <span class="text-danger">*</span></label>
                            											<input type="hidden" name="rec_id" value="<?php echo $product_details_row['id']; ?>">
                            											<input class="form-control" value="<?php echo $product_details_row['product_name']; ?>" type="text" name="product_name" id="product_name">
                            										</div>
                            										<div class="form-group">
                            											<label>Product Image <span class="text-danger">*</span></label>
                            											<input class="form-control" value="<?php echo $product_details_row['product_image']; ?>" type="file" name="product_image" id="product_image">
                            										</div>
                            										
                            										<div class="form-group">
                            											<label>Price <span class="text-danger">*</span></label>
                            											 <input class="form-control" type="text" name="product_price" id="product_price"  value="<?php echo $product_details_row['price']; ?>">
                            										</div>
                            										<div class="form-group">
                            											<label>Category <span class="text-danger">*</span></label>
                                										<select class="form-control" id="currencyLabel" name="product_category" required>
                        												    <option value="">Select Category</option>
                            												<?php 
                            												$master_category=mysqli_query($con,"select * from master_category where is_active='1'");
                            												while($master_category_row=mysqli_fetch_array($master_category))
                            												{
                            												?>    
                        													<option value="<?php echo $master_category_row['id']; ?>" <?php if($master_category_row['id']==$product_details_row['category']) { ?> selected <?php } ?>><?php echo $master_category_row['master_name']; ?></option>
                        												    <?php } ?>	
                        												</select>
                            										</div>
                            										<div class="form-group">
                            											<label>Status <span class="text-danger">*</span></label>
                            											<select class="form-control" id="product_status" name="product_status">
                            												<option value="1" <?php if($product_details_row['status']=='1') { ?> selected <?php } ?>>Active</option>
                            												<option value="0" <?php if($product_details_row['status']=='0') { ?> selected <?php } ?>>Inactive</option>
                            											</select>
                            										</div>
                            										<div class="submit-section">
                            											<button class="btn btn-primary submit-btn" name="edit_products">Save</button>
                            										</div>
                            									</form>
                            								</div>
                            							</div>
                            						</div>
                            					</div>
                            					<!-- /Edit Tax Modal -->
                            					
                            					<!-- Delete Tax Modal -->
                            					<div class="modal custom-modal fade" id="delete_product_<?php echo $product_details_row['id']; ?>" role="dialog">
                            						<div class="modal-dialog modal-dialog-centered">
                            							<div class="modal-content">
                            								<div class="modal-body">
                            									<form method="post">    
                            									<div class="modal-icon text-center mb-3">
                            										<i class="fas fa-trash-alt text-danger"></i>
                            									</div>
                            									<input type="hidden" name="rec_id" value="<?php echo $product_details_row['id']; ?>">
                            									<div class="modal-text text-center">
                            										<h2>Delete Items</h2>
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
															<a href="javascript:void(0)"><img class="avatar avatar-sm mr-2 avatar-img rounded-circle" src="assets/img/products/<?php echo $product_details_row['product_image']; ?>" alt="User Image"> <?php echo $product_details_row['product_name']; ?></a>
														</h2>
													</td>
													<td><?php echo $category_details['master_name']; ?></td>
													<td><?php echo $product_details_row['price']; ?></td>
													<td>
													<?php if($product_details_row['status']=='1') { ?>    
													
													    <span class="badge badge-pill bg-success-light">Active</span>
													    
													<?php } else { ?>
													
													    <span class="badge badge-pill bg-danger-light">Inactive</span>
													    
													<?php } ?>
													</td>
													<td><?php echo date('d-m-Y',strtotime($product_details_row['create_date'])); ?></td>
													<td class="text-right">
														<a href="#" data-toggle="modal" data-target="#edit_product_<?php echo $product_details_row['id']; ?>" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Edit</a> 
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
					
				   	<!-- Add Offer Modal -->
					<div id="add_product" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add Featured Items</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label>Product Name <span class="text-danger">*</span></label>
											<input class="form-control" type="text" name="product_name" id="product_name">
										</div>
										<div class="form-group">
											<label>Product Image <span class="text-danger">*</span></label>
											<input class="form-control" type="file" name="product_image" id="product_image">
										</div>
										
										<div class="form-group">
											<label>Price <span class="text-danger">*</span></label>
											 <input class="form-control" type="text" name="product_price" id="product_price">
										</div>
										<div class="form-group">
											<label>Category <span class="text-danger">*</span></label>
    										<select class="select" id="currencyLabel" name="product_category" required>
											    <option value="">Select Category</option>
												<?php 
												$master_category=mysqli_query($con,"select * from master_category where is_active='1'");
												while($master_category_row=mysqli_fetch_array($master_category))
												{
												?>    
												<option value="<?php echo $master_category_row['id']; ?>"><?php echo $master_category_row['master_name']; ?></option>
											    <?php } ?>	
											</select>
										</div>
										<div class="form-group">
											<label>Status <span class="text-danger">*</span></label>
											<select class="form-control" id="product_status" name="product_status">
												<option value="1">Active</option>
												<option value="0">Inactive</option>
											</select>
										</div>
										<div class="submit-section">
											<button class="btn btn-primary submit-btn" name="add_products">Save</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- /Add Offer Modal -->	
					
					
					
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

	</body>
</html>