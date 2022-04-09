<?php

    include('includes/config.php');
    
    session_start();
	
	if(isset($_GET['invno'])){
       
       $invno=$_GET['invno'];
   
       $num_rows=mysqli_num_rows(mysqli_query($con,"SELECT * FROM orders where order_id='".$invno."' and is_active='1'"));
            											            
       if($num_rows > 0) {
           
       $_SESSION['add_customer']=array();    
           
        $fetch_rows=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM orders where order_id='".$invno."' and is_active='1'")); 
        
        $customers_row=mysqli_fetch_array(mysqli_query($con,"select * from customers where id='".$fetch_rows['customer_id']."' and is_active='1'"));
      
           $add_customer=array(
            
            "rev_email"=> $customers_row['email_id'],
            "rev_name"=> $customers_row['first_name'],
            "last_name"=> $customers_row['last_name'],
            "add_line1"=> $customers_row['address'],
            "add_line2"=> $customers_row['address2'],
            "rev_phone"=> $customers_row['phone'],
            "rev_pin"=> $customers_row['rev_pin'],
            "rev_country"=> $customers_row['country']
            
          );   
      
          array_push($_SESSION['add_customer'],$add_customer); 
       
       }
   
   }
    
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Blend Ur Spice - Order Edit</title>
		
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
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active">Edit Order</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<?php 
        	            $id=$_GET['invno'];
        	            
 	                    $row=mysqli_fetch_array(mysqli_query($con,"select * from orders where order_id='".$id."' and is_active='1'"));
 	                    
 	                    $customers_row=mysqli_fetch_array(mysqli_query($con,"select * from customers where id='".$row['customer_id']."' and is_active='1'"));
                        
                        $delivery_status_row=mysqli_fetch_array(mysqli_query($con,"select * from delivery_status where id='".$row['status']."' and is_active='1'"));
                         
 	                    
 	                    
            	     ?>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
							   <form method="post" action="invoice_edit_process.php" id="invoice_insert" enctype="multipart/form-data" autocomplete="off"> 
								<div class="card-body">
										<div class="row">
										    <div class="col-xl-7">
											    <img src="images/logo.png" alt="Logo"><br/><br/>
											    <h5 class="card-title">Sold By</h5>
											    <table>
											        <tbody>
											            <?php 
        											        $sender_details=mysqli_query($con,"select * from sender_details where id='1' and is_active='1'");
        											        $row_sender=mysqli_fetch_array($sender_details);
											            ?>
        												<tr>
        													<td><?php echo $row_sender['name'];?></td>
        												</tr>
        												<tr>
        													<td><?php echo $row_sender['address'];?></td>
        												</tr>
        												<tr>
        													<td><?php echo $row_sender['address2'];?></td>
        												</tr>
        												<tr>
        													<td><?php echo $row_sender['address3'];?></td>
        												</tr>
        												<tr>
        													<td><?php echo $row_sender['pincode'];?></td>
        												</tr>
        												<tr>
        													<td><?php echo $row_sender['country'];?></td>
        												</tr>
        												<tr>
        													<td><?php echo $row_sender['email'];?></td>
        												</tr>
        												<tr>
        													<td><?php echo $row_sender['phone'];?></td>
        												</tr>
											        </tbody>
								                </table>
											</div>
											<div class="col-xl-5">
												<div class="form-group row">
													<label class="col-lg-4 col-form-label">Order ID</label>
													<div class="col-lg-8">
													    <input type="hidden" class="form-control" name="invid" id="invid" value="<?php echo $row['id']; ?>">
														<input type="text" class="form-control" name="invno" id="invno" value="<?php echo $row['order_id']; ?>" readonly="readonly">
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 col-form-label">Order Date</label>
													<div class="col-lg-8">
													    <div class="cal-icon">
														    <input class="form-control datetimepicker" type="text" name="inv_date" id="inv_date" value="<?php echo date('d-m-Y',strtotime($row['order_date'])); ?>" required>
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
                                                                <input type="text" id="search_email" name="search_email" class="form-control rounded" value="<?php echo $customers_row['email_id']; ?>" placeholder="Search E-mail Address" aria-label="Search" aria-describedby="search-addon" />
                                                                <!--<button type="button" class="btn btn-outline-primary" id="search_customer" name="search_customer"><i class="fas fa-search"></i></button>-->
                                                            </div>
													</div>
												</div>
												
												<div class="form-group row">
												   
												    <div class="col-lg-12">
												     
											     	  <div id="customer-search-edit-link">  
    												     <a href="javascript:void(0)" class="link-primary" onclick="search_email_edit()">
    												        <ins>Edit Customer Details</ins> 
    												     </a><br><br>
    												  </div>  
        												  
        											  <div id="view_cust_details">     
        											 
												        <table>
        											        <tbody>
                												
                												<tr>
                													<td><?php echo $customers_row['first_name'].' '.$customers_row['last_name']; ?></td>
                												</tr>
                												<tr>
                													<td><?php echo $customers_row['address']; ?></td>
                												</tr>
                												<tr>
                													<td><?php echo $customers_row['address2']; ?></td>
                												</tr>
                												<tr>
                													<td><?php echo $customers_row['country'].' '.$customers_row['postal_code']; ?></td>
                												</tr>
                												<tr>
                													<td><?php echo $customers_row['phone']; ?></td>
                												</tr>
                												<tr>
                													<td><?php echo $customers_row['email_id']; ?></td>
                												</tr>
        											        </tbody>
										                </table>
										              </div> 
												    </div>
											    </div>
											</div>
											
											<div class="col-xl-5">
											    <h5 class="card-title">Delivery Details</h5>
											    
												<div class="form-group row">
											        
													<label class="col-lg-4 col-form-label">Delivery Date</label>
													<div class="col-lg-8">
														<input type="text" class="form-control datetimepicker" name="delivery_date" id="delivery_date" value="<?php echo date('d-m-Y',strtotime($row['delivery_date'])); ?>" required>
													</div>
												</div> 
												<div class="form-group row">
													<label class="col-lg-4 col-form-label">Delivery Status</label>
													<div class="col-lg-8">
														<select class="select" name="delivery_status" id="delivery_status" required>
    														<option value="">Select Option</option>
    														<?php
                                                            $delivery_status=mysqli_query($con,"select * from delivery_status where is_active='1'");
                                                            while($delivery_status_row=mysqli_fetch_array($delivery_status))
                                                            { ?>
    														    <option value="<?php echo $delivery_status_row['id']; ?>" <?php if($delivery_status_row['id']==$row['status']){ ?>selected<?php } ?>><?php echo $delivery_status_row['sts_option']; ?></option>
                                                            <?php } ?>
													    </select>
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
												    <?php 
	     	                                            $sql1=mysqli_query($con,"select * from order_items where order_id='".$row['order_id']."' and is_active='1'");
	     	                                            $i=1;
	     	                                            while($row1=mysqli_fetch_array($sql1))
                                            	     	{
                                            	     ?>
													<tr class="single-row">
													    <input type="hidden" name="prd_id[]" id="prd_id_<?php echo $i; ?>" value="<?php echo $row1['id']; ?>">
														<td>
															<input type="text" class="form-control" name="item_name[]" id="item_name" value="<?php echo htmlspecialchars($row1['product_name']); ?>" required>
														</td>
														<td>
															<input type="text" class="form-control" name="quantity[]" id="quantity" value="<?php echo $row1['quantity']; ?>" onkeyup="getInput()" required>
														</td>
														<td>
															<input type="text" class="form-control" name="price[]" id="price" value="<?php echo $row1['unit_price']; ?>" onkeyup="getInput()" required>
														</td>
														<td>
															<input type="text" class="form-control" name="amount" id="amount" value="<?php echo $row1['product_price']; ?>" disabled>
														</td>
														<td></td>
													</tr>
													<?php $i=$i+1; } ?>
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
												        <td style="border: 1px solid #dee2e6;"><div id="sum"><input type="text" name="subtotal" class="form-control" id="total" value="<?php echo $row['subtotal']; ?>" readonly></div></td>
												        <td></td>
												    </tr>
												    
												    <tr>
												        <th colspan="2"></th>
												        <th style="text-align:right;">Shipping Amount </th>
												        <td style="border: 1px solid #dee2e6;"><input type="text" class="form-control shipping_amt" name="shipping_amt" id="shipping_amt" value="<?php echo $row['ship_amount']; ?>"></td>
												    </tr>
												    
												    <tr>
												        <th colspan="2"></th>
												        <th style="text-align:right;">Discount </th>
												        <td style="border: 1px solid #dee2e6;"><input type="text" class="form-control amt_discount" name="amt_discount" id="amt_discount" value="<?php echo $row['discount']; ?>"></td>
												    </tr>
												    
												    <tr>
												        <th colspan="2"></th>
												        <th style="text-align:right;">Total</th>
												        <td style="border: 1px solid #dee2e6;"><input type="text" class="form-control" name="amt_total" id="amt_total" value="<?php echo $row['total_price']; ?>" readonly></td>
												    </tr>
												</tfoot>
											</table>
										</div>
										
									
										<div class="text-right mt-4" style="margin-right: 20px;">
										    <div class="form-group">
											  <button type="submit" name="savetodb" class="btn btn-primary">Update Invoice</button>
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
													            <label>Email Address <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
													            <input type="text" class="form-control" name="rev_email" id="rev_email" >
											                </div>
            												<div class="form-group">
            													<label>First Name <i class="fa fa-star" style="color: red;font-size: 5px";></i></label>
            													<input type="text" class="form-control" name="rev_name" id="rev_name" >
            												</div>
            												<div class="form-group">
            													<label>Address Line1 <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
            													<input type="text" class="form-control" name="add_line1" id="add_line1" >
            												</div>
            												<div class="form-group">
            													<label>Address Line3</label>
            													<input type="text" class="form-control" name="add_line3" id="add_line3">
            												</div>
            												<div class="form-group">
            													<label>Phone No</label>
            													<input type="text" class="form-control" name="rev_phone" id="rev_phone">
            												</div>
											            </div>
            											<div class="col-md-6">
            												<div class="form-group">
            													<label>Business Name</label>
            													<input type="text" class="form-control" name="business_name" id="business_name">
            												</div>
            												<div class="form-group">
            													<label>Last Name</label>
            													<input type="text" class="form-control" name="last_name" id="last_name">
            												</div>
            												<div class="form-group">
            													<label>Address Line2</label>
            													<input type="text" class="form-control" name="add_line2" id="add_line2">
            												</div>
            												<div class="form-group">
            													<label>Postal Zip <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
            													<input type="text" class="form-control" name="rev_pin" id="rev_pin">
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
                        <!--</form>    -->
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
		
		<script>
            $(document).ready(function(){
                $('.delete_img').click(function(){
                    
                    var img_id= $(this).attr('id');
                    $.ajax({  
                        url:"ref_files_delete.php",  
                        method:"POST",  
                        data:{img_id:img_id},  
                        success:function(data)  
                        {  
                         if(data==1){
                            
                            window.location.reload();
                         }
                        }  
                    });  
                }) ;
             });
        </script>
        
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
		
		function search_email_edit()
    	{
    	   
    	   var invno=document.getElementById('invno').value;
    	   
    	    if(invno!=''){
    	       
    	       $.ajax({  
            	    
                url:"edit_customer_details.php",  
                method:"POST",  
                data:{ invno:invno },  
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
        	
        	if( rev_name!='' && add_line1!='' && rev_pin!='' && rev_country!='')
        	{
        	   
                	$.ajax({  
                    url:"edit_customer.php",  
                    method:"POST",  
                    data:{ rev_email:rev_email,rev_name:rev_name,last_name:last_name,add_line1:add_line1,add_line2:add_line2,add_line3:add_line3,rev_phone:rev_phone,rev_pin:rev_pin,rev_country:rev_country,business_name:business_name },  
                    success:function(data)  
                    {  
                      
                      $('#addcustomer').modal('hide');
                      $('#search_email').val(rev_email);
                      $('#view_cust_details').html(data);
                      
                    }  
                }); 
        	    
        	} else {
        	   
        	  alert('Oops! Please fill in all the required fields.');
        	    
        	}
        
    	});   
    	
    	$(document).on("click","#add-information",function() {	 
		    
		    var workorder=$('#workorder').val(); 
		    var quoteref=$('input[name="quoteref"]:checked').val();
		    var hs_code=$('#hs_code').val(); 
		    var transchg=$('input[name="transchg"]:checked').val(); 
		    
		    
		    
        
             $.ajax({  
            	    
                url:"other_details.php",  
                method:"POST",  
                data:{ workorder:workorder,quoteref:quoteref,hs_code:hs_code,transchg:transchg },  
                success:function(data)  
                {  
                    
                  $('#additionalinfo').modal('hide');
                  
                  $('#add-other-links').hide();
                  
                  $('#edit-other-links').show();
                  
                  $('#view_other_information').html(data);
                  
                }  
            }); 
        	
        
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
    	
    	
    	 $(function() {
           
         $("#search_email" ).autocomplete({
           source: 'search.php',
         });
         
      });
    	
		</script>

	</body>
</html>