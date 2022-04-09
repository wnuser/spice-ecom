<?php

session_start();
include('includes/config.php');

if(isset($_POST['add_cusine'])) {
    
    
   $category_name=mysqli_real_escape_string($con,$_POST['category_name']);
   $cusine_status=mysqli_real_escape_string($con,$_POST['cusine_status']);
   
   $category_image=$_FILES['category_image']['name'];
  
      if($category_image!=''){
          
         $random =  rand(1000,9999);
                
         $tmpFilePath = $_FILES['category_image']['tmp_name'];
        
         //save the filename
         $shortname = date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['category_image']['name']));
        
         //save the url and the file
         $filePath = "assets/img/seasoning_categories/" . date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['category_image']['name']));
         
         move_uploaded_file($tmpFilePath, $filePath);    
          
   } 
   
   $insert_cusines=mysqli_query($con,"INSERT INTO `seasoning_categories` (`category_name`, `category_image`, `status`, `create_date`) VALUES ('$category_name', '$shortname', '$cusine_status', CURDATE())");
   
   if($insert_cusines==true) {
    
        echo "<script>alert('Success! Category Added.');location.href='seasoning_categories.php';</script>";   
       
   } else {
       
        echo "<script>alert('Oops! Something went wrong.');location.href='seasoning_categories.php';</script>"; 
       
   }
    
}


if(isset($_POST['edit_cusine'])) {
    
   $rec_id=mysqli_real_escape_string($con,$_POST['rec_id']);    
   
   $category_name=mysqli_real_escape_string($con,$_POST['category_name']);
   $cusine_status=mysqli_real_escape_string($con,$_POST['cusine_status']);
   
   $category_image_details=mysqli_fetch_array(mysqli_query($con,"select * from seasoning_categories where id='".$rec_id."' and status='1' and is_active='1'"));
   
   $shortname='';
   
   $category_image=$_FILES['category_image']['name'];
  
      if($category_image!=''){
          
         $random =  rand(1000,9999);
                
         $tmpFilePath = $_FILES['category_image']['tmp_name'];
        
         //save the filename
         $shortname = date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['category_image']['name']));
        
         //save the url and the file
         $filePath = "assets/img/seasoning_categories/" . date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['category_image']['name']));
         
         move_uploaded_file($tmpFilePath, $filePath);    
              
       } else {
        
         $shortname=$category_image_details['category_image'];
           
      }
   
   
   $update_tax_status=mysqli_query($con,"update seasoning_categories set category_name='".$category_name."',category_image='".$shortname."', status='".$cusine_status."' where id='".$rec_id."' and is_active='1'");
   
   if($update_tax_status==true) {
    
    echo "<script>alert('Success! Category updated.');location.href='seasoning_categories.php';</script>";   
       
   } else {
       
        echo "<script>alert('Oops! Something went wrong.');location.href='seasoning_categories.php';</script>"; 
       
   }
    
}

if(isset($_POST['delete_cusine'])) {
    
   $rec_id=mysqli_real_escape_string($con,$_POST['rec_id']);   
   
   
   $update_tax_status=mysqli_query($con,"update seasoning_categories set is_active='0' where id='".$rec_id."' and is_active='1'");
   
   if($update_tax_status==true) {
    
    echo "<script>alert('Success! Category Deleted.');location.href='seasoning_categories.php';</script>";   
       
   } else {
       
        echo "<script>alert('Oops! Something went wrong.');location.href='seasoning_categories.php';</script>"; 
       
   }
    
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Blend Ur Spice - Seasoning Categories</title>
		
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
								<h3 class="page-title">Seasoning Categories</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashbaord.php">Seasoning Mix</a></li>
									<li class="breadcrumb-item active">Seasoning Categories</li>
								</ul>
							</div>
							<div class="col-auto">
								<a href="javascript:void(0)" data-toggle="modal" data-target="#add_cusine"  class="btn btn-primary">
									<i class="fas fa-plus"></i>&nbsp;Add Categories
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
													<th>Category Name</th>
													<th>Status</th>
													<th>Create Date</th>
													<th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>
											<?php 
											$i=1;
											$cusine_details=mysqli_query($con,"select * from seasoning_categories where is_active='1'");
											while($cusine_details_row=mysqli_fetch_array($cusine_details))
											{
											?>    
											
											
											<!-- Edit Tax Modal -->
                            					<div id="edit_cusine_<?php echo $cusine_details_row['id']; ?>" class="modal custom-modal fade" role="dialog">
                            						<div class="modal-dialog modal-dialog-centered" role="document">
                            							<div class="modal-content">
                            								<div class="modal-header">
                            									<h5 class="modal-title">Edit Cusines</h5>
                            									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            										<span aria-hidden="true">&times;</span>
                            									</button>
                            								</div>
                            								<div class="modal-body">
                            									<form method="post" enctype="multipart/form-data">
                            										<div class="form-group">
                            											<label>Category Name <span class="text-danger">*</span></label>
                            											<input type="hidden" name="rec_id" value="<?php echo $cusine_details_row['id']; ?>">
                            											<input class="form-control" value="<?php echo $cusine_details_row['category_name']; ?>" type="text" name="category_name" id="category_name">
                            										</div>
                            										<div class="form-group">
                            											<label>Category Image <span class="text-danger">*</span></label>
                            											<input class="form-control" value="<?php echo $cusine_details_row['category_image']; ?>" type="file" name="category_image" id="category_image">
                            										</div>
                            										<div class="form-group">
                            											<label>Status <span class="text-danger">*</span></label>
                            											<select class="form-control" id="cusine_status" name="cusine_status">
                            												<option value="1" <?php if($cusine_details_row['status']=='1') { ?> selected <?php } ?>>Active</option>
                            												<option value="0" <?php if($cusine_details_row['status']=='0') { ?> selected <?php } ?>>Inactive</option>
                            											</select>
                            										</div>
                            										<div class="submit-section">
                            											<button class="btn btn-primary submit-btn" name="edit_cusine">Save</button>
                            										</div>
                            									</form>
                            								</div>
                            							</div>
                            						</div>
                            					</div>
                            					<!-- /Edit Tax Modal -->
                            					
                            					<!-- Delete Tax Modal -->
                            					<div class="modal custom-modal fade" id="delete_cusine_<?php echo $cusine_details_row['id']; ?>" role="dialog">
                            						<div class="modal-dialog modal-dialog-centered">
                            							<div class="modal-content">
                            								<div class="modal-body">
                            									<form method="post" enctype="multipart/form-data">    
                            									<div class="modal-icon text-center mb-3">
                            										<i class="fas fa-trash-alt text-danger"></i>
                            									</div>
                            									<input type="hidden" name="rec_id" value="<?php echo $cusine_details_row['id']; ?>">
                            									<div class="modal-text text-center">
                            										<h2>Delete Category</h2>
                            										<p>Are you sure want to delete?</p>
                            									</div>
                            								</div>
                            								<div class="modal-footer text-center">
                            									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            									<button type="submit" name="delete_cusine" class="btn btn-primary">Delete</button>
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
															<a href="javascript:void(0)"><img class="avatar avatar-sm mr-2 avatar-img rounded-circle" src="assets/img/seasoning_categories/<?php echo $cusine_details_row['category_image']; ?>" alt="User Image"> <?php echo $cusine_details_row['category_name']; ?></a>
														</h2>
													</td>
													<td>
													<?php if($cusine_details_row['status']=='1') { ?>    
													
													    <span class="badge badge-pill bg-success-light">Active</span>
													    
													<?php } else { ?>
													
													    <span class="badge badge-pill bg-danger-light">Inactive</span>
													    
													<?php } ?>
													</td>
													<td><?php echo date('d-m-Y',strtotime($cusine_details_row['create_date'])); ?></td>
													<td class="text-right">
														<a href="#" data-toggle="modal" data-target="#edit_cusine_<?php echo $cusine_details_row['id']; ?>" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Edit</a> 
														<a href="#" data-toggle="modal" data-target="#delete_cusine_<?php echo $cusine_details_row['id']; ?>" class="btn btn-sm btn-white text-danger mr-2"><i class="far fa-trash-alt mr-1"></i>Delete</a>
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
					
				   	<!-- Add cusine Modal -->
					<div id="add_cusine" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add Category</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label>Category Name <span class="text-danger">*</span></label>
											<input class="form-control" type="text" name="category_name" id="category_name">
										</div>
										<div class="form-group">
											<label>Category Image <span class="text-danger">*</span></label>
											<input class="form-control" type="file" name="category_image" id="category_image">
										</div>
										
										<div class="form-group">
											<label>Status <span class="text-danger">*</span></label>
											<select class="select" id="tax_status" name="cusine_status">
												<option value="1">Active</option>
												<option value="0">Inactive</option>
											</select>
										</div>
										<div class="submit-section">
											<button class="btn btn-primary submit-btn" name="add_cusine">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- /Add cusine Modal -->	
					
					
					
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