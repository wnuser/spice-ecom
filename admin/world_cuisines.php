<?php

session_start();
include('includes/config.php');

if(isset($_POST['add_products'])) {
    
   $product_id=mysqli_real_escape_string($con,$_POST['product_id']); 
   $product_name=mysqli_real_escape_string($con,$_POST['product_name']);
   $product_price=mysqli_real_escape_string($con,$_POST['product_price']);
   $product_qty=mysqli_real_escape_string($con,$_POST['product_qty']);
   $product_status=mysqli_real_escape_string($con,$_POST['product_status']);
   $recepie_ingredient=mysqli_real_escape_string($con,$_POST['recepie_ingredient']);
  
   
     $product_image=$_FILES['product_image']['name'];
  
      if($product_image!=''){
          
         $random =  rand(1000,9999);
                
         $tmpFilePath = $_FILES['product_image']['tmp_name'];
        
         //save the filename
         $shortname = date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['product_image']['name']));
        
         //save the url and the file
         $filePath = "assets/img/deals/" . date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['product_image']['name']));
         
         move_uploaded_file($tmpFilePath, $filePath);    
          
   } 
   
   $insert_products=mysqli_query($con,"INSERT INTO `our_products` (`prd_type`, `category_id`, `product_name`, `prd_qty`, `price`, `product_image`, `recepie_ingredient`, `status`, `create_date`) 
   VALUES ('3', '$product_id', '$product_name', '$product_qty', '$product_price', '$shortname', '$recepie_ingredient', '$product_status', CURDATE())");
   
   if($insert_products==true) {
       
        $_SESSION['alert_msg']='<strong>Success!</strong> World Cuisines Product Added.';
       
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
		<title>Blend Ur Spice - World Cuisines</title>
		
		<!-- Favicon -->
		<!--<link rel="shortcut icon" href="assets/img/favicon.png">-->
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
		
		<link rel="stylesheet" href="assets/css/bootstrap3-wysihtml5.min.css">
		
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
									<li class="breadcrumb-item active">Add World Cuisines</li>
								</ul>
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
						   
						   
        					<!-- Search Filter -->
        					<div id="filter_inputs" class="card filter-card" style="display:block;">
        						<div class="card-body pb-0">
        						    <form method="post" enctype="multipart/form-data" autocomplete="off">
        						        
        						       <div class="row"> 
        						       
        						       <div class="col-md-4">
        									<div class="form-group">
        										<label>Cuisine Category <span class="text-danger">*</span></label><br>
        										<select class="form-control" id="product_id" name="product_id" style="width:100%;" required>
    											    <option value="">Select Category</option>
    												<?php 
    												$product_master=mysqli_query($con,"select * from product_master where is_active='1'");
    												while($product_master_row=mysqli_fetch_array($product_master))
    												{
    												?>    
    												<option value="<?php echo $product_master_row['id']; ?>" ><?php echo $product_master_row['product_name']; ?></option>
    											    <?php } ?>	
    											</select>
        									</div>
        								</div>
        						       
        						       <div class="col-md-4">
    										<div class="form-group">
    											<label>Product Name <span class="text-danger">*</span></label>
    											<input class="form-control" type="text" name="product_name" id="product_name" required>
    										</div>
										</div>
										<div class="col-md-4">    
    										<div class="form-group">
    											<label>Product Image <span class="text-danger">*</span></label><br>
    											<input type="file" name="product_image" id="product_image" required>
    										</div>
										</div>
										<div class="col-md-4">  
    										<div class="form-group">
    											<label>Quantity</label>
    											 <input class="form-control" type="text" name="product_qty" id="product_qty">
    										</div>
										</div>
										<div class="col-md-4">  
    										<div class="form-group">
    											<label>Price <span class="text-danger">*</span></label>
    											 <input class="form-control" type="text" name="product_price" id="product_price" required>
    										</div>
										</div>
										<div class="col-md-4">  
    										<div class="form-group">
    											<label>Status <span class="text-danger">*</span></label>
    											<select class="form-control" id="product_status" name="product_status" required>
    												<option value="1">Active</option>
    												<option value="0">Inactive</option>
    											</select>
    										</div>
										</div>
										
										<div class="col-md-12">
										  <label>Product Ingredients</label>  
											<div class="form-group">
												<textarea type="text" class="form-control textarea" name="recepie_ingredient" id="recepie_ingredient"></textarea>
											</div>
										</div>
										
										<div class="col-md-12">
										  <div class="form-group"> 
											 <button class="btn btn-primary submit-btn" name="add_products" style="float: right;margin-bottom:25px;">Submit</button>
										   </div>
										</div>
										
									    </div>
									</form>
        						</div>
        					</div>
        					<!-- /Search Filter -->
						 
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
		
		<script src="assets/js/bootstrap3-wysihtml5.all.min.js"></script>
		
		<script>
           
        $('#product_select1,#product_select2').select2(); 
        
         $('.textarea').wysihtml5({
              toolbar: { fa: true }
            });
        
        </script>

	</body>
</html>