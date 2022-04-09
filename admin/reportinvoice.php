<?php

    include('includes/config.php');
    session_start();
    
    if(isset($_GET['status']))
    {
        $id=$_GET['invno'];
        
        $status=$_GET['status'];
        
        $del=mysqli_query($con,"update orders_table set status='".$status."' where order_id='".$id."'");
        
        if($del)
        {
            echo "<script>alert('Success! Order status updated.');location.href='reportsall.php'</script>";
        }
            
        else {
            
            echo "<script>alert('Opps! Something went wrong.');location.href='reportsall.php'</script>";
        }
    }
    
    if(isset($_POST['shipping_order']))
    {
        $order_id=$_POST['order_id'];
        
        $ship_date=date('Y-m-d',strtotime($_POST['ship_date']));
        
        $del=mysqli_query($con,"update orders_table set status='4',delivered_date='".$ship_date."' where order_id='".$order_id."'");
        
        if($del)
        {
            echo "<script>alert('Success! Order status updated.');location.href='reportsall.php'</script>";
        }
            
        else {
            
            echo "<script>alert('Opps! Something went wrong.');location.href='reportsall.php'</script>";
        }
    }
    
     if(isset($_POST['amount_refund']))
    {
        

        $ref_date=array();
        $ref_amount=array();
        $ref_remarks =array();
        
        $ref_date= $_POST["ref_date"];
        $ref_amount= $_POST["ref_amount"];
        $ref_remarks= $_POST["ref_remarks"];
        
        $invno=mysqli_real_escape_string($con,$_POST['cus_invno']);
        $cus_invamount=mysqli_real_escape_string($con,$_POST['cus_invamount']);
        
            for($i=0;$i<count($ref_date);$i++)
            {
                
                $invoice_details=mysqli_fetch_array(mysqli_query($con,"select * from orders_table where order_id='".$invno."'"));
           
                $ref_date_value = date('Y-m-d',strtotime($ref_date[$i])); 
                $ref_amount_value= mysqli_real_escape_string($con,$ref_amount[$i]);
                $ref_remarks_value =mysqli_real_escape_string($con,$ref_remarks[$i]);
            
                $refund_sql=mysqli_query($con,"INSERT INTO `invrefund_amount` (`user_id`, `refund_date`, `refund_amount`, `refund_remarks`, `create_date`) 
                VALUES ('$invno', '$ref_date_value', '$ref_amount_value', '$ref_remarks_value', CURDATE())");
                
                $refund_total=$invoice_details['total'] - $ref_amount[$i];
                
                $refund_status=mysqli_query($con,"update orders_table set amount_refund='".$refund_total."',status='5' where order_id='".$invno."'");

            }
            
                if($refund_sql)
                {
                    
                    echo "<script>alert('Invoice Refund Amount Added Successfully..!!');location.href='reportsall.php'</script>";
               
                } else {
                  
                    echo "<script>alert('Oops! Something went Wrong.');location.href='reportsall.php'</script>";
                }
       
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Blend Ur Spice - Invoice Report</title>
		
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
	<body >
	
		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
			    <?php include('includes/header.php'); ?>
			<!-- /Header -->
			
			<!-- Page Wrapper -->
			<?php 
            if(isset($_GET['invno']))
            {
            ?>
			<div class="page-wrapper">
				<div class="content container-fluid">
				    <?php 
                        $id=$_GET['invno'];
                        $sql=mysqli_query($con,"select * from orders_table where order_id='".$id."'");
                        $row=mysqli_fetch_array($sql);
                       
                        $customers_row=mysqli_fetch_array(mysqli_query($con,"select * from customers where id='".$row['customer_id']."' and is_active='1'"));
                        
                        $delivery_status_row=mysqli_fetch_array(mysqli_query($con,"select * from delivery_status where id='".$row['status']."' and is_active='1'"));
                                                
                    ?>
					<div class="row">
						<div class="col-xl-12">
							<div class="card">
								<div class="card-body">
									<div class="invoice-item">
										<div class="row">
											<div class="col-md-8">
												<div class="invoice-logo">
													<img src="images/logo.png" alt="logo">
												</div>
											</div>
											<div class="col-md-4">
												<table align="">
												    <tr>
												        <td><strong>Order ID</strong></td>
												        <td>:</td>
												        <td>&nbsp;<?php echo $row['order_id'];?></td>
												    </tr>
												    <tr>
												        <td><strong>Order Date</strong></td>
												        <td>:</td>
												        <td>&nbsp;<?php echo date('d-m-Y',strtotime($row['created_at']));?></td>
												    </tr>
												</table>
											</div>
										</div>
									</div>
									<br>
									<div class="invoice-item">
									    <div class="row">
									        <div class="col-md-4">
												<div class="invoice-info">
												    <?php 
    											        $sender_details=mysqli_query($con,"select * from sender_details where id='1' and is_active='1'");
    											        $row_sender=mysqli_fetch_array($sender_details);
											        ?>
												    <strong class="customer-text"><u>Sold By</u></strong>
													<p><?php echo $row_sender['name'];?></p>
													<p><?php echo $row_sender['address'];?></p>
													<p><?php echo $row_sender['address2'];?></p>
													<p><?php echo $row_sender['address3'];?></p>
													<p><?php echo $row_sender['pincode'];?></p>
													<p><?php echo $row_sender['country'];?></p>
													<p><?php echo $row_sender['email'];?></p>
													<p><?php echo $row_sender['phone'];?></p>
												</div>
											</div>
											<div class="col-md-4">
												<div class="invoice-info">
													<strong class="customer-text"><u>Shipping To</u></strong>
													<p><?php echo $customers_row['first_name'].' '.$customers_row['last_name'];?></p>
													<p><?php echo $customers_row['address'];?></p>
													<p><?php echo $customers_row['address2'];?></p>
													<p><?php echo $customers_row['postal_code'];?></p>
													<p><?php echo $customers_row['country'];?></p>
													<p><?php echo $customers_row['email_id'];?></p>
													<p><?php echo $customers_row['phone'];?></p>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="invoice-info">
													<strong class="customer-text"><u>Delivery Details</u></strong>
													<p><b>Delivery Date</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $row['delivered_date'] ? date('d-m-Y',strtotime($row['delivered_date'])) : "-" ;?></p>
												    <p><b>Status</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $delivery_status_row['sts_option'];?></p><br>
											        <p style="color:#999;font-size: 14px;">( <?php echo $delivery_status_row['sts_desc'];?> )</p>    
												</div>
											</div>
											
									    </div>
									</div>
									
									<!-- Invoice Item -->
									<div class="invoice-item invoice-table-wrap">
										<div class="row">
											<div class="col-md-12">
												<div class="table-responsive">
													<table class="invoice-table table table-bordered" style="width:100%;">
														<thead>
															<tr>
															    <th style="width:10%;">S.No</th>
																<th style="width:55%;">Item Name</th>
																<th style="width:10%;">Quantity</th>
																<th style="width:10%;">Price</th>
																<th style="width:15%;">Amount</th>
															</tr>
														</thead>
														<tbody>
														    <?php 
                                                                $sql2=mysqli_query($con,"select * from order_product where order_g_id='".$id."'");
                                                                $i=1;
                                                                $grand_tot='0';
                                                                while($row2=mysqli_fetch_array($sql2))
                                                                {
																	if($row2['product_id'])
																	{
																		$order_items = mysqli_query($con,"select * from our_products where id='".$row2['product_id']."' and is_active='1'");
                            											$order_item_product = mysqli_fetch_array($order_items);
																		
																		$item=$order_item_product['product_name'];
																		$quantity=$row2['product_quantity'];
																		$prize=$row2['product_price'];
																		$total1=$row2['product_total'];
																		$grand_tot=$grand_tot+$total1;

																	} else {
																		$order_items = mysqli_query($con,"select * from reacipies where id='".$row2['reacipie_id']."' ");
                            											$order_item_product = mysqli_fetch_array($order_items);
																		
																		$recID = $order_item_product['id']; 
																		$item=$order_item_product['recipe_name'];
																		$quantity=$row2['product_quantity'];
																		$prize=$row2['product_price'];
																		$total1=$row2['product_total'];
																		$grand_tot=$grand_tot+$total1;
																	}
                                                               
                                                            ?>
															<tr>
															    <td style="width:10%;"><?php echo $i; ?></td>
																<?php 
																	if($row2['product_id'])
																	{
																		?>
																			<td style="width:55%;"><?php echo $item; ?></td>
																		<?php
																	} else {
																		?>
																		
																			<td style="width:55%;">
																			<a href="javascript:void(0)" onclick="order_items_reacipi('<?php echo $recID; ?>')" >
																				<?php echo $item; ?>
																			</a>
																			</td>
																		<?php
																	}
																?>
																<td style="width:10%;"><?php echo $quantity; ?></td>
																<td style="width:10%;">£<?php echo number_format($prize,2); ?></td>
																<td style="width:15%;">£<?php echo number_format($total1,2); ?></td>
															</tr>
															<?php $i=$i+1;  } ?>
														</tbody>
														<tfoot>
														    <tr>
														        <th colspan="3"></th>
														        <th>Sub Total (GBP)</th>
														        <th>£<?php echo number_format($grand_tot,2); ?></th>
														    </tr>
														     <tr>
														        <th colspan="3"></th>
														        <th>Discount</th>
														        <th>£<?php echo number_format($row['discount'],2); ?></th>
														    </tr>
														     <tr>
														        <th colspan="3"></th>
														        <th>Vat (20%)</th>
														        <th>£<?php echo number_format($row['vat_amt'],2); ?></th>
														    </tr>
														    <tr>
														        <th colspan="3"></th>
														        <th>Shipping Amount (GBP)</th>
														        <th>£<?php echo number_format($row['ship_amount'],2); ?></th>
														    </tr>
														    <tr>
														        <th colspan="3"></th>
														        <th>Total (GBP)</th>
														        <th>£<?php echo number_format($row['total_price'],2); ?></th>
														    </tr>
														</tfoot>
													</table>
												</div>
											</div>
										</div>
									</div>
									<!-- /Invoice Item -->
									<br/>
									
									<!-- Invoice Refund --><br/>
									<?php if($row['status']=='5') { ?>
									
    									<div class="col-lg-12">
    									    <div class="card">
        										<div class="card-header">
        											<h5 class="card-title">Amount Refund Details</h5>
        										</div>
        										<div class="card-body">
        											<ul class="activity-feed">
        											    <?php 
                                                            $inv_refund=mysqli_query($con,"select * from invrefund_amount where user_id='".$id."' and user_id!='' and is_active='1'");
                                                            while($row_refund=mysqli_fetch_array($inv_refund))
                                                            {
                                                        ?> 
        												<li class="feed-item">
        													<div class="feed-date"><?php echo date('d-m-Y',strtotime($row_refund['refund_date'])); ?></div>
        													<span class="feed-text">$<?php echo $row_refund['refund_amount']; ?></span><br/>
        													<span class="feed-text"><?php echo $row_refund['refund_remarks']; ?></span>
        												</li>
        												<?php
                                                            }
                                                        ?>
        											</ul>
        										</div>
    									    </div>
    								    </div>
								    
								    <?php } ?>
								    <!-- /Invoice Refund -->
								    <br>
									<!-- /Invoice Item -->
									<div class="invoice-item">
									    
									    <!-- Accept Order -->
										<div class="row">
										   
										   <?php if($row['status']!='4') { ?> 
										    
									        <div class="col-lg-2">
									            <a class="btn btn-sm btn-info mr-2" href="reportinvoice.php?invno=<?php echo $row['order_id']; ?>&status=2" onclick="return confirm('Are you sure you want to accept this order?');">
												<i class="fas fa-check mr-1"></i> Accept Order
											    </a>  
										    </div>
										    
										    <?php } ?>
										    
										    <!-- Cancel Order -->
										    <div class="col-lg-2">
									            <a class="btn btn-sm btn-danger mr-2" href="reportinvoice.php?invno=<?php echo $row['order_id']; ?>&status=3" onclick="return confirm('Are you sure you want to cancel this order?');">
												<i class="fas fa-times mr-1"></i> Cancel Order
											    </a>  
										    </div>
										    
										    <!-- Refund Order -->
										    
										    <?php if($row['status']!='3') { ?>
										    
										    <div class="col-lg-2">
									            <a class="btn btn-sm btn-warning mr-2" href="javascript:void(0)" onclick="return confirm('If you want to refund the order. Please make it first to cancel the order.');" >
												<i class="fas fa-credit-card mr-1"></i> Send Refund
											    </a>  
										    </div>
										    
										    <?php } else { ?>
										    
										    <?php if($row['status']!='4') { ?> 
										    
    										    <div class="col-lg-2">
    									            <a class="btn btn-sm btn-warning mr-2" href="javascript:void(0)" onclick="select_refund_modal(<?php echo $row['id']; ?>)">
    												<i class="fas fa-credit-card mr-1"></i> Send Refund
    											    </a>  
    										    </div>
										    
										    <?php  } } ?>
										    
										    <!-- Finish Order -->
										    
										    <?php if($row['status']!='2') { ?>
										    
										     <?php if($row['status']!='4') { ?> 
    										    <div class="col-lg-2">
    									            <a class="btn btn-sm btn-primary mr-2" href="javascript:void(0)" onclick="return confirm('If you want to Finish the order. Please make it first to Accept the order.');">
    												<i class="fas fa-archive mr-1"></i> Finish Order
    											    </a>  
    										    </div>
										    
										    <?php } } else { ?>
										    
										    <?php if($row['status']!='4') { ?> 
										    
    										    <div class="col-lg-2">
    									            <a class="btn btn-sm btn-primary mr-2" href="reportinvoice.php?invno=<?php echo $row['order_id']; ?>&status=6" onclick="return confirm('Are you sure you want to finish this order?');">
    												<i class="fas fa-archive mr-1"></i> Finish Order
    											    </a>  
    										    </div>
										    
										    <?php } } ?>
										    
										    <!-- Ship Order -->
										    
										    <?php if($row['status']!='6') { ?>
										    
										    <?php if($row['status']!='4') { ?> 
										    
    										    <div class="col-lg-2">
    									            <a class="btn btn-sm btn-success mr-2" href="javascript:void(0)" onclick="return confirm('If you want to Ship the order. Please make it first to Finish the order.');">
    												<i class="fas fa-truck mr-1"></i> Ship Order
    											    </a>  
    										    </div>
										    
										    <?php } } else { ?>
										    
										    <?php if($row['status']!='4') { ?> 
										    
    										    <div class="col-lg-2">
    									            <a class="btn btn-sm btn-success mr-2" href="javascript:void(0)" data-toggle="modal" data-target="#order_shipment">
    												<i class="fas fa-truck mr-1"></i> Ship Order
    											    </a>  
    										    </div>
										    
										    <?php } } ?>
										    
										    <!-- Print Order -->
										     <div class="col-lg-2">
									            <a class="btn btn-sm btn-white mr-2" href="invoice_viewpdf.php?invno=<?php echo $row['order_id']?>" target="_blank">
												<i class="fas fa-print mr-1"></i> Print
											    </a>  
										    </div>
										</div>
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
		
		<div class="modal fade bd-example-modal-lg" id="amountrefund" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Amount Refund</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" >
                        <div class="modal-body" id="view_refund_modal"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="amount_refund" class="btn btn-primary">Save</button>
                        </div>
                  </form>    
                </div>
            </div>
        </div>
        
        
        <div class="modal fade bd-example-modal-lg" id="order_shipment" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ship Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" >
                        <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <label>Order ID</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="order_id" value="<?php echo $row['order_id']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Date of Shipping</label>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="ship_date" id="ship_date" required>
                                </div>
                            </div>
                        </div>    
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="shipping_order" class="btn btn-primary">Update</button>
                        </div>
                  </form>    
                </div>
            </div>
        </div>
		
		<div class="modal fade bd-example-modal-lg" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document" style="max-width: 800px;">
                <div class="modal-content">
                  <div class="modal-header border-bottom-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-title text-center">
                      <h4>Order Details</h4>
                    </div>
                   <div class="row">
                       <div class="col-md-12" id="order_details_item">
                           
                       </div>
                   </div>
                </div>
                
              </div>
             </div>
        </div>
		
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
		
		<script>
		
            $(document).ready(function() {
                
              $(".delete").hide();
              
            }); 
            
          	$(document).on("click",".add",function() {	   
                  
                $(".delete").fadeIn("1500");
                //Append a new row of code to the "#items" div
                $("#items").append(
                  '<div class="next-referral"><div class="row"><div class="col-md-4"><div class="form-group"><label>Refund Date <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label><input name="ref_date[]" id="ref_date" type="date" class="form-control datetimepicker"></div></div><div class="col-md-4"><div class="form-group"><label>Refund Amount <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label><input name="ref_amount[]" id="ref_amount" type="text" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label>Remarks <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label><textarea rows="2" cols="2" class="form-control" name="ref_remarks[]" id="ref_remarks" placeholder="Enter Remarks" required></textarea></div></div></div></div>'
                );    

          	});
          	
          	$(document).on("click",".delete",function() {	
          	    
          	      $(".next-referral").last().remove();
          	    
          	});
            
            function select_refund_modal(val)
        	{
        	   
        	    if(val!=''){
        	       
        	       $.ajax({  
                	    
                    url:"refund_modal.php",  
                    method:"POST",  
                    data:{ refund_id:val },  
                    success:function(data)  
                    { 
                        
                        $('#view_refund_modal').html(data);
                        
                        $('#amountrefund').modal('show');
                      
                    }  
                }); 
        	       
        	   } else {
        	       
        	       $('#view_refund_modal').html('');
        	       
        	   } 
        	   
        	    
        	}

			function order_items_reacipi(id){
        	  
			  $.ajax({
			  url : "ajax_order_details.php",
			  data : {id:id },
			  type : 'post',
			  success : function(response) {
					  
			   $('#order_details_item').html(response);
			   
			   $('#order_details').modal('show');
			  
			  }
			  
			});    
			  
		  }
            
		</script>

	</body>
</html>