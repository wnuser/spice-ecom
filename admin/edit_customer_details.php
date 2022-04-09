<?php 

include('includes/config.php');

    session_start();

    if(isset($_POST['email_id'])){
        
       $email_id=$_POST['email_id'];  
     
       $num_rows=mysqli_num_rows(mysqli_query($con,"SELECT * FROM orders where email_id='".$email_id."' and is_active='1'"));
            											            
       if($num_rows > 0) {
           
       $customer_id=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM orders where email_id='".$email_id."' and is_active='1'"));
       
       $customer_rows=mysqli_fetch_array(mysqli_query($con,"select * from customers where id='".$customer_id['customer_id']."' and is_active='1'"));
       
       $html='
       
       <div class="modal-dialog" role="document" style="max-width: 600px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Customer Information</h5>
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
            													<input type="text" class="form-control" name="rev_name" id="rev_name" value="'.$customer_rows['first_name'].'">
            												</div>
											                <div class="form-group">
													            <label>Email Address <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
													            <input type="text" class="form-control" name="rev_email" id="rev_email" value="'.$customer_rows['email_id'].'" disabled>
											                </div>
            												<div class="form-group">
            													<label>Address Line1 <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
            													<input type="text" class="form-control" name="add_line1" id="add_line1" value="'.$customer_rows['address'].'">
            												</div>
            												<div class="form-group">
            													<label>Postal Zip <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
            													<input type="text" class="form-control" name="rev_pin" id="rev_pin" value="'.$customer_rows['postal_code'].'">
            												</div>
											            </div>
            											<div class="col-md-6">
            												<div class="form-group">
            													<label>Last Name</label>
            													<input type="text" class="form-control" name="last_name" id="last_name" value="'.$customer_rows['last_name'].'">
            												</div>
            												
            												<div class="form-group">
            													<label>Phone No</label>
            													<input type="text" class="form-control" name="rev_phone" id="rev_phone" value="'.$customer_rows['phone'].'">
            												</div>
            												
            												<div class="form-group">
            													<label>Address Line2</label>
            													<input type="text" class="form-control" name="add_line2" id="add_line2" value="'.$customer_rows['address2'].'">
            												</div>
            												<div class="form-group">
            													<label>Country <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
            													<input type="text" class="form-control" name="rev_country" id="rev_country" value="'.$customer_rows['country'].'">
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
                                <input type="submit" id="edit-customer" name="edit-customer" class="btn btn-primary" value="Edit">
                            </div>
                       </div>
                    </div>';
        
                echo $html; 
        
       
       }
        
    } else if(isset($_POST['invno'])) {
        
    
       $invno=$_POST['invno'];  
     
       $num_rows=mysqli_num_rows(mysqli_query($con,"SELECT * FROM orders where order_id='".$invno."' and is_active='1'"));
            											            
       if($num_rows > 0) {
           
       $customer_id=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM orders where order_id='".$invno."' and is_active='1'"));
       
       $customer_rows=mysqli_fetch_array(mysqli_query($con,"select * from customers where id='".$customer_id['customer_id']."' and is_active='1'"));
       
       $html='
       
       <div class="modal-dialog" role="document" style="max-width: 600px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Customer Information</h5>
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
            													<input type="text" class="form-control" name="rev_name" id="rev_name" value="'.$customer_rows['first_name'].'">
            												</div>
											            
											                <div class="form-group">
													            <label>Email Address <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
													            <input type="text" class="form-control" name="rev_email" id="rev_email" value="'.$customer_rows['email_id'].'" disabled>
											                </div>
            											
            												<div class="form-group">
            													<label>Address Line1 <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
            													<input type="text" class="form-control" name="add_line1" id="add_line1" value="'.$customer_rows['address'].'">
            												</div>
            												
            												<div class="form-group">
            													<label>Postal Zip <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
            													<input type="text" class="form-control" name="rev_pin" id="rev_pin" value="'.$customer_rows['postal_code'].'">
            												</div>
            											
											            </div>
            											<div class="col-md-6">
            												
            												<div class="form-group">
            													<label>Last Name</label>
            													<input type="text" class="form-control" name="last_name" id="last_name" value="'.$customer_rows['last_name'].'">
            												</div>
            												
            												<div class="form-group">
            													<label>Phone No</label>
            													<input type="text" class="form-control" name="rev_phone" id="rev_phone" value="'.$customer_rows['phone'].'">
            												</div>
            												
            												<div class="form-group">
            													<label>Address Line2</label>
            													<input type="text" class="form-control" name="add_line2" id="add_line2" value="'.$customer_rows['address2'].'">
            												</div>
            												
            												<div class="form-group">
            													<label>Country <i class="fa fa-star" style="color: red;font-size: 5px"; ></i></label>
            													<input type="text" class="form-control" name="rev_country" id="rev_country" value="'.$customer_rows['country'].'">
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
                                <input type="submit" id="edit-customer" name="edit-customer" class="btn btn-primary" value="Edit">
                            </div>
                       </div>
                    </div>';
        
                echo $html; 
        
       
       }    
        
        
    }

?>