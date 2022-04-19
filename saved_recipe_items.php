<?php

session_start();
include 'Cart.php';
$cart = new Cart;
include('includes/config.php');

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
    </head>
    <body>

        <!-- preloader -->
        <!-- <div id="preloader">
            <div id="loading-center">
               <img src="img/spinner.gif">
            </div>
        </div> -->
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
                                    <li class="breadcrumb-item active" aria-current="page">Saved Recipes</li>
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
                    <div class="row justify-content-center">
                        <div class="col-xl-12">
                            <div class="cart-wrapper">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Recipe Name</th>
                                                <th>Grinding Type</th>
                                                <th>Comments</th>
                                                <th>Created Date</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        <?php
                                        $i=1;
                                        $order_details=mysqli_query($con,"select * from reacipies where customer_id='".$_SESSION['logged_id']."' and is_active='1' ORDER BY id DESC");
                                        while($order_details_row=mysqli_fetch_array($order_details))
                                        {
                                        ?>    
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><a href="javascript:void(0)" onclick="order_items('<?php echo $order_details_row['id']; ?>')"><?php echo $order_details_row['recipe_name']; ?></a></td>
                                                <td><?php echo $order_details_row['grinding_type']; ?></td>
                                                <td><?php echo $order_details_row['cust_own_desc']; ?></td>
                                                <td><?php echo date('d-m-Y',strtotime($order_details_row['created'])); ?></td>
                                                <td class="product-subtotal"><span>£ <?php echo $order_details_row['total_price']; ?></span></td>
                                                <td>
                                                    <a type="button" href="javascript:void(0)" onclick="addRecipeToDeals(<?php echo $order_details_row['id']; ?>,'Continental Cuisine')" class="btn btn-success"><i class="flaticon-shopping"></i>&nbsp;</a>
                                                    <a href="update_recipe.php?id=<?= $order_details_row['id'] ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> </a>
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal<?=$order_details_row['id'] ?>" title="share Recipe" > <i class="fa fa-share"></i> </button>
                                                    <a type="button" href="javascript:void(0)" class="btn btn-info btn-sm" style="background-color: #03a9f4;"><i class="fas fa-edit"></i>&nbsp;</a>
                                                    <a type="button" href="customize_own_spice.php?delete=<?php echo $order_details_row['id']; ?>"  onclick="return confirm('You want to delete this recipe?');" class="btn btn-danger btn-sm" style="background-color: red;"><i class="far fa-trash-alt"></i>&nbsp;</a>
                                                </td>

                                            </tr>


                                            <div class="modal fade" id="exampleModal<?=$order_details_row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Share Recipe with another site user</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                         <form action="" method="post">
                                                              <div class="form-group">
                                                                  <label for="">Recipe</label>
                                                                  <input type="text" class="form-control" readonly  value="<?=$order_details_row['recipe_name'] ?>">
                                                              </div>
                                                              <input type="hidden" name="recipe_id" value="<?= $order_details_row['id'] ?>">
                                                              <div class="form-group">
                                                                  <label for="">Enter Email</label>
                                                                  <input type="text" name="email" id="" class="form-control">
                                                              </div>
                                                              <div class="form-group">
                                                                  <button class="btn btn-info" type="submit" name="shareRecipe" >Submit</button>
                                                              </div>
                                                         </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>

                                    <?php $i=$i+1; } ?>    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="shop-cart-bottom">
                                <div class="continue-shopping">
                                    <a href="customize_own_spice.php" class="btn">Continue Shopping</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if(isset($_POST['shareRecipe'])){
                $recipe_id   = $_POST['recipe_id'];
                $email       = $_POST['email'];

                $query = mysqli_query($con, "SELECT * from customers where email_id='".$email."' ");

                if($query->num_rows) {
                    $userDetails  = mysqli_fetch_assoc($query);
                    $userId       = $userDetails['id'];

                    $recipequery   = mysqli_query($con, "SELECT * from reacipies where id='".$recipe_id."'");
                    $recipeDetails = mysqli_fetch_assoc($recipequery);

                    $recipeDetails['customer_id'] = $userId;

                    $insert_recipes   = mysqli_query($con,"INSERT INTO reacipies (customer_id, subtotal, total_price, order_form, recipe_name, grinding_type, cust_own_desc, created, modified) 
                    VALUES ('".$userId."', '".$recipeDetails['subtotal']."', '".$recipeDetails['total_price']."', '2', '".$recipeDetails['recipe_name']."', '".$recipeDetails['grinding_type']."', '".$recipeDetails['cust_own_desc']."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
                    
                    $newRecipeId = mysqli_insert_id($con);


                    $recipeItemsquery  = mysqli_query($con, "SELECT * from reacipie_items where reacipie_id='".$recipe_id."'");
                   
                    while($row_array = mysqli_fetch_assoc($recipeItemsquery)) {
                        
                        $insert_recipe_items=mysqli_query($con,"INSERT INTO reacipie_items (reacipie_id, product_id, product_name, product_img, quantity, product_price, spices_type, order_date) 
                        VALUES ('".$newRecipeId."', '".$row_array['product_id']."', '".$row_array['product_name']."', '".$row_array['product_img']."', '".$row_array['quantity']."', '".$row_array['product_price']."', '".$row_array['spices_type']."', '".date("Y-m-d")."')");
                    }

                    // die(mysqli_error($con));

                    echo "<script>alert('Recipe has been shared!');location.replace('saved_recipe_items.php');</script>";

                } else {
                    echo "<script>alert('This user not found....!') </script>";
                }
            }
            
            
            
            ?>
            <!-- cart-area-end -->
            
            <div class="modal fade bd-example-modal-lg" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document" style="max-width: 800px;">
                    <div class="modal-content">
                      <div class="modal-header border-bottom-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-title text-center">
                          <h4>Recipe Spices Details</h4>
                        </div>
                       <div class="row">
                           <div class="col-md-12" id="order_details_item">
                           </div>
                       </div>
                    </div>
                    
                  </div>
                 </div>
            </div>    

        </main>
        <!-- main-area-end -->


        <!-- footer-area -->
         <?php include('includes/footer.php'); ?>
        <!-- footer-area-end -->

		<!-- JS here -->
        <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="js/vendor/jquery-3.6.0.min.js"></script>
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
        <script>
            
            
            function order_items(id){
        	  
              $.ajax({
              url : "ajax_order_details.php",
              data : {id:id },
              type : 'post',
              success : function(response) {
                  
               $('#order_details_item').html(response);
               
               $('#order_details').modal('show');
              
              }
              
            });    
              
          }
		    
		</script>
    </body>
</html>
