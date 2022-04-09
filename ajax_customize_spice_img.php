<?php
session_start();
include 'Cart.php';
$cart = new Cart;
include('includes/config.php');

if(isset($_POST['spices_id'])){
    
    $spices_img_id=$_POST['spices_img_id'];
    
    $spices_details=mysqli_fetch_array(mysqli_query($con,"select * from spices_list where id='".$_POST['spices_id']."' and status='1' and is_active='1'"));
    
    $output='<a href="javascript:void(0)"><img src="admin/assets/img/spices/'.$spices_details['spices_images'].'" alt=""></a>';
    
    $output.='<input type="hidden" name="spices_price[]" id="spices_price_'.$spices_img_id.'" value="'.$spices_details['after_stock_price'].'">';
    
    $output.='<input type="hidden" name="spices_name[]" id="spices_name_'.$spices_img_id.'" value="'.$spices_details['spices_name'].'">';
    
    echo $output;
    
}                                            

?>