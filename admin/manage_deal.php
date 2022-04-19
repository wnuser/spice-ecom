<?php

session_start();
include('includes/config.php');

if(isset($_POST['add_products'])) {
    
    
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
   
   $insert_products=mysqli_query($con,"INSERT INTO `our_products` (`prd_type`, `product_name`, `prd_qty`, `price`, `product_image`, `recepie_ingredient`, `status`, `create_date`) 
   VALUES ('1', '$product_name', '$product_qty', '$product_price', '$shortname', '$recepie_ingredient', '$product_status', CURDATE())");
   
   if($insert_products==true) {
       
        $_SESSION['alert_msg']='<strong>Success!</strong> Deals Product Added.';
       
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
		<title>Eternal Seasoning - Deals</title>
		
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
        <style>
           .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
        </style>
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
								<h3 class="page-title">Deals</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashbaord.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Add Deals</li>
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
        						       
        						       <!-- <div class="col-md-3"> -->
    										<div class="form-group">
    											<label>Make Deal On or Off<span class="text-danger">*</span></label> <br>
                                                <label class="switch">
                                                    <input type="checkbox" id="deal">
                                                    <span class="slider round"></span>
                                                </label>
    										</div> <br>
										<!-- </div> -->
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

        $('#deal').change(function(){
            if (this.checked) {
                
                var checkbox = 1;
                $.ajax({
                    method: "POST",
                    url : "ajax_manage_deals.php",
                    data : {checkbox:checkbox},
                    success:function(data){
                        alert('Status update successfully');
                    },
                    error:function(data) {
                        alert('Something went wrong');
                    }
                })
            } else{
                var checkbox = 0;
                $.ajax({
                    method: "POST",
                    url : "ajax_manage_deals.php",
                    data : {checkbox:checkbox},
                    success:function(data){
                        alert('Status update successfully');
                    },
                    error:function(data) {
                        alert('Something went wrong');                        
                    }
                })
            }
        });
        
         $('.textarea').wysihtml5({
              toolbar: { fa: true }
            });
        
        </script>

	</body>
</html>