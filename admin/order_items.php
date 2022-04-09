<?php 

 include('includes/config.php');
 session_start();
    
 if(isset($_POST['order_id'])) {
     
     
    $order_id=$_POST['order_id'];
    
    $output='<div class="row">
                <div class="col-md-12">
				        	<div class="table-responsive">
				        	   <table id="packing-order" class="table table-stripped table-hover">
				        	       <thead>
				        	           <tr>
				        	               <td>S.No</td>
				        	               <td>Product Name</td>
				        	               <td>Qty</td>
				        	               <td>Price</td>
				        	               <td>Total</td>
				        	           </tr>
				        	       </thead>
				        	       <tbody>';
                                    $i=1;
                                    $order_items=mysqli_query($con,"select * from itemtable_clb where user_id='".$order_id."' and is_active='1'");
                                    while($order_items_rows=mysqli_fetch_array($order_items)){
                                        
                                    $output.='<tr>
                                    
                                    <td>'.$i.'</td>
                                    <td><a href="javascript:void(0)" class="appadd" data-toggle="tooltip" data-placement="bottom" title="'.$order_items_rows['description'].'">'.$order_items_rows['description'].'</a></td>
                                    <td>'.$order_items_rows['quantity'].'</td>
                                    <td>'.$order_items_rows['prize'].'</td>
                                    <td>'.$order_items_rows['total'].'</td>
                                    
                                    </tr>';    
                                        
                                    $i=$i+1;

                                    } 
                                
                                    $output.='</tbody>
                                        	   </table>
                                        	</div>      
                                        </div>
                                     </div>';
                                
                                
        echo $output;                       
                                
     
 }



?>