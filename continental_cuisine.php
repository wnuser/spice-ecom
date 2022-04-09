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
        <title>Blend Ur Spice - Seasoning Mix</title>
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
        
        
        .discount-thumb img {
            
            object-fit: cover;
            opacity: 0.4;
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
            
        <section class="breadcrumb-area breadcrumb-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">Continental Cuisine</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Continental Cuisine</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>        
            
         <!-- best-deal-area -->
            <section class="best-deal-area pt-60 pb-80">
                <div class="container">
                    <div class="row">
                    <?php 
                    $seasoning_categories=mysqli_query($con,"select * from seasoning_categories where status='1' and is_active='1'");
                    while($seasoning_categories_row=mysqli_fetch_array($seasoning_categories))
                    {
                    ?>    
                        <div class="col-xl-4 col-lg-6 col-md-8">
                            <div class="discount-item mb-20" style="text-align: center;">
                                <div class="discount-thumb" style="background: #000000c4;border-radius: 10px;">
                                    <img src="admin/assets/img/seasoning_categories/<?php echo $seasoning_categories_row['category_image']; ?>" style="width:420px;height:220px;" alt="<?php echo $cusines_row['cusine_name']; ?>">
                                </div>
                                <div class="discount-content">
                                    <h4 class="title"><?php echo $seasoning_categories_row['category_name']; ?></h4>
                                    <a href="seasoning-mix.php?category=<?php echo $seasoning_categories_row['id']; ?>" class="btn rounded-btn">View Ingredients</a>
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
    </body>
</html>
