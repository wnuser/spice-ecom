<?php

include('includes/config.php');

session_start();

if(isset($_POST['add_expenses']))
{
   
   
    $exp_id=mysqli_real_escape_string($con,$_POST['exp_id']);
    $sup_name=mysqli_real_escape_string($con,$_POST['sup_name']);
    $date=$_POST['exp_date'];
    $exp_category=mysqli_real_escape_string($con,$_POST['exp_category']);
    
    $useful_life=mysqli_real_escape_string($con,$_POST['useful_life']);
    $start_month=mysqli_real_escape_string($con,$_POST['start_month']);
    $start_year=mysqli_real_escape_string($con,$_POST['start_year']);
    
    
    $description=mysqli_real_escape_string($con,$_POST['description']);
    $inv_amount=mysqli_real_escape_string($con,$_POST['inv_amount']);
    
    $remark=mysqli_real_escape_string($con,$_POST['remark']);
    $pay_type=mysqli_real_escape_string($con,$_POST['pay_type']);
   
    $exp_date_format=date('Y-m-d',strtotime($date));
    
        
    $exp_data=mysqli_query($con,"INSERT INTO `expenses_receipt` (`exp_id`,`sup_name`,`date`, `exp_category`, `useful_life`, `start_month`, `start_year`, `description`, `amount`, `remark`, `pay_type`, `create_date`) 
    VALUES ('$exp_id', '$sup_name', '$exp_date_format', '$exp_category', '$useful_life', '$start_month', '$start_year', '$description', '$inv_amount', '$remark','$pay_type', CURDATE())");
   
    
    $last_id = $con->insert_id;
    
    
    if($exp_data==true)
    {
        
          $sql3=mysqli_query($con,"select * from generate_id where id='3' and is_active=1");
          $invno_num=mysqli_fetch_array($sql3);
          $inc=$invno_num['inc_num']+1;
          $sql2=mysqli_query($con,"update generate_id set inc_num='".$inc."' where id='3' and is_active=1");
          
         echo "<script>alert('Expenses Receipt Insert Successfully..!!');location.href='expenses_receipt.php'</script>";
         
    } else {
        
         echo "<script>alert('Something Went wrong..!!');location.href='expenses_receipt.php'</script>";
    }
   
}
    
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Blend Ur Spice - Expenses</title>
		
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
		
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
		
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
						<div class="row">
							<div class="col-sm-12">
								<!--<h3 class="page-title">Invoices</h3>-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Expenses Report</a></li>
									<li class="breadcrumb-item active">Add Expenses</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="row">
						<div class="col-md-12">
							<div class="card">
							    <form method="post" enctype="multipart/form-data" autocomplete="off"> 
								<div class="card-body">
								    <div class="row">
								         
								           <?php 
    										    $sql=mysqli_query($con,"select * from generate_id where id='3' and is_active='1'");
    										    $row=mysqli_fetch_array($sql);
    										  
    										        $pur_id=$row["pref_name"].''.$row["inc_num"];
										    ?>   
								        
								        <div class="col-md-4">
									        <div class="form-group">
									            <input type="text" class="form-control" name="exp_id" id="exp_id" value="<?php echo $pur_id; ?>" readonly>
									        </div>
									    </div>
								        
									    <div class="col-md-4">
									        <div class="form-group">
									            <div class="cal-icon">
									              <input type="text" class="form-control datetimepicker" name="exp_date" id="exp_date" placeholder="Expenses Date" required>
									            </div>
									        </div>
									    </div>
									    
									    <div class="col-md-4">
									        <div class="form-group">
									            <input type="text" class="form-control" name="sup_name" id="sup_name" placeholder="Supplier Name">
									        </div>
									    </div>
									    
									    <div class="col-md-4">
									        <div class="form-group">
										        <select class="select" name="exp_category" id="exp_category" required onchange="select_assets(this.value)">
												    <option value="">Select Category</option>
													<?php 
													$expenses_category=mysqli_query($con,"select * from expenses_category where is_active='1'");
													while($expenses_category_row=mysqli_fetch_array($expenses_category))
													{
													?>
													<option value="<?php echo $expenses_category_row['id']; ?>"><?php echo $expenses_category_row['category_name']; ?></option>
													<?php } ?>
											    </select>
									        </div>
									    </div>
									    
									    <div class="col-md-4 assets_content" style="display:none;">
									        <div class="form-group">
									            <input type="text" class="form-control" name="useful_life" id="useful_life" placeholder="Useful life (Year)">
									        </div>
									    </div>
									    
									    <div class="col-md-4 assets_content" style="display:none;">
									        <div class="form-group">
									            <input type="text" class="form-control" name="start_month" id="start_month" placeholder="Starting Month">
									        </div>
									    </div>
									    
									    <div class="col-md-4 assets_content" style="display:none;">
									        <div class="form-group">
									            <input type="text" class="form-control" name="start_year" id="start_year" placeholder="Starting Year">
									        </div>
									    </div>
									    
									    <div class="col-md-4">
									        <div class="form-group">
									            <input type="text" class="form-control" name="description" id="description" placeholder="Description">
									        </div>
									    </div>
									    
									    <div class="col-md-4">
									        <div class="form-group">
									            <input type="text" class="form-control" name="inv_amount" id="inv_amount" placeholder="Expenses Total" required>
									        </div>
									    </div>
									    
									    <div class="col-md-4">
									        <div class="form-group">
										        <select class="select" name="pay_type" id="pay_type" required>
												    <option value="">Select Payment</option>
													<option value="Cash">Cash</option>
													<option value="Card">Card</option>
													<option value="Cheque">Cheque</option>
											    </select>
									        </div>
									    </div>
									    
									    <div class="col-md-4">
									        <div class="form-group">
									            <textarea class="form-control" name="remark" id="remark" placeholder="Remark"></textarea>
									        </div>
									    </div>
									    
									</div>
					            </div>
								
								<div class="row">
							     <div class="col-md-12">	    
    								  <div class="form-group">    
        								    <div class="text-right mt-4">
        									  <button type="submit" name="add_expenses" class="btn btn-primary">Add Expenses</button>
        							    	</div>
    							     	</div>
							    	</div>
								</div>
								
							    </form>
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
		
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	
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
		
		<script>
		
		
		   $('#start_month').datetimepicker({
			format: 'MM',
			icons: {
				up: "fas fa-angle-up",
				down: "fas fa-angle-down",
				next: 'fas fa-angle-right',
				previous: 'fas fa-angle-left'
			}
	    });
	    
	    $('#start_year').datetimepicker({
			format: 'YYYY',
			icons: {
				up: "fas fa-angle-up",
				down: "fas fa-angle-down",
				next: 'fas fa-angle-right',
				previous: 'fas fa-angle-left'
			}
	    });
		
		
		    //Add new row
            const tBody = document.getElementById("table-body");

            addNewRow =()=> {
                const row = document.createElement("tr");
                row.className = "single-row";
                row.innerHTML = `<td><input type="text" class="form-control" name="paid_amount[]" id="paid_amount" required></td>
            					 <td><input type="date" class="form-control" name="paid_date[]" id="paid_date" required></td>
            					 <td class="add-remove text-center"><i class="fas fa-minus-circle" action="delete"></i></td>`
                
                tBody.insertBefore(row, tBody.lastElementChild.previousSibling);
            }


            document.getElementById("add-row").addEventListener("click", (e)=> {
                e.preventDefault();
                addNewRow();
            });


            //GET INPUTS, MULTIPLY AND GET THE ITEM PRICE
            getInput =()=> {
                var rows = document.querySelectorAll("tr.single-row");
                rows.forEach((currentRow) => {
                    var quantity = currentRow.querySelector("#quantity").value;
                    var price = currentRow.querySelector("#price").value;
            
                    amount = quantity * price;
                    currentRow.querySelector("#amount").value = amount;
                    overallSum();
                    
                })
            };
            
            
            //Get the overall sum/Total
            overallSum =()=> {
                var arr = document.getElementsByName("amount");
                var total = 0;
                for(var i = 0; i < arr.length; i++) {
                    if(arr[i].value) {
                        total += +arr[i].value;
                    }
                    
                    document.getElementById("total").value = total;
                        
                    var amt_gst = ((parseFloat(total) * 7 ) / 100);
                      
                    document.getElementById("amt_gst").value = amt_gst;
                        
                    var amt_total = total + amt_gst;
                    
                    document.getElementById("amt_total").value = amt_total;
                    
                }
            }
            
            
            
            //Delete row from the table
            tBody.addEventListener("click", (e)=>{
                let el = e.target;
                const deleteROW = e.target.attributes.action.value;
                if(deleteROW == "delete") {
                    delRow(el);
                    overallSum();
                }
            })
            
            //Target row and remove from DOM;
            delRow =(el)=> {
                el.parentNode.parentNode.parentNode.removeChild(el.parentNode.parentNode);
            }
            
            
            function select_assets(val){
                
                if(val=='3'){
                    
                  $('.assets_content').show(); 
                  
                  $('#useful_life').attr('required', true);   
                  $('#start_month').attr('required', true);   
                  $('#start_year').attr('required', true);   
                    
                } else {
                    
                  $('.assets_content').hide(); 
                  
                  $('#useful_life').attr('required', false);   
                  $('#start_month').attr('required', false);   
                  $('#start_year').attr('required', false);  
                    
                }
                
                
            }
            
		</script>
	    
	</body>
</html>