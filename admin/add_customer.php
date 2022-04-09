<?php 

include('includes/config.php');

    session_start();

    if(isset($_POST['rev_email'])){
        
      $num_rows=mysqli_num_rows(mysqli_query($con,"SELECT * FROM customers where email_id='".$_POST['rev_email']."' and is_active='1'"));
            											            
      if($num_rows==0) {
        
        $_SESSION['add_customer']=array();   
       
        $add_customer=array(
            
            "rev_email"=> $_POST['rev_email'],
            "rev_name"=> $_POST['rev_name'],
            "last_name"=> $_POST['last_name'],
            "add_line1"=> $_POST['add_line1'],
            "add_line2"=> $_POST['add_line2'],
            "rev_phone"=> $_POST['rev_phone'],
            "rev_pin"=> $_POST['rev_pin'],
            "rev_country"=> $_POST['rev_country']
            
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
       
      } else {
           
            echo "This email already exists on your invoice. Please Search on Email ID.";; 
           
      }
           
        
    }


?>