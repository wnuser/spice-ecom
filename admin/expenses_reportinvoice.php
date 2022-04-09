<?php
    include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Blend Ur Spice - Expenses Invoice Report</title>
		
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
		
			<!-- Header -->
			    <?php include('includes/header.php'); ?>
			<!-- /Header -->
			
			<!-- Page Wrapper -->
			<?php 
            if(isset($_GET['recepit_id']))
            {
            ?>
			<div class="page-wrapper">
				<div class="content container-fluid">
				    <?php 
                        $id=$_GET['recepit_id'];
                        $sql=mysqli_query($con,"select * from expenses_receipt where exp_id='".$id."' and is_active='1'");
                        $row=mysqli_fetch_array($sql);
                        
                         $exp_category=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM expenses_category where id='".$row['exp_category']."' and is_active='1'"));    
                        
                    ?>
					<div class="row justify-content-center">
						<div class="col-xl-10">
							<div class="card">
								<div class="card-body">
								    <div class="table-responsive">
										<table class="table table-bordered mb-0">
											<tbody>
												<tr>
												    <td><strong>Expenses ID</strong></td>
											        <td><?php echo $row['exp_id'];?></td>
													<td><strong>Expenses Date</strong></td>
													<td><?php echo date('d-m-Y',strtotime($row['date']));?></td>
													
												</tr>
											    <tr>
											        <td><strong>Supplier Name</strong></td>
											        <td><?php echo $row['sup_name'];?></td>
											        <td><strong>Payment Mode</strong></td>
											        <td><?php echo $row['pay_type'];?></td>
											    </tr>
											    <tr>
											        <td><strong>Expenses Total</strong></td>
											        <td><?php echo $row['amount'];?></td>
											        <td><strong>Category</strong></td>
											        <td><?php echo $exp_category['category_name'];?></td>
											    </tr>
											    <tr>
											        <td><strong>Description</strong></td>
											        <td><?php echo $row['description'];?></td>
											        <td><strong>Remark</strong></td>
											        <td colspan='3'><?php echo $row['remark'];?></td>
											    </tr>
											   
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
		    <?php }?>
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
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>

	</body>
</html>