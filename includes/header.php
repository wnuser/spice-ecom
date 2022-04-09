<?php

$activePage = basename($_SERVER['PHP_SELF'], ".php");


if(isset($_POST['subscribe'])) {
    
    $user_emailid=mysqli_real_escape_string($con,$_POST['email_id']);
    
    $insert_subscribe=mysqli_query($con,"INSERT INTO `subscribed_users` (`email_id`, `create_date`) VALUES ('".$user_emailid."', CURDATE())");
    
    if($insert_subscribe==true) {
        
        
        echo "<script>alert('Thank you for subscribing.');</script>";
        
    } else {
        
         echo "<script>alert('Something went wrong!');</script>";
    }
    
}

?>
<header>

    <?php 
    $profile_details=mysqli_fetch_array(mysqli_query($con,"select * from profile where id='1' and is_active='1'"));
    
    if(isset($_SESSION['logged_id'])) {
        $saved_recipes_count=mysqli_num_rows(mysqli_query($con,"select * from reacipies where customer_id='".$_SESSION['logged_id']."' and is_active='1'"));

    }
    
    ?>

            <!-- header-search-area -->
            <div class="header-search-area">
                <div class="container custom-container">
                    <div class="row align-items-center">
                        <div class="col-xl-4 col-lg-5 d-none d-lg-block">
                            <div class="logo">
                                <a href="javascript:void(0)"><img src="admin/assets/img/profiles/<?php echo $profile_details['profile_img']; ?>" alt="Logo"></a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7">
                            <div class="d-block d-sm-flex align-items-center justify-content-end">
                                <div class="header-action">
                                    <ul>
                                        <?php if(isset($_SESSION['logged_id'])){ ?>
                                        <li class="header-user"><a href="account.php"><i class="flaticon-user"></i></a></li>
                                        <?php } else { ?>
                                        <li class="header-user"><a href="javascript:void(0)" onclick="loginModal()"><i class="flaticon-user"></i></a></li>
                                        <?php } ?>
                                        <?php if(isset($_SESSION['logged_id'])){ ?>
                                        <li class="header-wishlist">
                                            <a href="saved_recipe_items.php"><i class="flaticon-mail"></i></a>
                                            <span class="item-count"><?php echo $saved_recipes_count; ?></span>
                                        </li>
                                        <?php } ?>
                                        <li class="header-cart-action cart-dropdown">
                                        <?php 
                                        if(isset($_SESSION['logged_id']))
                                        {
                                        $getCartDataQry = mysqli_query($con,"select * from cart where customer_id='".$_SESSION['logged_id']."'");
                                        $getCartTotal = mysqli_query($con,"select SUM(price * quantity) as total_cost from cart where customer_id='".$_SESSION['logged_id']."'");
                                        $count = mysqli_num_rows($getCartDataQry);
                                        $totalCart = mysqli_fetch_assoc($getCartTotal);

                                         if($count > 0){
                                         ?>     
                                         
                                         <div class="header-cart-wrap">
                                            <a href="javascript:void(0)"><i class="flaticon-shopping-basket"></i></a>
                                            <span class="item-count"><?php echo $count; ?></span>
                                            <ul class="minicart">
                                            
                                            <?php
                          
                                               while($cartData = mysqli_fetch_assoc($getCartDataQry)) {
                                              ?>
                                                    
                                            
                                                <li class="d-flex align-items-start">
                                                    <div class="cart-img">
                                                    <?php 
                                                        if($cartData['reacipie_id'])
                                                        {
                                                            ?>
                                                                <a href="javascript:void(0)"><img src="img/rec_item.png" style="width:100px;height:87px;" alt=""></a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                                <a href="javascript:void(0)"><img src="<?php echo $cartData['product_img']; ?>" style="width:100px;height:87px;" alt=""></a>
                                                            <?php
                                                        }
                                                    ?>
                                                    </div>
                                                    <div class="cart-content">
                                                    <?php 
                                                        if($cartData['reacipie_id'])
                                                        {
                                                            ?>
                                                                <h4><a href="javascript:void(0)" onclick="order_items('<?php echo $cartData['reacipie_id']; ?>')"><?php echo $cartData['product_name']; ?></a></h4>
                                                            <?php
                                                        } else {
                                                            ?>
                                                                <h4><a href="javascript:void(0)"><?php echo $cartData['product_name']; ?></a></h4>
                                                            <?php
                                                        }
                                                    ?>
                                                        <div class="cart-price">
                                                            <span class="new"><?php echo $cartData['quantity']; ?> x £<?php echo number_format($cartData['price'],2); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="del-icon">
                                                        <a href="javascript:void(0)"><i class="far fa-trash-alt" onclick="removeCartItem(<?php echo $cartData["id"]; ?>)"></i></a>
                                                    </div>
                                                </li>  
                                                
                                               <?php } ?>
                                       
                                                <li>
                                                    <div class="total-price">
                                                        <span class="f-left">Total:</span>
                                                        <span class="f-right">£<?php echo number_format(($totalCart['total_cost']),2); ?></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="checkout-link">
                                                        <a href="view-cart.php">View Cart</a>
                                                        <a class="black-color" href="checkout.php">Checkout</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <!--<div class="cart-amount">£<?php echo number_format(($totalCart['total_cost']),2); ?></div>-->
                                            
                                     <?php }
                                        } else { ?>   
                                         
                                          <div class="header-cart-wrap">
                                                <a href="javascript:void(0)"><i class="flaticon-shopping-basket"></i></a>
                                                <span class="item-count">0</span>
                                                <ul class="minicart">
                                                    <li class="d-flex align-items-start">
                                                        <div class="cart-img" style="flex: 0 0 300px;">
                                                          <img src="img/empty-cart.png"> 
                                                        </div>
                                                    </li>
                                                    
                                                    <li>
                                                        <div class="total-price">
                                                            <span class="f-left">Total:</span>
                                                            <span class="f-right">£0.00</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="checkout-link">
                                                            <a href="javascript:void(0)">View Cart</a>
                                                            <a class="black-color" href="javascript:void(0)">Checkout</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                          <!--<div class="cart-amount">£0.00</div>-->
                                        
                                        <?php } ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header-search-area-end -->

            <div id="sticky-header" class="menu-area">
                <div class="container custom-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                            <div class="menu-wrap">
                                <nav class="menu-nav">
                                    <div class="logo d-block d-lg-none">
                                        <a href="index.php"><img src="admin/assets/img/profiles/<?php echo $profile_details['profile_img']; ?>" width="185" height="58" alt=""></a>
                                    </div>
                                    <div class="navbar-wrap main-menu d-none d-lg-flex">
                                        <ul class="navigation">
                                            <li class="<?= ($activePage == 'index') ? 'active':''; ?>"><a href="index.php">Deals</a></li>
                                           
                                            <?php if(isset($_SESSION['logged_id'])){ ?>
                                            
                                            <li class="<?= ($activePage == 'customize_own_spice') ? 'active':''; ?>"><a href="customize_own_spice.php">Customize your Own Spice Mix</a></li>
                                           
                                            <?php } else { ?>
                                            
                                            <li><a href="javascript:void(0)" onclick="loginModal()">Customize your Own Spice Mix</a></li>
                                            
                                            <?php } ?>
                                            
                                            <li class="<?= ($activePage == 'seasoning-mix') ? 'active':''; ?>"><a href="seasoning-mix.php">Porridge</a></li>
                                            <li class="<?= ($activePage == 'world-cusines') ? 'active':''; ?>"><a href="world-cusines.php">World Cusines</a></li>
                                            
                                            
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <!-- Mobile Menu  -->
                            <div class="mobile-menu">
                                <nav class="menu-box">
                                    <div class="close-btn"><i class="fas fa-times"></i></div>
                                    <div class="nav-logo"><a href="index.php"><img src="img/logo/logo.png" alt="" title=""></a>
                                    </div>
                                    <div class="menu-outer">
                                        <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                                    </div>
                                    <div class="social-links">
                                        <ul class="clearfix">
                                            <li><a href="javascript:void(0)"><span class="fab fa-twitter"></span></a></li>
                                            <li><a href="javascript:void(0)"><span class="fab fa-facebook-f"></span></a></li>
                                            <li><a href="javascript:void(0)"><span class="fab fa-pinterest-p"></span></a></li>
                                            <li><a href="javascript:void(0)"><span class="fab fa-instagram"></span></a></li>
                                            <li><a href="javascript:void(0)"><span class="fab fa-youtube"></span></a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <div class="menu-backdrop"></div>
                            <!-- End Mobile Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </header>