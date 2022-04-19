<?php
session_start();
include 'Cart.php';
$cart = new Cart;
include('includes/config.php');

if(isset($_POST['customize_spice']))
{
  $spices_price     = array();
  $spices_name      = array();
  $spices_ids       = array();
  $prd_qty          = array();
  $spices_inv_total = array();

  $customers    = mysqli_query($con,"select * from customers where id='".$_SESSION['logged_id']."' and is_active=1");
  $cust_details = mysqli_fetch_array($customers);
  
  $first_name    =$cust_details['first_name'];
  $last_name     =$cust_details['last_name'];
  $cust_email_id =$cust_details['email_id'];
  $address       =$cust_details['address'];
  $town_city     =$cust_details['town_city'];
  $postal_code   =$cust_details['postal_code'];
  $country       =$cust_details['country'];
  $phone_no      =$cust_details['phone'];
  
  $recipe_name   =$_POST['recipe_name'];
  
  $spices_price  = $_POST['spices_price'];
  $spices_name   = $_POST['spices_name'];
  $spices_ids    = $_POST['spices_ids'];
  $prd_qty          = $_POST['prd_qty'];
  $spices_inv_total = $_POST['spices_inv_total'];
  $grinding_type    = $_POST['grinding_type'];
  $cust_own_desc    = $_POST['cust_own_desc'];
  $total_price      = $_POST['total_price'];
  
  $enquiry_details  = mysqli_fetch_array(mysqli_query($con,"select * from generate_id where id='1' and is_active='1'"));
  $ord_inc_value    = $enquiry_details['pref_name'].''.$enquiry_details['inc_num'];
  
  $insert_recipes   = mysqli_query($con,"INSERT INTO reacipies (customer_id, subtotal, total_price, order_form, recipe_name, grinding_type, cust_own_desc, created, modified) 
   VALUES ('".$_SESSION['logged_id']."', '".$total_price."', '".$total_price."', '2', '".$recipe_name."', '".$grinding_type."', '".$cust_own_desc."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
   $recipe_id = mysqli_insert_id($con);


   for($i=0;$i<count($spices_ids);$i++)
	{
       
        $inc_no  = $i+1;
       
        $spice_type=$_POST['raw_roasted'.$inc_no.''];
       
        $spices_details=mysqli_fetch_array(mysqli_query($con,"select * from spices_list where id='".$spices_ids[$i]."' and status='1' and is_active='1'"));
        
        $spices_image="admin/assets/img/spices/".$spices_details['spices_images'];

        $insert_recipe_items=mysqli_query($con,"INSERT INTO reacipie_items (reacipie_id, product_id, product_name, product_img, quantity, product_price, spices_type, order_date) 
        VALUES ('".$recipe_id."', '".$spices_ids[$i]."', '".$spices_name[$i]."', '".$spices_image."', '".$prd_qty[$i]."', '".$spices_inv_total[$i]."', '".$spice_type."', '".date("Y-m-d")."')");

        if($insert_recipe_items) {

        }else {
            die(mysqli_error($con));
 
        }
       
    }
  
   if($insert_recipes==true)
    {
        
     $ord_value_id = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM generate_id WHERE id='1' and is_active='1'"));   
     $inc_value=$ord_value_id['inc_num']+1;
     $update_gen_val= mysqli_query($con,"update generate_id set inc_num='".$inc_value."' WHERE id='1' and is_active='1'");    

    echo "<script>location.href='saved_recipe_items.php';</script>";
    
    } else {
        
         echo "<script>alert('Opps! Something went wrong.');</script>";
        
    }
  
}

if(isset($_REQUEST['delete']))
{
    $recDelete = mysqli_query($con,"DELETE FROM reacipies WHERE id='".$_REQUEST['delete']."' AND customer_id='".$_SESSION['logged_id']."' ");
    $recItemDelete = mysqli_query($con,"DELETE FROM reacipie_items WHERE reacipie_id='".$_REQUEST['delete']."' ");
    if($recDelete || $recItemDelete)
    {
        echo "<script>alert('Your reacipies has been delete successfully!.');location.href='saved_recipe_items.php';</script>";
    } else {
         echo "<script>alert('Opps! Something went wrong.');</script>";
    }
}

?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Eternal Seasoning - Customize your Own Spice Mix</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
        <!-- Place favicon.ico in the root directory -->

		<!-- CSS here -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="css/fontawesome-all.min.css">
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" href="css/flaticon.css">
        <link rel="stylesheet" href="css/aos.css">
        <link rel="stylesheet" href="css/slick.css">
        <link rel="stylesheet" href="css/default.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
        
        .sticky-static-top {
            position: sticky;
            top: 85px;
        }
        
        #error_message {
            
            margin-top: 15px;
            margin-bottom: 15px;
            color: #ef3f3f;
            font-weight: bold;    
            
        }
        
        </style>
        
    </head>
    <body>

        <!-- preloader -->
        <div id="preloader">
            <div id="loading-center">
               <img src="img/spinner.gif">
            </div>
        </div>
        <!-- preloader-end -->

		<!-- Scroll-top -->
        <button class="scroll-top scroll-to-target" data-target="html">
            <i class="fas fa-angle-up"></i>
        </button>
        <!-- Scroll-top-end-->

        <!-- header-area -->
        <?php include('includes/header.php'); ?>
        <!-- header-area-end -->


        <!-- main-area -->
        <main>

            <!-- breadcrumb-area -->
            <section class="breadcrumb-area breadcrumb-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">Customize your Own Spice Mix</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Customize your Own Spice Mix</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>      
            <!-- breadcrumb-area-end -->

            <!-- cart-area -->
            <div class="cart-area pt-90 pb-90">
                <div class="container">
                    
                 <form method="post" autocomplete="off">  
                   
                   <p style="color: #9f1d28;font-size: 17px;font-weight: 600;">* Minimum purchase order 200g</p>
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                            <div class="cart-wrapper">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <input type="text" class="form-control" name="recipe_name" id="recipe_name" placeholder="Name your seasoning" required> 
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail"></th>
                                                <th class="product-name">Add Your Spice</th>
                                                <th class="product-quantity">Quantity</th>
                                                <th class="product-subtotal">Raw/Roasted</th>
                                                <th class="product-delete"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body">
                                            <tr class="single-row">
                                                <td class="product-thumbnail spce-image-1"><a href="javascript:void(0)"><img src="img/product/cart_img01.jpg" alt=""></a></td>
                                                <td class="product-name">
                                                <select class="form-control spices_list" name="spices_ids[]" id="spices_ids1" onchange="spices_image(1,this.value)" required>
                                                    <option value="">Select Spices</option>    
                                                    <?php
                                                    $spices_list=mysqli_query($con,"select * from spices_list where status='1' and is_active='1'");
                                                    while($spices_list_row=mysqli_fetch_array($spices_list))
                                                    {
                                                    ?>
                                                    <option value="<?php echo $spices_list_row['id']; ?>"><?php echo $spices_list_row['spices_name']; ?></option>
                                                    <?php } ?>
                                                  </select>    
                                                </td>
                                                <input type="hidden" class="spices_inv_total" name="spices_inv_total[]" id="spices_inv_total1">
                                                <td class="product-quantity">
                                                    <div class="shop-perched-info">
                                                        <div class="sd-cart-wrap">
                                                          <div class="cart-plus-minus">      
                                                                <input type="text" class="qty" placeholder="0" name="prd_qty[]" id="prd_qty1" onchange="update_quantity(1)"  required>
                                                           </div>         
                                                        </div>
                                                        <p>Grams</p>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal">
                                                    <input type="radio" name="raw_roasted1" id="raw_roasted1" value="Raw" required>&nbsp;Raw&nbsp;&nbsp;
                                                    <input type="radio" name="raw_roasted1" id="raw_roasted1" value="Roasted">&nbsp;Roasted
                                                </td>
                                                <td class="product-delete"><a href="javascript:void(0)"><i class="far fa-trash-alt"></i></a></td>
                                            </tr>
                                            
                                            <tr>
                                               <td colspan="2">
                                                  <div class="shop-cart-bottom">
                                                        <div class="continue-shopping">
                                                            <a type="button" href="javascript:void(0)" id="add-row" class="btn"> + ADD ITEM</a>
                                                        </div>
                                                    </div> 
                                               </td>
                                               <td>Total Weight : <span id="total-weight">0</span> <span>Grams</span> </td>
                                               <td colspan="2">
                                                  <div class="shop-cart-bottom">
                                                        <div class="continue-shopping">
                                                            <button type="button" href="javascript:void(0)" id="add-row" class="btn" style="background: cadetblue;" onclick="overallSum()">CREATE RECIPE</button>
                                                        </div>
                                                    </div> 
                                               </td>
                                           </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <p id="error_message"></p>  
                            
                            <div class="row" style="margin-top:15px;">
                                <div class="col-md-6">
                                    <label>Grinding Type</label>
                                    <div class="form-group">
                                        <input type="radio" name="grinding_type" id="grinding_type" value="Powder" required>&nbsp;Powder&nbsp;
                                        <input type="radio" name="grinding_type" id="grinding_type" value="Coarse" >&nbsp;Coarse&nbsp;
                                        <input type="radio" name="grinding_type" id="grinding_type" value="Semi Coarse" >&nbsp;Semi Coarse&nbsp;
                                        <input type="radio" name="grinding_type" id="grinding_type" value="Flakes" >&nbsp;Flakes&nbsp;
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label>Add Comments</label>
                                    <div class="form-group">
                                        <textarea class="form-control" name="cust_own_desc" id="cust_own_desc"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-xl-4 col-lg-12">
                            <div class="shop-cart-total sticky-static-top">
                                <h3 class="title">Cart Totals</h3>
                                <div class="shop-cart-widget">
                                    <div class="form">
                                        <ul>
                                            <input type="hidden" name="total_price" id="total_price" value="0">
                                            <li class="sub-total"><span>Subtotal</span> <span class="amount">£ 0.00</span></li>
                                            <li class="cart-total-amount"><span>Total Price</span> <span class="amount">£ 0.00</span></li>
                                        </ul><br>
                                        <input type="submit" id="customize_spice" name="customize_spice" class="btn" value="SAVE RECIPE" style="display:none;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                   </form> 
                </div>
            </div>
            <!-- cart-area-end -->

        </main>
        <!-- main-area-end -->

        <!-- footer-area -->
        <?php include('includes/footer.php'); ?>
        <!-- footer-area-end -->


		<!-- JS here -->
        <script src="js/vendor/jquery-3.6.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/isotope.pkgd.min.js"></script>
        <script src="js/imagesloaded.pkgd.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/jquery.countdown.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/ajax-form.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/aos.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		
		<script>
           
        $('.spices_list').select2();
        
           function increment_quantity(cart_id) {
                var inputQuantityElement = $("#prd_qty"+cart_id);
                var newQuantity = parseInt($(inputQuantityElement).val())+5;
                
                $("#prd_qty"+cart_id).val(newQuantity);
                
                var spice_price=$("#spices_price_"+cart_id).val();
                
                if(spice_price > 0 )
                {
                
                    var per_gram_amt=(spice_price/1000);
                    
                    var gram_total_amt=(per_gram_amt * newQuantity);
                    
                    $('#spices_inv_total'+cart_id).val(gram_total_amt.toFixed(2));
                    
                   // overallSum();
                   
                
                }
                
            }
            
            function decrement_quantity(cart_id) {
                
                var inputQuantityElement = $("#prd_qty"+cart_id);
                if($(inputQuantityElement).val() > 1) 
                {
                var newQuantity = parseInt($(inputQuantityElement).val()) - 5;
                
                $("#prd_qty"+cart_id).val(newQuantity);
                
                var spice_price=$("#spices_price_"+cart_id).val();
                
                if(spice_price > 0)
                {
                
                    var per_gram_amt=(spice_price/1000);
                    
                    var gram_total_amt=(per_gram_amt * newQuantity);
                    
                    $('#spices_inv_total'+cart_id).val(gram_total_amt.toFixed(2));
                    
                   // overallSum();
                
                }
                
                }
            }
            
            
             function update_quantity(cart_id) {
                
                var inputQuantityElement = $("#prd_qty"+cart_id);
                
                var newQuantity = parseInt($(inputQuantityElement).val());
                
                if($(inputQuantityElement).val() >=5) 
                {
                
                    var spice_price=$("#spices_price_"+cart_id).val();
                    
                    if(spice_price > 0)
                    {
                    
                        var per_gram_amt=(spice_price/1000);
                        
                        var gram_total_amt=(per_gram_amt * newQuantity);
                        
                        $('#spices_inv_total'+cart_id).val(gram_total_amt.toFixed(2));
                        
                       // overallSum();
                    
                    }
                
                }
            }
            
        
        </script>
        
                <script>
    		    //Add new row
                const tBody = document.getElementById("table-body");
                
                let t = 2;

                addNewRow =()=> {
                    
                    const row = document.createElement("tr");
                    row.className = "single-row";
                    
                    var NodesString = '';
                    
                                NodesString+='<td class="product-thumbnail spce-image-'+t+'"><a href="javascript:void(0)"><img src="img/product/cart_img01.jpg" alt=""></a></td>';
                                NodesString+='<td class="product-name">';
                                NodesString+='<select class="form-control spices_list" name="spices_ids[]" id="spices_ids'+t+'" onchange="spices_image('+t+',this.value)" required>';
                                NodesString+='<option value="">Select Spices</option>';    
                                <?php
                                $spices_list=mysqli_query($con,"select * from spices_list where status='1' and is_active='1'");
                                while($spices_list_row=mysqli_fetch_array($spices_list))
                                {
                                ?>
                                NodesString+='<option value="<?php echo $spices_list_row['id']; ?>"><?php echo $spices_list_row['spices_name']; ?></option>';
                                <?php } ?>
                                NodesString+='</select>';    
                                NodesString+='</td><input type="hidden" class="spices_inv_total" name="spices_inv_total[]" id="spices_inv_total'+t+'">';
                                NodesString+='<td class="product-quantity">';
                                NodesString+='<div class="shop-perched-info">';
                                NodesString+='<div class="sd-cart-wrap">';
                                NodesString+='<div class="cart-plus-minus">';
                                NodesString+='<input type="text" class="qty" value="0" name="prd_qty[]" id="prd_qty'+t+'" onchange="update_quantity('+t+')" required>';
                                NodesString+='<div class="dec qtybutton" onclick="decrement_quantity('+t+')">-</div><div class="inc qtybutton" onclick="increment_quantity('+t+')">+</div></div>';
                                NodesString+='</div>';
                                NodesString+=' <p>Grams</p></div>';
                                NodesString+='</td>';
                                NodesString+='<td class="product-subtotal">';
                                NodesString+='<input type="radio" name="raw_roasted'+t+'" id="raw_roasted'+t+'" value="Raw" required>&nbsp;Raw&nbsp;&nbsp;';
                                NodesString+='<input type="radio" name="raw_roasted'+t+'" id="raw_roasted'+t+'" value="Roasted">&nbsp;Roasted';
                                NodesString+='</td>';
                                NodesString+='<td class="add-remove product-delete"><i class="far fa-trash-alt" action="delete"></i></td>';
                                
                               row.innerHTML = NodesString;
                    
                               tBody.insertBefore(row, tBody.lastElementChild.previousSibling);
                               
                                t += 1; 
                    
                               $('.spices_list').select2(); 
                }


                document.getElementById("add-row").addEventListener("click", (e)=> {
                    e.preventDefault();
                    addNewRow();
                });
           
            
                //Get the overall sum/Total
                overallSum =()=> {
                
               
                    var arr = document.getElementsByClassName("spices_inv_total");
                    
                    var total = 0;
                    for(var i = 0; i < arr.length; i++) {
                        if(arr[i].value) {
                            total += +arr[i].value;
                        }
                        
                    }

                    var qtyarr = document.getElementsByClassName("qty");
                    var totalWeight  = 0;
                    for (var index = 0; index < qtyarr.length; index++) {
                        if(qtyarr[index].value) {
                            totalWeight += +qtyarr[index].value;
                        }
                    }

                    $('#total-weight').empty();
                    $('#total-weight').append(totalWeight);


                    
                    var list = document.getElementsByClassName("qty");
                    var values = [];
                    for(var i = 0; i < list.length; ++i) {
                        values.push(parseFloat(list[i].value));
                    }
                    total_qty = values.reduce(function(previousValue, currentValue, index, array){
                        return previousValue + currentValue;
                    });
                    
                    if(total_qty >= 200) {
                    
                    $('#error_message').html("");
                        
                    $("#customize_spice").css("display", "block");
                    
                    $('.sub-total span.amount').html('£ '+total.toFixed(2));
                    
                    $('.cart-total-amount span.amount').html('£ '+total.toFixed(2));
                    
                    $('#total_price').val(total.toFixed(2)); 
                        
                    } else {
                        
                         $("#customize_spice").css("display", "none");
                       
                         $('#error_message').html("Minimum purchase order 200g.");
                        
                    }
            }
            
            
            //Delete row from the table
            tBody.addEventListener("click", (e)=>{
                let el = e.target;
                const deleteROW = e.target.attributes.action.value;
                if(deleteROW == "delete") {
                    delRow(el);
                   // overallSum();
                }
            })
            
            //Target row and remove from DOM;
            delRow =(el)=> {
                el.parentNode.parentNode.parentNode.removeChild(el.parentNode.parentNode);
            }
            
		</script>
		<script>
            
            function spices_image(spices_img_id,spices_id){
        	  
                $.ajax({
            		url : "ajax_customize_spice_img.php",
            		data : {spices_img_id:spices_img_id,spices_id:spices_id },
            		type : 'post',
            		success : function(response) {
            		 
            		 $('.spce-image-'+spices_img_id).html(response);
            		
            		}
            		
            	});    
                
            }
    
		    
		</script>
        
    </body>
</html>
