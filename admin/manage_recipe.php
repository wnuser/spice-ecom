<?php

session_start();
include('includes/config.php');


if(isset($_POST['delete_products'])) {
    
   $rec_id=mysqli_real_escape_string($con,$_POST['rec_id']);   
   
   
   $delete_tax_status=mysqli_query($con,"DELETE FROM admin_recipes where id='".$rec_id."'");
   
    if($delete_tax_status==true) {
       
        $_SESSION['alert_msg']='<strong>Success!</strong> Recipe deleted successfully.';
       
   } else {
       
        $_SESSION['alert_msg']='<strong>Oops!</strong> Something went wrong.';
       
   }
    
}

if(isset($_POST['submit-recipe'])) 
{
    $name         = $_POST['name'];
    $description  = $_POST['description'];
    $image        = $_FILES['image']['name'];
  
    if($image!=''){
        
       $random =  rand(1000,9999);
              
       $tmpFilePath = $_FILES['image']['tmp_name'];
      
       //save the filename
       $shortname = date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['image']['name']));
      
       //save the url and the file
       $filePath = "assets/img/admin_recipes/" . date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['image']['name']));
       
       move_uploaded_file($tmpFilePath, $filePath);    
        
 } else {
     $shortname = NULL;
 }

    $insertQuery = mysqli_query($con, "INSERT INTO admin_recipes (name, image, description) values('".$name."', '".$shortname."', '".$description."')");
    if($insertQuery) {

        echo "<script>alert('Recipe Created Successfully.')</script>";
    } else {

        echo "<script>alert('Something went wrong') </script>";
    }

}

if(isset($_POST['update-recipe'])) {

	$name        = $_POST['name'];
	$description = $_POST['description'];
	$id          = $_POST['id'];
	$image       = $_FILES['image']['name'];

	if($image!=''){
        
		$random =  rand(1000,9999);
			   
		$tmpFilePath = $_FILES['image']['tmp_name'];
	   
		//save the filename
		$shortname = date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['image']['name']));
	   
		//save the url and the file
		$filePath = "assets/img/admin_recipes/" . date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['image']['name']));
		
		move_uploaded_file($tmpFilePath, $filePath);    
		 
	} else {

		$getDetails  = mysqli_query($con, "SELECT * from admin_recipes where id='".$id."' ");
		$details     = mysqli_fetch_assoc($getDetails);
		$shortname   = $details['image'];
	}

	$updateQuery = mysqli_query($con, "UPDATE admin_recipes set name='".$name."', image='".$shortname."', description='".$description."' WHERE id='".$id."' ");

    // die(mysqli_error($con));
    if($updateQuery) {

        echo "<script>alert('Recipe Updated Successfully.')</script>";
    } else {

        echo "<script>alert('Something went wrong') </script>";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Eternal Seasoning - View Deals</title>
		
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
								<h3 class="page-title">Admin Recipes</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashbaord.php">Dashboard</a></li>
									<li class="breadcrumb-item active">View Deals</li>
								</ul>
							</div>
							<div class="col-auto">
								<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
									<i class="fas fa-plus"></i>&nbsp;Add Recipe
								</button>
							</div>
						</div>
					</div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Recipe</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                 <form action="" method="post" enctype="multipart/form-data">
                                       <div class="form-group">
                                            <label for="">Enter Recipe Name</label>
                                            <input type="text" name="name" class="form-control" id="" required>
                                       </div>
                                       <div class="form-group">
                                           <label for="">Recipe Image</label>
                                           <input type="file" name="image" required>
                                       </div>
                                       <div class="form-group">
                                            <label for="">Recipe Description</label>
                                            <textarea required  type="text" name="description" class="form-control textarea" id=""></textarea>
                                       </div>
                                       <div class="form-group">
                                           <button type="submit" class="btn btn-primary" name="submit-recipe">Submit</button>
                                       </div>
                                 </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
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
													<th>Recipe Name</th>
													<th>Image</th>
													<th>Description</th>
													
													<th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>
											<?php 
											$i=1;
											$product_details=mysqli_query($con,"select * from admin_recipes");
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
														    <?= $product_details_row['name'] ?>
															
														</h2>
													</td>
													<td><a href="javascript:void(0)"><img class="avatar avatar-sm mr-2 avatar-img rounded-circle" src="assets/img/admin_recipes/<?php echo $product_details_row['image']; ?>" alt="User Image"> </a></td>
													<td><?php echo $product_details_row['description']; ?></td>
												
													<td class="text-right">
														<button data-toggle="modal" data-target="#updateModal<?= $product_details_row['id'] ?>"  class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Edit</a> 
														<a href="#" data-toggle="modal" data-target="#delete_product_<?php echo $product_details_row['id']; ?>" class="btn btn-sm btn-white text-danger mr-2"><i class="far fa-trash-alt mr-1"></i>Delete</a>
													</td>
												</tr>



				    <div class="modal fade" id="updateModal<?= $product_details_row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Recipe</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                 <form action="" method="post" enctype="multipart/form-data">
                                       <div class="form-group">
                                            <label for="">Enter Recipe Name</label>
                                            <input type="text" required value="<?= $product_details_row['name'] ?>" name="name" class="form-control" id="">
											<input type="hidden" name="id" value="<?= $product_details_row['id'] ?>">
                                       </div>
                                       <div class="form-group">
                                           <label for="">Recipe Image</label>
                                           <input type="file" name="image">
                                       </div>
                                       <div class="form-group">
                                            <label for="">Recipe Description</label>
                                            <textarea  required type="text" name="description" class="form-control textarea" id=""><?= $product_details_row['description'] ?></textarea>
                                       </div>
                                       <div class="form-group">
                                           <button type="submit" class="btn btn-primary" name="update-recipe">Submit</button>
                                       </div>
                                 </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>






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
		
        <script src="assets/js/bootstrap3-wysihtml5.all.min.js"></script>

		<script>
           
        $('#product_select1,#product_select2').select2(); 

        $('.textarea').wysihtml5({
              toolbar: { fa: true }
            });
        
        </script>

	</body>
</html>