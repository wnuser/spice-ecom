<?php 

 include('includes/config.php');
 
error_reporting(0);
session_start();

if(isset($_POST['savetodb']))
{
    
        $itemName=array();
        $quantity=array();
        $price =array();
        
        $invid=mysqli_real_escape_string($con,$_POST['invid']);
        $invno=mysqli_real_escape_string($con,$_POST['invno']);
        $invdate = date('Y-m-d',strtotime($_POST["inv_date"])); 
        
        
        //Invoice To
        $rev_name= mysqli_real_escape_string($con,$_SESSION['add_customer'][0]['rev_name']);
        $last_name= mysqli_real_escape_string($con,$_SESSION['add_customer'][0]['last_name']);
        
        $address1_txt= mysqli_real_escape_string($con,$_SESSION['add_customer'][0]['add_line1']);
        $address1=nl2br($address1_txt);
        $address2_txt= mysqli_real_escape_string($con,$_SESSION['add_customer'][0]['add_line2']);
        $address2=nl2br($address2_txt);
        
        $rev_country=mysqli_real_escape_string($con,$_SESSION['add_customer'][0]['rev_country']);
        $rev_pin= mysqli_real_escape_string($con,$_SESSION['add_customer'][0]['rev_pin']);
        $rev_phone= mysqli_real_escape_string($con,$_SESSION['add_customer'][0]['rev_phone']);
        $rev_email= mysqli_real_escape_string($con,$_SESSION['add_customer'][0]['rev_email']);
        
        //Delivery Details
        $delivery_date = date('Y-m-d',strtotime($_POST["delivery_date"])); 
        $delivery_status= mysqli_real_escape_string($con,$_POST['delivery_status']);
        
        $prd_id= $_POST["prd_id"];
        $itemName= $_POST["item_name"];
        $quantity= $_POST["quantity"];
        $price= $_POST["price"];
        
        $subtotal= mysqli_real_escape_string($con,$_POST["subtotal"]);
        $amt_discount= mysqli_real_escape_string($con,$_POST["amt_discount"]);
        $shipping_amt= mysqli_real_escape_string($con,$_POST["shipping_amt"]);
        $amt_total= mysqli_real_escape_string($con,$_POST["amt_total"]);
    
        $get_invoiceinfo=mysqli_fetch_array(mysqli_query($con,"select * from orders where order_id='".$invno."' and is_active='1'"));
        
        $customer_id='';
    
        $check_customer_email=mysqli_num_rows(mysqli_query($con,"select * from customers where email_id='".$rev_email."' and is_active='1'"));
        
        if($check_customer_email > 0) {
            
            $update_customer_details=mysqli_query($con,"update `customers`  set `first_name`='".$rev_name."', `last_name`='".$last_name."', `phone`='".$rev_phone."', `address`='".$address1."', `address2`='".$address2."', 
            `postal_code`='".$rev_pin."', `country`='".$rev_country."' where email_id='".$rev_email."' and is_active='1'");
            
             $check_customer_id=mysqli_fetch_array(mysqli_query($con,"select * from customers where email_id='".$rev_email."' and is_active='1'"));
             
             $customer_id=$check_customer_id['id'];
    
        
        } else {
            
            
            $add_customer_details=mysqli_query($con,"INSERT INTO `customers` (`first_name`, `last_name`, `email_id`, `phone`, `address`, `address2`, `postal_code`, `country`,  `create_date`) 
            VALUES ('$rev_name', '$last_name', '$rev_email', '$rev_phone', '$address1', '$address2', '$rev_pin', '$rev_country', CURDATE())");
            
            $customer_id=$con->insert_id;    
        
        }   
        
        $update_order = mysqli_query($con,"update `orders` set `customer_id`='".$customer_id."', `order_date`='".$invdate."', `delivery_date`='".$delivery_date."',
        `subtotal`='".$subtotal."', `discount`='".$amt_discount."', `ship_amount`='".$shipping_amt."', `total_price`='".$amt_total."',status='".$delivery_status."' where order_id='".$invno."' and is_active='1'");
    
        for($i=0;$i<count($itemName); $i++)
         {  
            $get_num_records=mysqli_query($con,"select * from order_items where order_id='".$invno."' and is_active='1'");
            $num_rec=mysqli_num_rows($get_num_records);
          
          if($itemName[$i]!="" && $quantity[$i]!="" && $price[$i]!="")
           { 
               $resp_itemname=mysqli_real_escape_string($con,$itemName[$i]);
               $resp_quanity=mysqli_real_escape_string($con,$quantity[$i]);
               $resp_price=mysqli_real_escape_string($con,$price[$i]);
               $resp_amount=$resp_quanity * $resp_price;
                if($i<$num_rec)
                {
                    
                   $query = mysqli_query($con,"Update order_items set product_name='".$resp_itemname."', quantity='".$resp_quanity."', unit_price='".$resp_price."', product_price='".$resp_amount."' where order_id='".$invno."' and is_active='1'");

                } else{
                    
                    $query = mysqli_query($con,"INSERT INTO order_items(order_id ,product_name, quantity, unit_price, product_price) VALUES ('".$invno."', '".$resp_itemname."', '".$resp_quanity."', '".$resp_price."', '".$resp_amount."'");
                }
           }
        
         }
       
 
      if($update_order==true)
      {
        
          
          echo "<script>alert('Success! Invoice Updated Successfully.');location.href='invoice_edit.php?invno=$invno';</script>";     
      
      }
      else
      {
          
       echo "<script>alert('Oops! Something went wrong.');location.href='invoice_edit.php?invno=$invno';</script>";
       
      }
}

?>