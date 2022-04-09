<?php

    include('includes/config.php');

    session_start();
    
    
    if(isset($_POST['selected_add'])) {
        
        
      $html='<option value="">Select Address</option>';
      
		
            $sel_sender=mysqli_query($con,"select * from sender_details where is_active='1'");
            while($sel_sender_row=mysqli_fetch_array($sel_sender))
            {
               if($sel_sender_row['sender']==$_POST['selected_add'])
               {
            
			     $html.='<option value="'.$sel_sender_row['id'].'" selected >'.$sel_sender_row['sender'].'</option>';
			    
               } else {
                   
                   $html.='<option value="'.$sel_sender_row['id'].'"  >'.$sel_sender_row['sender'].'</option>';
               } 
            }  
            
        echo $html;
        
        
    }


?>