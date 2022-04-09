<?php
    include('includes/config.php');
    session_start();

   if(isset($_GET['del']))
    {
        $row_id=$_GET['del'];
        
        $del_data=mysqli_query($con,"update expenses_receipt set is_active='0' where id='".$row_id."' and is_active=1");
        
        if($del_data==true)
        {
             echo "<script>alert('Deleted Successfully..!!');location.href='expenses_reportsall.php'</script>";
        }
            
        else {
            
             echo "<script>alert('Something went wrong..!!');location.href='expenses_reportsall.php'</script>";
        }
        
    }
    
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
		<title>Blend Ur Spice - Expenses Report</title>
		
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
    			 <?php
    			 $expenses_totals=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as grand_total from expenses_receipt where is_active='1'")); 
    			 ?>
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<!--<h3 class="page-title">Invoices</h3>-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Expenses Report</a></li>
									<li class="breadcrumb-item active">All Report Details</li>
								</ul>
							</div>
							<div class="col">
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Expensesn Total</a></li>
									<li class="breadcrumb-item active"><?php echo number_format($expenses_totals['grand_total'],2); ?></li>
								</ul>
							</div>
							<div class="col-auto">
								<a href="expenses_receipt.php" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Create Expenses Invoice">
									<i class="fas fa-plus"></i> Create
								</a>
								<a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search" data-toggle="tooltip" data-placement="bottom" title="Advanced Search">
									<i class="fas fa-filter"></i> Filter
								</a>
								
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
    										<label>Expenses No</label>
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
    								        <a href="expenses_reportsall.php" class="btn btn-info" style="margin-top: 30px;"><i class="fa fa-times"></i></a>
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
												   <th>Expenses ID</th>
												   <th>Category</th>
												   <th>Supplier Name</th>
												   <th>Payment</th>
												   <th>Total Amount</th>
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
                                            		  
                                            		    
                                            			$dateQuery ="AND date BETWEEN '".$from_date."' AND '".$to_date."'";
                                            			
                                            		} else if($_POST['invoiceno']!='') {
                                            		    
                                            		    $dateQuery ="AND exp_id= '".$_POST['invoiceno']."'";
                                            		}
                                            		
                                            		$i=0;
                                            		$grand_total=0;
                                                    $res=mysqli_query($con,"SELECT * FROM expenses_receipt where is_active='1' $dateQuery ORDER BY date desc");
                                                    while($row=mysqli_fetch_array($res)){
                                                        
                                                    $exp_category=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM expenses_category where id='".$row['exp_category']."' and is_active='1'"));    
                                                    
                                                    $grand_total=$grand_total+$row['amount'];
                                                    
                                                    $i++;
                                        	    ?>
                                        	    
												<tr>
												    <td><?php echo $i; ?></td>
												    <td><?php echo $row['exp_id']; ?></td>
												    <td><?php echo $exp_category['category_name']; ?></td>
												    <td><?php echo $row['sup_name']; ?></td>
												    <td><?php echo $row['pay_type']; ?></td>
													<td><?php echo number_format($row['amount'],2); ?></td>
													
													<td class="text-right">
														<!--<a class="btn btn-sm btn-primary mr-2" href="expenses_invoice_viewpdf.php?invno=<?php echo $row['exp_id']?>" target="_blank">-->
														<!--	<i class="fas fa-download mr-1"></i> Print-->
														<!--</a>-->
														
														<a class="btn btn-sm btn-info" href="expenses_reportinvoice.php?recepit_id=<?php echo $row['exp_id']?>">
															<i class="far fa-eye mr-1"></i> View
														</a>
														
														<a class="btn btn-sm btn-primary" href="expense_edit.php?exp_id=<?php echo $row['exp_id']?>">
															<i class="far fa-edit mr-1"></i> Edit
														</a>
														
														<!--<a class="btn btn-sm btn-danger" href="expenses_reportsall.php?del=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');">-->
														<!--	<i class="far fa-trash-alt mr-1"></i> Delete-->
														<!--</a>-->
														
													</td>
													
													
													<!--<td class="text-right">-->
													<!--	<div class="dropdown dropdown-action">-->
													<!--		<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>-->
													<!--		<div class="dropdown-menu dropdown-menu-right">-->
													<!--		    <a class="dropdown-item" href="reportinvoice.php?recepit_id=<?php echo $row['id']; ?>" target="_blank"><i class="far fa-eye mr-2"></i>View</a>-->
													<!--			<a class="dropdown-item" href="edit_receipt.php?recepit_id=<?php echo $row['id']; ?>"><i class="far fa-edit mr-2"></i>Edit</a>-->
													<!--			<a class="dropdown-item" href="reportsall.php?del=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt mr-2"></i>Delete</a>-->
													<!--		</div>-->
													<!--	</div>-->
													<!--</td>-->
													
												</tr>
												<?php }?>
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