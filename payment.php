<?php
session_start();
include 'Cart.php';
$cart = new Cart;
include ('includes/config.php');

if(!isset($_SESSION['order_id'])) {
    echo "<script>alert('Please continue to shoping!.');location.href='index.php';</script>";
}

?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Eternal Seasoning - Checkout</title>
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
            <!-- <section class="breadcrumb-area breadcrumb-bg">
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
        </section>         -->
            <!-- breadcrumb-area-end -->

            <!-- checkout-area -->
            <div class="checkout-area pt-90 pb-90">
                <div class="container">
                    
                   <!-- <form method="post" action="create-order.php" autocomplete="off">   -->
                   
                    <div class="row justify-content-center">
                        
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
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
                                            <span>Payment</span>
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
                                             <div class="col-md-3"></div>
                                             <div class="col-md-6">
                                                  <div class="form-group">
                                                    <label for="">Customer Name</label>
                                                    <input type="text" name="first_name" id="first_name" value="<?= $_SESSION['customer_name'] ?>" placeholder="First Name *" required>
                                                  </div>

                                                  <!--  -->

                                                  <div class="form-group">
                                                      <label for="">Total Order Amount £</label>
                                                      <input type="text" name="amount" readonly  value="<?= $_SESSION['total_amount']  ?>">
                                                  </div>
    
                                                  <input type="hidden" id="order_id" name="order_id" value="<?= $_SESSION['order_id'] ?>">
                                                  <input type="hidden" id="cutomer_phone" value="<?= $_SESSION['cutomer_phone'] ?>">
                                                  <input type="hidden" id="cutomer_email" value="<?= $_SESSION['cutomer_email'] ?>" >
                                                  <input type="hidden" id="cutomer_address" value="<?= $_SESSION['cutomer_address'] ?>" >

                                                  <div class="form-group">
                                                        <button type="button" onclick="pay(<?= $_SESSION['total_amount'] ?>)" class="btn btn-success"> Confirm </button>
                                                  </div>

                                             </div>
                                             <div class="col-md-3"></div>
                                        </div>
                                       
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                           
                        </div>
                    </div>
                  <!-- </form>  -->
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
 
<script type="text/javascript">
 
  function pay(amount) {
    var handler = StripeCheckout.configure({
      key: 'pk_test_51KUVKaCEyUQFbck914yxgCiclXBb9k15UIjlI92ya4ATI9BdAAwORgpeIJm71zvrqtbqLhTmOTfIgjuh4ISrCswV00P8RY2ZRb', // your publisher key id
      locale: 'auto',
      token: function (token) {
        // You can access the token ID with `token.id`.
        // Get the token ID to your server-side code for use.
        console.log('Token Created!!');
        console.log(token)
        $('#token_response').html(JSON.stringify(token));
        var order_id         = $('#order_id').val();
        var cutomer_phone    = $('#cutomer_phone').val();
        var cutomer_email    = $('#cutomer_email').val();
        var cutomer_address  = $('#cutomer_address').val();

        // console.log(cutomer_email, 'tt');
        // return false;
        // exit;
        
 
        $.ajax({
          url:"process_payment.php",
          method: 'post',
          data: { tokenId: token.id, amount: amount, order_id:order_id,cutomer_phone:cutomer_phone,cutomer_email:cutomer_email,cutomer_address:cutomer_address },
          dataType: "json",
          success: function( data ) {

             if(data.status == 'success') {
                 alert('Payment has been done successfully!');
                 location.href = "account.php";
             } else {
                 alert('Someting went wrong,please try again!');
             }
            // console.log('success',response.data);
            // $('#token_response').append( '<br />' + JSON.stringify(response.data));
          },
          error:function(data) {

                 alert('Someting went wrong,please try againk!'+data);
          }
        })
      }
    });
  
    handler.open({
      name: 'Eternal Seasoning',
      description: 'Checkout',
      amount: amount * 100
    });
  }
</script>
    </body>
</html>
