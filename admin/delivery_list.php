<?php

    include('includes/config.php');
    session_start();
    
    date_default_timezone_set('Asia/Calcutta');
    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

   if(isset($_POST['send_email'])) {
    
        $today_date=date('d-m-Y');
        
        $orders_id=array();
    
        require_once 'PHPExcel-1.8/Classes/PHPExcel.php';	
        
        $objPHPExcel = new PHPExcel();
        
        $mail=$_POST['email_id'];
        $delivery_com=$_POST['delivery_com'];
        $orders_id=$_POST['orders_id'];
         
        
        	$objPHPExcel->getProperties()->setCreator("Universal Computer Services")->setLastModifiedBy("Universal Computer Services");
        	$objPHPExcel = PHPExcel_IOFactory::load("template/Delivery-List-Export-Template.xlsx");		
        
        	$row_no = 2; 
        	
        	if($orders_id!='') 
        	{
			    
        	       for($j=0;$j<count($orders_id);$j++)
        	       {
        
        	
                        $order_details_=mysqli_query($con,"SELECT * FROM invoiceinfo_clb where id='".$orders_id[$j]."' and is_active='1'");
                        
                        while($order_details_row=mysqli_fetch_array($order_details_)){
                    
                        $rev_name=$order_details_row['rev_name'].' '.$order_details_row['rev_name'];
                        
                        $rev_address=$order_details_row['address1'].' , '.$order_details_row['address2'].' , '.$order_details_row['rev_country'].' - '.$order_details_row['rev_pin'];
                    
                            $item_details=mysqli_query($con,"select * from itemtable_clb where user_id='".$order_details_row['user_id']."' and is_active='1'");
                            while($item_details_row=mysqli_fetch_array($item_details))
                            {
            
                        	$objPHPExcel->setActiveSheetIndex(0)
                        				->setCellValue('A'.$row_no, trim($order_details_row['user_id']))
                        				->setCellValue('B'.$row_no, trim($order_details_row['ref_id']))
                        				->setCellValue('C'.$row_no, date('d-m-Y',strtotime($order_details_row['invdate'])))
                        				->setCellValue('D'.$row_no, trim($rev_name))
                        				->setCellValue('E'.$row_no, trim($order_details_row['rev_phone']))
                        				->setCellValue('F'.$row_no, $rev_address)
                        				->setCellValue('G'.$row_no, trim($item_details_row['description']));
                        			
                        				$row_no++;
                        	}
                    	
                        }
                        
                    //  $update_status=mysqli_query($con,"update invoiceinfo_clb set status='4' where id='".$orders_id[$j]."' and is_active='1'");     
            
        	       }
                	
                	
                	$objPHPExcel->getActiveSheet()->setTitle('Today Orders - '.$today_date);
                	$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_FOLIO);
                	
                
                	$objPHPExcel->setActiveSheetIndex(0);
                	$stamp='Delivery_orders_'.date('d-m-Y').'_'.date('U').'.xlsx';
                	$file_name = 'send_orders/'.$stamp;
                	
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                    
                    $objWriter->save($file_name);
                
                    $to=$mail;
                
                    $subject="UCS - Delivery Orders";
                    
                    $msg="UCS Today Orders";
                    
                    require 'class/class.phpmailer.php';
                	$mail = new PHPMailer;
                	$mail->Host = 'universalcomputer.com.sg';
                	$mail->Port = $_SERVER['SERVER_PORT'];
                	$mail->SMTPDebug  = 1;                            
                	$mail->SMTPAuth = true;							
                	$mail->SetFrom("sales@universalcomputer.com.sg","UCS");
                	$mail->SMTPSecure = 'ssl';							
                	$mail->From = 'sales@universalcomputer.com.sg';		
                	$mail->FromName = 'UCS';		
                	$mail->AddAddress($to, 'Sales Team');	
                	$mail->IsHTML(true);									
                	$mail->AddAttachment($file_name); 
                	$mail->Subject = 'UCS - Today Orders';
                	$mail->Body = 'Please Collect Your Invoice Report.';	
                
                if($mail->Send()){
                    
                    echo "<script>alert('Delivery Mail send Successfully..');location.href='delivery_list.php';</script>";
                    
                } else {
                    
                     echo "<script>alert('Something went wrong.Please try again.');location.href='delivery_list.php';</script>";
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
		<title>UCS - Delivery Orders</title>
		
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
									<li class="breadcrumb-item"><a href="#">Today Orders</a></li>
									<li class="breadcrumb-item active">Delivery List</li>
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
						                	<select class="select" name="delivery_com" id="delivery_com" onchange="delivery_change(this.value)" required>
												<option value="">Select Option</option>
												<?php
                                                $delivery_com=mysqli_query($con,"select * from delivery_company where is_active='1'");
                                                while($delivery_com_row=mysqli_fetch_array($delivery_com))
                                                { ?>
												    <option value="<?php echo $delivery_com_row['id']; ?>" <?php if($delivery_com_row['id']==$_GET['type']) { ?> selected <?php } ?>><?php echo $delivery_com_row['company_name']; ?></option>
                                                <?php } ?>
										    </select>
    						            </div>
    						        </div>
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
										<table id="delivery-order" class="table table-stripped table-hover">
											<thead class="thead-light">
												<tr>
												   <th data-orderable="false"><input type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);" /></th> 
												   <th>Order ID</th>
												   <th>Reference ID</th>
												   <th>Order Date</th>
												   <th>Delivery</th>
												   <th>Customer Name</th>
												   <th>Shipping To</th>
												   <th>Product Name</th>
												</tr>
											</thead>
											<tbody>
										        <?php 
										        
									               
                                            		
                                            		$i=0;
                                            		$grand_total=0;
                                                    $res=mysqli_query($con,"SELECT * FROM invoiceinfo_clb where is_active='1' ORDER BY id DESC");
                                                    while($row=mysqli_fetch_array($res)){
                                                        
                                                    $delivery_company=mysqli_fetch_array(mysqli_query($con,"select * from delivery_company where id='".$row['delivery_company']."' and is_active='1'"));    
                                                    
                                                    $grand_total=$grand_total+$row['total'];
                                                    
                                                    $item_details=mysqli_query($con,"select * from itemtable_clb where user_id='".$row['user_id']."' and is_active='1'");
                                                    while($item_details_row=mysqli_fetch_array($item_details))
                                                    {
                                                        
                                                     $i++;        
                                        	  
                                        	          ?>
                                        	    
    												<tr>
    												    <td><input type="checkbox" name="orders_id[]" class="case" id="orders_id" value="<?php echo $row['id']; ?>" ></td>
    													<td><?php echo $row['user_id']; ?></td>
    													<td><?php echo $row['ref_id']; ?></td>
    													<td><?php echo date('d-m-Y',strtotime($row['invdate'])); ?></td>
    													<td><?php echo $delivery_company['company_name']; ?></td>
    													<td><?php echo $row['rev_name'].' '.$row['last_name'];?></td>
    													<td>
            												<p></p>
        													<p><?php echo $row['address1'];?></p>
        													<p><?php echo $row['address2'];?></p>
        													<p><?php echo $row['rev_pin'];?></p>
        													<p><?php echo $row['rev_country'];?></p>
        													<p><?php echo $row['rev_email'];?></p>
        													<p><?php echo $row['rev_phone'];?></p>    
    													</td>
    													<td><?php echo $item_details_row['description']; ?></td>
    												</tr>
												<?php } }?>
											</tbody>
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
		
            $(document).ready(function() {
                
                $('#delivery-order').DataTable({
    		    
                         "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
                         "pageLength": -1,
                         dom: 'Bfrtip',
                         buttons: [
                           
                            {
                                extend: 'excel',
                                footer:true,
                                text: 'Download Excel',
                                 exportOptions: {
                                    columns: ':visible'
                                }
                            },
                             {
                                extend: 'pdf',
                                orientation: 'landscape',
                                footer:true,
                                text: 'Download PDF',
                                 exportOptions: {
                                    columns: ':visible'
                                }
                            }
                        ],
                        select: true
                         
                });    
                
            
              
            }); 
            
          
            
		</script>
		
		 <script>
    
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
        
        
            function delivery_change(val) {
                 
                if(val!=''){
                    
                    window.location.href='delivery_list.php?type='+val;
                    
                } else {
                    
                    window.location.href='delivery_list.php';
                } 
                 
            }
        
    </script>

	</body>
</html>