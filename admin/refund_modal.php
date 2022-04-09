<?php 

include('includes/config.php');

session_start();

if(isset($_POST['refund_id'])) {

$row=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM orders_table where id='".$_POST['refund_id']."' "));

$customers_row=mysqli_fetch_array(mysqli_query($con,"select * from customers where id='".$row['customer_id']."' and is_active='1'"));

            $html='<div class="row">
                    <div class="col-md-12">
			            <div class="card">
				            <div class="card-body">
				                <div class="row">
						            <div class="col-md-6">
						                <div class="form-group">
											<label>Order ID </label>
											<input type="text" class="form-control" name="cus_invno" id="cus_invno" value="'.$row['order_id'].'" readonly>
										</div>
										<div class="form-group">
											<label>Customer E-Mail </label>
											<input type="text" class="form-control" name="cus_email" id="cus_email" value="'.$customers_row['email_id'].'" readonly>
										</div>
						            </div>
									<div class="col-md-6">
									    <div class="form-group">
								            <label>Order Date </label>
								            <input type="text" class="form-control" name="cus_invdate" id="cus_invdate" value="'.date('d-m-Y',strtotime($row['created_at'])).'" readonly>
						                </div>
										<div class="form-group">
											<label>Invoice Amount </label>
											<input type="text" class="form-control" name="cus_invamount" id="cus_invamount" value="'.$row['total_price'].'" readonly>
										</div>
									</div>
									<div class="col-md-12">
									    <div class="row">
									        <div class="col-md-4">
											    <div class="form-group">
													<label>Refund Date <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
			                                          <input class="form-control datetimepicker" type="date" name="ref_date[]" id="ref_date" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Refund Amount <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
													<input type="text" class="form-control" name="ref_amount[]" id="ref_amount" required>
												</div>
											</div>
											<div class="col-md-4">
											    <div class="form-group">
													<label>Remarks <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
													<textarea rows="2" cols="2" class="form-control" name="ref_remarks[]" id="ref_remarks" placeholder="Enter Remarks" required></textarea>
										        </div>
											</div>
										</div>
									</div>
									
							        <div class="col-md-12" id="items"></div>
									   
									<div class="col-lg-12">
									  <div class="form-group">
									       <button id="add" class="btn add add-more button-yellow uppercase" type="button">+ Add another referral</button> 
									       <button class="delete btn button-white uppercase" type="button">- Remove referral</button>
									  </div>   
									</div>
					            </div>
			                </div>
		                </div>
	                </div>
	            </div>';
	            
	   echo $html;         
	            
}

?>