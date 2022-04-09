<?php
    include('includes/config.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>LAGPAT - Amount Refund</title>
		
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
									<li class="breadcrumb-item"><a href="#">Invoices</a></li>
									<li class="breadcrumb-item active">Amount Refund</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card card-table"> 
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-stripped table-hover datatable">
											<thead class="thead-light">
												<tr>
												   <th>S.No</th>
												   <th>Invoice No</th>
												   <th>Invoice Date</th>
												   <!--<th>Invoice Total</th>-->
												   <th>Refund Date</th>
												   <th>Refund Amount</th>
												   <th>Remark</th>
												</tr>
											</thead>
											<tbody>
										        <?php 
                                            		
                                        		$i=0;
                                        		$grand_total=0;
                                        		$refund_total=0;
                                                $res=mysqli_query($con,"SELECT * FROM invrefund_amount where is_active='1'");
                                                while($row=mysqli_fetch_array($res)){
                                                    
                                                $invoice_details=mysqli_fetch_array(mysqli_query($con,"select * from invoiceinfo_clb where user_id='".$row['user_id']."' and is_active='1'"));    
                                                    
                                                $refund_total=$refund_total+$row['refund_amount'];
                                                
                                                $grand_total=$grand_total+$invoice_details['total'];
                                                
                                                $i++;
                                                
                                        	    ?>
                                        	    
												<tr>
												    <td><?php echo $i; ?></td>
													<td><?php echo $row['user_id']; ?></a></td>
													<td><?php echo date('d-m-Y',strtotime($invoice_details['invdate'])); ?></td>
													<!--<td><?php echo $invoice_details['total']; ?></td>-->
													<td><?php echo date('d-m-Y',strtotime($row['refund_date'])); ?></td>
													<td><?php echo $row['refund_amount']; ?></td>
													<td><?php echo $row['refund_remarks']; ?></td>
												</tr>
												
											<?php }?>
												
											</tbody>
											<tfoot>
											    <tr>
											       <td colspan="3"></td> 
											       <!--<td><?php echo number_format($grand_total,2); ?></td> -->
											       <td></td> 
											       <td><?php echo number_format($refund_total,2); ?></td> 
											       <td></td>
											    </tr>
											</tfoot>
										</table>
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

		<!-- Datepicker Core JS -->
		<script src="assets/plugins/moment/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>

	</body>
</html>