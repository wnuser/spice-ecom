<?php

    if(isset($_POST['account_login'])) {
            
        $user_email=mysqli_real_escape_string($con,$_POST['user_email']);    
        $user_password=mysqli_real_escape_string($con,$_POST['user_password']);
        
        $login_check=mysqli_num_rows(mysqli_query($con,"select * from customers where email_id='".$user_email."' and is_active='1'"));
        
        if($login_check > 0) {
            
         $check_passowrd=mysqli_num_rows(mysqli_query($con,"select * from customers where email_id='".$user_email."' and password='".$user_password."' and is_active='1'"));   
         
         if($check_passowrd > 0) {
             
            $user_details=mysqli_fetch_array(mysqli_query($con,"select * from customers where email_id='".$user_email."' and password='".$user_password."' and is_active='1'"));     
             
             $_SESSION['logged_id']=$user_details['id'];
            
             $_SESSION['login_user']=$user_details['first_name'].' '.$user_details['last_name'];
    
         } else {
             
              echo "<script>alert('Opps! Invalide Password.');</script>";   
         }
            
            
        } else {
          
          echo "<script>alert('Opps! Invalide Email Address.');</script>";  
            
         }
            
    }   


 if(isset($_POST['register']))
     {
        $name=mysqli_real_escape_string($con,$_POST['name']);
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $mobileno=mysqli_real_escape_string($con,$_POST['mobileno']);
        $password=mysqli_real_escape_string($con,$_POST['password']);
        
        $login_check=mysqli_num_rows(mysqli_query($con,"select * from customers where email_id='".$email."' and is_active='1'"));
    
        if($login_check=='0') {
            
          $register = mysqli_query($con,"INSERT INTO `customers` (`first_name`, `last_name`, `email_id`, `phone`, `address`, `town_city`, `postal_code`, `country`, `password`, `create_date`) 
          VALUES ('$name', '', '$email', '$mobileno', '', '', '', '', '$password', CURDATE())");
          
          if($register==true)
          {
        
             echo "<script>alert('Successs! Account Created.');</script>"; 
          
          } else {
              
             echo "<script>alert('Opps! Something went wrong.');</script>"; 
             
          }
        
        } else {
            
          echo "<script>alert('Opps! This Email ID Already Registerd.');</script>";     

        }
        
   }
 
  
?>  