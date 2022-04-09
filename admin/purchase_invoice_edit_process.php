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
    
    //Invoice To
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
    
    $prd_id= $_POST["prd_id"];
    $itemName= $_POST["item_name"];
    $quantity= $_POST["quantity"];
    $qty_type= $_POST["qty_type"];
    $price= $_POST["price"];
    
    
    $subtotal= mysqli_real_escape_string($con,$_POST["subtotal"]);
    $amt_gst= mysqli_real_escape_string($con,$_POST["amt_vat"]);
    $ship_cost= mysqli_real_escape_string($con,$_POST["ship_cost"]);
    $amt_total= mysqli_real_escape_string($con,$_POST["amt_total"]);
    
    $FileName = $_FILES["pur_file"]["name"];
    $targetFile = 'purchase_invoice/' . basename($_FILES["pur_file"]["name"]);
    move_uploaded_file($_FILES["pur_file"]["tmp_name"], $targetFile);
    
   // $currency_det = mysqli_real_escape_string($con,$_POST["currency_det"]);
    $payment_mode = mysqli_real_escape_string($con,$_POST["payment_mode"]);
    
    $due_date = date('Y-m-d',strtotime($_POST["due_date"]));
    

        for($i=0;$i<count($itemName); $i++)
         {  
            $get_num_records=mysqli_query($con,"select * from itemtable_clb where user_id='".$purno."' and is_active='1'");
            $num_rec=mysqli_num_rows($get_num_records);
          
          if($itemName[$i]!="" && $quantity[$i]!="" && $price[$i]!="")
           { 
               $resp_itemname=mysqli_real_escape_string($con,$itemName[$i]);
               $resp_quanity=mysqli_real_escape_string($con,$quantity[$i]);
               $resp_qtytype=mysqli_real_escape_string($con,$qty_type[$i]);
               $resp_price=mysqli_real_escape_string($con,$price[$i]);
               $resp_amount=$resp_quanity * $resp_price;
                if($i<$num_rec)
                {
                    
                   $query = mysqli_query($con,"Update itemtable_clb set description='".$resp_itemname."', quantity='".$resp_quanity."', qty_type='".$resp_qtytype."', prize='".$resp_price."', total='".$resp_amount."' where user_id='".$purno."' And id='".$prd_id[$i]."'");

                }else{
                    
                    $query = mysqli_query($con,"INSERT INTO itemtable_clb(user_id ,description, quantity, prize, total, create_date) VALUES ('".$purno."', '".$resp_itemname."', '".$resp_quanity."', '".$resp_price."', '".$resp_amount."', CURDATE())");
                }
           }
        
         }
        
        $sql =mysqli_query($con,"Update invoiceinfo_clb set `com_name`='$com_name', `com_email`='$com_email', `com_phone`='$com_phone',`com_address`='$address1',`com_address2`='$address2',`com_address3`='".$address3."',`com_pin`='".$com_pin."',`com_country`='".$com_country."',
        `invdate`='$pur_date', `subtotal`='$subtotal', `gst`='$amt_gst', `ship_cost`='".$ship_cost."', `grand_total`='$amt_total', `purchase_payment`='$payment_mode', `due_date`='".$due_date."' where `inv_id`='$purno'");
 
      if($sql==true)
      {
        
          
          echo "<script>alert('Success! Purchase Invoice Updated Successfully.');location.href='purchase_reportsall.php';</script>";     
      
      }
      else
      {
          
      echo "<script>alert('Oops! Something went wrong.');location.href='purchase_reportsall.php'</script>";
       
      }
}

?>