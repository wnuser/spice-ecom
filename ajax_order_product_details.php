<?php
session_start();
include 'Cart.php';
$cart = new Cart;
include('includes/config.php');

if(isset($_POST['id'])){
    
    $reacipies_id=$_POST['id'];
    
    $order_details = mysqli_query($con,"SELECT * FROM order_product WHERE order_id = '".$reacipies_id."' AND customer_id ='".$_SESSION['logged_id']."' ");
    
    $output='<div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th class="product-name">S.No</th>
                            <th class="product-price">Image</th>
                            <th class="product-price">Product Name</th>
                            <th class="product-price">Qty</th>';
                                
                              $output.='<th class="product-price">Price</th>
                              <th class="product-subtotal">Total</th>';
                             
                        $output.='</tr>
                    </thead>
                    <tbody>';
                    $j=1;
                    $tot_item_amt=0;
                    while($orderdetails1 = mysqli_fetch_array($order_details))
                    {
                        if($orderdetails1['product_id'])
                        {
                            $order_items = mysqli_query($con,"select * from our_products where id='".$orderdetails1['product_id']."' and is_active='1'");
                            $order_item_product = mysqli_fetch_array($order_items);
                            
                                $output.='<tr>
                                <td>'.$j.'</td>
                                <td><img src="admin/assets/img/deals/'.$order_item_product['product_image'].'" style="width:50px;height:50px;"></td>
                                <td>'.$order_item_product['product_name'].'</td>
                                <td>'.$orderdetails1['product_quantity'].'</td>';
                                    
                                $output.='<td>'.number_format($orderdetails1['product_price'],2).'</td>
                                <td>'.number_format($orderdetails1['product_total'],2).'</td>';
                                
                                $output.='</tr>';
                                
                                $j=$j+1;
                            
                        } else {

                            $order_items = mysqli_query($con,"select * from reacipies where id='".$orderdetails1['reacipie_id']."' ");
                            $order_item_product = mysqli_fetch_array($order_items);
                            
                                $output.='<tr>
                                <td>'.$j.'</td>
                                <td><img src="img/rec_item.png" style="width:50px;height:50px;"></td>
                                <td>'.$order_item_product['recipe_name'].'</td>
                                <td>'.$orderdetails1['product_quantity'].'</td>';
                                    
                                $output.='<td>'.number_format($orderdetails1['product_price'],2).'</td>
                                <td>'.number_format($orderdetails1['product_total'],2).'</td>';
                                
                                $output.='</tr>';
                                
                                $j=$j+1;
                        }
                    }
    
                $output.='</tbody>
                <tfoot>
                </tfoot>
                        </table>
                    </div>';
    
    echo $output;
    
}                                            

?>