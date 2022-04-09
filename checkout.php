<?php
session_start();
include 'Cart.php';
$cart = new Cart;
include ('includes/config.php');
$first_name = "";
$last_name = "";
$user_country = "";
$user_address = "";
$town_city = "";
$postal_code = "";
$email_id = "";
$phone_no = "";
$order_notes = "";
if (isset($_SESSION['logged_id'])) {
    $logged_user_details = mysqli_fetch_array(mysqli_query($con, "select * from customers where id='" . $_SESSION['logged_id'] . "' and is_active='1'"));
    $first_name = $logged_user_details['first_name'];
    $last_name = $logged_user_details['last_name'];
    $user_country = $logged_user_details['country'];
    $user_address = $logged_user_details['address'];
    $town_city = $logged_user_details['town_city'];
    $postal_code = $logged_user_details['postal_code'];
    $email_id = $logged_user_details['email_id'];
    $phone_no = $logged_user_details['phone'];
    $order_notes = $logged_user_details['order_notes'];
}
if (isset($_POST['place_order'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user_country = $_POST['cust_country'];
    $user_address = $_POST['cust_address'];
    $town_city = $_POST['cust_town_city'];
    $postal_code = $_POST['postal_code'];
    $email_id = $_POST['cust_email'];
    $phone_no = $_POST['phone_num'];
    $order_notes = $_POST['order_notes'];
    $login_id = '';
    $login_check = mysqli_num_rows(mysqli_query($con, "select * from customers where email_id='" . $email_id . "' and is_active='1'"));
    if ($login_check > 0) {
        $login_details = mysqli_fetch_array(mysqli_query($con, "select * from customers where email_id='" . $email_id . "' and is_active='1'"));
        $guset_information = mysqli_query($con, "Update `customers` set `first_name`='$first_name', `last_name`='$last_name',  `address`='$user_address', `town_city`='$town_city',
        `postal_code`='$postal_code', `phone`='$phone_no', `country`='$user_country', `order_notes`='$order_notes' where email_id='" . $email_id . "' and is_active='1'");
        $login_id = $login_details['id'];
    } else {
        $guset_information = mysqli_query($con, "INSERT INTO `customers` (`first_name`, `last_name`, `address`, `town_city`, `postal_code`, `email_id`, `phone`, `country`, `order_notes`, `create_date`) 
        VALUES ('$first_name', '$last_name', '$user_address', '$town_city', '$postal_code', '$email_id', '$phone_no', '$user_country', '$order_notes', CURDATE())");
        $login_id = $con->insert_id;
    }
    if ($guset_information == true) {
        $_SESSION['logged_id'] = $login_id;
        $_SESSION['login_user'] = $first_name . ' ' . $last_name;
        header('Location:cartAction.php?action=placeOrder');
    } else {
        echo "<script>alert('Something went wrong.Please try agian.!');</script>";
    }
}
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Blend Ur Spice - Checkout</title>
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
        <?php include ('includes/header.php'); ?>
        <!-- header-area-end -->


        <!-- main-area -->
        <main>

            <!-- breadcrumb-area -->
            <section class="breadcrumb-area breadcrumb-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">Checkout</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                     <li class="breadcrumb-item"><a href="view-cart.php">View Shopping Cart</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>        
            <!-- breadcrumb-area-end -->

            <!-- checkout-area -->
            <div class="checkout-area pt-90 pb-90">
                <div class="container">
                    
                   <form method="post" action="create-order.php" autocomplete="off">  
                   
                    <div class="row justify-content-center">
                        
                        <div class="col-lg-7">
                            <div class="checkout-progress-wrap">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="checkout-progress-step">
                                    <ul>
                                        <li class="active">
                                            <div class="icon"><i class="fas fa-check"></i></div>
                                            <span>Shipping</span>
                                        </li>
                                        <li>
                                            <div class="icon">2</div>
                                            <span>Order Successful</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="checkout-form-wrap">
                                <div class="form">
                                    
                                 <?php if (isset($_SESSION['logged_id'])) { ?>
                                 
                                    <div class="checkout-form-top">
                                        <h5 class="title">Contact information</h5>
                                        <div class="account-create-info">
                                                <a href="javascript:void(0)"><?php echo $_SESSION['login_user']; ?> <i class="fas fa-user"></i></a>
                                        </div>
                                    </div>
                                    
                                   <?php
} else { ?>
                                   
                                   <div class="checkout-form-top">
                                        <h5 class="title">Contact information</h5>
                                        <p>Already have an account? <a href="javascript:void(0)" onclick="loginModal()">Log in</a></p>
                                    </div>
                                   
                                   <?php
} ?>
                                   
                                   
                                    <div class="building-info-wrap">
                                        <h5 class="title">Billing Information</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="first_name" id="first_name" value="<?php echo $first_name; ?>" placeholder="First Name *" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="last_name" id="last_name" value="<?php echo $last_name; ?>" placeholder="Last Name ">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="phone_num" id="phone_num" value="<?php echo $phone_no; ?>" placeholder="Phone Number *" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email" name="cust_email" id="cust_email" value="<?php echo $email_id; ?>" placeholder="Email Id *" required>
                                            </div>
                                        </div>
                                        <input type="text" name="cust_country" id="cust_country" value="<?php echo $user_country; ?>" placeholder="Country / Region *" required>
                                        <input type="text" name="cust_address" id="cust_address" value="<?php echo $user_address; ?>" placeholder="Street Address *" required>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="cust_town_city" id="cust_town_city" value="<?php echo $town_city; ?>" placeholder="Town City *" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="postal_code" name="postal_code" value="<?php echo $postal_code; ?>" placeholder="Postal zip *" required>
                                            </div>
                                        </div>
                                        <textarea name="order_notes" id="order_notes" placeholder="Order You Have Notes ( Optional )"><?php echo $order_notes; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="shop-cart-total order-summary-wrap">
                                <h3 class="title">Order Summary</h3>
                                <?php
                                    $getCartDataQry = mysqli_query($con, "select * from cart where customer_id='" . $_SESSION['logged_id'] . "'");
                                    $getCartTotal = mysqli_query($con, "select SUM(price * quantity) as total_cost from cart where customer_id='" . $_SESSION['logged_id'] . "'");
                                    $count = mysqli_num_rows($getCartDataQry);
                                    $totalCart = mysqli_fetch_assoc($getCartTotal);
                                    while ($cartData = mysqli_fetch_assoc($getCartDataQry)) {
                                ?>
                                <div class="os-products-item">
                                    <div class="thumb">
                                        <?php
    if ($cartData['reacipie_id']) {
?>
                                                                <a href="javascript:void(0)"><img src="img/rec_item.png" alt=""></a>
                                                            <?php
    } else {
?>
                                                                <a href="javascript:void(0)"><img src="<?php echo $cartData['product_img']; ?>" alt=""></a>
                                                            <?php
    }
?>
                                    </div>
                                    <div class="content">
                                        <?php
    if ($cartData['reacipie_id']) {
?>
                                                                <h6 class="title"><a href="javascript:void(0)" onclick="order_items('<?php echo $cartData['reacipie_id']; ?>')"><?php echo $cartData['product_name']; ?></a></h6>
                                                            <?php
    } else {
?>
                                                                <h6 class="title"><a href="javascript:void(0)"><?php echo $cartData['product_name']; ?></a></h6>
                                                            <?php
    }
?>
                                        <span class="price"><?php echo $cartData['quantity']; ?> X £ <?php echo $cartData['price']; ?></span>
                                    </div>
                                </div>
                                <?php
} ?>
                                
                                <div class="shop-cart-widget">
                                    <div class="form">
                                        <ul>
                                            <li class="sub-total"><span>Subtotal</span> £ <?php echo number_format(($totalCart['total_cost']), 2); ?></li>
                                            
                                            <li class="sub-total"><span>Shipping</span> Free</li>
                                            <li class="cart-total-amount"><span>Total Price</span> <span class="amount">£ <?php echo number_format($totalCart['total_cost'], 2); ?></span></li>
                                        </ul>
                                        <div class="payment-method-info">
                                            <!--<div class="paypal-method-flex">-->
                                            <!--    <div class="custom-control">-->
                                            <!--        <input type="radio" class="custom-control-input" name="delivery_option" id="customCheck5">-->
                                            <!--        <label class="custom-control-label" for="customCheck5">Cash on delivery</label>-->
                                            <!--        <p>Pay with cash upon delivery.</p>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <div class="paypal-method-flex">
                                                <div class="custom-control">
                                                    <input type="radio" class="custom-control-input" name="delivery_option" id="customCheck6">
                                                    <label class="custom-control-label" for="customCheck6">Stripe</label>
                                                </div>
                                                <div class="paypal-logo"><img src="img/images/card.png" alt=""></div>
                                            </div>
                                        </div>
                                        <div class="payment-terms">
                                            <!--<p>The purpose Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</p>-->
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck7" required>
                                                <label class="custom-control-label" for="customCheck7">I agree to the website terms and conditions</label>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn" name="create_order" value="Place order">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </form> 
                </div>
            </div>
            <!-- checkout-area-end -->

        </main>
        <!-- main-area-end -->

        <!-- footer-area -->
        <?php include ('includes/footer.php'); ?>
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
