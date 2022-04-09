<?php
session_start();
// initialize shopping cart class
include 'Cart.php';
$cart = new Cart;

include('includes/config.php');

// include database configuration file
include 'dbConfig.php';

// echo "tee";


if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){

    // echo "tttt";
    
    
    if($_REQUEST['action'] == 'addToDeals' && !empty($_REQUEST['id']) && !empty($_REQUEST['category'])){
        
        $productID = $_REQUEST['id'];
        
        $product_qty= $_REQUEST['prd_qty'];

        // echo $product_qty; exit;
        
        // get product details
        
        $query = $db->query("SELECT * FROM our_products WHERE id = ".$productID);
        $row = $query->fetch_assoc();
        
        $image_path="admin/assets/img/deals/".$row['product_image'];
        
        $itemData = array(
            
            'id' => $row['id'],
            'name' => $row['product_name'],
            'price' => $row['price'],
            'img'=> $image_path,
            'category'=> $_REQUEST['category'],
            'qty' => $product_qty,
        );

        $checkCartExist = mysqli_fetch_assoc(mysqli_query($con,"select * from cart where customer_id='".$_SESSION['logged_id']."' AND product_id='".$row['id']."'"));
              
        ini_set('display_errors', 1);
        // print_r($checkCartExist);
        // exit;
        if($checkCartExist)
        {
            $newQnty = $checkCartExist['quantity'] + $product_qty;
            $cart_add = mysqli_query($con,"UPDATE cart SET quantity='".$newQnty."' WHERE product_id='".$row['id']."' AND customer_id='".$_SESSION['logged_id']."' ");
        } else {

            // echo "ttt";
            // exit;

            try {
                //code...
                $cart_add = mysqli_query($con,"INSERT INTO `cart` (`customer_id`, `product_id`, `product_img` , `product_name`, `quantity`, `price`) 
                VALUES ( '".$_SESSION['logged_id']."','".$row['id']."','".$image_path."','".$row['product_name']."', '".$product_qty."', '".$row['price']."')");
    
            } catch (\Throwable $th) {
                //throw $th;
                echo $th->getMessage();
            }


        //    echo  error_reporting(E_ALL);
        //    print_r($row);
        //    exit;
        }

      
        
        
        $getCartDataQry = mysqli_query($con,"select * from cart where customer_id='".$_SESSION['logged_id']."'");
        $getCartTotal = mysqli_query($con,"select SUM(price * quantity) as total_cost from cart where customer_id='".$_SESSION['logged_id']."'");
        $count = mysqli_num_rows($getCartDataQry);
        $totalCart = mysqli_fetch_assoc($getCartTotal);
        $output='<div class="header-cart-wrap">
                    <a href="javascript:void(0)"><i class="flaticon-shopping-basket"></i></a>
                    <span class="item-count">'.$count.'</span>
                    <ul class="minicart">';
                    
                     if($count > 0){
                        
                        while($cartData = mysqli_fetch_assoc($getCartDataQry)) {
                            $output.='<li class="d-flex align-items-start">
                            <div class="cart-img">';
                            if($cartData['reacipie_id'])
                            {
                                $output.='<a href="javascript:void(0)"><img src="img/rec_item.png" style="width:100px;height:87px;" alt=""></a>';

                            } else {
                                $output.='<a href="javascript:void(0)"><img src="'.$cartData['product_img'].'" style="width:100px;height:87px;" alt=""></a>';
                            }          
                            $output.='</div>
                            <div class="cart-content">';
                            if($cartData['reacipie_id'])
                            {
                                $output.='<h4><a href="javascript:void(0)" onclick="order_items('.$cartData['reacipie_id'].')">'.$cartData['product_name'].'</a></h4>';
                            } else {
                               $output.='<h4><a href="javascript:void(0)">'.$cartData['product_name'].'</a></h4>';
                            }
                            $output.='<div class="cart-price">
                                    <span class="new">'.$cartData['quantity'].' x £'.number_format($cartData['price'],2).'</span>
                                </div>
                            </div>
                            <div class="del-icon">
                                <a href="javascript:void(0)" onclick="removeCartItem('.$cartData["id"].')"><i class="far fa-trash-alt"></i></a>
                            </div>
                        </li>';    
                          }
                     } else {
                            
                         $output.='<li class="d-flex align-items-start">
                                  
                                    <div class="cart-img" style="flex: 0 0 300px;">
                                      <img src="img/empty-cart.png"> 
                                    </div>

                                </li>';    
                            
                        }  
                        
                        $output.='<li>
                            <div class="total-price">
                                <span class="f-left">Total:</span>
                                <span class="f-right">£'.number_format(($totalCart['total_cost']),2).'</span>
                            </div>
                        </li>';
                        
                         if($count > 0){
                        
                        $output.='<li>
                            <div class="checkout-link">
                                <a href="view-cart.php">View Cart</a>
                                <a class="black-color" href="checkout.php">Checkout</a>
                            </div>
                        </li>';
                        
                        } else {
                            
                        $output.='<li>
                            <div class="checkout-link">
                                <a href="javascript:void(0)">View Cart</a>
                                <a class="black-color" href="javascript:void(0)">Checkout</a>
                            </div>
                        </li>';
                            
                        }
                        
                    $output.='</ul>
                </div>
                <div class="cart-amount">£'.number_format(($totalCart['total_cost']),2).'</div>';
                           
            // die(mysqli_error($con));
            
            echo $output;  
        
        
        
     } elseif($_REQUEST['action'] == 'addRecipeToDeals' && !empty($_REQUEST['id']) && !empty($_REQUEST['category'])){
        
        $productID = $_REQUEST['id'];
        
        $product_qty= $_REQUEST['prd_qty'];
        
        // get product details
        
        $row = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM reacipies WHERE id = ".$productID));
        
        $checkCartExist = mysqli_fetch_assoc(mysqli_query($con,"select * from cart where customer_id='".$_SESSION['logged_id']."' AND reacipie_id='".$productID."'"));
              
        if($checkCartExist)
        {
            $newQnty = $checkCartExist['quantity'] + $product_qty;
            $cart_add = mysqli_query($con,"UPDATE cart SET quantity='".$newQnty."' WHERE reacipie_id='".$row['id']."' AND customer_id='".$_SESSION['logged_id']."' ");
        } else {
            $cart_add = mysqli_query($con,"INSERT INTO `cart` (`customer_id`,  `product_name`, `quantity`, `price`, `reacipie_id`) 
            VALUES ( '".$_SESSION['logged_id']."', '".$row['recipe_name']."', '".$product_qty."', '".$row['total_price']."', '".$row['id']."')");
        }

       
        // $insertItem = $cart->insert($itemData);
        
        $getCartDataQry = mysqli_query($con,"select * from cart where customer_id='".$_SESSION['logged_id']."'");
        $getCartTotal = mysqli_query($con,"select SUM(price * quantity) as total_cost from cart where customer_id='".$_SESSION['logged_id']."'");
        $count = mysqli_num_rows($getCartDataQry);
        $totalCart = mysqli_fetch_assoc($getCartTotal);
        $output='<div class="header-cart-wrap">
                    <a href="javascript:void(0)"><i class="flaticon-shopping-basket"></i></a>
                    <span class="item-count">'.$count.'</span>
                    <ul class="minicart">';
                    
                     if($count > 0){
                        
                        while($cartData = mysqli_fetch_assoc($getCartDataQry)) {
                            $output.='<li class="d-flex align-items-start">
                            <div class="cart-img">';
                            if($cartData['reacipie_id'])
                            {
                                $output.='<a href="javascript:void(0)"><img src="img/rec_item.png" style="width:100px;height:87px;" alt=""></a>';

                            } else {
                                $output.='<a href="javascript:void(0)"><img src="'.$cartData['product_img'].'" style="width:100px;height:87px;" alt=""></a>';
                            }
                            $output.='</div>
                            <div class="cart-content">';
                            if($cartData['reacipie_id'])
                                {
                                    $output.='<h4><a href="javascript:void(0)" onclick="order_items('.$cartData['reacipie_id'].')">'.$cartData['product_name'].'</a></h4>';
                                } else {
                                   $output.='<h4><a href="javascript:void(0)">'.$cartData['product_name'].'</a></h4>';
                                }
                                
                            $output.='<div class="cart-price">
                                    <span class="new">'.$cartData['quantity'].' x £'.number_format($cartData['price'],2).'</span>
                                </div>
                            </div>
                            <div class="del-icon">
                                <a href="javascript:void(0)" onclick="removeCartItem('.$cartData["id"].')"><i class="far fa-trash-alt"></i></a>
                            </div>
                        </li>';    
                          }
                     } else {
                            
                         $output.='<li class="d-flex align-items-start">
                                  
                                    <div class="cart-img" style="flex: 0 0 300px;">
                                      <img src="img/empty-cart.png"> 
                                    </div>

                                </li>';    
                            
                        }  
                        
                        $output.='<li>
                            <div class="total-price">
                                <span class="f-left">Total:</span>
                                <span class="f-right">£'.number_format(($totalCart['total_cost']),2).'</span>
                            </div>
                        </li>';
                        
                         if($count > 0){
                        
                        $output.='<li>
                            <div class="checkout-link">
                                <a href="view-cart.php">View Cart</a>
                                <a class="black-color" href="checkout.php">Checkout</a>
                            </div>
                        </li>';
                        
                        } else {
                            
                        $output.='<li>
                            <div class="checkout-link">
                                <a href="javascript:void(0)">View Cart</a>
                                <a class="black-color" href="javascript:void(0)">Checkout</a>
                            </div>
                        </li>';
                            
                        }
                        
                    $output.='</ul>
                </div>
                <div class="cart-amount">£'.number_format(($totalCart['total_cost']),2).'</div>';
                           
                        
            echo $output;  
        
        
        
     } elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
         
        $rowid=md5($_REQUEST['id']); 
         
        $itemData = array(
            'rowid' => $rowid,
            'qty' => $_REQUEST['qty']
        );
        
        $updateCart = mysqli_query($con,"UPDATE cart SET quantity='".$_REQUEST['qty']."' WHERE id='".$_REQUEST['id']."' AND customer_id='".$_SESSION['logged_id']."' ");
 
        $getCartDataQry = mysqli_query($con,"select * from cart where customer_id='".$_SESSION['logged_id']."' ");
        $getCartTotal = mysqli_query($con,"select SUM(price * quantity) as total_cost from cart where customer_id='".$_SESSION['logged_id']."'");
        $count = mysqli_num_rows($getCartDataQry);
        $totalCart = mysqli_fetch_assoc($getCartTotal);

        $updateItem = $cart->update($itemData);
        
        $output='<div class="header-cart-wrap">
                    <a href="javascript:void(0)"><i class="flaticon-shopping-basket"></i></a>
                    <span class="item-count">'.$count.'</span>
                    <ul class="minicart">';
                    
                    if($count > 0){
                        
                        while($cartData = mysqli_fetch_assoc($getCartDataQry)) {
                            $output.='<li class="d-flex align-items-start">
                            <div class="cart-img">';
                            if($cartData['reacipie_id'])
                            {
                                $output.='<a href="javascript:void(0)"><img src="img/rec_item.png" style="width:100px;height:87px;" alt=""></a>';

                            } else {
                                $output.='<a href="javascript:void(0)"><img src="'.$cartData['product_img'].'" style="width:100px;height:87px;" alt=""></a>';
                            }          
                            $output.='</div>
                            <div class="cart-content">';
                            if($cartData['reacipie_id'])
                            {
                                $output.='<h4><a href="javascript:void(0)" onclick="order_items('.$cartData['reacipie_id'].')">'.$cartData['product_name'].'</a></h4>';
                            } else {
                               $output.='<h4><a href="javascript:void(0)">'.$cartData['product_name'].'</a></h4>';
                            }
                            $output.='<div class="cart-price">
                                    <span class="new">'.$cartData['quantity'].' x £'.number_format($cartData['price'],2).'</span>
                                </div>
                            </div>
                            <div class="del-icon">
                                <a href="javascript:void(0)" onclick="removeCartItem('.$cartData["id"].')"><i class="far fa-trash-alt"></i></a>
                            </div>
                        </li>';    
                          }
                     } else {
                            
                         $output.='<li class="d-flex align-items-start">
                                  
                                    <div class="cart-img" style="flex: 0 0 300px;">
                                      <img src="img/empty-cart.png"> 
                                    </div>

                                </li>';    
                            
                        }  
                        
                        $output.='<li>
                            <div class="total-price">
                                <span class="f-left">Total:</span>
                                <span class="f-right">£'.number_format(($totalCart['total_cost']),2).'</span>
                            </div>
                        </li>';
                        
                         if($count > 0){
                        
                        $output.='<li>
                            <div class="checkout-link">
                                <a href="view-cart.php">View Cart</a>
                                <a class="black-color" href="checkout.php">Checkout</a>
                            </div>
                        </li>';
                        
                        } else {
                            
                        $output.='<li>
                            <div class="checkout-link">
                                <a href="javascript:void(0)">View Cart</a>
                                <a class="black-color" href="javascript:void(0)">Checkout</a>
                            </div>
                        </li>';
                            
                        }
                        
                    $output.='</ul>
                </div>
                <div class="cart-amount">£'.number_format(($totalCart['total_cost']),2).'</div>';
                           
             
                           
                        
            echo $output;
        
        
    } elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        
        $deleteItem = $cart->remove($_REQUEST['id']);

        $cartDelete = mysqli_query($con,"DELETE FROM cart WHERE id='".$_REQUEST['id']."' AND customer_id='".$_SESSION['logged_id']."' ");
        $getCartDataQry = mysqli_query($con,"select * from cart where customer_id='".$_SESSION['logged_id']."' ");
        $getCartTotal = mysqli_query($con,"select SUM(price * quantity) as total_cost from cart where customer_id='".$_SESSION['logged_id']."'");
        $count = mysqli_num_rows($getCartDataQry);
        $totalCart = mysqli_fetch_assoc($getCartTotal);
        
            $output='<div class="header-cart-wrap">
                    <a href="javascript:void(0)"><i class="flaticon-shopping-basket"></i></a>
                    <span class="item-count">'.$count.'</span>
                    <ul class="minicart">';
                    
                    if($count > 0){
                        
                        while($cartData = mysqli_fetch_assoc($getCartDataQry)) {
                            $output.='<li class="d-flex align-items-start">
                            <div class="cart-img">';
                            if($cartData['reacipie_id'])
                            {
                                $output.='<a href="javascript:void(0)"><img src="img/rec_item.png" style="width:100px;height:87px;" alt=""></a>';

                            } else {
                                $output.='<a href="javascript:void(0)"><img src="'.$cartData['product_img'].'" style="width:100px;height:87px;" alt=""></a>';
                            }          
                            $output.='</div>
                            <div class="cart-content">';
                            if($cartData['reacipie_id'])
                            {
                                $output.='<h4><a href="javascript:void(0)" onclick="order_items('.$cartData['reacipie_id'].')">'.$cartData['product_name'].'</a></h4>';
                            } else {
                               $output.='<h4><a href="javascript:void(0)">'.$cartData['product_name'].'</a></h4>';
                            }
                            $output.='<div class="cart-price">
                                    <span class="new">'.$cartData['quantity'].' x £'.number_format($cartData['price'],2).'</span>
                                </div>
                            </div>
                            <div class="del-icon">
                                <a href="javascript:void(0)" onclick="removeCartItem('.$cartData["id"].')"><i class="far fa-trash-alt"></i></a>
                            </div>
                        </li>';    
                          }
                     } else {
                            
                         $output.='<li class="d-flex align-items-start">
                                  
                                    <div class="cart-img" style="flex: 0 0 300px;">
                                      <img src="img/empty-cart.png"> 
                                    </div>

                                </li>';    
                            
                        }  
                        
                        $output.='<li>
                            <div class="total-price">
                                <span class="f-left">Total:</span>
                                <span class="f-right">£'.number_format(($totalCart['total_cost']),2).'</span>
                            </div>
                        </li>';
                        
                         if($count > 0){
                        
                        $output.='<li>
                            <div class="checkout-link">
                                <a href="view-cart.php">View Cart</a>
                                <a class="black-color" href="checkout.php">Checkout</a>
                            </div>
                        </li>';
                        
                        } else {
                            
                        $output.='<li>
                            <div class="checkout-link">
                                <a href="javascript:void(0)">View Cart</a>
                                <a class="black-color" href="javascript:void(0)">Checkout</a>
                            </div>
                        </li>';
                            
                        }
                        
                    $output.='</ul>
                </div>
                <div class="cart-amount">£'.number_format(($totalCart['total_cost']),2).'</div>';
                                
            echo $output;
        
       } else if($_REQUEST['action'] == 'addWhishlistItem' && !empty($_REQUEST['id'])){
                
            $cust_id=$_SESSION['logged_id'];
            $prd_id=$_REQUEST['id'];   
            
            $add_whishlist=mysqli_query($con,"INSERT INTO `wishlist` (`cust_id`, `prd_id`, `create_date`) VALUES ('$cust_id', '$prd_id', CURDATE())");    
                
       } else if($_REQUEST['action'] == 'removeWhishlistItem' && !empty($_REQUEST['id'])){

        $prd_id=$_REQUEST['id'];   
        
        $add_whishlist=mysqli_query($con,"update `wishlist` set is_active='0' where id='".$prd_id."' and is_active='1'");        

      } else if($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['logged_id'])){
        // insert order details into database
        
        $ord_value = $db->query("SELECT * FROM generate_id WHERE id='1' and is_active='1'");
        $ord_row = $ord_value->fetch_array();
        $ord_inc_value=$ord_row['pref_name'].''.$ord_row['inc_num'];
        
        if($tax_details['status']=='1')
        {
        
            $vat_amt=$cart->total1()/100*$tax_details['tax_percentage'];
            
            $tot_amount= $cart->total1() + $vat_amt; 
            
        } else {
            
            
            $vat_amt=0;
            
            $tot_amount= $cart->total1();
            
        }
         
        $_SESSION['order_id']=$ord_inc_value;
        
        $insertOrder = $db->query("INSERT INTO orders (customer_id, order_id, order_date, subtotal, vat_amt, total_price, created, modified) VALUES ('".$_SESSION['logged_id']."', '".$ord_inc_value."', '".date("Y-m-d")."', '".$cart->total1()."', '".$vat_amt."', '".$tot_amount."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
        
        if($insertOrder){
            
            $orderID = $ord_inc_value;
            $sql = '';
            // get cart items
            $cartItems = $cart->contents();
            
            foreach($cartItems as $item){
                 
                
                $sql .= "INSERT INTO order_items (order_id, product_id, product_name, product_img, quantity, unit_price, product_price, order_date) VALUES ('".$orderID."', '".$item['id']."', '".$item['name']."', '".$item['img']."', '".$item['qty']."', '".$item['price']."', '".$item['subtotal']."', '".date("Y-m-d")."');";
               
            }
            
               // insert order items into database
               $insertOrderItems = $db->multi_query($sql);
            
               if($insertOrderItems){
                   
                 $ord_value_id = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM generate_id WHERE id='1' and is_active='1'"));   
                 $inc_value=$ord_value_id['inc_num']+1;
                 $update_gen_val= mysqli_query($con,"update generate_id set inc_num='".$inc_value."' WHERE id='1' and is_active='1'");
                 
                 $destory_cart = $cart->destroy();
                   
                 header("Location: order_success.php");
               
            } else {
                
                header("Location: checkout.php");
            }
            
        } else{
            
            header("Location: checkout.php");
        }
        
    } else {
        
        header("Location: index.php");
    }
    
} else{
    
    header("Location: index.php");
}