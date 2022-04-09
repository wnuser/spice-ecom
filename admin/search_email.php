<?php 

include('includes/config.php');

    session_start();

    if(isset($_POST['srch_email'])){
        
       $srch_email=$_POST['srch_email'];  
     
       $num_rows=mysqli_num_rows(mysqli_query($con,"SELECT * FROM customers where email_id='".$srch_email."' and is_active='1'"));
            											            
       if($num_rows > 0) {
           
       $_SESSION['add_customer']=array();    
           
       $fetch_rows=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM customers where email_id='".$srch_email."' and is_active='1'")); 
      
       $add_customer=array(
        
        "rev_email"=> $fetch_rows['email_id'],
        "rev_name"=> $fetch_rows['first_name'],
        "last_name"=> $fetch_rows['last_name'],
        "add_line1"=> $fetch_rows['address'],
        "add_line2"=> $fetch_rows['address2'],
        "rev_phone"=> $fetch_rows['phone'],
        "rev_pin"=> $fetch_rows['postal_code'],
        "rev_country"=> $fetch_rows['country']
        
        
      );   
      
       array_push($_SESSION['add_customer'],$add_customer); 
       
       $html='<table>
	        <tbody>
				
				<tr>
					<td>'.$_SESSION['add_customer'][0]['rev_name'].' '.$_SESSION['add_customer'][0]['last_name'].'</td>
				</tr>
				<tr>
					<td>'.$_SESSION['add_customer'][0]['add_line1'].'</td>
				</tr>
				<tr>
					<td>'.$_SESSION['add_customer'][0]['add_line2'].'</td>
				</tr>
			
				<tr>
					<td>'.$_SESSION['add_customer'][0]['rev_country'].' '.$_SESSION['add_customer'][0]['rev_pin'].'</td>
				</tr>
				<tr>
					<td>'.$_SESSION['add_customer'][0]['rev_phone'].'</td>
				</tr>
				<tr>
					<td>'.$_SESSION['add_customer'][0]['rev_email'].'</td>
				</tr>
				
	        </tbody>
         </table>';
        
        echo $html; 
       
       } 
        
    }


?>