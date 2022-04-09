<?php

    include('includes/config.php');
    session_start();
    
    date_default_timezone_set('Asia/Calcutta');
    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

   if(isset($_POST['send_email'])) {
       
        $orders_id=array();
    
        $today_date=date('d-m-Y');
    
        require_once 'PHPExcel-1.8/Classes/PHPExcel.php';	
        
        $objPHPExcel = new PHPExcel();
        
        $mail=$_POST['email_id'];
        
        $orders_id=$_POST['orders_id'];
         
        
        	$objPHPExcel->getProperties()->setCreator("Universal Computer Services")->setLastModifiedBy("Universal Computer Services");
        	$objPHPExcel = PHPExcel_IOFactory::load("template/Orders-Export-Template.xlsx");		
        
        	$row_no = 2; 
			
			if($orders_id!='') {
			    
			       for($j=0;$j<count($orders_id);$j++)
			       {
        	
                        $order_details=mysqli_query($con,"SELECT * FROM invoiceinfo_clb where id='".$orders_id[$j]."' and is_active='1'");
                        while($order_details_row=mysqli_fetch_array($order_details)){
                    
                        $rev_name=$order_details_row['rev_name'].' '.$order_details_row['last_name'];
                        
                        $rev_address='';
                        
                        if($order_details_row['address1']!=''){
                            
                          $rev_address.=$order_details_row['address1'].',';    
                            
                        }
                        
                        if($order_details_row['address2']!=''){
                            
                          $rev_address.=$order_details_row['address2'].',';    
                            
                        }
                        
                        if($order_details_row['rev_country']!=''){
                            
                          $rev_address.=$order_details_row['rev_country'].',';    
                            
                        }
                        
                        if($order_details_row['rev_pin']!=''){
                            
                          $rev_address.=$order_details_row['rev_pin'].',';    
                            
                        }
                        
                        $delivery_company=mysqli_fetch_array(mysqli_query($con,"select * from delivery_company where id='".$order_details_row['delivery_company']."' and is_active='1'"));
                        
                            $item_details=mysqli_query($con,"select * from itemtable_clb where user_id='".$order_details_row['user_id']."' and is_active='1'");
                            while($item_details_row=mysqli_fetch_array($item_details))
                            {
            
                        	$objPHPExcel->setActiveSheetIndex(0)
                        				->setCellValue('A'.$row_no, trim($order_details_row['user_id']))
                        			    ->setCellValueExplicit('B'.$row_no, trim($order_details_row['ref_id'], PHPExcel_Cell_DataType::TYPE_STRING))
                        				->setCellValue('C'.$row_no, date('d-m-Y',strtotime($order_details_row['invdate'])))
                        				->setCellValue('D'.$row_no, trim($rev_name))
                        				->setCellValue('E'.$row_no, trim($order_details_row['rev_phone']))
                        				->setCellValue('F'.$row_no, $rev_address)
                        				->setCellValue('G'.$row_no, trim($delivery_company['company_name']))
                        				->setCellValue('H'.$row_no, trim($item_details_row['description']))
                        				->setCellValue('I'.$row_no, trim($item_details_row['quantity']));
                        				
                        			$row_no++;
                        	}
                    	
                        }
                        
                       $update_status=mysqli_query($con,"update invoiceinfo_clb set status='2' where id='".$orders_id[$j]."' and is_active='1'"); 
                        
                    
			       }
                	
                	
                	$objPHPExcel->getActiveSheet()->setTitle('Today Orders - '.$today_date);
                	$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_FOLIO);
                	
                
                	
                	$objPHPExcel->setActiveSheetIndex(0);
                	$stamp='Today_orders_'.date('d-m-Y').'_'.date('U').'.xlsx';
                	$file_name = 'send_orders/'.$stamp;
                	
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                    
                    $objWriter->save($file_name);
                
                    $to=$mail;
                
                    $subject="UCS - Packing Lists";
                    
                    $msg="UCS - Packing Lists for '".date('d-m-Y')."'";
                    
                    require_once ("PHPMailer/class.phpmailer.php");  
                    require_once ("PHPMailer/class.smtp.php");
                	
                	$mail = new PHPMailer();
                    $mail->IsSMTP();
                	$mail->Host       = "universalcomputer.com.sg";
                	$mail->SMTPDebug  = 1;                
                	$mail->SMTPAuth   = false;                  
                	$mail->SMTPSecure = "ssl";                 
                	$mail->Port       = 465;  
                	$mail->IsHTML(true);
                	$mail->Username = 'notification@universalcomputer.com.sg';
                    $mail->Password = 'Ggn6d#$lBKU*';
                    $mail->SMTPAuth = false; 
                	$mail->Subject = $subject;
                	
                	$mail->SetFrom("sales@universalcomputer.com.sg","UCS");
                    $mail->From = "sales@universalcomputer.com.sg";
                    $mail->FromName = "Universal Computer Services";
                			
                	$mail->AddAddress($to, 'Sales Team');
                	
                	$mail->addBCC("ucsbhuvana@gmail.com","Bhuvana");
                	
                	$mail->addBCC("periyasamyanbu@gmail.com","Anbu");
                	
                	$mail->addBCC("gemonster021@gmail.com","Testing");
                	
                	$mail->AddAttachment($file_name);
                	
                	for($k=0;$k<count($orders_id);$k++)
                	{
                	  
                	  $shipping_bills=mysqli_query($con,"select * from shipping_bills where inv_id='".$orders_id[$k]."' and is_active='1'");
                	  while($shipping_bills_row=mysqli_fetch_array($shipping_bills))
                	  {
                	    
                	    $bills_name="refer_file/".$shipping_bills_row['refer_file'];
                	
                	    $mail->AddAttachment($bills_name);
                	  
                	  }
                	
                	}
                	
                  $mail->AltBody = "This is the body in plain text for non-HTML mail clients";

                  $mail->MsgHTML($msg);
                
                if($mail->Send()){
                    
                    echo "<script>alert('Packing Mail send Successfully..');location.href='packing_updates.php';</script>";
                    
                } else {
                    
                     echo "<script>alert('Something went wrong.Please try again.');location.href='packing_updates.php';</script>";
                }   
        
			} else {
			    
			    echo "<script>alert('Oops! Please select any one checkbox.');</script>";
			    
			}    
       
}
    
    
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>UCS - Packing List</title>
		
		<!-- Favicon -->
		<!--<link rel="shortcut icon" href="assets/img/favicon.png">-->
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
		<link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
		
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
		
		<style>
		 
		 .pagination { 
		     
		     padding: 0 1.5rem 1.5rem;
		     
		 }   
		 
		  .buttons-excel {
		  
    		color: #fff;
            background-color: #009efb;
            border: 1px solid #009efb;
            padding: .375rem .75rem;
            border-radius: .25rem;   
		     
		 }
		 
		 .buttons-pdf {
		  
    		color: #fff;
            background-color: #009efb;
            border: 1px solid #009efb;
            padding: .375rem .75rem;
            border-radius: .25rem;   
		     
		 }
		    
		</style>
		
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	
		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<?php include('includes/header.php'); ?>
			
			<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">
			
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<!--<h3 class="page-title">Invoices</h3>-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active">Packing List</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
						    
						  <form method="post"> 
								    
						     <div class="row">
						        <div class="col-md-4">
						            <label>Sender Email ID</label>
						            <div class="form-group">
						                <input type="email" class="form-control" name="email_id" id="email_id" placeholder="Sender Email" required>
						            </div>
						        </div>
						        <div class="col-md-4">
						            <div class="form-group">
						                <input type="submit" name="send_email" class="btn btn-success" value="Send" style="margin-top:30px;">
						            </div>
						        </div>
						    </div>
						    
						    
							<div class="card card-table"> 
								<div class="card-body">
									<div class="table-responsive" style="padding: 1.5rem 1.5rem 0;">
									    <div class="row">
									        <div class="col-md-4">
									            <a href="download_packing_list.php" class="btn btn-info" type="button" >Download Excel</a>&nbsp;&nbsp;
									            <a href="pdf_download_packing_list.php" target="_blank" class="btn btn-info" type="button" >Download PDF</a>
									        </div>
									    </div>
										<table class="table table-stripped table-hover datatable">
											<thead class="thead-light">
												<tr>
												  <th data-orderable="false"><input type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);"></th>
												   <th>Order ID</th>
												   <th>Reference ID</th>
												   <th>Order Date</th>
												   <th>Delivery</th>
												   <th>Customer Name</th>
												   <th>Shipping To</th>
												   <th>Total</th>
												</tr>
											</thead>
											<tbody>
										        <?php 
                                            		$i=0;
                                            		$grand_total=0;
                                                    $res=mysqli_query($con,"SELECT * FROM invoiceinfo_clb where status='1' and is_active='1' ORDER BY id DESC");
                                                    while($row=mysqli_fetch_array($res)){
                                                    
                                                    $delivery_status_row=mysqli_fetch_array(mysqli_query($con,"select * from delivery_status where id='".$row['status']."' and is_active='1'"));
                                                    
                                                    $delivery_company=mysqli_fetch_array(mysqli_query($con,"select * from delivery_company where id='".$row['delivery_company']."' and is_active='1'")); 
                                                    
                                                    $grand_total=$grand_total+$row['total'];
                                                        
                                                    $i++;        
                                        	  
                                        	        ?>
                                        	    
    												<tr>
    												    <?php if($row['status']=='1') { ?>
    												      <td><input type="checkbox" name="orders_id[]" class="case" id="orders_id" value="<?php echo $row['id']; ?>" ></td>
    													<?php } else { ?>
    													   <td><input type="checkbox" name="orders_id[]" class="case" id="orders_id" value="<?php echo $row['id']; ?>" disabled></td>
    													<?php } ?>
    													
    													<td><a href="javascript:void(0)" type="button" class="badge bg-primary-light" onclick="products_list('<?php echo $row['user_id']; ?>')"><?php echo $row['user_id']; ?></a></td>
    													<td><?php echo $row['ref_id']; ?></td>
    													<td><?php echo date('d-m-Y',strtotime($row['invdate'])); ?></td>
    													<td><?php echo $delivery_company['company_name']; ?></td>
    													<td><?php echo $row['rev_name'].' '.$row['last_name'];?></td>
    													<td>
            											<address>	
        													<?php echo $row['address1'];?></br>
        												    <?php echo $row['address2'];?></br>
        													<?php echo $row['rev_pin'];?></br>
        												    <?php echo $row['rev_country'];?></br>
        													<?php echo $row['rev_email'];?></br>
        													<?php echo $row['rev_phone'];?> 
        												</address>
    													</td>
    													<td><?php echo number_format($row['total'],2); ?></td>
    												</tr>
												<?php }?>
											</tbody>
											<tfoot>
											    <tr>
											       <td colspan="6"></td>
											       <td align="right"><b>Sub Total</b></td>
											       <td><?php echo number_format($grand_total,2); ?></td>
											    </tr>
											</tfoot>
										</table>
									   </form>	
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Wrapper -->
			
		   <div class="modal fade  bd-example-modal-lg" id="orderitems" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document" style="max-width: 850px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Order Items</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="order_items">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                       </div>
                    </div>
                </div>	
			
		</div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
		<script src="assets/js/jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Feather Icon JS -->
		<script src="assets/js/feather.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>
		
		<!-- Datatables JS -->
		<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/datatables/datatables.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

		<!-- Datepicker Core JS -->
		<script src="assets/plugins/moment/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
		 <script>
		 
		  function products_list(ord_id){
		
		  $.ajax({  
            	    
                url:"order_items.php",  
                method:"POST",  
                data:{ order_id:ord_id },  
                success:function(data)  
                { 
                    
                    $('#order_items').html(data);
                    
                    $('#orderitems').modal('show');
                  
                }  
            });     
		     
		 }
    
           function check_uncheck_checkbox(isChecked) {
            	if(isChecked) {
            		$('input[class="case"]').each(function() { 
            			this.checked = true; 
            		});
            	} else {
            		$('input[class="case"]').each(function() {
            			this.checked = false;
            		});
            	}
            }
            
        </script>

	</body>
</html>