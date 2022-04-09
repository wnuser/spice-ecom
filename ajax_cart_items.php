<?php
session_start();
include 'Cart.php';
$cart = new Cart;
include('includes/config.php');

$output='';

$output.='<div class="col-xl-8">
                            <div class="cart-wrapper">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail"></th>
                                                <th class="product-name">Product</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-quantity">Quantity</th>
                                                <th class="product-subtotal">Total</th>
                                                <th class="product-delete"></th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                       
                                        $getCartDataQry = mysqli_query($con,"select * from cart where customer_id='".$_SESSION['logged_id']."'");
                                        $getCartTotal = mysqli_query($con,"select SUM(price * quantity) as total_cost from cart where customer_id='".$_SESSION['logged_id']."'");
                                        $count = mysqli_num_rows($getCartDataQry);
                                        $totalCart = mysqli_fetch_assoc($getCartTotal);

                                         if($count > 0){
                                             
                          
                                            while($cartData = mysqli_fetch_assoc($getCartDataQry)) {
                                            
                                            $output.='<tr>
                                                <td class="product-thumbnail">';
                                                if($cartData['reacipie_id'])
                                                {
                                                    $output.='<a href="javascript:void(0)"><img src="img/rec_item.png" alt=""></a>';

                                                } else {
                                                    $output.='<a href="javascript:void(0)"><img src="'.$cartData['product_img'].'" alt=""></a>';
                                                } 
                                                $output.='</td>
                                                
                                                <td class="product-name">';
                                                if($cartData['reacipie_id'])
                                                {
                                                    $output.='<h4><a href="javascript:void(0)" onclick="order_items('.$cartData['reacipie_id'].')">'.$cartData['product_name'].'</a></h4>';
                                                } else {
                                                $output.='<h4><a href="javascript:void(0)">'.$cartData['product_name'].'</a></h4>';
                                                }
                                                $output.='</td>
                                                <td class="product-price">£ '.number_format($cartData['price'],2).'</td>
                                                <td class="product-quantity">
                                                    <div class="cart--plus--minus">
                                                        <form action="#" class="num-block">
                                                            <input type="text" class="in-num" id="input-quantity-'.$cartData["id"].'" min="1" value="'.$cartData["quantity"].'" readonly="">
                                                            <div class="qtybutton-box">
                                                                <span class="plus"><i class="fas fa-angle-up" onclick="increment_quantity('.$cartData["id"].')")"></i></span>
                                                                <span class="minus dis"><i class="fas fa-angle-down" onclick="decrement_quantity('.$cartData["id"].')"></i></span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal"><span>£ '.number_format($cartData['price'] * $cartData['quantity'],2).'</span></td>
                                                <td class="product-delete"><a href="javascript:void(0)"><i class="far fa-trash-alt" onclick="removeCartItem('.$cartData["id"].')"></i></a></td>
                                            </tr>';
                                            
                                         } } else { 
                                        
                                          $output.='<tr>
                                          <td colspan="6"><h5 style="text-align:center;"><a href="#">Your Cart is Empty..</a></td>
                                          </tr>';
                                        
                                         } 
                                            
                                       $output.='</tbody>
                                       
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12">
                            <div class="shop-cart-total sticky-static-top">
                                <h3 class="title">Cart Totals</h3>
                                <div class="shop-cart-widget">
                                    <div class="form">
                                        <ul>
                                            <li class="sub-total"><span>Subtotal</span>£ '.number_format(($totalCart['total_cost']),2).'</li>';
                                            
                                            $output.='<li class="sub-total"><span>Shipping</span>Free</li>
                                            <li class="cart-total-amount"><span>Total Price</span> <span class="amount">£ '.number_format($totalCart['total_cost'],2).'</span></li>
                                        </ul>';
                                        
                                        if($count > 0){
                                        
                                        $output.='<a href="checkout.php" class="btn">PROCEED TO CHECKOUT</a>';
                                        
                                        } else {
                                            
                                         $output.='<a href="javascript:void(0)" class="btn">PROCEED TO CHECKOUT</a>';    
                                         
                                        }
                                    $output.='</div>
                                </div>
                            </div>
                        </div>';
   echo $output;

?>