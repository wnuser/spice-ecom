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
        <title>Blend Ur Spice - Home</title>
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
        
        .row-bordered {
            overflow: hidden;
        }
        
        .account-settings-fileinput {
            position: absolute;
            visibility: hidden;
            width: 1px;
            height: 1px;
            opacity: 0;
        }
        .account-settings-links .list-group-item.active {
            font-weight: bold !important;
        }
        html:not(.dark-style) .account-settings-links .list-group-item.active {
            background: transparent !important;
        }
        .account-settings-multiselect ~ .select2-container {
            width: 100% !important;
        }
        .light-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(24, 28, 33, 0.03) !important;
        }
        .light-style .account-settings-links .list-group-item.active {
            color: #4e5155 !important;
        }
        .material-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(24, 28, 33, 0.03) !important;
        }
        .material-style .account-settings-links .list-group-item.active {
            color: #4e5155 !important;
        }
        .dark-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(255, 255, 255, 0.03) !important;
        }
        .dark-style .account-settings-links .list-group-item.active {
            color: #fff !important;
        }
        .light-style .account-settings-links .list-group-item.active {
            color: #4E5155 !important;
        }
        .light-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(24,28,33,0.03) !important;
        }    
        
        .appadd {

        white-space: nowrap;
        overflow: hidden;
        width: 250px;
        height: 20px;
        text-overflow: ellipsis; 
        
        }      
            
        #loading
        {
            
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(255,255,255,255) url("img/cart-loading.gif") center no-repeat;
        	
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
        
        <div class="prd-loader"></div>

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
            
         <!-- slider-area -->
            <section class="slider-area" data-background="img/bg/slider_area_bg.jpg">
                <div class="container custom-container">
                    <div class="row">
                        <div class="col-7">
                            <div class="slider-active">
                                <div class="single-slider slider-bg" data-background="img/slider/blend-banner-01.jpg">
                                    <div class="slider-content">
                                        <h5 class="sub-title" data-animation="fadeInUp" data-delay=".2s">top deal !</h5>
                                        <h2 class="title" data-animation="fadeInUp" data-delay=".4s">Ingredients</h2>
                                        <p data-animation="fadeInUp" data-delay=".6s">Get up to 50% OFF Today Only</p>
                                        <a href="deals.php" class="btn rounded-btn" data-animation="fadeInUp" data-delay=".8s">Shop Now</a>
                                    </div>
                                </div>
                                <div class="single-slider slider-bg" data-background="img/slider/blend-banner-02.jpg">
                                    <div class="slider-content">
                                        <h5 class="sub-title" data-animation="fadeInUp" data-delay=".2s">Real simple !</h5>
                                        <h2 class="title" data-animation="fadeInUp" data-delay=".4s">Continental Cuisine</h2>
                                        <p data-animation="fadeInUp" data-delay=".6s">Get up to 50% OFF Today Only</p>
                                        <a href="seasoning-mix.php" class="btn rounded-btn" data-animation="fadeInUp" data-delay=".8s">Shop Now</a>
                                    </div>
                                </div>
                                <div class="single-slider slider-bg" data-background="img/slider/blend-banner-03.jpg">
                                    <div class="slider-content">
                                        <h5 class="sub-title" data-animation="fadeInUp" data-delay=".2s">top deal !</h5>
                                        <h2 class="title" data-animation="fadeInUp" data-delay=".4s">World Cuisines</h2>
                                        <p data-animation="fadeInUp" data-delay=".6s">Get up to 50% OFF Today Only</p>
                                        <a href="world-cusines.php" class="btn rounded-btn" data-animation="fadeInUp" data-delay=".8s">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="slider-banner-img mb-20">
                                <a href="javascript:void(0)"><img src="img/slider/slider_banner01.jpg" alt=""></a>
                            </div>
                            <div class="slider-banner-img">
                                <a href="javascript:void(0)"><img src="img/slider/slider_banner02.jpg" alt=""></a>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="slider-banner-img">
                                <a href="javascript:void(0)"><img src="img/slider/slider_banner03.jpg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- category-area -->
                <div class="container custom-container">
                    <div class="slider-category-wrap">
                        <div class="row category-active">
                        <?php 
                        $spices_list=mysqli_query($con,"select * from spices_list where status='1' and is_active='1' limit 12");
                        while($spices_list_row=mysqli_fetch_array($spices_list))
                        {
                        if($spices_list_row['spices_images']!='')
                        {
                        ?>     
                            <div class="col-lg-2">
                                <div class="category-item active">
                                    <a href="javascript:void(0)" class="category-link"></a>
                                    <div class="category-thumb">
                                        <img src="admin/assets/img/spices/<?php echo $spices_list_row['spices_images']; ?>" alt="<?php echo $spices_list_row['spices_name']; ?>" style="width:120px;height:120px;">
                                    </div>
                                    <div class="category-content">
                                        <h6 class="title"><?php echo $spices_list_row['spices_name']; ?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php } } ?>    
                        </div>
                    </div>
                </div>
                <!-- category-area-end -->

            </section>
            <!-- slider-area-end --> 
            
            <!-- best-deal-area -->
            <section class="best-deal-area pt-60 pb-80" style="background: #f2f4f7;">
                <div class="container">
                    
                    <div class="row justify-content-center">
                        <div class="col-xl-7 col-lg-9">
                            <div class="best-deal-top-wrap">
                                <div class="bd-section-title">
                                    <h3 class="title">Best Deals <span>of this Week!</span></h3>
                                    <p>A virtual assistant collects the products from your list</p>
                                </div>
                                <div class="coming-time" data-countdown="2022/02/27"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                    <?php 
                    $delas=mysqli_query($con,"select * from our_products where prd_type='1' and status='1' and is_active='1'");
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
                    
                        <div class="col-xl-3">
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
                    <?php } ?>   
                    </div>
                </div>
            </section>
            <!-- best-deal-area-end -->
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
        
        $(".qtybutton").on("click", function () {
        	var $button = $(this);
        	var oldValue = $button.parent().find("input").val();
        	if ($button.text() == "+") {
        		var newVal = parseFloat(oldValue) + 1;
        	} else {
        		// Don't allow decrementing below zero
        		if (oldValue > 0) {
        			var newVal = parseFloat(oldValue) - 1;
        		} else {
        			newVal = 0;
        		}
        	}
        	$button.parent().find("input").val(newVal);
        });        
            
        </script>
        
    </body>
</html>
