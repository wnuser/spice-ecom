<?php
include('includes/config.php');

session_start();

if(isset($_POST["login"])) {

	$result = mysqli_query($con,"SELECT * FROM admin_user WHERE user_name='" . $_POST["username"] . "' and password = '". $_POST["password"]."' and status='1' and is_active='1'");
	$row  = mysqli_fetch_array($result);
	
	if(is_array($row)) {
	    
	$_SESSION["login_id"]=$row['id'];
	
    $_SESSION["login_name"]=$row['name'];
    

	 echo '<script language="javascript">window.location= "dashboard.php"; </script>';

	} else { 
	    
    echo '<script language="javascript"> alert("Invalid Username or Password!"); window.location= "index.php"; </script>';

	}
    
    
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Blend Ur Spice - Login</title>
		
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
		<div class="main-wrapper login-body">
			<div class="login-wrapper">
				<div class="container">
					<img class="img-fluid logo-dark mb-2" src="images/logo.png" alt="Logo">
					<div class="loginbox">
						<div class="login-right">
							<div class="login-right-wrap">
								<h1>Login</h1>
								<p class="account-subtitle">Access to our dashboard</p>
								<form method="post">
									<div class="form-group">
										<label class="form-control-label">User Name</label>
										<input type="text" name="username" class="form-control" required>
									</div>
									<div class="form-group">
										<label class="form-control-label">Password</label>
										<div class="pass-group">
											<input type="password" name="password" class="form-control" required>
											<span class="fas fa-eye toggle-password"></span>
										</div>
									</div>
									<button class="btn btn-lg btn-block btn-primary" type="submit" name="login">Login</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
		<script src="assets/js/jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Feather Icon JS -->
		<script src="assets/js/feather.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
	</body>
</html>