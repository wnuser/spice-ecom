<?php

    include('includes/config.php');
    session_start();
    
    date_default_timezone_set('Asia/Calcutta');
    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
    
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>UCS - Reports</title>
		
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
		 
		 .text-primary {
		     
              color: #0f1568 !important;
          } 
		    
		</style>
		
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body >
	
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
									<li class="breadcrumb-item active">Reports</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
						    
						  <form method="post"> 
								    
						     <div class="row">
						         
						        
    						    <div class="col-md-2">
									<div class="form-group">
										<label>From Date</label>
										<div class="cal-icon">
											<input class="form-control datetimepicker" type="text" name="from_date" value="<?php if(isset($_POST['search_report'])) {  echo $_POST['from_date'];  } ?>">
										</div>
									</div>
    							</div>
    							
    							<div class="col-md-2">
    									<div class="form-group">
    										<label>To Date</label>
    										<div class="cal-icon">
    											<input class="form-control datetimepicker" type="text" name="to_date" value="<?php if(isset($_POST['search_report'])) {  echo $_POST['to_date'];  } ?>">
    										</div>
    									</div>
    							</div>
    							
    						     <div class="col-md-2">
        						            <label>Order Received By</label>
    						            <div class="form-group">
						                	<select class="select" name="order_com" id="order_com">
												<option value="">Select Option</option>
												<?php
                                                $delivery_com=mysqli_query($con,"select * from order_company where is_active='1'");
                                                while($delivery_com_row=mysqli_fetch_array($delivery_com))
                                                { ?>
												    <option value="<?php echo $delivery_com_row['id']; ?>" <?php if($delivery_com_row['id']==$_POST['order_com']) { ?> selected <?php } ?>><?php echo $delivery_com_row['comp_name']; ?></option>
                                                <?php } ?>
										    </select>
    						            </div>
    						      </div>
    						      
    						      <div class="col-md-2">
        						            <label>Status</label>
    						            <div class="form-group">
						                	<select class="select" name="delivery_status" id="delivery_status">
												<option value="">Select Option</option>
												<?php
                                                $delivery_status=mysqli_query($con,"select * from delivery_status where is_active='1'");
                                                while($delivery_status_row=mysqli_fetch_array($delivery_status))
                                                { ?>
												    <option value="<?php echo $delivery_status_row['id']; ?>" <?php if($delivery_status_row['id']==$_POST['delivery_status']) { ?> selected <?php } ?>><?php echo $delivery_status_row['sts_option']; ?></option>
                                                <?php } ?>
										    </select>
    						            </div>
    						      </div>
    						     
    						      <div class="col-md-2">
    						            <div class="form-group">
    						                <input type="submit" name="search_report" class="btn btn-success" value="Search" style="margin-top:30px;">
    						            </div>
    						        </div>
						    </div>
						    
						    </form>	
						    
							<div class="card card-table"> 
								<div class="card-body">
									<div class="table-responsive" style="padding: 1.5rem 1.5rem 0;">
										<table id="packing-order" class="table table-stripped table-hover">
											<thead class="thead-light">
												<tr>
												   <th>S.No</th>
												   <th>Order ID</th>
												   <th>Reference ID</th>
												   <th>Order Date</th>
												   <th>Delivery Date</th>
												   <th>Received By</th>
												   <th>Customer Name</th>
												   <th>Mobile No</th>
												   <th>Total</th>
												</tr>
											</thead>
											<tbody>
										           <?php 
                                            		
                                                		$i=1;
                                                		
                                                		$grand_total=0;
                                                		
                                                		$dateQuery='';
									            
            											if($_POST['from_date']!='' && $_POST['to_date']!='')
                                                		{
                                                		    
                                                		    $from_date=date('Y-m-d',strtotime($_POST['from_date']));
                                                		    $to_date=date('Y-m-d',strtotime($_POST['to_date']));
                                                		  
                                                		    
                                                			$dateQuery.="AND invdate BETWEEN '".$from_date."' AND '".$to_date."'";
                                                			
                                                		} 
                                                		
                                                		if($_POST['order_com']!='') {
                                                		    
                                                		    $dateQuery.="AND order_by='".$_POST['order_com']."' ";
                                                		    
                                                		}  
                                                		
                                                		if($_POST['delivery_status']!='') {
                                                		    
                                                		    $dateQuery.="AND status='".$_POST['delivery_status']."' ";
                                                		    
                                                		}  
                                        		        
                                        		             
                                        		        $res=mysqli_query($con,"SELECT * FROM invoiceinfo_clb where is_active='1' $dateQuery ORDER BY id DESC");
                                        		             
                                                        while($row=mysqli_fetch_array($res)){
                                                        
                                                        $delivery_status_row=mysqli_fetch_array(mysqli_query($con,"select * from delivery_status where id='".$row['status']."' and is_active='1'"));
                                                        
                                                        $order_by_row=mysqli_fetch_array(mysqli_query($con,"select * from order_company where id='".$row['order_by']."' and is_active='1'"));
                                                        
                                                        $grand_total=$grand_total+$row['total'];
                                                   
                                        	        ?>
                                        	    
    												<tr>
    												    <td><?php echo $i; ?></td>
    												   	<td><?php echo $row['user_id']; ?></td>
    													<td><?php echo $row['ref_id']; ?></td>
    													<td><?php echo date('d-m-Y',strtotime($row['invdate'])); ?></td>
    													<td><?php echo date('d-m-Y',strtotime($row['delivery_date'])); ?></td>
    													<td><p class="<?php echo $order_by_row['class_name']; ?>"><b><?php echo $order_by_row['comp_name']; ?></b></p></td>
    													<td><?php echo $row['rev_name'].' '.$row['last_name'];?></td>
    													<td><?php echo $row['rev_phone']; ?></td>
    													<td><?php echo number_format($row['total'],2); ?></td>
    												</tr>
												<?php $i=$i+1; } ?>
											</tbody>
											<tfoot>
											    <tr>
											       <td colspan="7"></td>
											       <td align="right"><b>Sub Total</b></td>
											       <td><?php echo number_format($grand_total,2); ?></td>
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
                
                $('#packing-order').DataTable({
    		    
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
            
        </script>

	</body>
</html>