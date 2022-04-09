<?php

session_start();
include('includes/config.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Online Order - Profile</title>
		
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
				
					<div class="row justify-content-lg-center">
						<div class="col-lg-10">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col">
										<h3 class="page-title">Profile</h3>
										<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
											<li class="breadcrumb-item active">Profile</li>
										</ul>
									</div>
								</div>
							</div>
							<!-- /Page Header -->
			   
			                <?php 
								
							$profile_details=mysqli_fetch_array(mysqli_query($con,"select * from profile where id='1' and status='1' and is_active='1'"));
							
							?>
			                  
							<div class="profile-cover">
								<div class="profile-cover-wrap">
									<img class="profile-cover-img" src="assets/img/cover/<?php echo $profile_details['cover_image']; ?>" alt="Profile Cover">
								</div>
							</div>

							<div class="text-center mb-5">
								<label class="avatar avatar-xxl profile-cover-avatar" for="avatar_upload">
									<img class="avatar-img" src="assets/img/profiles/<?php echo $profile_details['profile_img']; ?>" alt="Profile Image">
								</label>
								<h2><?php echo $profile_details['name']; ?> <i class="fas fa-certificate text-primary small" data-toggle="tooltip" data-placement="top" title="" data-original-title="Verified"></i></h2>
								<ul class="list-inline">
									<li class="list-inline-item">
										<i class="fas fa-map-marker-alt"></i> <?php echo $profile_details['address1']; ?>
									</li>
									<li class="list-inline-item">
										<i class="far fa-calendar-alt"></i> <span>Joined <?php echo date('M, Y',strtotime($profile_details['create_date'])); ?></span>
									</li>
								</ul>
							</div>
			
							<div class="row">
								<div class="col-lg-4">
								
									<div class="card">
										<div class="card-header">
											<h5 class="card-title d-flex justify-content-between">
												<span>Profile</span> 
												<a class="btn btn-sm btn-white" href="settings.php">Edit</a>
											</h5>
										</div>
										<div class="card-body">
											<ul class="list-unstyled mb-0">
												<li class="py-0">
													<small class="text-dark">About</small>
												</li>
												<li>
													<?php echo $profile_details['name']; ?>
												</li>
												<li class="pt-2 pb-0">
													<small class="text-dark">Contacts</small>
												</li>
												<li>
													<?php echo $profile_details['email']; ?>
												</li>
												<li>
													<?php echo $profile_details['phone']; ?>
												</li>
												<li class="pt-2 pb-0">
													<small class="text-dark">Address</small>
												</li>
												<li>
													<?php echo $profile_details['address1']; ?>,<br>
													<?php echo $profile_details['address2']; ?>
												</li>
											</ul>
										</div>
									</div>

								</div>

								<div class="col-lg-8">
									<div class="card">
										<div class="card-header">
											<h5 class="card-title">Activity</h5>
										</div>
										<div class="card-body card-body-height">
											<ul class="activity-feed">
												<li class="feed-item">
													<span class="feed-text"> No Activity Found</span>
												</li>
											</ul>
										</div>
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
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>

	</body>
</html>