<?php
session_start();
include 'Cart.php';
$cart = new Cart;
include('includes/config.php');

if(isset($_POST['reset_password_update']))
    {
        
        $token_id=mysqli_real_escape_string($con,$_POST['token_id']); 
        $new_password=mysqli_real_escape_string($con,$_POST['new_password']); 
        $con_password=mysqli_real_escape_string($con,$_POST['con_password']);     
        
        $check_password=mysqli_num_rows(mysqli_query($con,"select * from password_reset_token where token_no='".$token_id."' and is_active='1'"));
        

            if($check_password > 0){
                
             if($new_password==$con_password)   
             {
            
                $password_update=mysqli_query($con,"update customers set password='".$con_password."' where email_id='".$email_id."' and is_active='1'");
                
                if($password_update==true){
                    
                    $update_token_id=mysqli_query($con,"DELETE FROM `password_reset_token` WHERE token_no='".$token_id."' and is_active='1'");
                    
                    echo "<script>alert('Success! New password updated.');location.href='index.php';</script>";
                    
                } else {
                    
                    echo "<script>alert('Oops! Something went wrong.');</script>";
                    
                }
                
             } else {
                
               echo "<script>alert('Oops! New password & confirm password does not match');</script>"; 
                
            }    
        
        } else {
            
           echo "<script>alert('Expired token. Please request a new password reset link.');location.href='index.php';</script>"; 
            
        }
        
        
        
    }

?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Eternal Seasoning - Password Reset</title>
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
            <?php 
            $token_id=$_GET['token'];
            ?>
            <!-- contact-area -->
            <section class="contact-area pt-90 pb-90">
                <div class="container">
                    <div class="container-inner-wrap">
                        <div class="row justify-content-center justify-content-lg-between">
                            <div class="col-lg-6 col-md-8 order-2 order-lg-0">
                                <div class="contact-title mb-25">
                                    <h5 class="sub-title">Reset Your Password</h5>
                                    <p>Please enter a new password<span>.</span></p>
                                </div>
                                <div class="contact-wrap-content">
                                    <form method="post" class="contact-form">
                                        <div class="form-grp">
                                            <label for="name">New password <span>*</span></label>
                                            <input type="hidden" name="token_id" id="token_id" value="<?php echo $token_id; ?>">
                                            <input type="password" name="new_password" id="new_password" placeholder="New password" required>
                                        </div>
                                        <div class="form-grp">
                                            <label for="email">Re-enter Password <span>*</span></label>
                                            <input type="password" name="con_password" id="con_password" placeholder="Re-enter Password" required>
                                        </div>
                                        <button type="submit" name="reset_password_update" class="btn rounded-btn">RESET MY PASSWORD</button>
                                    </form>
                                </div>
                            </div>
                            <!--<div class="col-xl-5 col-lg-6 col-md-8">-->
                            <!--    <div class="contact-info-wrap">-->
                            <!--        <div class="contact-img">-->
                            <!--            <img src="img/images/contact_img.png" alt="">-->
                            <!--        </div>-->
                            <!--        <div class="contact-info-list">-->
                            <!--            <ul>-->
                            <!--                <li>-->
                            <!--                    <div class="icon"><i class="fas fa-map-marker-alt"></i></div>-->
                            <!--                    <div class="content">-->
                            <!--                        <p><?php echo $profile_details['address1']; ?></p>-->
                            <!--                        <p><?php echo $profile_details['address2']; ?></p>-->
                            <!--                    </div>-->
                            <!--                </li>-->
                            <!--                <li>-->
                            <!--                    <div class="icon"><i class="fas fa-phone-alt"></i></div>-->
                            <!--                    <div class="content">-->
                            <!--                        <p><?php echo $profile_details['phone']; ?></p>-->
                            <!--                    </div>-->
                            <!--                </li>-->
                            <!--                <li>-->
                            <!--                    <div class="icon"><i class="fas fa-envelope-open"></i></div>-->
                            <!--                    <div class="content">-->
                            <!--                        <p><?php echo $profile_details['email']; ?></p>-->
                            <!--                    </div>-->
                            <!--                </li>-->
                            <!--            </ul>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </section>
            <!-- contact-area-end -->

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
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </body>
</html>
