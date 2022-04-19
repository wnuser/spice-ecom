<?php
    include('includes/config.php');
    session_start();
    
    if(isset($_POST['ing_id'])) {
        
    $output='';
    
    
    
    $ingredients_details=mysqli_fetch_array(mysqli_query($con,"select * from spices_list where id='".$_POST['ing_id']."' and is_active='1'"));       
    
    $output.='<form method="post" autocomplete="off" enctype="multipart/form-data">
    		    
    			<div class="form-group">
    				<label>Spices Name <span class="text-danger">*</span></label>
					<input type="hidden" name="rec_id" id="rec_id" value="'.$ingredients_details['id'].'">
    				<input class="form-control" type="text" name="spices_name" id="spices_name" value="'.$ingredients_details['spices_name'].'" required>
				</div>
				<div class="form-group">
				<label>Price <span class="text-danger">*</span></label>
				<input class="form-control" type="text" name="price" id="price" value="'.$ingredients_details['price'].'" required>
			</div>
    			<div class="form-group">
					<label>Spices Image <span class="text-danger">*</span></label>
					<input class="form-control" type="file" name="spices_image" id="spices_image">
				</div>
    		
    			<div class="form-group">
    				<label>Status <span class="text-danger">*</span></label>
    				<select class="form-control" name="status" id="status" required>';
    				
    				if($ingredients_details['status']=="1")
        			  {
    					$output.='<option value="1" selected>Active</option>
    					<option value="0">Inactive</option>';
    					
        			  } else {
        			      
        			      $output.='<option value="1">Active</option>
    					<option value="0" selected >Inactive</option>';
        			  }	
    				$output.='</select>
    			</div>
    			<div class="submit-section">
    				<button type="submit" class="btn btn-primary submit-btn" name="edit-ingredients">Update</button>
    			</div>
    		</form>';
    		
    echo $output;		
        
    }
    
    
?>