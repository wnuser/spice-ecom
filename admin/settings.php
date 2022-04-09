<?php

session_start();

include('includes/config.php');

if(isset($_POST['profile_update'])) {
    
  
  $name=mysqli_real_escape_string($con,$_POST['name']);  
  $email=mysqli_real_escape_string($con,$_POST['email']);  
  $phone=mysqli_real_escape_string($con,$_POST['phone']);  
  $location=mysqli_real_escape_string($con,$_POST['location']);  
  $addressline1=mysqli_real_escape_string($con,$_POST['addressline1']);  
  $addressline2=mysqli_real_escape_string($con,$_POST['addressline2']);  
  $zipcode=mysqli_real_escape_string($con,$_POST['zipcode']);
  $opening_hours=mysqli_real_escape_string($con,$_POST['opening_hours']);
  
  $shortname='';
  
  $cover_shortname='';
  
  $profile_details=mysqli_fetch_array(mysqli_query($con,"select * from profile where id='1' and status='1' and is_active='1'"));
  
     $profile_img=$_FILES['profile_img']['name'];
  
      if($profile_img!=''){
          
         $random =  rand(1000,9999);
                
         $tmpFilePath = $_FILES['profile_img']['tmp_name'];
        
         //save the filename
         $shortname = date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['profile_img']['name']));
        
         //save the url and the file
         $filePath = "assets/img/profiles/" . date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['profile_img']['name']));
         
         move_uploaded_file($tmpFilePath, $filePath);    
          
      } else {
          
        $shortname=$profile_details['profile_img'];
          
      } 
      
      
      $cover_image=$_FILES['cover_image']['name'];
  
      if($cover_image!=''){
          
         $random =  rand(1000,9999);
                
         $cover_tmpFilePath = $_FILES['cover_image']['tmp_name'];
        
         //save the filename
         $cover_shortname = date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['cover_image']['name']));
        
         //save the url and the file
         $cover_filePath = "assets/img/cover/" . date('d-m-Y').'-'.$random.'-'.preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['cover_image']['name']));
         
         move_uploaded_file($cover_tmpFilePath, $cover_filePath);    
          
      } else {
          
        $cover_shortname=$profile_details['cover_image'];
          
      }   
    
    $update_profiles=mysqli_query($con,"update profile set profile_img='".$shortname."',cover_image='".$cover_shortname."',name='".$name."',email='".$email."',phone='".$phone."',country='".$location."',
    address1='".$addressline1."',address2='".$addressline2."',zip_code='".$zipcode."',opening_hours='".$opening_hours."' where id='1' and is_active='1'"); 
    
    if($update_profiles==true) {
        
        echo "<script>alert('Success! Profile Updated.');location.href='settings.php';</script>";
        
    } else {
        
        echo "<script>alert('Oops! Something went wrong.');location.href='settings.php';</script>";
        
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
					<div class="page-header">
						<div class="row">
							<div class="col-sm-6">
								<h3 class="page-title">Settings</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
									</li>
									<li class="breadcrumb-item active">Profile Settings</li>
								</ul>
							</div>
						</div>
					</div>
				
					<div class="row">
						<div class="col-xl-3 col-md-4">
						
							<!-- Settings Menu -->
							<?php include('includes/setting_sidebar.php'); ?>
							<!-- /Settings Menu -->
							
						</div>
						
						<div class="col-xl-9 col-md-8">
						
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Basic information</h5>
								</div>
								<div class="card-body">
								
								<?php 
								
								$profile_details=mysqli_fetch_array(mysqli_query($con,"select * from profile where id='1' and status='1' and is_active='1'"));
								
								?>
									<!-- Form -->
									<form method="post" enctype="multipart/form-data">
									    
										<div class="row form-group">
											<label for="name" class="col-sm-3 col-form-label input-label">Image</label>
											<div class="col-sm-9">
												<div class="d-flex align-items-center">
													<label class="avatar avatar-xxl profile-cover-avatar m-0" for="edit_img">
														<img id="avatarImg" class="avatar-img" src="assets/img/profiles/<?php echo $profile_details['profile_img']; ?>" alt="Profile Image">
														<input type="file" id="edit_img" name="profile_img">
														<span class="avatar-edit">
															<i data-feather="edit-2" class="avatar-uploader-icon shadow-soft"></i>
														</span>
													</label>
												</div>
											</div>
										</div>
									
									   <div class="row form-group">
											<label for="name" class="col-sm-3 col-form-label input-label">Cover Image</label>
											<div class="col-sm-9">
												<input type="file" class="form-control" name="cover_image" id="cover_image" >
											</div>
										</div>	
										
										<div class="row form-group">
											<label for="name" class="col-sm-3 col-form-label input-label">Name</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="name" id="name" value="<?php echo $profile_details['name']; ?>" placeholder="Your Name" required>
											</div>
										</div>
										<div class="row form-group">
											<label for="email" class="col-sm-3 col-form-label input-label">Email</label>
											<div class="col-sm-9">
												<input type="email" class="form-control" name="email" id="email" value="<?php echo $profile_details['email']; ?>" placeholder="Email" required>
											</div>
										</div>
										<div class="row form-group">
											<label for="phone" class="col-sm-3 col-form-label input-label">Phone <span class="text-muted">(Optional)</span></label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="phone" id="phone" value="<?php echo $profile_details['phone']; ?>" placeholder="+x(xxx)xxx-xx-xx" required>
											</div>
										</div>
										<div class="row form-group">
											<label for="location" class="col-sm-3 col-form-label input-label">Country</label>
											<div class="col-sm-9">
												<div class="mb-3">
													<input type="text" class="form-control" name="location" id="location" value="<?php echo $profile_details['country']; ?>" placeholder="Country" required>
												</div>
											</div>
										</div>
										<div class="row form-group">
											<label for="addressline1" class="col-sm-3 col-form-label input-label">Address line 1</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="addressline1" id="addressline1" value="<?php echo $profile_details['address1']; ?>" placeholder="Your address" required>
											</div>
										</div>
										<div class="row form-group">
											<label for="addressline2" class="col-sm-3 col-form-label input-label">Address line 2 <span class="text-muted">(Optional)</span></label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="addressline2" id="addressline2" value="<?php echo $profile_details['address2']; ?>" placeholder="Your address">
											</div>
										</div>
										<div class="row form-group">
											<label for="zipcode" class="col-sm-3 col-form-label input-label">Zip code</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="zipcode" id="zipcode" value="<?php echo $profile_details['zip_code']; ?>" placeholder="Your zip code" required>
											</div>
										</div>
										
										<div class="row form-group">
											<label for="zipcode" class="col-sm-3 col-form-label input-label">Opening Hours</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="opening_hours" id="opening_hours" value="<?php echo $profile_details['opening_hours']; ?>" placeholder="Opening Hours" required>
											</div>
										</div>
										
										<div class="text-right">
											<button type="submit" name="profile_update" class="btn btn-primary">Save Changes</button>
										</div>
									</form>
									<!-- /Form -->
									
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
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>

	</body>
</html>