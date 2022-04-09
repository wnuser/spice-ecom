<?php
session_start();

include('./includes/config.php');

if(isset($_POST['id'])){
    
    $reacipies_id=$_POST['id'];
    
    $order_details=mysqli_fetch_array(mysqli_query($con,"select * from reacipies where customer_id='".$_SESSION['logged_id']."' and is_active='1'"));
    
    $output='<div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th class="product-name">S.No</th>
                            <th class="product-price">Image</th>
                            <th class="product-price">Product Name</th>
                            <th class="product-price">Qty</th>';
                            if($order_details['order_form']=='2')
                            {
                              $output.='<th class="product-price">Row/Roasted</th>';
                            } else {
                                
                              $output.='<th class="product-price">Price</th>
                              <th class="product-subtotal">Total</th>';
                                
                            }
                             
                        $output.='</tr>
                    </thead>
                    <tbody>';
                    $j=1;
                    $tot_item_amt=0;
                    $order_items=mysqli_query($con,"select * from reacipie_items where reacipie_id='".$reacipies_id."' and is_active='1'");
                    while($order_items_rows=mysqli_fetch_array($order_items))
                    {
                        
                        $tot_item_amt=$tot_item_amt+$order_items_rows['product_price'];
                        
                        $output.='<tr>
                        <td>'.$j.'</td>
                        <td><img src="../'.$order_items_rows['product_img'].'" style="width:50px;height:50px;"></td>
                        <td>'.$order_items_rows['product_name'].'</td>
                        <td>'.$order_items_rows['quantity'].'</td>';
                        if($order_details['order_form']=='2')
                        {
                          $output.='<td>'.$order_items_rows['spices_type'].'</td>';
                          
                        } else {
                            
                        $output.='<td>'.number_format($order_items_rows['unit_price'],2).'</td>
                        <td>'.number_format($order_items_rows['product_price'],2).'</td>';
                        
                        }
                        
                        $output.='</tr>';
                        
                        $j=$j+1;
                        
                    }
    
                $output.='</tbody>
                <tfoot>
                <tr>
                <th colspan="4" style="text-align: right;">Subtotal</td>
                <th colspan="">'.number_format($tot_item_amt,2).'</th>
                </tr>
              
                </tfoot>
                        </table>
                    </div>';
    
    echo $output;
    
}                                            

?>