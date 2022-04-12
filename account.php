<?php
session_start();
include 'Cart.php';
$cart = new Cart;
include('includes/config.php');

 if(isset($_SESSION['logged_id'])){
       
        $logged_user_details=mysqli_fetch_array(mysqli_query($con,"select * from customers where id='".$_SESSION['logged_id']."' and is_active='1'"));    
           
        $first_name=$logged_user_details['first_name']; 
        $last_name=$logged_user_details['last_name']; 
        $user_country=$logged_user_details['country']; 
        $user_address=$logged_user_details['address']; 
        $town_city=$logged_user_details['town_city']; 
        $postal_code=$logged_user_details['postal_code']; 
        $email_id=$logged_user_details['email_id']; 
        $phone_no=$logged_user_details['phone'];   
        $order_notes=$logged_user_details['order_notes']; 
       
       
   }
   
   if(isset($_POST['account_update'])) {
     
        $first_name=mysqli_real_escape_string($con,$_POST['first_name']); 
        $last_name=mysqli_real_escape_string($con,$_POST['last_name']); 
        $user_country=mysqli_real_escape_string($con,$_POST['cust_country']); 
        $user_address=mysqli_real_escape_string($con,$_POST['cust_address']); 
        $town_city=mysqli_real_escape_string($con,$_POST['cust_town_city']); 
        $postal_code=mysqli_real_escape_string($con,$_POST['postal_code']); 
        $email_id=mysqli_real_escape_string($con,$_POST['cust_email']); 
        $phone_no=mysqli_real_escape_string($con,$_POST['phone_num']);   
        $order_notes=mysqli_real_escape_string($con,$_POST['order_notes']); 
        
        $guset_information=mysqli_query($con,"Update `customers` set `first_name`='$first_name', `last_name`='$last_name',  `address`='$user_address', `town_city`='$town_city',
        `postal_code`='$postal_code', `phone`='$phone_no', `country`='$user_country', `order_notes`='$order_notes' where email_id='".$email_id."' and is_active='1'");
        
        
        if($guset_information==true){
            
            header('Location:account.php');
            
        }  else {
            
            echo "<script>alert('Something went wrong.Please try agian.!');</script>";
            
       }  
        
    } 
    
    
    if(isset($_POST['change_password']))
    {
        
      
        $user_id=$_SESSION['logged_id'];   
        
        $current_password=mysqli_real_escape_string($con,$_POST['current_password']); 
        $new_password=mysqli_real_escape_string($con,$_POST['new_password']); 
        $repeat_password=mysqli_real_escape_string($con,$_POST['repeat_password']);     
        
        $check_password=mysqli_num_rows(mysqli_query($con,"select * from customers where id='".$user_id."' and password='".$current_password."' and is_active='1'"));
        

            if($check_password > 0){
                
             if($new_password==$repeat_password)   
             {
            
                $password_update=mysqli_query($con,"update customers set password='".$repeat_password."' where id='".$user_id."' and is_active='1'");
                
                if($password_update==true){
                    
                    echo "<script>alert('Success! New password updated.');</script>";
                    
                } else {
                    
                    echo "<script>alert('Oops! Something went wrong.');</script>";
                    
                }
                
             } else {
                
               echo "<script>alert('Oops! New password & repeat password does not match');</script>"; 
                
            }    
        
        } else {
            
           echo "<script>alert('Oops! Current password does not match');</script>"; 
            
        }
        
        
        
    }
   

?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Blend Ur Spice - Account</title>
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

            <!-- breadcrumb-area -->
            <section class="breadcrumb-area breadcrumb-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-content">
                                <h2 class="title">Account Profile</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Account Profile</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb-area-end -->

            <!-- 404-area -->
            <section class="error-area pt-100 pb-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col-md-10">
                            <div class="container light-style flex-grow-1 container-p-y">

                            <h4 class="font-weight-bold py-3 mb-4">
                              Account settings
                            </h4>
                        
                            <div class="card overflow-hidden">
                              <div class="row no-gutters row-bordered row-border-light">
                                <div class="col-md-3 pt-0">
                                  <div class="list-group list-group-flush account-settings-links">
                                    <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
                                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
                                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-orders">My Orders</a>
                                    <a class="list-group-item list-group-item-action" href="logout.php">Logout</a>
                                    
                                  </div>
                                </div>
                                <div class="col-md-9">
                                  <div class="tab-content">
                                    <div class="tab-pane fade active show" id="account-general">
                        
                                      <div class="card-body">
                                      <form method="post" autocomplete="off"> 
                                       <div class="checkout-form-wrap">
                                          <div class="form">   
                                               
                                            <div class="checkout-form-top">
                                                <h5 class="title">Billing Information</h5>
                                                <div class="account-create-info">
                                                        <a href="javascript:void(0)"><?php echo $first_name.' '.$last_name; ?> <i class="fas fa-user"></i></a>
                                                </div>
                                            </div>
                                        
                                            <div class="building-info-wrap">
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
                                                        <input type="email" name="cust_email" id="cust_email" value="<?php echo $email_id; ?>" placeholder="Email Id*" required>
                                                    </div>
                                                </div>
                                                <input type="text" name="cust_country" id="cust_country" value="<?php echo $user_country; ?>" placeholder="Country / Region *" required>
                                                <input type="text" name="cust_address" id="cust_address" value="<?php echo $user_address; ?>" placeholder="Street Address *" required>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" name="cust_town_city" id="cust_town_city" value="<?php echo $town_city; ?>" placeholder="Town City" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" name="postal_code" name="postal_code" value="<?php echo $postal_code; ?>" placeholder="Postal zip" required>
                                                    </div>
                                                </div>
                                                <textarea name="order_notes" id="order_notes" placeholder="Order You Have Notes ( Optional )"><?php echo $order_notes; ?></textarea>
                                            </div>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="text-right mt-3">
                                          <button type="submit" name="account_update" class="btn btn-primary">Save changes</button>
                                        </div>
                                        
                                       </form>
                                        
                                      </div>
                        
                                    </div>
                                    <div class="tab-pane fade" id="account-change-password">
                                      <div class="card-body pb-2">
                                          
                                        <form method="post" autocomplete="off">
                                            
                                            <div class="form-group">
                                              <label class="form-label">Current password</label>
                                              <input type="password" name="current_password" id="current_password" class="form-control" required>
                                            </div>
                            
                                            <div class="form-group">
                                              <label class="form-label">New password</label>
                                              <input type="password" name="new_password" id="new_password" class="form-control" required>
                                            </div>
                            
                                            <div class="form-group">
                                              <label class="form-label">Repeat new password</label>
                                              <input type="password" name="repeat_password" id="repeat_password" class="form-control" required>
                                            </div>
                                            
                                            <div class="text-right mt-3">
                                              <button type="submit" name="change_password" class="btn btn-primary">Save changes</button>
                                            </div>
                                            
                                        </form>    
                        
                                      </div>
                                    </div>
                                    <div class="tab-pane fade active show" id="account-orders">
                        
                                      <div class="card-body">
                                      <form method="post" autocomplete="off"> 
                                       <div class="checkout-form-wrap">
                                          <div class="form">   
                                               
                                            <div class="checkout-form-top">
                                                <h5 class="title">My Orders</h5>
                                            </div>
                                            
                                            <div class="cart-wrapper">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th class="product-name">Order ID</th>
                                                                <th class="product-price">Order Date</th>
                                                                <th class="product-price">Delivery Date</th>
                                                                <th class="product-subtotal">Total</th>
                                                                <th class="product-name">Payment Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        
                                                        <?php
                                                        $i=1;
                                                        $order_details=mysqli_query($con,"SELECT * FROM orders_table WHERE  customer_id ='".$_SESSION['logged_id']."' ORDER BY created_at DESC ");
                                                        while($order_details_row=mysqli_fetch_array($order_details))
                                                        {
                                                        ?>   
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td class="product-name"><a href="javascript:void(0)" onclick="order_items_details('<?php echo $order_details_row['id']; ?>')" >
                                                                <?php echo $order_details_row['order_id']; ?></a>
                                                            </td>
                                                            <td class="product-name"><?php echo date('d-m-Y',strtotime($order_details_row['created_at'])); ?></td>
                                                             <td class="product-name"><?php echo  $order_details_row['delivered_date'] ? date('d-m-Y',strtotime($order_details_row['delivered_date'])) : "-" ; ?></td>
                                                            <td class="product-subtotal"><span>£ <?php echo $order_details_row['total_price']; ?></span></td>
                                                            <td class="product-name">
                                                                <?php  if($order_details_row['payment_status']) {
                                                                  echo " <span style='color:green;'> Completed </span>";
                                                                }else {
                                                                  echo "<span style='color:red;'> Pending </span>"; 
                                                                } ?>
                                                            </td>
                                                        </tr>
                                                        <?php $i=$i+1;} ?>    
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        
                                       </form>
                                        
                                      </div>
                        
                                    </div>
                                    
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>    
                        </div>
                    </div>
                </div>
            </section>
            <!-- 404-area-end -->
            
            <div class="modal fade bd-example-modal-lg" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document" style="max-width: 800px;">
                <div class="modal-content">
                  <div class="modal-header border-bottom-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-title text-center">
                      <h4>Order Details</h4>
                    </div>
                   <div class="row">
                       <div class="col-md-12" id="order_details_item">
                           
                       </div>
                   </div>
                </div>
                
              </div>
             </div>
        </div>

        </main>
        <!-- main-area-end -->

        <!-- footer-area -->
        <?php include('includes/footer.php'); ?>
        <!-- footer-area-end -->


		<!-- JS here -->
        <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="js/vendor/jquery-3.6.0.min.js"></script>
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
            
          
    
		    
		</script>
        
    </body>
</html>
