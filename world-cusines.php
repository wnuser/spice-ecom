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
        <title>Eternal Seasoning - Cusines Categories</title>
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
        
        <style>
        
         .appadd {

            white-space: nowrap;
            overflow: hidden;
            width: 250px;
            height: 20px;
            text-overflow: ellipsis; 
            
            }     
        
        .discount-thumb img {
            
            object-fit: cover;
            opacity: 0.4;
        }    
        
        .sp-product-thumb {
            position: relative;
            padding: 20px 15px 0px;
        }
        
        .sp-product-content {
            padding: 15px 20px 16px;
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
        
        <?php 
        $cousine_details=mysqli_fetch_array(mysqli_query($con,"select * from cusines where id='".$_GET['category']."' and status='1' and is_active='1'"));
        ?> 
        
        <section class="breadcrumb-area breadcrumb-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">World Cusines</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">World Cusines</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>    
            
        
         <!-- special-products-area -->
            <section class="special-products-area gray-bg pt-50 pb-60">
                <div class="container">
                    <div class="special-products-wrap">
                        <div class="row justify-content-center">
                             <div class="col-3 order-2 order-lg-0" style="background: #fff;padding: 15px;">
                                <aside class="shop-sidebar">
                                    <div class="widget shop-widget">
                                        <div class="shop-widget-title">
                                            <h6 class="title">World Cusines</h6>
                                        </div>
                                        <div class="shop-cat-list">
                                            <ul>
                                            <?php 
                                            $cusines=mysqli_query($con,"select * from cusines where status='1' and is_active='1'");
                                            while($cusines_row=mysqli_fetch_array($cusines))
                                            {
                                            ?>        
                                                <li class="<?= ($cusines_row['id'] == $_GET['category']) ? 'active':''; ?>"><a href="world-cusines.php?category=<?php echo $cusines_row['id']; ?>"><?php echo $cusines_row['cusine_name']; ?> <span>+</span></a></li>
                                            <?php } ?>    
                                            </ul>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                            <div class="col-9">
                                <div class="row justify-content-center">
                                
                                <?php 
                                
                                $query='';
                                
                                if(isset($_GET['category']))
                                {
                                  
                                  $get_cusines=mysqli_query(mysqli_query($con,"select * from product_master where category='".$_GET['category']."' and status='1' and is_active='1'"));
                                  
                                  $query.="category_id='".$get_cusines['id']."' and";
                                    
                                }
                               
                                $delas=mysqli_query($con,"select * from our_products where prd_type='3' and status='1' and is_active='1'");
                                $num_of_records=mysqli_num_rows($delas);
                                if($num_of_records > 0)
                                {
                                while($delas_row=mysqli_fetch_array($delas))
                                {
                                ?>    
                                
                                
                                   <div class="modal fade" id="recepie_ingredient_<?php echo $delas_row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header border-bottom-0">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <div class="form-title text-center">
                                              <h4><?php echo $delas_row['product_name']; ?></h4>
                                            </div>
                                            <div class="d-flex flex-column text-center">
                                            <div class="col-md-12">
                                             <?php echo $delas_row['recepie_ingredient']; ?>  
                                            </div>   
                                          </div>
                                        </div>
                                      </div>
                                     </div>
                                    </div>
                                
                                   <div class="col-md-4">
                                        <div class="best-deal-item" style="margin-bottom: 15px;">
                                            <div class="best-deal-thumb">
                                                <a href="javascript:void(0)"><img src="admin/assets/img/deals/<?php echo $delas_row['product_image']; ?>" alt="" style="width:250px;height:160px;"></a>
                                            </div>
                                            <div class="best-deal-content sp-product-content" style="padding: 0;">
                                                <div class="main-content" style="text-align: center;">
                                                    <h4 class="title appadd"><a href="javascript:void(0)"><?php echo $delas_row['product_name']; ?></a></h4>
                                                    <span class="product-status" style="font-weight: bold;">IN Stock</span>
                                                    <p style="margin-top: 10px;">£<?php echo $delas_row['price']; ?> / <?php echo $delas_row['prd_qty']; ?></p>
                                                    <div class="sp-cart-wrap">
                                                        <form action="#">
                                                            <div class="cart-plus-minus">
                                                                <input type="text" value="1" name="cart_qty" id="cart_qty_<?php echo $delas_row['id']; ?>">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="section-btn text-center text-md-center">
                                                <a href="javascript:void(0)" onclick="addToDeals(<?php echo $delas_row['id']; ?>,'World Cusines')" class="btn">+ ADD</a>
                                                <a href="javascript:void(0)" class="btn" data-toggle="modal" data-target="#recepie_ingredient_<?php echo $delas_row['id']; ?>">Details</a>
                                            </div>
                                        </div>
                                    </div>
                        
                                    
                                <?php } } else { ?>    
                                
                                  <div class="error-content text-center">
                                    <div class="error_txt"><img src="img/products-not-found.png" style="width:50%;"></div>
                                        <h5>We are sorry...</h5>
                                        <p>This products or Category was not found</p>
                                   </div>
                                
                                <?php } ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- special-products-area-end -->    
        
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
    </body>
</html>
