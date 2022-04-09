<?php
include('includes/config.php');
session_start();

    if(isset($_POST['submit']))
    {
    
        $name=mysqli_real_escape_string($con,$_POST['name']);
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $address=mysqli_real_escape_string($con,$_POST['address']);
        $address2=mysqli_real_escape_string($con,$_POST['address2']);
        $address3=mysqli_real_escape_string($con,$_POST['address3']);
        $pincode=mysqli_real_escape_string($con,$_POST['pincode']);  
        $country=mysqli_real_escape_string($con,$_POST['country']);  
        $phone=mysqli_real_escape_string($con,$_POST['phone']);  
          
      
        $sql=mysqli_query($con,"insert into sender_details(sender,name,address,address2,address3,pincode,country,phone,email,create_date) values ('$name','$name','$address','$address2','$address3','$pincode','$country','$phone','$email',CURDATE())");
        
        if($sql=="true")
        {
            echo "<script>alert('Sender Successfully Created..');window.location='sender_details.php';</script>";
        } else {
            echo "<script>alert('Something went wrong..');window.location='sender_details.php';</script>";
        }
    }
    
    if(isset($_GET['delete']))
    {
        $row_id=$_GET['delete'];
        $del_data=mysqli_query($con,"update sender_details set is_active='0' where id='".$row_id."' and is_active='1'");
    
        if($del_data==true)
        {
            echo "<script>alert('Sender Details Deleted Successfully..!!');location.href='sender_details.php'</script>";
        }
            
        else {
            
            echo "<script>alert('Something went wrong..!!');location.href='sender_details.php'</script>";
        }
    }

    if(isset($_POST['update'])){
    
        $send_id=$_POST['send_id'];
        $name=mysqli_real_escape_string($con,$_POST['name']);
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $address=mysqli_real_escape_string($con,$_POST['address']);
        $address2=mysqli_real_escape_string($con,$_POST['address2']);
        $address3=mysqli_real_escape_string($con,$_POST['address3']);
        $pincode=mysqli_real_escape_string($con,$_POST['pincode']);  
        $country=mysqli_real_escape_string($con,$_POST['country']);  
        $phone=mysqli_real_escape_string($con,$_POST['phone']);
        
        
        $sender_update=mysqli_query($con,"update sender_details set sender='".$name."',name='".$name."',address='".$address."',address2='".$address2."',address3='".$address3."',pincode='".$pincode."',country='".$country."',phone='".$phone."',email='".$email."' where id='".$send_id."'");
    
        if($sender_update==true){
            
            echo "<script>alert('Sender Details Updated Successfully..');location.href='sender_details.php';</script>";
            
        } else {
            
            echo "<script>alert('Something went wrong..');location.href='sender_details.php';</script>";
            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>LAGPAT - UCS Details</title>
		
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
								<!--<h3 class="page-title">Sender</h3>-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">UCS</a></li>
									<li class="breadcrumb-item active">Address Details</li>
								</ul>
							</div>
						</div>
					</div>
					
					<?php
					
                    if(isset($_GET['edit']))
                    {
                        
                    ?>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<form class="needs-validation" novalidate method="post">
									    <?php 
                                            $sender_id=$_GET['edit'];
                                            $update_sender=mysqli_query($con,"select * from sender_details where id='".$sender_id."' and is_active='1'");
                                            while($sender_row=mysqli_fetch_array($update_sender))
                                            {
                                        ?>
										<div class="row">
										    <div class="col-md-3">
												<div class="form-group">
													<label>Company Name <i class="fa fa-star" style="color: red;font-size: 5px";></i></label>
													<input type="hidden" name="send_id" id="send_id" value="<?php echo $sender_row['id']; ?>">
													<input type="text" id="name" name="name" class="form-control" value="<?php echo $sender_row['name']; ?>" required>
													<div class="invalid-feedback">
													    Please Enter Company Name
												    </div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Email Address <i class="fa fa-star" style="color: red;font-size: 5px";></i></label>
													<input type="email" id="email" name="email" class="form-control" value="<?php echo $sender_row['email']; ?>" required>
													<div class="invalid-feedback">
													    Please Enter Valid Email
												    </div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Address Line1 <i class="fa fa-star" style="color: red;font-size: 5px";></i></label>
													<input type="text" id="address" name="address" class="form-control" value="<?php echo $sender_row['address']; ?>" required>
													<div class="invalid-feedback">
													    Please Enter Address
												    </div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Address Line2 </label>
													<input type="text" id="address2" name="address2" class="form-control" value="<?php echo $sender_row['address2']; ?>">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Address Line3 </label>
													<input type="text" id="address3" name="address3" class="form-control" value="<?php echo $sender_row['address3']; ?>">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Postal Zip <i class="fa fa-star" style="color: red;font-size: 5px";></i></label>
													<input type="text" id="pincode" name="pincode" class="form-control" value="<?php echo $sender_row['pincode']; ?>" required>
													<div class="invalid-feedback">
													    Please Enter Postal Zip
												    </div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Country <i class="fa fa-star" style="color: red;font-size: 5px";></i></label>
													<input type="text" id="country"  name="country" class="form-control" value="<?php echo $sender_row['country']; ?>" required>
													<div class="invalid-feedback">
													    Please Enter Country
												    </div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Phone No</label>
													<input type="text" id="phone" name="phone" class="form-control" value="<?php echo $sender_row['phone']; ?>">
												</div>
											</div>
										</div>
										<?php }?>
										<div class="text-right mt-4">
											<button type="submit" name="update" class="btn btn-primary">Update Sender</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<?php }else{?>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<form class="needs-validation" novalidate method="post">
										<div class="row">
										    <div class="col-md-3">
												<div class="form-group">
													<label>Company Name <i class="fa fa-star" style="color: red;font-size: 5px";></i></label>
													<input type="text" id="name" name="name" class="form-control" required>
													<div class="invalid-feedback">
													    Please Enter Company Name
												    </div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Email Address <i class="fa fa-star" style="color: red;font-size: 5px";></i></label>
													<input type="email" id="email" name="email" class="form-control" required>
													<div class="invalid-feedback">
													    Please Enter Valid Email
												    </div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Address Line1 <i class="fa fa-star" style="color: red;font-size: 5px";></i></label>
													<input type="text" id="address" name="address" class="form-control" required>
													<div class="invalid-feedback">
													    Please Enter Address
												    </div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Address Line2 </label>
													<input type="text" id="address2" name="address2" class="form-control">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Address Line3 </label>
													<input type="text" id="address3" name="address3" class="form-control">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Postal Zip <i class="fa fa-star" style="color: red;font-size: 5px";></i></label>
													<input type="text" id="pincode" name="pincode" class="form-control" required>
													<div class="invalid-feedback">
													    Please Enter Postal Zip
												    </div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Country <i class="fa fa-star" style="color: red;font-size: 5px";></i></label>
													<input type="text" id="country"  name="country" class="form-control" required>
													<div class="invalid-feedback">
													    Please Enter Country
												    </div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Phone No</label>
													<input type="text" id="phone" name="phone" class="form-control">
												</div>
											</div>
										</div>
										<div class="text-right mt-4">
											<button type="submit" name="submit" class="btn btn-primary">Add Sender</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					
					<?php }?>
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card card-table"> 
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-stripped table-hover datatable">
											<thead class="thead-light">
												<tr>
												   <th>S.No</th>
												   <th>Name</th>
												   <th>Email</th>
												   <th>Address</th>
												   <th>Address2</th>
												   <th>Address3</th>
												   <th>Postal Zip</th>
												   <th>Country</th>
												   <th>Phone</th>
												   <th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>
											    <?php 
    		                                        $i=0;
                                                    $res=mysqli_query($con,"SELECT * FROM sender_details where is_active=1 ORDER BY id desc");
                                                    while($row=mysqli_fetch_array($res)){ $i++;
                                                ?>
												<tr>
												    <td><?php echo $i; ?></td>
													<td><?php echo $row['name']; ?></td>
													<td><?php echo $row['email']; ?></td>
													<td><?php echo $row['address']; ?></td>
													<td><?php echo $row['address2']; ?></td>
													<td><?php echo $row['address3']; ?></td>
													<td><?php echo $row['pincode']; ?></td>
													<td><?php echo $row['country']; ?></td>
													<td><?php echo $row['phone']; ?></td>
													<td class="text-right">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="sender_details.php?edit=<?php echo $row['id']; ?>"><i class="far fa-edit mr-2"></i>Edit</a>
																<a class="dropdown-item" href="sender_details.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Confirm to Delete?');"><i class="far fa-trash-alt mr-2"></i>Delete</a>
															</div>
														</div>
													</td>
												</tr>
												<?php 
                                                    }
                                                ?>
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
		
		<!-- Datatables JS -->
		<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/datatables/datatables.min.js"></script>

		<!-- Datepicker Core JS -->
		<script src="assets/plugins/moment/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Form Validation JS -->
        <script src="assets/js/form-validation.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>

	</body>
</html>