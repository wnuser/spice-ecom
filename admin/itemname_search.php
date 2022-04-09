<?php 

include('includes/config.php');
	
	
	if (isset($_GET['term'])) {
	    
	   $item_name=$_GET['term'];
    
       $query = "SELECT * FROM itemtable_clb WHERE description LIKE '%$item_name%' and is_active='1' group by description";
        $result = mysqli_query($con, $query);
    
        if (mysqli_num_rows($result) > 0) {
         while ($user = mysqli_fetch_array($result)) {
          $res[] = $user['description'];
         }
        } else {
          $res = array();
        }
        //return json res
        echo json_encode($res);
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>