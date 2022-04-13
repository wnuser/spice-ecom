<?php
    include('includes/config.php');
    session_start();
    
    if(isset($_POST['create-ingredients'])) {
      
      $spices_name=mysqli_real_escape_string($con,$_POST['spices_name']);
      $price=mysqli_real_escape_string($con,$_POST['price']);
      $status=mysqli_real_escape_string($con,$_POST['status']);
      
      $spices_image=$_FILES['spices_image']['name'];
  
      if($spices_image!=''){
          
         $random =  rand(1000,9999);
                
         $tmpFilePath = $_FILES['spices_image']['tmp_name'];
        
         //save the filename
         $shortname = date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['spices_image']['name']));
        
         //save the url and the file
         $filePath = "assets/img/spices/" . date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['spices_image']['name']));
         
         move_uploaded_file($tmpFilePath, $filePath);    
          
     } 
     
      $spice_name_check=mysqli_num_rows(mysqli_query($con,"select * from spices_list where spices_name='".$spices_name."' and status='1' and is_active='1'"));
     
         if($spice_name_check=='0')
         {
            
              $insert_ingredients=mysqli_query($con,"INSERT INTO `spices_list` (`spices_name`, `spices_images`, `price`, `status`, `create_date`) 
              VALUES ('$spices_name', '$shortname', '$price', '$status', CURDATE())");     
               
               if($insert_ingredients==true) 
               {
                   
                   $_SESSION['alert_msg']='<strong>Success!</strong> Spices Added.';
                   
               } else {
                   
                   $_SESSION['alert_msg']='<strong>Oops!</strong> Something went wrong.';
               }
           
         } else {
             
            $_SESSION['alert_msg']='<strong>Oops!</strong> This spice is already added.';
             
         } 
        
    }
    
    if(isset($_POST['edit-ingredients'])) {
      
      $rec_id=$_POST['rec_id'];  
      $spices_name=mysqli_real_escape_string($con,$_POST['spices_name']);
      $price=mysqli_real_escape_string($con,$_POST['price']);
      $status=mysqli_real_escape_string($con,$_POST['status']);
      
      $product_details=mysqli_fetch_array(mysqli_query($con,"select * from spices_list where id='".$rec_id."' and status='1' and is_active='1'"));
   
      $shortname='';
   
      $spices_image=$_FILES['spices_image']['name'];
  
      if($spices_image!=''){
          
         $random =  rand(1000,9999);
                
         $tmpFilePath = $_FILES['spices_image']['tmp_name'];
        
         //save the filename
         $shortname = date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['spices_image']['name']));
        
         //save the url and the file
         $filePath = "assets/img/spices/" . date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['spices_image']['name']));
         
         move_uploaded_file($tmpFilePath, $filePath);    
              
       } else {
        
         $shortname=$product_details['spices_images'];
           
      }
        
      $update_category=mysqli_query($con,"update `spices_list` SET `spices_name`='".$spices_name."', `spices_images`='".$shortname."', `price`='".$price."', `status`='".$status."' where id='".$rec_id."' and is_active='1'");     
       
       if($update_category==true) 
       {
           
           $_SESSION['alert_msg']='<strong>Success!</strong> Spices Updated.';
           
       } else {
           
           $_SESSION['alert_msg']='<strong>Oops!</strong> Something went wrong.';
       }
        
    }

    if(isset($_GET['delete']))
    {
        $id=$_GET['delete'];
        
        $del=mysqli_query($con,"update spices_list set is_active='0' where id='".$id."' and is_active='1'");
        
        if($del==true)
        {
            
            $_SESSION['alert_msg']='<strong>Success!</strong> Spices Deleted.';
        }
            
        else {
            
           $_SESSION['alert_msg']='<strong>Oops!</strong> Something went wrong.';
          
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Eternal Seasoning - Spices</title>
		
		<!-- Favicon -->
		<!--<link rel="shortcut icon" href="assets/img/favicon.png">-->
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
		
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
		
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
								<!--<h3 class="page-title">Invoices</h3>-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Spices</li>
								</ul>
							</div>
						
							<div class="col-auto">
								<a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#add_category">
									<i class="fas fa-plus"></i> Add Spices
								</a>
						    </div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
						
						 <?php if(isset($_POST['create-ingredients']) || isset($_POST['edit-ingredients']) || isset($_GET['delete'])) { ?>
						
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
										<table class="table table-stripped table-hover datatable">
											<thead class="thead-light">
												<tr>
												   <th>S.No</th>
												   <th>Spices Name</th>
												   <!--<th>Price</th>-->
												   <th>Status</th>
												   <th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>
										        <?php 
									                
                                        		$i=0;
                                                $ingredients=mysqli_query($con,"SELECT * FROM spices_list where is_active='1' ORDER BY id DESC");
                                                while($ingredients_row=mysqli_fetch_array($ingredients)){
                                                $i++;
                                        	    ?>
                                        	    
												<tr>
												    <td><?php echo $i; ?></td>
													<td>
														<h2 class="table-avatar">
															<a href="javascript:void(0)"><img class="avatar avatar-sm mr-2 avatar-img rounded-circle" src="assets/img/spices/<?php echo $ingredients_row['spices_images']; ?>" alt="User Image"> <?php echo $ingredients_row['spices_name']; ?></a>
														</h2>
													</td>
													<!--<td><?php echo $ingredients_row['price']; ?></td>-->
													<td>
													<?php if($ingredients_row['status']=='1') { ?>
    													<span class="badge badge-pill bg-success-light">Active</span>
    												<?php } else { ?>	
    													<span class="badge badge-pill bg-danger-light">Inactive</span>
													<?php } ?>    
													</td>
													
													<td class="text-right">
														<a class="btn btn-sm btn-info mr-2" href="javascript:void(0)" onclick="edit_ingredients(<?php echo $ingredients_row['id']; ?>)">
															<i class="fas fa-edit mr-1"></i> Edit
														</a>
														<a class="btn btn-sm btn-danger" href="spices.php?delete=<?php echo $ingredients_row['id']?>" onclick="return confirm('Are you sure you want to delete this item?');">
															<i class="fas fa-trash mr-1"></i> Delete
														</a>
													</td>
												</tr>
												<?php }?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				    <!-- Add Category Modal -->
					<div id="add_category" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add Spices</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form method="post" autocomplete="off" enctype="multipart/form-data">
									   
										<div class="form-group">
											<label>Spices Name <span class="text-danger">*</span></label>
											<input class="form-control" type="text" name="spices_name" id="spices_name" required>
										</div>
										<div class="form-group">
											<label>Spices Image <span class="text-danger">*</span></label>
											<input class="form-control" type="file" name="spices_image" id="spices_image" required>
										</div>
										<!--<div class="form-group">-->
										<!--	<label>Price <span class="text-danger">*</span></label>-->
										<!--	<input class="form-control" type="text" name="price" id="price" required>-->
										<!--</div>-->
										<div class="form-group">
											<label>Status <span class="text-danger">*</span></label>
											<select class="form-control" name="status" id="status" required>
												<option value="1">Active</option>
												<option value='0'>Inactive</option>
											</select>
										</div>
										<div class="submit-section">
											<button type="submit" class="btn btn-primary submit-btn" name="create-ingredients">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- /Add Category Modal -->	
					
					<!-- Edit Category Modal -->
					<div id="edit_ingredient" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Edit Spices</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" id="view_ingredient_details">
									
								</div>
							</div>
						</div>
					</div>
					<!-- /Edit Category Modal -->
					
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
		
		<!-- Datatables JS -->
		<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/datatables/datatables.min.js"></script>

		<!-- Datepicker Core JS -->
		<script src="assets/plugins/moment/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		
		<script>
		    
            // In your Javascript (external .js resource or <script> tag)
        $('#product_id').select2(); 
            
         function edit_ingredients(val) {
             
    		  
    	     $.ajax({  
                url:"ajax_spices_edit.php",  
                method:"POST",  
                data:{ ing_id:val },  
                success:function(data)  
                { 
                 
                  $('#view_ingredient_details').html(data);
                  
                  $('#edit_ingredient').modal('show');
                      
                }  
                
               }); 
            
        	}   
            
        
		</script>

	</body>
</html>