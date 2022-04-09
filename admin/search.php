<?php 

include('includes/config.php');
	
	
	if (isset($_GET['term'])) {
	    
	   $email_id=$_GET['term'];
    
       $query = "SELECT * FROM customers WHERE email_id LIKE '%$email_id%' and is_active='1' group by rev_email";
        $result = mysqli_query($con, $query);
    
        if (mysqli_num_rows($result) > 0) {
         while ($user = mysqli_fetch_array($result)) {
          $res[] = $user['email_id'];
         }
        } else {
          $res = array();
        }
        //return json res
        echo json_encode($res);
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>