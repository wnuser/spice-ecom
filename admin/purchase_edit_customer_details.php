<?php 

include('includes/config.php');

    session_start();

    if(isset($_POST['email_id'])){
        
       $email_id=$_POST['email_id'];  
     
       $num_rows=mysqli_num_rows(mysqli_query($con,"SELECT * FROM invoiceinfo_clb where com_name='".$email_id."' and is_active='1'"));
            											            
       if($num_rows > 0) {
           
       $customer_rows=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM invoiceinfo_clb where com_name='".$email_id."' and is_active='1'"));
       
       $html='
       
       <div class="modal-dialog" role="document" style="max-width: 600px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Company Information</h5>
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
													            <input type="text" class="form-control" name="com_name" id="com_name" value="'.$customer_rows['com_name'].'">
											                </div>
            												<div class="form-group">
            													<label>Address Line1</label>
            													<input type="text" class="form-control" name="add_line1" id="add_line1" value="'.$customer_rows['com_address'].'">
            												</div>
            												<div class="form-group">
            													<label>Address Line3</label>
            													<input type="text" class="form-control" name="add_line3" id="add_line3" value="'.$customer_rows['com_address3'].'">
            												</div>
            												<div class="form-group">
            													<label>Phone No</label>
            													<input type="text" class="form-control" name="com_phone" id="com_phone" value="'.$customer_rows['com_phone'].'">
            												</div>
											            </div>
            											<div class="col-md-6">
            												<div class="form-group">
            													<label>Email Address </label>
            													<input type="text" class="form-control" name="com_email" id="com_email" value="'.$customer_rows['com_email'].'">
            												</div>
            												<div class="form-group">
            													<label>Address Line2</label>
            													<input type="text" class="form-control" name="add_line2" id="add_line2" value="'.$customer_rows['com_address2'].'">
            												</div>
            												<div class="form-group">
            													<label>Postal Zip </label>
            													<input type="text" class="form-control" name="com_pin" id="com_pin" value="'.$customer_rows['com_pin'].'">
            												</div>
            												<div class="form-group">
            													<label>Country </label>
            													<input type="text" class="form-control" name="com_country" id="com_country" value="'.$customer_rows['com_country'].'">
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
        
    
       $purno=$_POST['invno'];  
     
       $num_rows=mysqli_num_rows(mysqli_query($con,"SELECT * FROM invoiceinfo_clb where inv_id='".$purno."' and is_active='1'"));
            											            
       if($num_rows > 0) {
           
       $customer_rows=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM invoiceinfo_clb where inv_id='".$purno."' and is_active='1'"));
       
       $html='
       
       <div class="modal-dialog" role="document" style="max-width: 600px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Company Information</h5>
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
													            <input type="text" class="form-control" name="com_name" id="com_name" value="'.$customer_rows['com_name'].'">
											                </div>
            												<div class="form-group">
            													<label>Address Line1 </label>
            													<input type="text" class="form-control" name="add_line1" id="add_line1" value="'.$customer_rows['com_address'].'">
            												</div>
            												<div class="form-group">
            													<label>Address Line3</label>
            													<input type="text" class="form-control" name="add_line3" id="add_line3" value="'.$customer_rows['com_address3'].'">
            												</div>
            												<div class="form-group">
            													<label>Phone No</label>
            													<input type="text" class="form-control" name="com_phone" id="com_phone" value="'.$customer_rows['com_phone'].'">
            												</div>
											            </div>
            											<div class="col-md-6">
            												<div class="form-group">
            													<label>Email Address </label>
            													<input type="text" class="form-control" name="com_email" id="com_email" value="'.$customer_rows['com_email'].'" disabled>
            												</div>
            												<div class="form-group">
            													<label>Address Line2</label>
            													<input type="text" class="form-control" name="add_line2" id="add_line2" value="'.$customer_rows['com_address2'].'">
            												</div>
            												<div class="form-group">
            													<label>Postal Zip </label>
            													<input type="text" class="form-control" name="com_pin" id="com_pin" value="'.$customer_rows['com_pin'].'">
            												</div>
            												<div class="form-group">
            													<label>Country </label>
            													<input type="text" class="form-control" name="com_country" id="com_country" value="'.$customer_rows['com_country'].'">
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