<?php 

 include('includes/config.php');
 
error_reporting(0);
session_start();

if(isset($_POST['savetodb']))
{
    
    
    $itemName=array();
    $quantity=array();
    $qty_type=array();
    $price =array();
    
    $purno=mysqli_real_escape_string($con,$_POST['purno']);
    $pur_date = date('Y-m-d',strtotime($_POST["pur_date"]));
    
    //Purchase Company
    $com_name= mysqli_real_escape_string($con,$_SESSION['add_customer'][0]['com_name']);
    
    $address1_txt= mysqli_real_escape_string($con,$_SESSION['add_customer'][0]['add_line1']);
    $address1=nl2br($address1_txt);
    $address2_txt= mysqli_real_escape_string($con,$_SESSION['add_customer'][0]['add_line2']);
    $address2=nl2br($address2_txt);
    $address3_txt= mysqli_real_escape_string($con,$_SESSION['add_customer'][0]['add_line3']);
    $address3=nl2br($address3_txt);
    
    $com_country=mysqli_real_escape_string($con,$_SESSION['add_customer'][0]['com_country']);
    $com_pin= mysqli_real_escape_string($con,$_SESSION['add_customer'][0]['com_pin']);
    $com_phone= mysqli_real_escape_string($con,$_SESSION['add_customer'][0]['com_phone']);
    $com_email= mysqli_real_escape_string($con,$_SESSION['add_customer'][0]['com_email']);
    
    $itemName= $_POST["item_name"];
    $quantity= $_POST["quantity"];
    $qty_type= $_POST["qty_type"];
    $price= $_POST["price"];
    
    
    $subtotal= mysqli_real_escape_string($con,$_POST["subtotal"]);
    $amt_gst= mysqli_real_escape_string($con,$_POST["amt_gst"]);
    $ship_cost= mysqli_real_escape_string($con,$_POST["ship_cost"]);
    $amt_total= mysqli_real_escape_string($con,$_POST["amt_total"]);
    
    //$currency_det = mysqli_real_escape_string($con,$_POST["currency_det"]);
    $payment_mode = mysqli_real_escape_string($con,$_POST["payment_mode"]);
    
    $due_date = date('Y-m-d',strtotime($_POST["due_date"]));
    

        for($i=0;$i<count($itemName); $i++)
         {  
          
          if($itemName[$i]!="" && $quantity[$i]!="" && $price[$i]!="")
           { 
               $resp_itemname=mysqli_real_escape_string($con,$itemName[$i]);
               $resp_quanity=mysqli_real_escape_string($con,$quantity[$i]);
               $resp_qtytype=mysqli_real_escape_string($con,$qty_type[$i]);
               $resp_price=mysqli_real_escape_string($con,$price[$i]);
               $resp_amount=$resp_quanity * $resp_price;
            
              $query = mysqli_query($con,"INSERT INTO itemtable_clb(user_id ,description, quantity, qty_type, prize, total, create_date) VALUES ('".$purno."', '".$resp_itemname."', '".$resp_quanity."', '".$resp_qtytype."', '".$resp_price."', '".$resp_amount."', CURDATE())");
         
           }
        
         }

         $sql =mysqli_query($con,"INSERT INTO invoiceinfo_clb (`inv_id`, `com_name`, `com_email`, `com_phone`, `com_address`,`com_address2`,`com_address3`,`com_pin`,`com_country`, `invdate`, `subtotal`, `gst`, `ship_cost`, `grand_total`,`purchase_payment`,`due_date`, `create_date`)
         VALUES ('$purno', '$com_name', '$com_email', '$com_phone', '$address1', '$address2','$address3','$com_pin','$com_country', '$pur_date', '$subtotal', '$amt_gst', '$ship_cost', '$amt_total', '$payment_mode', '$due_date', CURDATE())"); 

 
      if($sql==true)
      {
          $_SESSION['invoice']=$_POST['purno']; 
          
          $sql3=mysqli_query($con,"select * from generate_id where id='2' and is_active=1");
          $invno_num=mysqli_fetch_array($sql3);
          $inc=$invno_num['inc_num']+1;
          $sql2=mysqli_query($con,"update generate_id set inc_num='".$inc."' where id='2' and is_active=1");
          
          unset($_SESSION['add_customer']);
          
          unset($_SESSION['add_information']);
          
          echo "<script>alert('Success! Purchase Invoice Created Successfully.');location.href='purchase_invoice.php';</script>";     
      
      }
      else
      {
          
       echo "<script>alert('Oops! Something went wrong.');location.href='purchase_invoice.php'</script>";
       
      }
}

?>