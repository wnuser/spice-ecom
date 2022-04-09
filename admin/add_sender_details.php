<?php 

    include('includes/config.php');

    session_start();

    if(isset($_POST['sen_company_name'])){
      
        
        $sen_company_name = mysqli_real_escape_string($con,$_POST['sen_company_name']);
        $sen_email= mysqli_real_escape_string($con,$_POST['sen_email']);
        $sen_address1= mysqli_real_escape_string($con,$_POST['sen_address1']);
        $sen_address2= mysqli_real_escape_string($con,$_POST['sen_address2']);
        $sen_address3= mysqli_real_escape_string($con,$_POST['sen_address3']);
        $sen_phone= mysqli_real_escape_string($con,$_POST['sen_phone']);
        $sen_country= mysqli_real_escape_string($con,$_POST['sen_country']);
        $sen_pin= mysqli_real_escape_string($con,$_POST['sen_pin']);
        
        $insert_new_address=mysqli_query($con,"INSERT INTO `sender_details` (`sender`, `name`, `address`, `address2`, `address3`, `pincode`, `country`, `phone`, `email`, `create_date`) 
        VALUES ( '$sen_company_name', '$sen_company_name', '$sen_address1', '$sen_address2', '$sen_address3', '$sen_pin', '$sen_country', '$sen_phone', '$sen_email', CURDATE())");
     
        $last_id = $con->insert_id;
        
        $_SESSION['invoice_to']=$last_id;
     
        $html='<table>
	        <tbody>
			
				<tr>
					<td>'.$sen_address1.'</td>
				</tr>
				<tr>
					<td>'.$sen_address2.'</td>
				</tr>
				<tr>
					<td>'.$sen_address3.'</td>
				</tr>
				<tr>
					<td>'.$sen_country.' '.$sen_pin.'</td>
				</tr>
				<tr>
					<td>'.$sen_phone.'</td>
				</tr>
				<tr>
					<td>'.$sen_email.'</td>
				</tr>
			
	        </tbody>
        </table>';
        
       echo $html; 
       
       
    } else if(isset($_POST['from_add'])) {
        
        
       $num_rows=mysqli_num_rows(mysqli_query($con,"SELECT * FROM sender_details where id='".$_POST['from_add']."' and is_active='1'"));
            											            
       if($num_rows > 0) {    
           
        $sender_details=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM sender_details where id='".$_POST['from_add']."' and is_active='1'")); 
        
            $sen_company_name = $sender_details['name'];
            $sen_email= $sender_details['email'];
            $sen_address1= $sender_details['address'];
            $sen_address2= $sender_details['address2'];
            $sen_address3= $sender_details['address3'];
            $sen_phone= $sender_details['phone'];
            $sen_country= $sender_details['country'];
            $sen_pin= $sender_details['pincode'];
            
        $_SESSION['invoice_to']=$sender_details['id'];    
     
        $html='<table>
	        <tbody>
				
				<tr>
					<td>'.$sen_address1.'</td>
				</tr>
				<tr>
					<td>'.$sen_address2.'</td>
				</tr>
				<tr>
					<td>'.$sen_address3.'</td>
				</tr>
				<tr>
					<td>'.$sen_country.' '.$sen_pin.'</td>
				</tr>
				<tr>
					<td>'.$sen_phone.'</td>
				</tr>
				<tr>
					<td>'.$sen_email.'</td>
				</tr>
			
	        </tbody>
        </table>';
        
       echo $html;      
       
       }
        
        
    }


?>