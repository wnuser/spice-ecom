<?php


session_start();
include ('includes/config.php');
    
    if($_POST['tokenId']) {

      require_once('vendor/autoload.php');
    
      //stripe secret key or revoke key
      $stripeSecret = 'sk_test_51KUVKaCEyUQFbck9Jiw1nyAzXMkp6xTzzmsndJTSRz6re4gDvziIwYS9Hp93gAITB5QjM4Tp60YnV3qUQU9xFN1t00vuVsGyH1';

      // See your keys here: https://dashboard.stripe.com/account/apikeys
      \Stripe\Stripe::setApiKey($stripeSecret);

     // Get the payment token ID submitted by the form:
      $token = $_POST['tokenId'];

      // Charge the user's card:
      $charge = \Stripe\Charge::create(array(
          "amount"        => ($_POST['amount']*100),
          "currency"      => "usd",
          "description"   => "Addtess :- ".$_POST['cutomer_address'],
          "metadata"      => ["order_id" => $_POST['order_id'], "customer_mobile" => $_POST['cutomer_phone']],       
          "source"        => $token,
          "receipt_email" => $_POST['cutomer_email'],
        
       ));
            
       // after successfull payment, you can store payment related information into your database
       
       $status  = $charge['status'];
       if($status == 'succeeded') 
       {
           $metadata   = $charge['metadata'];
           $orderId    = $metadata['order_id'];

           $updateOrder = mysqli_query($con, 'UPDATE orders_table set payment_status=1  where id='.$orderId.'');

           
            unset($_SESSION['order_id']);         
            unset($_SESSION['customer_name']);    
            unset($_SESSION['cutomer_phone']);    
            unset($_SESSION['cutomer_email']);    
            unset($_SESSION['cutomer_address']);  
            unset($_SESSION['total_amount']);    
            
            $data['status']  = "success";

       } else {
           $data['failed']   = "Failed";
       }

       $result  = json_encode($data);

       echo $result;


       
}
