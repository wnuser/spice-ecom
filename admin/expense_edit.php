<?php

include('includes/config.php');

session_start();

if(isset($_POST['edit_expenses']))
{
   
   
    $exp_id=mysqli_real_escape_string($con,$_POST['exp_id']);
    $sup_name=mysqli_real_escape_string($con,$_POST['sup_name']);
    $date=$_POST['exp_date'];
    $exp_category=mysqli_real_escape_string($con,$_POST['exp_category']);
    $description=mysqli_real_escape_string($con,$_POST['description']);
    $inv_amount=mysqli_real_escape_string($con,$_POST['inv_amount']);
    
    $remark=mysqli_real_escape_string($con,$_POST['remark']);
    $pay_type=mysqli_real_escape_string($con,$_POST['pay_type']);
   
    $exp_date_format=date('Y-m-d',strtotime($date));
    
        
    $exp_data=mysqli_query($con,"update `expenses_receipt` set `sup_name`='".$sup_name."',`date`='".$exp_date_format."', `exp_category`='".$exp_category."',
    `description`='".$description."', `amount`='".$inv_amount."', `remark`='".$remark."', `pay_type`='".$pay_type."' where exp_id='".$exp_id."' and is_active='1'");
   
    
    $last_id = $con->insert_id;
    
    
    if($exp_data==true)
    {
          
         echo "<script>alert('Expenses Receipt Updated Successfully..!!');location.href='expenses_reportsall.php'</script>";
         
    } else {
        
         echo "<script>alert('Something Went wrong..!!');location.href='expenses_reportsall.php'</script>";
    }
   
}
    
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Eternal Seasoning - Expenses</title>
		
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
									<li class="breadcrumb-item active">Edit Expenses</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<?php
					
					$exp_id=$_GET['exp_id'];
					$expense_row=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM expenses_receipt where exp_id='".$exp_id."' and is_active='1'"));
					
					
					
					?>
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
							    <form method="post" enctype="multipart/form-data" autocomplete="off"> 
								<div class="card-body">
								    <div class="row">
								        
								        <div class="col-md-4">
									        <div class="form-group">
									            <input type="text" class="form-control" name="exp_id" id="exp_id" value="<?php echo $expense_row['exp_id']; ?>" readonly>
									        </div>
									    </div>
								        
									    <div class="col-md-4">
									        <div class="form-group">
									            <div class="cal-icon">
									              <input type="text" class="form-control datetimepicker" name="exp_date" id="exp_date" value="<?php echo date('d-m-Y',strtotime($expense_row['date'])); ?>" placeholder="Expenses Date" required>
									            </div>
									        </div>
									    </div>
									    
									    <div class="col-md-4">
									        <div class="form-group">
									            <input type="text" class="form-control" name="sup_name" id="sup_name" value="<?php echo $expense_row['sup_name']; ?>" placeholder="Supplier Name">
									        </div>
									    </div>
									    
									    <div class="col-md-4">
									        <div class="form-group">
										        <select class="select" name="exp_category" id="exp_category" required>
												    <option value="">Select Category</option>
													<?php 
													$expenses_category=mysqli_query($con,"select * from expenses_category where is_active='1'");
													while($expenses_category_row=mysqli_fetch_array($expenses_category))
													{
													?>
													<option value="<?php echo $expenses_category_row['id']; ?>" <?php if($expenses_category_row['id']==$expense_row['exp_category']) { ?> selected <?php } ?>><?php echo $expenses_category_row['category_name']; ?></option>
													<?php } ?>
											    </select>
									        </div>
									    </div>
									    
									    <div class="col-md-4">
									        <div class="form-group">
									            <input type="text" class="form-control" name="description" id="description" value="<?php echo $expense_row['description']; ?>" placeholder="Description">
									        </div>
									    </div>
									    <div class="col-md-4">
									        <div class="form-group">
									            <input type="text" class="form-control" name="inv_amount" id="inv_amount" value="<?php echo $expense_row['amount']; ?>" placeholder="Expenses Total" required>
									        </div>
									    </div>
									    
									    <div class="col-md-4">
									        <div class="form-group">
										        <select class="select" name="pay_type" id="pay_type" required>
												    <option value="">Select Payment</option>
													<option value="Cash" <?php if($expense_row['pay_type']=="Cash") { ?> selected <?php } ?>>Cash</option>
													<option value="Card" <?php if($expense_row['pay_type']=="Card") { ?> selected <?php } ?>>Card</option>
													<option value="Cheque" <?php if($expense_row['pay_type']=="Cheque") { ?> selected <?php } ?>>Cheque</option>
											    </select>
									        </div>
									    </div>
									    
									    <div class="col-md-4">
									        <div class="form-group">
									            <textarea class="form-control" name="remark" id="remark" placeholder="Remark"><?php echo $expense_row['remark']; ?></textarea>
									        </div>
									    </div>
									    
									</div>
					            </div>
								
								<div class="row">
							     <div class="col-md-12">	    
    								  <div class="form-group">    
        								    <div class="text-right mt-4">
        									  <button type="submit" name="edit_expenses" class="btn btn-primary">Submit</button>
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
            
		</script>
	    
	</body>
</html>