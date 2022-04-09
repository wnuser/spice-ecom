<?php
    include('includes/config.php');
    session_start();
?>

	     <div class="row row_count" >
	         
                   <?php
                        $id=$_GET['invno'];
                        $sql=mysqli_query($con,"select * from invoiceinfo_clb where user_id='".$id."' and is_active='1'");
                        $row=mysqli_fetch_array($sql);
                        
                        $res=mysqli_query($con,"SELECT * FROM shipping_bills where inv_id='".$row['id']."' and is_active=1");
                    
                     while($res1 = mysqli_fetch_array($res))
                     {
                        $file_ext = pathinfo($res1['refer_file'], PATHINFO_EXTENSION);
                        ?>
                        <div class="col-md-2" style="text-align:center;">
                            
                        <?php
                        if($file_ext=='PDF' || $file_ext=='pdf')
                        { 
                        ?>
                        <!--<a href="refer_file/<?php echo $res1['refer_file']; ?>" target="_blank">-->
                        <!--    <img src="images/pdf-img.png" style="width:100px;height:100px;margin:20px 0px;margin-left: 5px;">-->
                        <!--</a>-->
                        <ul style="list-style-type: none;">
                           <li style="float: left;padding: 10px;">
                                <a href="refer_file/<?php echo $res1['refer_file']; ?>" target="_blank">   
                                   <div class="dash-widget-header" >
    								  <span class="dash-widget-icon" style="background-color: #ef3737ba;">
    										<i class="far fa-file-pdf" style="color:#fff;"></i>
    								  </span>
    						        </div>
    						    </a>    
                           </li> 
                        </ul>
                        
                        <?php } else if($file_ext=='zip') { ?>
                    
                        <a class="lightbox" href="refer_file/<?php echo $res1['refer_file']; ?>" ><img src="file_images/Simple_Comic_zip.png" style="width:150px;height:150px;margin: 20px 0px;margin-left: 5px;" ></a></br>
    
                        <?php } else if($file_ext=='xlsx') { ?>
                    
                        <a class="lightbox" href="refer_file/<?php echo $res1['refer_file']; ?>" >
                            <img src="refer_file/Excel-icon.png" style="width:100px;height:100px;margin: 20px 0px;margin-left: 5px;" >
                        </a>

                        <?php } else if($file_ext=='docx' || $file_ext=='doc' || $file_ext=='txt') { ?>
                        
                          <a class="lightbox" target="_blank" href="refer_file/<?php echo $res1['refer_file']; ?>">
                            <img src="refer_file/doc-icon.png" style="width:100px;height:100px;margin:20px 0px;margin-left: 5px;">
                          </a>

                        <?php } else if($file_ext=='pages') { ?>
                    
                         <a class="lightbox" href="refer_file/<?php echo $res1['refer_file']; ?>" >
                            <img src="refer_file/pages-ios-icon.png" style="width:100px;height:100px;margin: 20px 0px;margin-left: 5px;">
                         </a>

                        <?php } else { ?>
                        
                          <a class="lightbox" href="refer_file/<?php echo $res1['refer_file']; ?>" target="_blank">
                            <img src="refer_file/<?php echo $res1['refer_file']; ?>" style="width:150px;height:150px;margin:20px 0px;margin-left: 5px;">
                          </a>
                        
                        <?php } ?><br/>
                        <a name="delete_img" id="<?php echo $res1['id']; ?>" type="button" class="btn btn-danger delete_img">Delete</a>
                       
                        </div>
                        
                        <?php } ?>        

	     </div> 
	   