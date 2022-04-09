<?php 

include('includes/config.php');

    session_start();

    if(isset($_POST['com_name'])){
        
        $_SESSION['add_customer']=array();   
       
        $add_customer=array(
            
            "com_email"=> $_POST['com_email'],
            "add_line1"=> $_POST['add_line1'],
            "add_line2"=> $_POST['add_line2'],
            "add_line3"=> $_POST['add_line3'],
            "com_phone"=> $_POST['com_phone'],
            "com_pin"=> $_POST['com_pin'],
            "com_country"=> $_POST['com_country'],
            "com_name"=> $_POST['com_name']
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


?>