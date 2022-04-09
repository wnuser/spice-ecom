          <footer>
            <div class="footer-area gray-bg pt-80 pb-30">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-3 col-lg-4 col-md-6" style="margin-top: -40px;">
                            <div class="footer-widget mb-50">
                                <!--<div class="footer-logo mb-25">-->
                                <!--    <a href="javascript:void(0)"><img src="admin/assets/img/profiles/<?php echo $profile_details['profile_img']; ?>" alt="Logo"></a>-->
                                <!--</div>-->
                                 <div class="fw-title">
                                    <h5 class="title">Location</h5>
                                </div>
                                <div class="footer-contact-list">
                                    <ul>
                                        <li>
                                            <div class="icon"><i class="flaticon-place"></i></div>
                                             <p><?php echo $profile_details['address1']; ?></p>
                                            <?php if($profile_details['address2']!=='') { ?>
                                             <p><?php echo $profile_details['address2']; ?></p>
                                            <?php } ?>    
                                            
                                        </li>
                                        <li>
                                            <div class="icon"><i class="flaticon-telephone-1"></i></div>
                                            <h5 class="number"><a href="tel:<?php echo $profile_details['phone']; ?>"><?php echo $profile_details['phone']; ?></a></h5>
                                        </li>
                                        <li>
                                            <div class="icon"><i class="flaticon-mail"></i></div>
                                            <p><a href="/cdn-cgi/l/email-protection#b7c4c2c7c7d8c5c3f7c1d2d0d2d999d4d8da"><span class="__cf_email__" data-cfemail="fa898f8a8a95888eba8c9f9d9f94d4999597">[<?php echo $profile_details['email']; ?>]</span></a></p>
                                        </li>
                                        <li>
                                            <div class="icon"><i class="flaticon-wall-clock"></i></div>
                                            <p>Week 7 days - <?php echo $profile_details['opening_hours']; ?></p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="footer-social">
                                    <ul>
                                        <li><a href="https://www.facebook.com/profile.php?id=100076340330842" target="_blank"><img src="img/fb.png"></a></li>
                                        <li><a href="https://www.instagram.com/blendurspice/" target="_blank"><img src="img/insta.png"></a></li>
                                        <li><a href="https://www.youtube.com/channel/UCzagYglJ1t3-jCfgtqMkfMQ" target="_blank"><img src="img/youtube.png"></a></li>
                                        <li><a href="https://www.linkedin.com/in/blend-ur-spice-8a3b18229/" target="_blank"><img src="img/linkedin.png"></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="footer-widget mb-50">
                                <div class="fw-title">
                                    <h5 class="title">Services</h5>
                                </div>
                                <div class="fw-link">
                                    <ul>
                                        <li><a href="javascript:void(0)">Order Status</a></li>
                                        <li><a href="javascript:void(0)">Our Blog</a></li>
                                        <li><a href="javascript:void(0)">Track Your Orders</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="footer-widget mb-50">
                                <div class="fw-title">
                                    <h5 class="title">Useful Links</h5>
                                </div>
                                <div class="fw-link">
                                    <ul>
                                        <li><a href="about-us.php">About Us</a></li>
                                        <li><a href="contact-us.php">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="footer-widget footer-box-widget mb-50">
                                <div class="f-newsletter">
                                    <div class="fw-title">
                                        <h5 class="title" style="color: #675f5b;">Sign Up</h5>
                                    </div>
                                    <form method="post" autocomplete="off">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your name *" required>
                                        <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Your email address *" required>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Your password *" required>
                                        <input type="submit" name="register" class="btn btn-success btn-round" value="Submit" style="background: #4eb92d;color: #ffff;padding: 0px;">
                                        <!--<button type="submit" name="subscribe"><i class="flaticon-send"></i></button>-->
                                    </form>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="copyright-wrap">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="copyright-text">
                                <p>Copyright &copy; <?php echo date('Y'); ?> BlendUrSpice. All Rights Reserved</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="payment-accepted text-center text-md-right">
                                <img src="img/images/payment_card.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        
      <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-title text-center">
                  <h4>Login</h4>
                </div>
                <div class="d-flex flex-column text-center">
                  <form method="post" autocomplete="off">
                    <div class="form-group">
                      <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Your email address *" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Your password *" required>
                    </div>
                    <button type="submit" name="account_login" class="btn btn-info btn-block btn-round">Login</button>
                  </form>
              </div>
            </div>
              <div class="modal-footer d-flex justify-content-center" style="text-align: center;">
                <div class="signup-section">
                    <a href="javascript:void(0)" class="text-info" onclick="ResetModal()"> Forget password?</a><br><br>
                    Not a member yet? <a href="javascript:void(0)" class="text-info" onclick="SignupModal()"> Sign Up</a>.
                </div>
              </div>
          </div>
         </div>
        </div>
        
        <div class="modal fade" id="SignupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-title text-center">
                  <h4>Sign Up</h4>
                </div>
                <div class="d-flex flex-column text-center">
                  <form method="post" autocomplete="off">
                     <div class="form-group">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Your name *" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="mobileno" id="mobileno" placeholder="Your phone number *" required>
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Your email address *" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Your password *" required>
                    </div>
                    <button type="submit" name="register" class="btn btn-info btn-block btn-round">Submit</button>
                  </form>
              </div>
            </div>
          </div>
        </div>    
    </div> 
    
        <div class="modal fade" id="ForgetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-title text-center">
                  <h4>Forget Password</h4>
                </div>
                <div class="d-flex flex-column text-center">
                  <form method="post" action="reset_password_email.php" autocomplete="off">
                    <p>Enter the email address associated to your account, we will send you the link to reset your password</p>  
                    <div class="form-group">
                      <input type="email" class="form-control" name="email_id" id="email_id" placeholder="Your email address *" required>
                    </div>
                    <button type="submit" name="reset_password" class="btn btn-info btn-block btn-round">Submit</button>
                  </form>
              </div>
            </div>
          </div>
        </div>    
    </div> 
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
        
      function loginModal(){
         
         $('#SignupModal').modal('hide'); 
         $('#ForgetPasswordModal').modal('hide');
         $('#loginModal').modal('show');
        
       }
        	
      function SignupModal(){
          
         $('#ForgetPasswordModal').modal('hide');
         $('#loginModal').modal('hide');	  
    	 $('#SignupModal').modal('show');
        	        
      }
      
      function ResetModal(){
          
          $('#loginModal').modal('hide');	  
    	  $('#SignupModal').modal('hide');	  
    	  $('#ForgetPasswordModal').modal('show');
        	        
      }
        
    </script>   
       
     <script>
    
        function increment_quantity(cart_id) {
            
        var inputQuantityElement = $("#input-quantity-"+cart_id);
        
        var newQuantity = parseInt($(inputQuantityElement).val())+1;
           
            save_to_db(cart_id, newQuantity);
        
         }
    
       function decrement_quantity(cart_id) {
           
        var inputQuantityElement = $("#input-quantity-"+cart_id);
        
            if($(inputQuantityElement).val() > 1) 
            {
                
            var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
            
            save_to_db(cart_id, newQuantity);
            
            }
        
        }
        
       function save_to_db(cart_id, new_quantity) {
            
        var action="updateCartItem";
    	
        $.ajax({
    		url : "cartAction.php",
    		data : "action="+action+"&id="+cart_id+"&qty="+new_quantity,
    		type : 'get',
    		success : function(response) {
    		   
    		 $('.cart-dropdown').html(response);   
    		
    		 view_cart();
    		
    		}
    		
    	});
    	
        }
        
        
       function addToDeals(cart_id,category) {

        //  console.log('test');
         
           
          $('.prd-loader').html('<div id="loading" style="text-align:center;" ></div>');  
         
          var action="addToDeals";
          
          var product_qty=$('#cart_qty_'+cart_id).val();
          
            $.ajax({
                
        		url : "cartAction.php",
        		data : "action="+action+"&id="+cart_id+"&category="+category+"&prd_qty="+product_qty,
        		type : 'get',
        		success : function(response) {
        	
                $('.cart-dropdown').html(response);
                console.log(response, 'success');
                
                
                $(window).scrollTop(0);
                
                $('.prd-loader').html(''); 
              
               },
            error:function(data) {
              console.log(data, 'error');
              
            }   
    		
    	});
    	
        }

        function addRecipeToDeals(cart_id,category) {
           
           $('.prd-loader').html('<div id="loading" style="text-align:center;" ></div>');  
          
           var action="addRecipeToDeals";
           
          //  var product_qty=$('#cart_qty_'+cart_id).val();
           var product_qty= 1;
           
             $.ajax({
                 
             url : "cartAction.php",
             data : "action="+action+"&id="+cart_id+"&category="+category+"&prd_qty="+product_qty,
             type : 'get',
             success : function(response) {
           
                 $('.cart-dropdown').html(response);
                 
                 $(window).scrollTop(0);
                 
                 $('.prd-loader').html(''); 
               
                }
         
       });
       
         }
        
       function removeCartItem(cart_id) {
    
        var action="removeCartItem";
    	
            $.ajax({
        		url : "cartAction.php",
        		data : "action="+action+"&id="+cart_id,
        		type : 'get',
        		success : function(response) {
        		
        		 $('.cart-dropdown').html(response); 
        		 
    		     view_cart();
        		
        		}
        		
        	});
    	
        }
        
        
        function addToWhishlist(cart_id) {
           
     
          var action="addWhishlistItem";
        	
                $.ajax({
            		url : "cartAction.php",
            		data : "action="+action+"&id="+cart_id,
            		type : 'get',
            		success : function(response) {
                   
                  
                   }
        		
        	});
    	
        }
        
      function view_cart(){
                
              $.ajax({
                  
                url: "ajax_cart_items.php",
                success: function(data) 
                {
                
                 $('#cart-items').html(data);
              
                }
                
                }); 
                
         }
        
        
      function removeWhishlist(cart_id) {
      
        var action="removeWhishlistItem";
    	
            $.ajax({
        		url : "cartAction.php",
        		data : "action="+action+"&id="+cart_id,
        		type : 'get',
        		success : function(response) {
        		 
        		 view_whishlist();
        		
        		}
        		
        	});
    	
        }
        
        
        function order_items_details(id){
        	  
            $.ajax({
            url : "ajax_order_product_details.php",
            data : {id:id },
            type : 'post',
            success : function(response) {
                
             $('#order_details_item').html(response);
             
             $('#order_details').modal('show');
            
            }
            
          });    
            
        }
        
            
     
   </script> 
        