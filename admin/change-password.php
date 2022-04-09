<?php

session_start();

include('includes/config.php');

 if(isset($_POST['pwd-reset'])) {

    $current_password=mysqli_real_escape_string($con,$_POST['current_password']);    
    $new_pwd=mysqli_real_escape_string($con,$_POST['new_password']);
    $con_pwd=mysqli_real_escape_string($con,$_POST['confirm_password']);
    
    $login_check=mysqli_num_rows(mysqli_query($con,"select * from admin_user where password='".$current_password."' and is_active='1'"));
    
    if($login_check > 0) {
        
     
     if($new_pwd == $con_pwd) {
         
        $password_reset=mysqli_query($con,"update admin_user set password='".$con_pwd."' where email_id='".$email."' and is_active='1'");     
         
         
        if($password_reset=true) {
            
             echo "<script>alert('Success! New password updated.');location.href='change-password.php';</script>";
            
        } else {
            
            echo "<script>alert('Opps! Somthing went wrong.');location.href='change-password.php';</script>"; 
            
        }
         
        

     } else {
         
          echo "<script>alert('Opps! New password and confirmation password do not match.');location.href='change-password.php';</script>";   
     }
        
        
    } else {
      
      echo "<script>alert('Opps! Invalide Password.');</script>";  
        
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
									<li class="breadcrumb-item active">Change Password</li>
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
									<h5 class="card-title">Change Password</h5>
								</div>
								<div class="card-body">
								
									<!-- Form -->
									<form method="post">
										<div class="row form-group">
											<label for="current_password" class="col-sm-3 col-form-label input-label">Current Password</label>
											<div class="col-sm-9">
												<input type="password" class="form-control" name="current_password" id="current_password" placeholder="Enter current password">
											</div>
										</div>
										<div class="row form-group">
											<label for="new_password" class="col-sm-3 col-form-label input-label">New Password</label>
											<div class="col-sm-9">
												<input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter new password">
											</div>
										</div>
										<div class="row form-group">
											<label for="confirm_password" class="col-sm-3 col-form-label input-label">Confirm new password</label>
											<div class="col-sm-9">
												<div class="mb-3">
													<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm your new password">
												</div>
											</div>
										</div>
										<div class="text-right">
											<button type="submit" class="btn btn-primary" name="pwd-reset">Save Changes</button>
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