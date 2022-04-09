<?php  

 include('includes/config.php');
 
 if(isset($_POST["img_id"]))  
 {  
        $delete_img = mysqli_query($con,"update shipping_bills set is_active='0' where id='".$_POST['img_id']."' and is_active=1 ");
       
         echo $delete_img;
              
        } 

  ?>