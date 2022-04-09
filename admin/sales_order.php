<?php
    include('includes/config.php');
    session_start();
    
    $_SESSION['pch_form_date']='';
    $_SESSION['pch_to_date']='';
    
    if(isset($_POST['search'])) {
        
      $_SESSION['pch_form_date']=$_POST['from_date'];  
      $_SESSION['pch_to_date']=$_POST['to_date'];  
        
    }
    
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Blend Ur Spice - Sales Order Details</title>
		
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
		
		<style>
		 
		 .text-primary {
		     
                color: #0f1568 !important;
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
									<li class="breadcrumb-item active">Sales Order Details</li>
								</ul>
							</div>
							<?php 
							$sales_total=mysqli_query($con,"SELECT * FROM orders where status='4' and is_active='1'");
                            while($row_sales=mysqli_fetch_array($sales_total)){
                                
                                $total=$total+$row_sales['total_price'];
                            } 
                            ?>
                            <div class="col">
								<!--<h3 class="page-title">Invoices</h3>-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Sales Total</a></li>
									<li class="breadcrumb-item active"><?php echo number_format($total,2); ?></li>
								</ul>
							</div>
							<div class="col-auto">
								<!--<a href="invoice.php" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Create Invoice">-->
								<!--	<i class="fas fa-plus"></i>-->
								<!--</a>-->
								<a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search" data-toggle="tooltip" data-placement="bottom" title="Advanced Search">
									<i class="fas fa-filter"></i> Filter
								</a>
								<!--<a class="btn btn-primary filter-btn" href="print_report_pdf.php" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Download Sales Report">-->
								<!--	<i class="far fa-file-pdf"></i>-->
								<!--</a>-->
							</div>
						</div>
					</div>
					<!-- /Page Header -->
			   
					<!-- Search Filter -->
					<div id="filter_inputs" class="card filter-card" style="display:block;">
						<div class="card-body pb-0">
						    <form method="POST">
						        <div class="row">
    								<div class="col-md-3">
    									<div class="form-group">
    										<label>Invoice No</label>
    										<input type="text" class="form-control" name="invoiceno" value="<?php if(isset($_POST['search'])) {  echo $_POST['invoiceno'];  } ?>">
    									</div>
    								</div>
    								<div class="col-md-1">
    									<div class="form-group">
    										<label style="margin-top: 35px;">(or)</label>
    							 	</div>
    							 	</div>
    								<div class="col-md-3">
    									<div class="form-group">
    										<label>From Date</label>
    										<div class="cal-icon">
    											<input class="form-control datetimepicker" type="text" name="from_date" value="<?php if(isset($_POST['search'])) {  echo $_POST['from_date'];  } ?>">
    										</div>
    									</div>
    								</div>
    								<div class="col-md-3">
    									<div class="form-group">
    										<label>To Date</label>
    										<div class="cal-icon">
    											<input class="form-control datetimepicker" type="text" name="to_date" value="<?php if(isset($_POST['search'])) {  echo $_POST['to_date'];  } ?>">
    										</div>
    									</div>
    								</div>
    								<div class="col-md-2">
    								    <div class="form-group">
    								        <label></label>
    								        <button type="submit" name="search" class="btn btn-success" style="margin-top: 30px;"><i class="fas fa-search"></i></button>
    								        <a href="sales_order.php" class="btn btn-info" style="margin-top: 30px;"><i class="fa fa-times"></i></a>
    								    </div>
    								</div>
							    </div>
						    </form>
						</div>
					</div>
					<!-- /Search Filter -->
					
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
												   <th>Delivery Date</th>
												   <th>Customer Name</th>
												   <th>Total Price</th>
												   <th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>
										        <?php 
										        
									                $dateQuery='';
									            
        											if($_POST['from_date']!='' && $_POST['to_date']!='')
                                            		{
                                            		    
                                            		    $from_date=date('Y-m-d',strtotime($_POST['from_date']));
                                            		    $to_date=date('Y-m-d',strtotime($_POST['to_date']));
                                            		  
                                            		    
                                            			$dateQuery ="AND order_date BETWEEN '".$from_date."' AND '".$to_date."'";
                                            			
                                            		} 
                                            		
                                            	    $i=1;
                                            		$grand_total=0;
                                            		
                                                    $res=mysqli_query($con,"SELECT * FROM orders where status='4' and is_active='1' $dateQuery ORDER BY id DESC");
                                                    while($row=mysqli_fetch_array($res)){
                                                    
                                                    $grand_total=$grand_total+$row['total_price'];
                                                    
                                                    $customers_row=mysqli_fetch_array(mysqli_query($con,"select * from customers where id='".$row['customer_id']."' and is_active='1'"));
                        
                                                    $delivery_status_row=mysqli_fetch_array(mysqli_query($con,"select * from delivery_status where id='".$row['status']."' and is_active='1'"));
                                                    
                                                    $delivery_company=mysqli_fetch_array(mysqli_query($con,"select * from delivery_company where id='".$row['delivery_company']."' and is_active='1'"));

                                                    
                                        	    ?>
                                        	    
												<tr>
												    <td><?php echo $i; ?></td>
													<td><?php echo $row['order_id']; ?></td>
													<td><?php echo date('d-m-Y',strtotime($row['order_date'])); ?></td>
														<td><?php echo date('d-m-Y',strtotime($row['delivery_date'])); ?></td>
													<td><?php echo $customers_row['first_name'].' '.$customers_row['last_name']; ?></td>
													<td><?php echo number_format($row['total_price'],2); ?></td>
													<td class="text-right">
														<a class="btn btn-sm btn-primary mr-2" href="invoice_viewpdf.php?invno=<?php echo $row['order_id']?>" target="_blank">
															<i class="fas fa-download mr-1"></i> Print
														</a>
														<a class="btn btn-sm btn-info" href="sales_invoice.php?invno=<?php echo $row['order_id']?>">
															<i class="far fa-eye mr-1"></i> View
														</a>
													</td>
												</tr>
												
												<?php $i++; } ?>
												
											</tbody>
											<tfoot>
											    <tr>
											       <td colspan="4"></td>
											       <td align="right"><b>Sub Total</b></td>
											       <td><?php echo number_format($grand_total,2); ?></td>
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