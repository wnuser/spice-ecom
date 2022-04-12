<?php
session_start();
include('includes/config.php');

    if(isset($_POST['create_order']))
    {
        $firstName      = $_POST['first_name'];
        $lastName       = $_POST['last_name'];
        $phoneNum       = $_POST['phone_num'];
        $custEmail      = $_POST['cust_email'];
        $custCountry    = $_POST['cust_country'];
        $custAddress    = $_POST['cust_address'];
        $custTowncity   = $_POST['cust_town_city'];
        $postalCode     = $_POST['postal_code'];
        $orderNotes     = $_POST['order_notes'];

        $getCartDataQry     = mysqli_query($con,"select * from cart where customer_id='".$_SESSION['logged_id']."'");
        $getCartTotal       = mysqli_query($con,"select SUM(price * quantity) as total_cost from cart where customer_id='".$_SESSION['logged_id']."'");
        $count              = mysqli_num_rows($getCartDataQry);
        $totalCart          = mysqli_fetch_assoc($getCartTotal);

        $ord_value_id       = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM generate_id WHERE id='1' and is_active='1'"));   
        $inc_value          = $ord_value_id['inc_num']+1;
        $update_gen_val     = mysqli_query($con,"update generate_id set inc_num='".$inc_value."' WHERE id='1' and is_active='1'");
        $ord_inc_value      = $ord_value_id['pref_name'].''.$ord_value_id['inc_num'];

        $insert_order  = mysqli_query($con,"INSERT INTO `orders_table`(`order_id`, `first_name`, `last_name`, `phone_num`, `cust_email`, `cust_country`, `cust_address`, `cust_town_city`, `postal_code`, `order_notes`, `customer_id`, `total_price`) 
                        VALUES ( '".$ord_inc_value."', '".$firstName."', '".$lastName."', '".$phoneNum."', '".$custEmail."', '".$custCountry."', '".$custAddress."', '".$custTowncity."', '".$postalCode."', '".$orderNotes."', '".$_SESSION['logged_id']."', '".$totalCart['total_cost']."' )" );
        $newOrderId = mysqli_insert_id($con);

        $_SESSION['order_id']         = $newOrderId;
        $_SESSION['customer_name']    = $firstName;
        $_SESSION['cutomer_phone']    = $phoneNum;
        $_SESSION['cutomer_email']    = $custEmail;
        $_SESSION['cutomer_address']  = $custAddress;
        $_SESSION['total_amount']     = $totalCart['total_cost'];

        while($cartData = mysqli_fetch_assoc($getCartDataQry)) {
            if($cartData['reacipie_id']) {
                $insert_order_products  = mysqli_query($con,"INSERT INTO `order_product`(`order_id`, `order_g_id`, `customer_id`, `reacipie_id`, `product_quantity`, `product_price`, `product_total`) 
                VALUES ( '".$newOrderId."', '".$ord_inc_value."', '".$_SESSION['logged_id']."', '".$cartData['reacipie_id']."', '".$cartData['quantity']."', '".$cartData['price']."', '".$cartData['price'] * $cartData['quantity']."' )" );
                echo mysqli_error($con);
            } else {
                $insert_order_products  = mysqli_query($con,"INSERT INTO `order_product`(`order_id`, `order_g_id`, `customer_id`, `product_id`, `product_quantity`, `product_price`, `product_total`) 
                VALUES ( '".$newOrderId."', '".$ord_inc_value."', '".$_SESSION['logged_id']."', '".$cartData['product_id']."', '".$cartData['quantity']."', '".$cartData['price']."', '".$cartData['price'] * $cartData['quantity']."' )" );
            }
            
        }

        $deleteCartData    = mysqli_query($con,"DELETE FROM cart WHERE customer_id ='".$_SESSION['logged_id']."' ");
        if($deleteCartData){
            echo "<script>alert('Please proceed to pay!.');location.href='payment.php';</script>";
        }


    }
    
?>