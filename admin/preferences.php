<?php

session_start();
include('includes/config.php');



if(isset($_POST['update_preference'])){
    

$pref_currency=mysqli_real_escape_string($con,$_POST['pref_currency']);
$pref_language=mysqli_real_escape_string($con,$_POST['pref_language']);
$about_company=mysqli_real_escape_string($con,$_POST['about_company']);
    
$update_preferences=mysqli_query($con,"update profile set currency='".$pref_currency."',language='".$pref_language."',about_company='".$about_company."' where is_active='1'");

if($update_preferences==true) {
    
    echo "<script>alert('Success! Preferences Updated.');location.href='preferences.php';</script>";
    
} else {
    
    echo "<script>alert('Oops! Something went wrong.');location.href='preferences.php';</script>";
    
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
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
		
		<link rel="stylesheet" href="assets/css/bootstrap3-wysihtml5.min.css">
		
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
									<li class="breadcrumb-item active">Preferences</li>
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
						
					     <?php 
								
						$profile_details=mysqli_fetch_array(mysqli_query($con,"select * from profile where id='1' and status='1' and is_active='1'"));
							
						?>
			                  	
						
						<div class="col-xl-9 col-md-8">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Preferences</h5>
								</div>
								<div class="card-body">
									<!-- Form -->
									<form method="post">
										<div class="row form-group">
											<label for="currencyLabel" class="col-sm-3 col-form-label input-label">Currency <span class="text-danger">*</span></label>
											<div class="col-sm-9">
												<select class="select" id="currencyLabel" name="pref_currency" required>
												    <option value="">Select Currency</option>
    												<?php 
    												$currency_master=mysqli_query($con,"select * from currency_master where is_active='1'");
    												while($currency_master_row=mysqli_fetch_array($currency_master))
    												{
    												?>    
													<option value="<?php echo $currency_master_row['id']; ?>" <?php if($currency_master_row['id']==$profile_details['currency']) { ?> selected <?php } ?>><?php echo $currency_master_row['currency']; ?> - <?php echo $currency_master_row['currency_country']; ?></option>
												    <?php } ?>	
												</select>
											</div>
										</div>
										<div class="row form-group">
											<label for="languageLabel" class="col-sm-3 col-form-label input-label">Language <span class="text-danger">*</span></label>
											<div class="col-sm-9">
												<select class="select" id="languageLabel" name="pref_language" required>
												 <option value="">Select Language</option>
                                                	<?php 
                                                	$language_master=mysqli_query($con,"select * from language_master where is_active='1'");
                                                	while($language_master_row=mysqli_fetch_array($language_master))
                                                	{
                                                	?>    
                                                	
                                                	 <option value="<?php echo $language_master_row['id']; ?>" <?php if($language_master_row['id']==$profile_details['language']) { ?> selected <?php } ?>><?php echo $language_master_row['language_name']; ?></option>
                                                	 
                                                	<?php } ?> 
												</select>
											</div>
										</div>
										
										<div class="row form-group">
											<label for="languageLabel" class="col-sm-3 col-form-label input-label">About Our Company <span class="text-danger">*</span></label>
											<div class="col-sm-9">
												<textarea class="form-control textarea" id="about_company" name="about_company" required><?php echo $profile_details['about_company']; ?></textarea>
											</div>
										</div>
									
										<div class="text-right">
											<button type="submit" name="update_preference" class="btn btn-primary">Save Changes</button>
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
		
		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
		<script src="assets/js/bootstrap3-wysihtml5.all.min.js"></script>
		
		<script>
		  
		  $('.textarea').wysihtml5({
              toolbar: { fa: true }
            }); 
		    
		</script>

	</body>
</html>