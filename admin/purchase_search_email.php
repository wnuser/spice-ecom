<?php 

include('includes/config.php');

    session_start();

    if(isset($_POST['srch_email'])){
        
       $srch_email=$_POST['srch_email'];  
     
       $num_rows=mysqli_num_rows(mysqli_query($con,"SELECT * FROM invoiceinfo_clb where com_name='".$srch_email."' and is_active='1'"));
            											            
       if($num_rows > 0) {
           
       $_SESSION['add_customer']=array();    
           
       $fetch_rows=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM invoiceinfo_clb where com_name='".$srch_email."' and is_active='1'")); 
      
       $add_customer=array(
        
        "com_email"=> $fetch_rows['com_email'],
        "add_line1"=> $fetch_rows['com_address'],
        "add_line2"=> $fetch_rows['com_address2'],
        "add_line3"=> $fetch_rows['com_address3'],
        "com_phone"=> $fetch_rows['com_phone'],
        "com_pin"=> $fetch_rows['com_pin'],
        "com_country"=> $fetch_rows['com_country'],
        "com_name"=> $fetch_rows['com_name']
        
      );   
      
       array_push($_SESSION['add_customer'],$add_customer); 
       
       $html='<table>
	        <tbody>
				<tr>
					<td>'.$_SESSION['add_customer'][0]['com_name'].'</td>
				</tr>
				<tr>
					<td>'.$_SESSION['add_customer'][0]['add_line1'].'</td>
				</tr>
				<tr>
					<td>'.$_SESSION['add_customer'][0]['add_line2'].'</td>
				</tr>
				<tr>
					<td>'.$_SESSION['add_customer'][0]['add_line3'].'</td>
				</tr>
				<tr>
					<td>'.$_SESSION['add_customer'][0]['com_country'].' '.$_SESSION['add_customer'][0]['com_pin'].'</td>
				</tr>
				<tr>
					<td>'.$_SESSION['add_customer'][0]['com_phone'].'</td>
				</tr>
				<tr>
					<td>'.$_SESSION['add_customer'][0]['com_email'].'</td>
				</tr>
				
	        </tbody>
         </table>';
        
        echo $html; 
       
       } 
        
    }


?>