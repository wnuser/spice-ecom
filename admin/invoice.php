<?php

include('includes/config.php');

session_start();

$_SESSION['add_customer']=array();

$_SESSION['add_information']=array();  
    
$sender_details=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM sender_details where id='1' and is_active='1'")); 

$sen_company_name = $sender_details['name'];
$sen_email= $sender_details['email'];
$sen_address1= $sender_details['address'];
$sen_address2= $sender_details['address2'];
$sen_address3= $sender_details['address3'];
$sen_phone= $sender_details['phone'];
$sen_country= $sender_details['country'];
$sen_pin= $sender_details['pincode'];

$_SESSION['invoice_to']=$sender_details['id'];
    
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title> Eternal Seasoning - Create Order</title>
		
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
									<li class="breadcrumb-item"><a href="#">Dashbaord</a></li>
									<li class="breadcrumb-item active">Create Order</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
							   <form method="post" action="form_process.php" id="invoice_insert" enctype="multipart/form-data" autocomplete="off"> 
								<div class="card-body">
										<div class="row">
										    <div class="col-xl-7">
											    <img src="images/logo.png" alt="Logo"><br/><br/>
											    <h5 class="card-title">Sold By</h5>
											    <!--  <div class="form-group row" >
											          
													<div class="col-lg-8">
														<select class="select" name="invoice_from" id="invoice_from" onchange="select_from_address(this.value)" required>
    														<option value="">Select Address</option>
    														<?php
                                                            $sel_sender=mysqli_query($con,"select * from sender_details where is_active='1'");
                                                            while($sel_sender_row=mysqli_fetch_array($sel_sender))
                                                            { ?>
    														    <option value="<?php echo $sel_sender_row['id']; ?>" <?php if($sel_sender_row['id']==$sender_details['id']) { ?> selected <?php } ?>><?php echo $sel_sender_row['sender']; ?></option>
                                                            <?php } ?>
													    </select>
													</div>
													
													<div class="col-lg-2">
													    <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#addaddress" style="margin-left:-25px;"><i class="fas fa-plus" data-toggle="tooltip" data-placement="bottom" title="Create New Address"></i></a>
													</div>
													
												</div> -->
												
												<div id="view_from_address">
												 
												<table>
                                        	        <tbody>
                                        			
                                        				<tr>
                                        					<td><?php echo $sen_address1; ?></td>
                                        				</tr>
                                        				<tr>
                                        					<td><?php echo $sen_address2; ?></td>
                                        				</tr>
                                        				<tr>
                                        					<td><?php echo $sen_address3; ?></td>
                                        				</tr>
                                        				<tr>
                                        					<td><?php echo $sen_country.' '.$sen_pin; ?></td>
                                        				</tr>
                                        				<tr>
                                        					<td><?php echo $sen_phone; ?></td>
                                        				</tr>
                                        				<tr>
                                        					<td><?php echo $sen_email; ?></td>
                                        				</tr>
                                        			
                                        	        </tbody>
                                                </table>    
												    
												</div>
												
											</div>
											<div class="col-xl-5">
											    <br/><br/><br/>
											    <?php 
											    $sql=mysqli_query($con,"select * from generate_id where id='1' and is_active='1'");
											    while($row=mysqli_fetch_array($sql))
											    { 
											        $inv_id=$row["pref_name"].''.$row["inc_num"];
											    ?>
												<div class="form-group row">
													<label class="col-lg-4 col-form-label">Order ID</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" name="invno" value="<?php echo $inv_id; ?>" readonly="readonly">
													</div>
												</div>
												<?php }?>
											
												<div class="form-group row">
													<label class="col-lg-4 col-form-label">Order Date</label>
													<div class="col-lg-8">
													    <div class="cal-icon">
														    <input class="form-control datetimepicker" type="text" name="inv_date" id="inv_date" required>
														</div>
													</div>
												</div>
											</div>
										</div>			
										
										<div class="row">
											
											<div class="col-xl-7"><br>
											
												<h5 class="card-title">Shipping To</h5>
												
												<div class="form-group row">
													
													<div class="col-lg-12">
														<div class="input-group" style="width: 70%;">
                                                            <input type="text" name="search_email" id="search_email" class="form-control rounded" value="<?php echo $_SESSION['add_customer'][0]['rev_email']; ?>" placeholder="Search E-mail Address" aria-label="Search" aria-describedby="search-addon" >
                                                            <!--<button type="button" class="btn btn-outline-primary" id="search_customer"><i class="fas fa-search"></i></button>-->
                                                        </div>
													</div>
												</div>
												
												<div class="form-group row">
												   
												    <div class="col-lg-12">
												        
    												      <div id="customer-add-link">  
        												     <a href="javascript:void(0)" class="link-primary" data-toggle="modal" data-target="#addcustomer">
        												        <ins>Add New Customer</ins>
        												     </a><br><br>
        												  </div>     
    												     
    												      <div id="customer-edit-link" style="display:none;">  
        												     <a href="javascript:void(0)" class="link-primary" data-toggle="modal" data-target="#addcustomer">
        												        <ins>Edit Customer Details</ins> 
        												     </a><br><br>
        												  </div>  
        												  
        												  <div id="customer-search-edit-link" style="display:none;">  
        												     <a href="javascript:void(0)" class="link-primary" onclick="email_search_edit()">
        												        <ins>Edit Customer Details</ins> 
        												     </a><br><br>
        												  </div>  

												      <div id="view_cust_details">     
												      
												       <?php if($_SESSION['add_customer']!=''){ ?>
												            
												        <table>
        											        <tbody>
                												<tr>
                													<td><?php echo $_SESSION['add_customer'][0]['rev_name'].' '.$_SESSION['add_customer'][0]['last_name']; ?></td>
                												</tr>
                												<tr>
                													<td><?php echo $_SESSION['add_customer'][0]['add_line1']; ?></td>
                												</tr>
                												<tr>
                													<td><?php echo $_SESSION['add_customer'][0]['add_line2']; ?></td>
                												</tr>
                												<tr>
                													<td><?php echo $_SESSION['add_customer'][0]['rev_country'].' '.$_SESSION['add_customer'][0]['rev_pin']; ?></td>
                												</tr>
                												<tr>
                													<td><?php echo $_SESSION['add_customer'][0]['rev_phone']; ?></td>
                												</tr>
                												<tr>
                													<td><?php echo $_SESSION['add_customer'][0]['rev_email']; ?></td>
                												</tr>
                											    
        											        </tbody>
        											        
										                </table>
										                
										                <?php } ?>
										               </div>
												    </div>
											    </div>
											</div>
										
										</div>
										</div>
										<div class="table-responsive mt-4">
											<table class="table table-stripped table-center table-hover">
												<thead>
													<tr>
														<th>Item Name</th>
														<th>Quantity</th>
														<th>Price</th>
														<th>Amount</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody id="table-body">
													<tr class="single-row">
														<td>
															<input type="text" class="form-control" name="item_name[]" id="item_name" required>
														</td>
														<td>
															<input type="text" class="form-control" name="quantity[]" id="quantity" onkeyup="getInput()" required>
														</td>
														<td>
															<input type="text" class="form-control" name="price[]" id="price" onkeyup="getInput()" required>
														</td>
														<td>
															<input type="text" class="form-control" name="amount" id="amount" disabled>
														</td>
														<td class="add-remove text-right">
															<i class="fas fa-minus-circle"></i> 
														</td>
													</tr>
													
													<tr>
													    <td colspan="5">
															<button type="button" class="btn btn-primary" id="add-row"><i class="fas fa-plus-circle"></i ></button>
														</td>
												   </tr>
												   
												</tbody>
												<tfoot>
												    <tr>
												        <!--<th colspan="2">Shipping Bill &nbsp;:&nbsp;<input type="file" name="refer_file" id="refer_file"></th>-->
												        <th colspan="2"></th>
												        <th style="text-align:right;">Sub Total</th>
												        <td style="border: 1px solid #dee2e6;"><div id="sum"><input type="text" placeholder="0.00" name="subtotal" class="form-control" id="total" readonly></div></td>
												        <td></td>
												    </tr>
												   
												    <tr>
												        <th colspan="2"></th>
												        <th style="text-align:right;">Shipping Amount </th>
												        <td style="border: 1px solid #dee2e6;"><input type="text" class="form-control shipping_amt" name="shipping_amt" id="shipping_amt"></td>
												    </tr>
												    
												    <tr>
												        <th colspan="2"></th>
												        <th style="text-align:right;">Discount </th>
												        <td style="border: 1px solid #dee2e6;"><input type="text" class="form-control amt_discount" name="amt_discount" id="amt_discount"></td>
												    </tr>
												    
												    <tr>
												        <th colspan="2"></th>
												        <th style="text-align:right;">Total</th>
												        <td style="border: 1px solid #dee2e6;"><input type="text" placeholder="0.00" class="form-control" name="amt_total" id="amt_total" readonly></td>
												    </tr>
												</tfoot>
											</table>
										</div>
									
										<div class="text-right mt-4" style="margin-right: 20px;">
										    <div class="form-group">
										    	<button type="submit" name="savetodb" class="btn btn-primary">Submit</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="modal fade" id="addcustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="max-width: 600px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Customer Information</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
							            <div class="card">
								            <div class="card-body">
									                <div class="row">
											            <div class="col-md-6">
											               <div class="form-group">
            													<label>First Name <i class="fa fa-star" style="color: red;font-size: 5px";></i></label>
            													<input type="text" class="form-control" name="rev_name" id="rev_name" >
            												</div>
											                <div class="form-group">
													            <label>Email Address <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
													            <input type="text" class="form-control" name="rev_email" id="rev_email" >
											                </div>
            												<div class="form-group">
            													<label>Address Line1 <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
            													<input type="text" class="form-control" name="add_line1" id="add_line1" >
            												</div>
            												<div class="form-group">
            													<label>Postal Zip <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
            													<input type="text" class="form-control" name="rev_pin" id="rev_pin">
            												</div>
											            </div>
            											<div class="col-md-6">
            												<div class="form-group">
            													<label>Last Name </label>
            													<input type="text" class="form-control" name="last_name" id="last_name" >
            												</div>
            											    <div class="form-group">
            													<label>Phone No <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
            													<input type="text" class="form-control" name="rev_phone" id="rev_phone">
            												</div>
            												<div class="form-group">
            													<label>Address Line2</label>
            													<input type="text" class="form-control" name="add_line2" id="add_line2">
            												</div>
            												<div class="form-group">
            													<label>Country <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
            													<input type="text" class="form-control" name="rev_country" id="rev_country">
            												</div>
            											</div>
										            </div>
							                </div>
						                </div>
					                </div>
					            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" id="add-customer" name="add-customer" class="btn btn-primary" value="Save">
                            </div>
                       </div>
                    </div>
                </div>
                
                
                <div class="modal fade" id="addaddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="max-width: 600px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Address</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
							            <div class="card">
								            <div class="card-body">
									                <div class="row">
											            <div class="col-md-6">
											                <div class="form-group">
            													<label>Company Name <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
            													<input type="text" class="form-control" name="sen_company_name" id="sen_company_name">
            												</div>
            												<div class="form-group">
            													<label>Address Line1 <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
            													<input type="text" class="form-control" name="sen_address1" id="sen_address1" >
            												</div>
            												<div class="form-group">
            													<label>Address Line3</label>
            													<input type="text" class="form-control" name="sen_address3" id="sen_address3">
            												</div>
            												<div class="form-group">
            													<label>Country <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
            													<input type="text" class="form-control" name="sen_country" id="sen_country">
            												</div>
											            </div>
            											<div class="col-md-6">
            											    
            											    <div class="form-group">
													            <label>Email Address </label>
													            <input type="text" class="form-control" name="sen_email" id="sen_email" >
											                </div>
											                
											                <div class="form-group">
            													<label>Address Line2</label>
            													<input type="text" class="form-control" name="sen_address2" id="sen_address2">
            												</div>
            												
            												<div class="form-group">
            													<label>Phone No</label>
            													<input type="text" class="form-control" name="sen_phone" id="sen_phone">
            												</div>
            											
            												<div class="form-group">
            													<label>Postal Zip <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
            													<input type="text" class="form-control" name="sen_pin" id="sen_pin">
            												</div>
            												
            											</div>
										            </div>
							                </div>
						                </div>
					                </div>
					            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="button" id="add-sender" name="add-sender" class="btn btn-primary" value="Save">
                            </div>
                       </div>
                    </div>
                </div>
                
		    </div>
			<!-- /Page Wrapper -->
		</div>
		<!-- /Main Wrapper -->
		
		<script>
		    //Add new row
            const tBody = document.getElementById("table-body");

            addNewRow =()=> {
                const row = document.createElement("tr");
                row.className = "single-row";
                row.innerHTML = `<td><input type="text" class="form-control" name="item_name[]" id="item_name" required></td>
            					 <td><input type="text" class="form-control" name="quantity[]" id="quantity" onkeyup="getInput()" required></td>
            					 <td><input type="text" class="form-control" name="price[]" id="price" onkeyup="getInput()" required></td>
            					 <td><input type="text" class="form-control amount" name="amount" id="amount" disabled></td>
            					 <td class="add-remove text-right"><i class="fas fa-minus-circle" action="delete"></i></td>`
                
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
                    
                    document.getElementById("amt_total").value = total;
                    
                    var shipping_amt=document.getElementById("shipping_amt").value;
                    
                    var amt_discount=document.getElementById("amt_discount").value;
                    
                    
                    if(shipping_amt > 0) {
                        
                      var amt_cal = (parseFloat(total) + parseFloat(shipping_amt));
                      
                      document.getElementById("amt_total").value = amt_cal;
                        
                    } 
                    
                    if(amt_discount > 0) {
                        
                      var ship_cal = (parseFloat(total) + parseFloat(shipping_amt));
                      
                      var disc_cal = (parseFloat(ship_cal) - parseFloat(amt_discount))
                      
                      document.getElementById("amt_total").value = disc_cal;
                        
                    } 
                    
                    
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
		
		<script type="text/javascript">
 
         $(document).ready(function(){
            var maxField = 11; 
            var addButton = $('.add_button'); 
            var wrapper = $('.field_wrapper'); 
            var x = 2;
            
            $(addButton).click(function(){
              
                if(x < maxField){ 
                    
                    $(wrapper).append('<div class="row" id="attr_'+x+'" style="margin-left: 20px;"><div class="col-md-8"><label>Shipping Bills</label><div class="form-group"><input type="file" name="refer_file[]" id="refer_file'+x+'" required><a href="javascript:void(0);" data-id="'+x+'" class="btn btn-danger remove_button"><i class="fas fa-minus-circle"></i ></a><br></div></div></div>');
                   
                    x++;
                }
            });
            
         
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                var rec_id=$(this).attr('data-id');
                $('#attr_'+rec_id).remove(); 
                x--; 
            });
        });

        </script>
	  
	    <script>	
		
		$(document).on("change","#search_email",function() {	 
		    
		    var srch_email=$('#search_email').val(); 
        	
        	if(srch_email!='')
        	{
        	   
                	$.ajax({  
                    url:"search_email.php",  
                    method:"POST",  
                    data:{ srch_email:srch_email },  
                    success:function(data)  
                    {  
                       
                      if(data!=''){
                      
                      $('#search_email').val(srch_email);
                      
                      $('#customer-add-link').hide();
                      $('#customer-edit-link').hide();
                      $('#customer-search-edit-link').show();
                      
                      $('#view_cust_details').html(data);
                      
                          
                      } else {
                      
                      alert('This Email ID Not Found.'); 
                      
                      $('#search_email').val('')
                      $('#view_cust_details').html(''); 
                       
                      $('#customer-add-link').show();
                      $('#customer-edit-link').hide();
                      $('#customer-search-edit-link').hide(); 
                          
                      }
                      
                    }  
                }); 
        	    
        	} else {
        	   
        	  alert('Oops! Please Enter the Email ID.');
        	    
        	}
        
    	});
    	
    	$(document).on("click","#add-customer",function() {
    	    
    	    alert();
		    
		    var rev_email=$('#rev_email').val(); 
		    var rev_name=$('#rev_name').val(); 
		    var last_name=$('#last_name').val(); 
		    var add_line1=$('#add_line1').val(); 
		    var add_line2=$('#add_line2').val(); 
		    var add_line3=$('#add_line3').val(); 
		    var rev_phone=$('#rev_phone').val(); 
		    var rev_pin=$('#rev_pin').val(); 
		    var rev_country=$('#rev_country').val(); 
		    var business_name=$('#business_name').val(); 
        	
        	if(rev_name!='' && add_line1!='' && rev_pin!='' && rev_country!='')
        	{
        	   
                	$.ajax({  
                    url:"add_customer.php",  
                    method:"POST",  
                    data:{ rev_email:rev_email,rev_name:rev_name,last_name:last_name,add_line1:add_line1,add_line2:add_line2,add_line3:add_line3,rev_phone:rev_phone,rev_pin:rev_pin,rev_country:rev_country,business_name:business_name },  
                    success:function(data)  
                    {  
                        
                      $('#addcustomer').modal('hide');
                      $('#search_email').val(rev_email);
                      
                      $('#customer-add-link').hide();
                      $('#customer-search-edit-link').hide();
                      $('#customer-edit-link').show();
                      
                      $('#view_cust_details').html(data);
                      
                    }  
                }); 
        	    
        	} else {
        	   
        	  alert('Oops! Please fill in all the required fields.');
        	    
        	}
        
    	});
    	
    	$(document).on("click","#add-sender",function() {	 
		    
		    var sen_company_name=$('#sen_company_name').val(); 
		    var sen_email=$('#sen_email').val(); 
		    var sen_address1=$('#sen_address1').val(); 
		    var sen_address2=$('#sen_address2').val(); 
		    var sen_address3=$('#sen_address3').val(); 
		    var sen_phone=$('#sen_phone').val(); 
		    var sen_country=$('#sen_country').val(); 
		    var sen_pin=$('#sen_pin').val(); 
		    
        	if(sen_company_name!='' && sen_email!='' && sen_address1!='' && sen_country!='' && sen_pin!='')
        	{
        	   
                	$.ajax({  
                    url:"add_sender_details.php",  
                    method:"POST",  
                    data:{ sen_company_name:sen_company_name,sen_email:sen_email,sen_address1:sen_address1,sen_address2:sen_address2,sen_address3:sen_address3,sen_phone:sen_phone,sen_country:sen_country,sen_pin:sen_pin },  
                    success:function(data)  
                    {  
                        
                      $('#addaddress').modal('hide');
                      
                      $('#sen_company_name').val(''); 
            		  $('#sen_email').val(''); 
            		  $('#sen_address1').val(''); 
            		  $('#sen_address2').val(''); 
            		  $('#sen_address3').val(''); 
            		  $('#sen_phone').val(''); 
            		  $('#sen_country').val(''); 
            		  $('#sen_pin').val(''); 
                      
                      selected_address(sen_company_name);
                      
                      $('#view_from_address').html(data);
                      
                    }  
                }); 
        	    
        	} else {
        	   
        	  alert('Oops! Please fill in all the required fields.');
        	    
        	}
        
    	});
    	
    	$(document).on("click","#edit-customer",function() {	 
		    
		    var rev_email=$('#rev_email').val(); 
		    var rev_name=$('#rev_name').val(); 
		    var last_name=$('#last_name').val(); 
		    var add_line1=$('#add_line1').val(); 
		    var add_line2=$('#add_line2').val(); 
		    var add_line3=$('#add_line3').val(); 
		    var rev_phone=$('#rev_phone').val(); 
		    var rev_pin=$('#rev_pin').val(); 
		    var rev_country=$('#rev_country').val(); 
		    var business_name=$('#business_name').val(); 
        	
        	if(rev_email!='' && rev_name!='' && add_line1!='' && rev_pin!='' && rev_country!='')
        	{
        	   
                	$.ajax({  
                    url:"edit_customer.php",  
                    method:"POST",  
                    data:{ rev_email:rev_email,rev_name:rev_name,last_name:last_name,add_line1:add_line1,add_line2:add_line2,add_line3:add_line3,rev_phone:rev_phone,rev_pin:rev_pin,rev_country:rev_country,business_name:business_name },  
                    success:function(data)  
                    {  
                      
                      $('#addcustomer').modal('hide');
                      $('#search_email').val(rev_email);
                      
                      $('#customer-add-link').hide();
                      $('#customer-search-edit-link').hide();
                      $('#customer-edit-link').show();
                      
                      $('#view_cust_details').html(data);
                      
                    }  
                }); 
        	    
        	} else {
        	   
        	  alert('Oops! Please fill in all the required fields.');
        	    
        	}
        
    	});
    
    	
       	$(document).on("change",".amt_discount",function() {
    	    
    	var amt_total=0;   
        
        var shipping_amt=$('#shipping_amt').val();
        
        var amt_discount=$('#amt_discount').val();
        
        var subtot=$('#total').val(); 
        
        if(shipping_amt!='') {
            
            subtot=(parseFloat(subtot) + (parseFloat(shipping_amt)));
        }
        
        if(amt_discount > 0)
        {
        
            if(subtot > 0)
            {
            
                 if(parseFloat(subtot) < parseFloat(amt_discount))
                  {
                      
                      alert('Please enter a valid amount!'); 
                      
                      $('#amt_discount').val('0.00');
                      $('#amt_total').val(subtot);
                        
                  } else {
                      
                      amt_cal = (parseFloat(subtot) - parseFloat(amt_discount));
                     
                      $('#amt_total').val(amt_cal.toFixed(2));
                  }
              
            } else {
                
               $('#amt_discount').val('0.00');
               $('#amt_total').val('0.00');
                
            }  
          
          
        } else {
            
           $('#amt_total').val(subtot.toFixed(2));    
            
        }
        
    	});
    	
    	$(document).on("change",".shipping_amt",function() {
    	    
    	var amt_total=0;   
        
        var shipping_amt=$('#shipping_amt').val();
        
        var amt_discount=$('#amt_discount').val();
        
        var subtot=$('#total').val(); 
        
        if(shipping_amt > 0)
        {
        
            if(subtot > 0)
            {
            
                amt_cal = (parseFloat(subtot) + parseFloat(shipping_amt));
                
                if(amt_discount!=''){
                    
                    amt_cal=(parseFloat(amt_cal) - parseFloat(amt_discount));
                }
                
                $('#amt_total').val(amt_cal.toFixed(2));
                
            } else {
                
               $('#shipping_amt').val('0.00');
               $('#amt_total').val('0.00');
                
            }  
          
          
        } else {
            
            if(amt_discount!=''){
                
               subtot=(parseFloat(subtot) - parseFloat(amt_discount));
               
            }    
            
           $('#amt_total').val(subtot.toFixed(2));    
            
        }
        
    	});
    	
    	function email_search_edit()
    	{
    	   
    	   var email_id=document.getElementById('search_email').value;
    	   
    	    if(email_id!=''){
    	       
    	       $.ajax({  
            	    
                url:"edit_customer_details.php",  
                method:"POST",  
                data:{ email_id:email_id },  
                success:function(data)  
                { 
                    
                  $('#addcustomer').html(data);
                  
                  $('#addcustomer').modal('show');
                  
                }  
            }); 
    	       
    	   } else {
    	       
    	       alert('Oops! Something went Wrong');
    	       
    	   } 
    	   
    	    
    	}
    	
    	function selected_address(val)
    	{
    	   
    	    if(val!=''){
    	       
    	       $.ajax({  
            	    
                url:"selected_address.php",  
                method:"POST",  
                data:{ selected_add:val },  
                success:function(data)  
                { 
                    
                    $('#invoice_from').html(data);
                  
                }  
            }); 
    	       
    	   } 
    	    
    	}
    	
    	function select_from_address(val)
    	{
    	   
    	    if(val!=''){
    	       
    	       $.ajax({  
            	    
                url:"add_sender_details.php",  
                method:"POST",  
                data:{ from_add:val },  
                success:function(data)  
                { 
                    
                    $('#view_from_address').html(data);
                  
                }  
            }); 
    	       
    	   } else {
    	       
    	       $('#view_from_address').html('');
    	       
    	   } 
    	   
    	    
    	}
    	
        $(function() {
           
         $("#search_email" ).autocomplete({
           source: 'search.php',
         });
         
      });
      
      $(function() {
           
         $("#item_name" ).autocomplete({
           source: 'itemname_search.php',
         });
         
      });
    	
	
	</script>

	</body>
</html>