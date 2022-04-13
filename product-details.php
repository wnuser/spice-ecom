<?php

session_start();
include('includes/config.php');

?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Eternal Seasoning - Product Details</title>
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
        <div id="preloader">
            <div id="loading-center">
                <div class="loader">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
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
            <div class="breadcrumb-area breadcrumb-bg-two">
                <div class="container custom-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-content">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Shop</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb-area-end -->
            <?php 
            $prd_id= base64_decode($_GET['prd']);
            $product_details=mysqli_fetch_array(mysqli_query($con,"select * from product_master where id='".$prd_id."' and status='1' and is_active='1'"));
            
            $cusines_details=mysqli_fetch_array(mysqli_query($con,"select * from cusines where id='".$product_details['category']."' and status='1' and is_active='1'"));
            
            ?>
            <!-- shop-details-area -->
            <section class="shop-details-area pt-90 pb-90">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="shop-details-flex-wrap">
                               
                                <div class="shop-details-img-wrap">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="item-one" role="tabpanel" aria-labelledby="item-one-tab">
                                            <div class="shop-details-img">
                                                <img src="admin/assets/img/products/<?php echo $product_details['product_image']; ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="shop-details-content">
                                <h4 class="title"><?php echo $product_details['product_name']; ?></h4>
                                <div class="shop-details-meta">
                                    <ul>
                                        <li>Cusine : <a href="javascript:void(0);"><?php echo $cusines_details['cusine_name']; ?></a></li>
                                        <li class="shop-details-review">
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span>Review</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="shop-details-price">
                                    <h2 class="price">$<?php echo $product_details['price']; ?></h2>
                                    <h5 class="stock-status">- IN Stock</h5>
                                </div>
                                <p>Organic food is food produced by methods complying with the standards of Rrganic farming. Standards vary Lorem ipsum
                                dolor sit amet, consectetur adipiscing worldwide, but organic farming.</p>
                               
                                <div class="shop-perched-info">
                                    <div class="sd-cart-wrap">
                                        <form action="#">
                                            <div class="cart-plus-minus">
                                                <input type="text" value="1">
                                            </div>
                                        </form>
                                    </div>
                                    <a href="#" class="btn">add to cart</a>
                                </div>
                                <div class="shop-details-bottom">
                                    <h5 class="title"><a href="#"><i class="far fa-heart"></i> Add To Wishlist</a></h5>
                                    <ul>
                                        <li>
                                            <span>Tag : </span>
                                            <a href="#">ICE Cream</a>
                                        </li>
                                        <li>
                                            <span>CATEGORIES :</span>
                                            <a href="#">women's,</a>
                                            <a href="#">bikini,</a>
                                            <a href="#">tops for,</a>
                                            <a href="#">large bust</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- shop-details-area-end -->
          

            <!-- best-sellers-area -->
            <section class="best-sellers-area pt-75">
                <div class="container">
                    <div class="row align-items-end mb-50">
                        <div class="col-md-8 col-sm-9">
                            <div class="section-title">
                                <span class="sub-title">Related Products</span>
                                <h2 class="title">From this Collection</h2>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-3">
                            <div class="section-btn text-left text-md-right">
                                <a href="javascript:void(0)" class="btn">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="best-sellers-products">
                        <div class="row justify-content-center">
                        
                        <?php 
                        $best_product_master=mysqli_query($con,"select * from product_master where status='1' and is_active='1' order by id desc limit 5");
                        while($best_product_master_rows=mysqli_fetch_array($best_product_master))
                        {
                        ?>    
                         
                            <div class="col-3">
                                <div class="sp-product-item mb-20">
                                    <div class="sp-product-thumb">
                                        <a href="javascript:void(0)"><img src="admin/assets/img/products/<?php echo $best_product_master_rows['product_image']; ?>" style="width:192px;height:143px;" alt=""></a>
                                    </div>
                                    <div class="sp-product-content">
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h6 class="title"><a href="javascript:void(0)"><?php echo $best_product_master_rows['product_name']; ?></a></h6>
                                        <span class="product-status">IN Stock</span><br>
                                        
                                        <p>$<?php echo $best_product_master_rows['price']; ?> - 250g</p>
                                    </div>
                                </div>
                            </div>
                            
                        <?php } ?>    
                            
                        </div>
                    </div>
                </div>
            </section>
            <!-- best-sellers-area-end -->

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
