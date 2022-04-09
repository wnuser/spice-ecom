<?php 

include('includes/config.php');
	
	if (isset($_GET['term'])) {
	    
	   $email_id=$_GET['term'];
    
       $query = "SELECT * FROM invoiceinfo_clb WHERE com_name LIKE '%$email_id%' and is_active='1' group by com_email";
        $result = mysqli_query($con, $query);
    
        if (mysqli_num_rows($result) > 0) {
         while ($user = mysqli_fetch_array($result)) {
          $res[] = $user['com_name'];
         }
        } else {
          $res = array();
        }
        //return json res
        echo json_encode($res);
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>