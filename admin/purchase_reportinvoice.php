<?php
    include('includes/config.php');
    
    if(isset($_POST['purchase_cancel']))
    {
        $order_id=$_POST['order_id'];
        
        $reason_cancel=$_POST['reason_cancel'];
        
        $del=mysqli_query($con,"update invoiceinfo_clb set purchase_payment='Cancelled',cancel_reason='".$reason_cancel."' where inv_id='".$order_id."' and is_active='1'");
        
        if($del)
        {
            echo "<script>alert('Success! Purchase information updated.');location.href='purchase_reportsall.php'</script>";
        }
            
        else {
            
            echo "<script>alert('Opps! Something went wrong.');location.href='purchase_reportsall.php'</script>";
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Blend Ur Spice - Purchase Invoice Report</title>
		
		<!-- Favicon -->
		<!--<link rel="shortcut icon" href="assets/img/favicon.png">-->
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
		
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
		
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	
		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
			    <?php include('includes/header.php'); ?>
			<!-- /Header -->
			
			<!-- Page Wrapper -->
			<?php 
            if(isset($_GET['invno']))
            {
            ?>
			<div class="page-wrapper">
				<div class="content container-fluid">
				    <?php 
                        $id=$_GET['invno'];
                        $sql=mysqli_query($con,"select * from invoiceinfo_clb where inv_id='".$id."' and is_active='1'");
                        $row=mysqli_fetch_array($sql);
                    ?>
					<div class="row justify-content-center">
						<div class="col-xl-10">
							<div class="card">
								<div class="card-body">
									<div class="invoice-item">
										<div class="row">
											<div class="col-md-7">
												<!--<div class="invoice-logo">-->
													<!--<img src="images/logo.png" alt="logo">-->
												<!--</div>-->
												<div class="invoice-info">
													<strong class="customer-text"><u>Purchase From</u></strong>
													<p><?php echo $row['com_name'];?></p>
													<p><?php echo $row['com_address'];?></p>
													<p><?php echo $row['com_address2'];?></p>
													<p><?php echo $row['com_address3'];?></p>
													<p><?php echo $row['com_pin'];?></p>
													<p><?php echo $row['com_country'];?></p>
													<p><?php echo $row['com_email'];?></p>
													<p><?php echo $row['com_phone'];?></p>
												</div>
												<!--<span style="font-weight:bold;">Reg.No: 200508936C</span>-->
											</div>
											<div class="col-md-5">
												<table align="">
												    <tr>
												        <td><strong>Purchase ID</strong></td>
												        <td>:</td>
												        <td><?php echo $row['inv_id'];?></td>
												    </tr>
												    <tr>
												        <td><strong>Purchase Date</strong></td>
												        <td>:</td>
												        <td><?php echo date('d-m-Y',strtotime($row['invdate']));?></td>
												    </tr>
												    
												    <?php if($row['purchase_payment']!=''){?>
												    <tr>
												        <td><strong>Payment Mode</strong></td>
												        <td>:</td>
												        <td><?php echo $row['purchase_payment'];?></td>
												    </tr>
												    <?php }?>
												    
												    <?php if($row['due_date']!=''){?>
												    <tr>
												        <td><strong>Due Date</strong></td>
												        <td>:</td>
												        <td><?php echo date('d-m-Y',strtotime($row['due_date']));?></td>
												    </tr>
												    <?php }?>
												    
												    <?php if($row['purchase_file']!=''){ ?>
												    <tr>
												        <?php $file_ext = pathinfo($row['purchase_file'], PATHINFO_EXTENSION);
												        if($file_ext=='pdf' || $file_ext=='pdf')
                                                        { ?>
												            <td><a href="purchase_invoice/<?php echo $row['purchase_file']; ?>" target="_blank"><img src="images/pdf-img.png" style="width:50px; height:50px;"></a></td>
												        <?php }else if($file_ext=='zip') {?>
												            <td><a class="lightbox" href="purchase_invoice/<?php echo $row['purchase_file'];?>" target="_blank"><img src="images/Simple_Comic_zip.png" style="width:50px; height:50px;"></a></td>
												        <?php }else if($file_ext=='docx' || $file_ext=='doc' || $file_ext=='txt') {?>
												            <td><a class="lightbox" href="purchase_invoice/<?php echo $row['purchase_file']; ?>" target="_blank"><img src="images/doc-icon.png" style="width:50px; height:50px;"></a></td>
												        <?php }else{ ?>
												            <td><a class="lightbox" href="purchase_invoice/<?php echo $row['purchase_file']; ?>" target="_blank"><img src="purchase_invoice/<?php echo $row['purchase_file']; ?>" style="width:50px; height:50px;"></a></td>
												        <?php }?>
												    </tr>
												    <?php }?>
												</table>
											</div>
										</div>
									</div>
									
									<!-- Invoice Item -->
									<div class="invoice-item invoice-table-wrap">
										<div class="row">
											<div class="col-md-12">
												<div class="table-responsive">
													<table class="invoice-table table table-bordered" style="width:100%;">
														<thead>
															<tr>
															    <th style="width:10%;">S.No</th>
																<th style="width:45%;">Item Name</th>
																<th style="width:10%;">Quantity</th>
																<th style="width:10%;"></th>
																<th style="width:10%;">Price</th>
																<th style="width:15%;">Amount</th>
															</tr>
														</thead>
														<tbody>
														    <?php 
                                                                $sql2=mysqli_query($con,"select * from itemtable_clb where user_id='".$id."' and is_active='1'");
                                                                $i=1;
                                                                $grand_tot='0';
                                                                while($row2=mysqli_fetch_array($sql2))
                                                                {
                                                                $item=$row2['description'];
                                                                $quantity=$row2['quantity'];
                                                                $qty_type=$row2['qty_type'];
                                                                $prize=$row2['prize'];
                                                                $total1=$row2['total'];
                                                                $grand_tot=$grand_tot+$total1;
                                                            ?>
															<tr>
															    <td style="width:10%;"><?php echo $i; ?></td>
																<td style="width:45%;"><?php echo $item; ?></td>
																<td style="width:10%;"><?php echo $quantity; ?></td>
																<td style="width:10%;"><?php echo $qty_type; ?></td>
																<td style="width:10%;"><?php echo number_format($prize,2); ?></td>
																<td style="width:15%;"><?php echo number_format($total1,2); ?></td>
															</tr>
															<?php $i=$i+1;  } ?>
														</tbody>
														<tfoot>
														    <tr>
														        <th colspan="4"></th>
														        <th>Sub Total </th>
														        <th>£<?php echo number_format($row['subtotal'],2); ?></th>
														    </tr>
														   
														    <tr>
														        <th colspan="4"></th>
														          <th>Vat (20%) </th>
														        <th>£<?php echo number_format($row['gst'],2); ?></th>
														    </tr>
														    
														    <tr>
														        <th colspan="4"></th>
														        <th>Shipping </th>
														        <th>£<?php echo number_format($row['ship_cost'],2); ?></th>
														    </tr>
														    
														    <tr>
														        <th colspan="4"></th>
														        <th>Total </th>
														        <th>£<?php echo number_format($row['grand_total'],2); ?></th>
														    </tr>
														</tfoot>
													</table>
												</div>
											</div>
										</div>
									</div>
									<!-- /Invoice Item -->
									
										<br/>
									
									<!-- Invoice Refund --><br/>
									<?php if($row['cancel_reason']!='') { ?>
									
    									<div class="col-lg-12">
    									    <div class="card">
        										<div class="card-header">
        											<h5 class="card-title">Reason for Cancellation</h5>
        										</div>
        										<div class="card-body">
        											<p><?php echo $row['cancel_reason']; ?></p>
        										</div>
    									    </div>
    								    </div>
								    
								    <?php } ?>
								    <!-- /Invoice Refund -->
								    <br>
									<!-- /Invoice Item -->
									<div class="invoice-item">
									    
									    <!-- Accept Order -->
										<div class="row">
										    
										    <!-- Cancel Order -->
										    <div class="col-lg-3">
									            <a class="btn btn-sm btn-danger mr-2" href="javascript:void(0)" data-toggle="modal" data-target="#cancel_modal">
												<i class="fas fa-times mr-1"></i> Cancel Purchase
											    </a>  
										    </div>
										    
										    <!-- Print Order -->
										     <div class="col-lg-3">
									            <a class="btn btn-sm btn-white mr-2" href="purchase_invoice_viewpdf.php?invno=<?php echo $row['order_id']?>" target="_blank">
												<i class="fas fa-print mr-1"></i> Print
											    </a>  
										    </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Wrapper -->
		    <?php }?>
		</div>
		<!-- /Main Wrapper -->
		
		<div class="modal fade bd-example-modal-lg" id="cancel_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Purchase Cancel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" >
                        <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <label>Purchase ID</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="order_id" value="<?php echo $row['inv_id']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Reason for Cancellation</label>
                                <div class="form-group">
                                    <textarea type="text" class="form-control" name="reason_cancel" id="reason_cancel" required></textarea>
                                </div>
                            </div>
                        </div>    
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="purchase_cancel" class="btn btn-primary">Submit</button>
                        </div>
                  </form>    
                </div>
            </div>
        </div>
		
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

		<!-- Datepicker Core JS -->
		<script src="assets/plugins/moment/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>

	</body>
</html>