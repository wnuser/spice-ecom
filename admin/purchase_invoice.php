<?php

include('includes/config.php');

session_start();

$_SESSION['add_customer']=array();
    
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Eternal Seasoning - Purchase Invoice</title>
		
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
									<li class="breadcrumb-item"><a href="#">Purchase Invoices</a></li>
									<li class="breadcrumb-item active">Create Invoice</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="row">
						<div class="col-md-12">
							<div class="card">
							    <form method="post" action="purchase_form_process.php" id="invoice_insert" enctype="multipart/form-data" autocomplete="off"> 
								<div class="card-body">
									<div class="row">
									    <div class="col-xl-7">
									        <!--<img src="images/logo.png" alt="Logo"><br/><br/>-->
										    <!--<span style="font-weight:bold;">Reg.No: 200508936C</span><br/><br/>-->
											<h5 class="card-title">Purchase From</h5>
											<div class="form-group row">
												<div class="col-lg-12">
													<div class="input-group" style="width: 70%;">
                                                        <input type="text" name="search_email" id="search_email" class="form-control rounded" value="<?php echo $_SESSION['add_customer'][0]['com_email']; ?>" placeholder="Search Company Name" aria-label="Search" aria-describedby="search-addon" required>
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
                    													<td><?php echo $_SESSION['add_customer'][0]['com_name']; ?></td>
                    												</tr>
                    												<tr>
                    													<td><?php echo $_SESSION['add_customer'][0]['add_line1']; ?></td>
                    												</tr>
                    												<tr>
                    													<td><?php echo $_SESSION['add_customer'][0]['add_line2']; ?></td>
                    												</tr>
                    												<tr>
                    													<td><?php echo $_SESSION['add_customer'][0]['add_line3']; ?></td>
                    												</tr>
                    												<tr>
                    													<td><?php echo $_SESSION['add_customer'][0]['com_country'].' '.$_SESSION['add_customer'][0]['com_pin']; ?></td>
                    												</tr>
                												    <tr>
                													    <td><?php echo $_SESSION['add_customer'][0]['com_phone']; ?></td>
                											    	</tr>
                    												<tr>
                    													<td><?php echo $_SESSION['add_customer'][0]['com_email']; ?></td>
                    												</tr>
        											            </tbody>
										                    </table>
										                <?php } ?>
							                        </div>
											    </div>
										    </div>
										</div>
										<div class="col-xl-5">
										    <?php 
    										    $sql=mysqli_query($con,"select * from generate_id where id='2' and is_active='1'");
    										    while($row=mysqli_fetch_array($sql))
    										    { 
    										        $pur_id=$row["pref_name"].''.$row["inc_num"];
										    ?>
											<div class="form-group row">
												<label class="col-lg-4 col-form-label">Purchase ID</label>
												<div class="col-lg-8">
													<input type="text" class="form-control" name="purno" value="<?php echo $pur_id; ?>" readonly="readonly">
												</div>
											</div>
											<?php }?>
											<div class="form-group row">
												<label class="col-lg-4 col-form-label">Purchase Date</label>
												<div class="col-lg-8">
												    <div class="cal-icon">
													    <input class="form-control datetimepicker" type="text" name="pur_date" id="pur_date" value="<?php echo date("d-m-Y"); ?>" required>
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
												<th></th>
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
												 <select class="form-control" name="qty_type[]" id="qty_type">
												     <option value="KG">KG</option>
												     <option value="Gram">Gram</option>
												 </select>
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
											    <td colspan="6">
													<button type="button" class="btn btn-primary" id="add-row"><i class="fas fa-plus-circle"></i ></button>
												</td>
										    </tr>
										</tbody>
										<tfoot>
    									    <tr>
    									        <th colspan="3"></th>
    									        <th style="text-align:right;">Sub Total</th>
    									        <td style="border: 1px solid #dee2e6;"><div id="sum"><input type="text" placeholder="0.00" name="subtotal" class="form-control" id="total" readonly></div></td>
    									        <td></td>
    									    </tr>
										   <tr>
										        <th colspan="2"></th>
										        <th>
										            <label>VAT Include</label>&nbsp;
										            <input type="radio" name="vat_include" id="vat_include" onclick="getInput()" value="1">&nbsp;Yes&nbsp;
										            <input type="radio" name="vat_include" id="vat_include" onclick="getInput()" value="0" checked>&nbsp;No
										         </th>
										        <th style="text-align:right;">VAT 20% </th>
										        <td style="border: 1px solid #dee2e6;"><input type="text" class="form-control amt_vat" name="amt_vat" id="amt_vat"></td>
										    </tr>
										    
										    <tr>
										        <th colspan="3"></th>
										        <th style="text-align:right;">Shipping Cost</th>
										        <td style="border: 1px solid #dee2e6;"><input type="text" placeholder="0.00" class="form-control" name="ship_cost" id="ship_cost" onchange="getInput()"></td>
										    </tr>
										    
										    <tr>
										        <th colspan="3"></th>
										        <th style="text-align:right;">Total</th>
										        <td style="border: 1px solid #dee2e6;"><input type="text" placeholder="0.00" class="form-control" name="amt_total" id="amt_total" readonly></td>
										    </tr>
										</tfoot>
									</table>
								</div>
								<div class="col-md-12">
				                    <div class="card">
					                    <div class="card-body">
								            <div class="row">
    										    <div class="col-xl-6">
    											</div>
    											<div class="col-xl-6">
    											   
										            <div class="form-group row">
            											<label class="col-lg-5 col-form-label">Payment Mode</label>
            											<div class="col-lg-7">
                											<select class="select" name="payment_mode" id="payment_mode">
                												<option value="">Select Payment Type</option>
                												<option value="Cash">Cash</option>
                												<option value="Credit">Credit</option>
                											</select>
                										</div>
						                            </div>
						                            
						                           <div class="form-group row">
        												<label class="col-lg-5 col-form-label">Credit Due Date</label>
        												<div class="col-lg-7">
        												    <div class="cal-icon">
        													    <input class="form-control datetimepicker" type="text" name="due_date" id="due_date" value="<?php echo date("d-m-Y"); ?>" required>
        													</div>
        												</div>
        											</div>
						                            
    											</div>
									        </div>
							            </div>
							        </div>
								</div>
								<div class="text-right mt-4">
									<button type="submit" name="savetodb" class="btn btn-primary">Add Invoice</button>
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
                            <h5 class="modal-title" id="exampleModalLabel">Purchase Company Information</h5>
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
    													<label>Company Name <i class="fa fa-star" style="color: red;font-size: 5px";></i></label>
    													<input type="text" class="form-control" name="com_name" id="com_name">
    												</div>
    												<div class="form-group">
    													<label>Address Line1 </label>
    													<input type="text" class="form-control" name="add_line1" id="add_line1">
    												</div>
    												<div class="form-group">
    													<label>Address Line3 </label>
    													<input type="text" class="form-control" name="add_line3" id="add_line3">
    												</div>
    												<div class="form-group">
    													<label>Phone No</label>
    													<input type="text" class="form-control" name="com_phone" id="com_phone">
    												</div>
            						            </div>
        										<div class="col-md-6">
    												<div class="form-group">
    										            <label>Email Address </label>
    										            <input type="text" class="form-control" name="com_email" id="com_email">
    								                </div>
    												<div class="form-group">
    													<label>Address Line2</label>
    													<input type="text" class="form-control" name="add_line2" id="add_line2">
    												</div>
    												<div class="form-group">
    													<label>Postal Zip </label>
    													<input type="text" class="form-control" name="com_pin" id="com_pin">
    												</div>
    												<div class="form-group">
    													<label>Country </label>
    													<input type="text" class="form-control" name="com_country" id="com_country">
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
            					 <td>
								 <select class="form-control" name="qty_type[]" id="qty_type">
								     <option value="KG">KG</option>
								     <option value="Gram">Gram</option>
								 </select>
								 </td>
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
                var amt_vat=0;
                
                for(var i = 0; i < arr.length; i++) {
                    if(arr[i].value) {
                        total += +arr[i].value;
                    }
                    
                    document.getElementById("total").value = total;
                    
                    var vat_checked= $("input[type='radio'][name='vat_include']:checked").val();
                    
                    if(vat_checked=='1')
                    {
                        
                       amt_vat = ((parseFloat(total) * 20 ) / 100);
                        
                    }
                      
                    document.getElementById("amt_vat").value = amt_vat;
                        
                    var amt_total = total + amt_vat;
                    
                    document.getElementById("amt_total").value = amt_total;
                    
                    var ship_cost=document.getElementById("ship_cost").value;
                    
                    if(ship_cost > 0) {
                        
                      var amt_cal = parseFloat(amt_total) + parseFloat(ship_cost);
                      
                      document.getElementById("amt_total").value = amt_cal;
                        
                    } else {
                        
                       document.getElementById("amt_total").value = amt_total;
                        
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
		
		$(document).on("change","#search_email",function() {	 
		    
		    var srch_email=$('#search_email').val(); 
        	
        	if(srch_email!='')
        	{
        	   
                	$.ajax({  
                    url:"purchase_search_email.php",  
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
                      
                      alert('This company name not found.'); 
                      
                      $('#search_email').val('')
                      $('#view_cust_details').html(''); 
                       
                      $('#customer-add-link').show();
                      $('#customer-edit-link').hide();
                      $('#customer-search-edit-link').hide(); 
                          
                      }
                      
                    }  
                }); 
        	    
        	} else {
        	   
        	  alert('Oops! Please enter the company name.');
        	    
        	}
        
    	});
    	
    	$(document).on("click","#add-customer",function() {	 
		    
		    var com_name=$('#com_name').val();
		    var com_email=$('#com_email').val();
		    var add_line1=$('#add_line1').val(); 
		    var add_line2=$('#add_line2').val(); 
		    var add_line3=$('#add_line3').val(); 
		    var com_phone=$('#com_phone').val(); 
		    var com_pin=$('#com_pin').val(); 
		    var com_country=$('#com_country').val();
        	
        	if(com_name!='')
        	{
        	   
                	$.ajax({  
                    url:"purchase_add_customer.php",  
                    method:"POST",  
                    data:{ com_email:com_email,com_name:com_name,add_line1:add_line1,add_line2:add_line2,add_line3:add_line3,com_phone:com_phone,com_pin:com_pin,com_country:com_country },  
                    success:function(data)  
                    {  
                        
                      $('#addcustomer').modal('hide');
                      $('#search_email').val(com_name);
                      
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
    	
    	
    	$(document).on("click","#edit-customer",function() {
    	    
		    var com_name=$('#com_name').val();
		    var com_email=$('#com_email').val();
		    var add_line1=$('#add_line1').val(); 
		    var add_line2=$('#add_line2').val(); 
		    var add_line3=$('#add_line3').val(); 
		    var com_phone=$('#com_phone').val(); 
		    var com_pin=$('#com_pin').val(); 
		    var com_country=$('#com_country').val();
		     
        	
        	if(com_name!='')
        	{
        	   
                	$.ajax({  
                    url:"purchase_edit_customer.php",  
                    method:"POST",  
                    data:{ com_email:com_email,com_name:com_name,add_line1:add_line1,add_line2:add_line2,add_line3:add_line3,com_phone:com_phone,com_pin:com_pin,com_country:com_country },  
                    success:function(data)  
                    {  
                      
                      $('#addcustomer').modal('hide');
                      $('#search_email').val(com_name);
                      
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
    	
    	$(document).on("change",".amt_gst",function() {
    	    
    	var amt_total=0;   
        
        amt_gst=$('#amt_gst').val();
        
        subtot=$('#total').val(); 
        
        if(amt_gst > 0)
        {
        
            if(subtot > 0)
            {
            
                 if(parseFloat(subtot) < parseFloat(amt_gst))
                  {
                      
                      alert('Please enter a valid amount!'); 
                      
                      $('#amt_gst').val('0.00');
                      $('#amt_total').val(subtot);
                        
                  } else {
                      
                      amt_cal = (parseFloat(subtot) + (parseFloat(subtot) * (parseFloat(amt_gst) / 100)));
                     
                      $('#amt_total').val(amt_cal.toFixed(2));
                  }
              
            } else {
                
               $('#amt_gst').val('0.00');
               $('#amt_total').val('0.00');
                
            }  
          
          
        } else {
            
           $('#amt_total').val(subtot);    
            
        }
        
    	});
    	
    	function email_search_edit()
    	{
    	   
    	   var email_id=document.getElementById('search_email').value;
    	   
    	    if(email_id!=''){
    	       
    	       $.ajax({  
            	    
                url:"purchase_edit_customer_details.php",  
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
    	
        $(function() {
           
            $("#search_email" ).autocomplete({
                source: 'purchase_search.php',
            });
         
        });
	    </script>
	</body>
</html>