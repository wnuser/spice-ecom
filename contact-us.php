<?php
session_start();
include 'Cart.php';
$cart = new Cart;
include('includes/config.php');

if(isset($_POST['contact_us'])){
    
    
    
      if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) 
        {
        
        $privatekey = "6LeqXtMdAAAAANXhEXLLv6gpXfy-O9w4cOk_IW6o";
        $captcha = $_POST['g-recaptcha-response'];
          
        $url = 'https://www.google.com/recaptcha/api/siteverify';
          
        $data = array(
              'secret' => $privatekey,
              'response' => $captcha,
              'remoteip' => $_SERVER['REMOTE_ADDR']
        );
        
        $curlConfig = array(
              CURLOPT_URL => $url,
              CURLOPT_POST => true,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_POSTFIELDS => $data
        );
        
          $ch = curl_init();
          curl_setopt_array($ch, $curlConfig);
          $response = curl_exec($ch);
          curl_close($ch);
          $jsonResponse = json_decode($response);
          
         if ($jsonResponse->success === true) { 
             
    
  
        $name=$_POST['name'];
  
        $email=$_POST['email'];
  
        $phone=$_POST['phone_number'];
  
        $comments=$_POST['message']; 
        
      
    $subject = "Blend Ur Spice - Contact Us";
    
    $message ='<div marginwidth="0" marginheight="0" style="font-family:Arial,sans-1;background:#fff">
    <table style="border-collapse: collapse;padding:10px 0 25px 0;border-radius:2px;margin:0 auto;background: rgba(0, 0, 0, 0.04) url(https://zulucare.com.sg/zulu/images/bg.jpg) top left repeat;" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#fff" align="center">
      <tbody>
      <tr>
        <td width="100%" valign="top">
        
          <table style="margin:0 auto;padding:35px 25px;width:650px;border-radius:10;border:1px solid #e5e5e5" width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="ffffff" align="center">
            <tbody>
            
            <tr style="text-align:center;">
              <td style="padding:0px 25px 10px 25px;font-size:20px;font-family:Arial,sans-serif;text-align:center;vertical-align:top;background-color:#ffffff;color:#2797cd;" align="center">
                <img src="http://czarmedias.com/BlendUrSpice/admin/assets/img/profiles/16-09-2021-3251-blend-new-logo.png"><br>
              </td>
            </tr>
            
            <tr style="text-align:center;">
              <td style="padding:0px 25px 10px 25px;font-size:16px;font-family:Arial,sans-serif;text-align:center;vertical-align:top;background-color:#ffffff;color:#828282" align="center">
                <span style="font-size:22px;font-weight:bold;color:#4caf50">Contact Us</span>
              </td>
            </tr>';
            
            
             $message .='<tr>
              <td style="width:600px;padding:25px 10px 0 10px;text-align:left;background-color:#ffffff" align="center">
                <table style="width:580px;margin:0 auto;background-color:#ffffff" cellspacing="0" cellpadding="0" align="center">
                  <tbody>
                  <tr>
                    <td>
                      <table style="width:580px;margin:0 auto;background-color:#f5f5f5;border-radius:5px" cellspacing="0" cellpadding="0" align="center">
                        <tbody>
                        <tr>
                          <td>
                            <table style="width:580px;margin:0 auto;padding:10px;background-color:#f5f5f5;border-top-left-radius:5px;border-top-right-radius:5px" cellspacing="0" cellpadding="0" align="center">
                              <tbody>
                              <tr>
                                <td style="width:580px;background-color:#f5f5f5" valign="top" align="center">
                                  <table style="width:100%;background-color:#f5f5f5;margin:0px auto" cellspacing="0" cellpadding="0" align="center">
                                    <tbody>
                                    <tr>
                                      
                                      <td style="width:370px;background-color:#f5f5f5;padding:10px" valign="top" align="center">
                                        <table style="width:100%;background-color:#f5f5f5;margin:0px auto" cellspacing="0" cellpadding="0" align="center">
                                          <tbody>
                                           <tr>
                                                <td style="padding: 15px;">Name</td>
                                                <td style="padding: 15px;"><b>'.$name.'</b></td>
                                            </tr>
                                             <tr>
                                                <td style="padding: 15px;">E-mail ID</td>
                                                <td style="padding: 15px;"><b>'.$email.'</b></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 15px;">Phone</td>
                                                <td style="padding: 15px;"><b>'.$phone.'</b></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 15px;">Message</td>
                                                <td style="padding: 15px;"><b>'.$comments.'</b></td>
                                            </tr>
                                          
                                        </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                  </tbody>
                                  </table>
                                </td>
                              </tr>
                            </tbody>
                           </table>
                          </td>
                        </tr>
          
                 <tr>
                    <td style="width:100%;background-color:#ffffff" valign="top">
                      <img src="https://ci6.googleusercontent.com/proxy/TYWLRM9skOXuDsYDKbAxTem23y0_04oW3z4Qt-FiFSTz2xmj7W0ZKqB-RMEtab0bjFlRPKgDdIQnOweNwooGLnh9lHHbVhs32SYB-oPuZQ=s0-d-e1-ft#https://in.bmscdn.com/mailers/images/161202ticket/zigzag.png" style="width:100%;display:block;background-color:#ffffff;color:#010101" class="CToWUd" width="580" height="15" border="0">
                    </td>
                  </tr>
                  <tr>
                    <td style="width:580px;padding-top:20px;background-color:#ffffff" valign="top" align="center">
                      <table style="width:100%;background-color:#ffffff;margin:0px auto" cellspacing="0" cellpadding="0" align="center">
                        <tbody>
                        <tr>
                        <td style="width:200px;font-size:13px;font-weight:bold;font-family:Arial,sans-serif;text-align:left;vertical-align:top;background-color:#ffffff;color:#3f474e" valign="top" align="left">
                            <p style="color:#787878;font-size:12px;margin:0;padding:0 0 4px 0">Enquiry Date &amp; Time</p>'.date('D, d M, Y | h:m').'
                        </td>
                          
                        <td style="width:200px;font-size:13px;font-weight:bold;font-family:Arial,sans-serif;text-align:left;vertical-align:top;background-color:#ffffff;color:#3f474e" valign="top" align="left">
                            <p style="color:#787878;font-size:12px;margin:0;padding:0 0 4px 0">For Further Assistance</p>
                            <a href="#" style="text-decoration:none;color:#4d90fe;display:inline-block" target="_blank"> '.$email.' </a><br>
                        </td>
                        </tr>
                      </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody></table>
              </td>
            </tr>
    </tbody></table>
  </div><div class="adL">
</div>
</div>';

//echo $message;exit();
    
    require_once ("PHPMailer/class.phpmailer.php");  
    require_once ("PHPMailer/class.smtp.php");
    
    $mail = new PHPMailer();
	$mail->Host       = "czarmedias.com";
	$mail->SMTPDebug  = 1;                
	$mail->SMTPAuth   = true;                  
	$mail->SMTPSecure = "ssl";                 
	$mail->Port       = 465;  
	$mail->IsHTML(true);
	$mail->Username = 'notification@czarmedias.com';
    $mail->Password = 'p9eoURvC1jrJ';
    $mail->SMTPAuth = true;
	
    $mail->Subject = $subject;
   
    $mail->SetFrom($email,$name);
   
    $mail->From = $email;
   
    $mail->FromName = $name;
   
    $mail->addAddress("blendurspice@gmail.com","Vasu");
    
    $mail->addBCC("ranjithjms1998@gmail.com","Ranjith");
   
    $mail->addBCC("kanimksd.ic@gmail.com","Kani");
   
    $mail->IsHTML(true);	
   
   $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
   
    $mail->MsgHTML($message);

    if($mail->Send()==true) {
      
     echo "<script>alert('Your Queries has been submitted successful.We will contact soon.');location.href='contact-us.php';</script>";      
      
    } else {
      
      echo "<script>alert('Something went wrong.Please try again.!);location.href='contact-us.php';</script>";
      
    }
   
   
         } else {
        
        echo "<script>alert('Robot verification failed, please try again.');window.location= 'contact-us.php';</script>";
        
     }  } else {
	  
    echo "<script>alert('Please click on the reCAPTCHA box.');window.location= 'contact-us.php';</script>";
	
  }
  
  
    
}

?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Blend Ur Spice - Contact Us</title>
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
        <?php include('includes/header.php'); ?>
        <!-- header-area-end -->


        <!-- main-area -->
        <main>

            <!-- contact-area -->
            <section class="contact-area pt-90 pb-90">
                <div class="container">
                    <div class="container-inner-wrap">
                        <div class="row justify-content-center justify-content-lg-between">
                            <div class="col-lg-6 col-md-8 order-2 order-lg-0">
                                <div class="contact-title mb-25">
                                    <h5 class="sub-title">Contact Us</h5>
                                    <h2 class="title">Let's Talk Question<span>.</span></h2>
                                </div>
                                <div class="contact-wrap-content">
                                    <form method="post" class="contact-form">
                                        <div class="form-grp">
                                            <label for="name">Your Name <span>*</span></label>
                                            <input type="text" name="name" id="name" placeholder="Jon Deo..." required>
                                        </div>
                                        <div class="form-grp">
                                            <label for="email">Your Email <span>*</span></label>
                                            <input type="email" name="email" id="email" placeholder="info.example@.com" required>
                                        </div>
                                        <div class="form-grp">
                                            <label for="email">Your Phone Number <span>*</span></label>
                                            <input type="text" name="phone_number" id="phone_number" placeholder="+01 1234567" required>
                                        </div>
                                        <div class="form-grp">
                                            <label for="message">Your Message <span>*</span></label>
                                            <textarea name="message" id="message" placeholder="Opinion..." required></textarea>
                                        </div>
                                        
                                        <div class="form-grp">
                                            <div class="g-recaptcha" data-sitekey="6LeqXtMdAAAAAI4RtVGcI20Kujtu4B_Fzt7Y-EQR"></div>
                                        </div>
                                        
                                        <button type="submit" name="contact_us" class="btn rounded-btn">Send Now</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-6 col-md-8">
                                <div class="contact-info-wrap">
                                    <div class="contact-img">
                                        <img src="img/images/contact_img.png" alt="">
                                    </div>
                                    <div class="contact-info-list">
                                        <ul>
                                            <li>
                                                <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                                <div class="content">
                                                    <p><?php echo $profile_details['address1']; ?></p>
                                                    <p><?php echo $profile_details['address2']; ?></p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon"><i class="fas fa-phone-alt"></i></div>
                                                <div class="content">
                                                    <p><?php echo $profile_details['phone']; ?></p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon"><i class="fas fa-envelope-open"></i></div>
                                                <div class="content">
                                                    <p><?php echo $profile_details['email']; ?></p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--<div class="contact-social">-->
                                    <!--    <ul>-->
                                    <!--        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>-->
                                    <!--        <li><a href="#"><i class="fab fa-twitter"></i></a></li>-->
                                    <!--        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>-->
                                    <!--    </ul>-->
                                    <!--</div>-->
                                </div>
                            </div>
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
