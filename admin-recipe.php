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
        if(isset($_GET['category'])) {
            $cousine_details = mysqli_fetch_array(mysqli_query($con,"select * from cusines where id='".$_GET['category']."' and status='1' and is_active='1'"));
        }
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
                                            <h6 class="title">Recipes</h6>
                                        </div>
                                        <div class="shop-cat-list">
                                            <ul>
                                            <?php 
                                            $cusines=mysqli_query($con,"select * from admin_recipes ");
                                            while($cusines_row=mysqli_fetch_array($cusines))
                                            {
                                            ?>        
                                                <!-- <li class="<?= ($cusines_row['id'] == $_GET['category']) ? 'active':''; ?>"><a href="world-cusines.php?category=<?php echo $cusines_row['id']; ?>"><?php echo $cusines_row['cusine_name']; ?> <span>+</span></a></li> -->
                                                <li class="<?= ($cusines_row['id'] == $_GET['id']) ? 'active':''; ?>" > <a href="admin-recipe.php?id=<?= $cusines_row['id'] ?>"> <?= $cusines_row['name'] ?> </a> </li>
                                            <?php } ?>    
                                            </ul>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                            <div class="col-9">
                                <div class="row justify-content-center">
                                
                                <?php 

                                if(isset($_GET['id'])) {
                                    $id  = $_GET['id'];
                                    $query  = mysqli_query($con, "SELECT * from admin_recipes where id='".$id."' ");
                                    $data   = mysqli_fetch_assoc($query);
                                } else {
                                    $query  = mysqli_query($con, "SELECT * from admin_recipes LIMIT 1 ");
                                    $data   = mysqli_fetch_assoc($query);

                                }
                                ?>
                                  
                                
                                   <div class="col-md-12">
                                        <div class="best-deal-item" style="margin-bottom: 15px;">
                                            <h4><?php echo $data['name']; ?></h4> <hr style="margin-top:0px; margin-bottom:10px;">
                                            <div style="width:100%; height:400px; text-align:center;">
                                                <img style="width:100%; height:400px;" src="admin/assets/img/admin_recipes/<?php echo $data['image']; ?>" alt="" >
                                            </div>
                                            <hr style="margin-top:10px; margin-bottom:10px;">
                                            <div class="">
                                               <p> <?= $data['description'] ?>  </p>
                                            </div>

                                        </div>
                                    </div>
                        
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
