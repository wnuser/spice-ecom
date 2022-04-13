<?php
    include('includes/config.php');
    session_start();

    if(isset($_POST['stock_update']))
    {
        $stock_id=$_POST['stock_id'];
        $open_stock=$_POST['open_stock'];
        $current_stock=$_POST['current_stock'];
        
        $update_stock= $open_stock + $current_stock;
        
        $current_stock_price=$_POST['current_stock_price'];
        $profit_amt=$_POST['profit_amt'];
        
        $before_stock_value=$update_stock * $current_stock_price;
       
        $after_price= ($current_stock_price/100)*$profit_amt;
        
        $stock_after_profit= $current_stock_price + $after_price;
        
        $stock_value_after_profit= $stock_after_profit * $update_stock;
        
        $stock_update=mysqli_query($con,"update spices_list set stock_qty='".$update_stock."',price='".$current_stock_price."',profit_amt='".$profit_amt."',
        before_stock_value='".$before_stock_value."',after_stock_price='".$stock_after_profit."',after_stock_value='".$stock_value_after_profit."' where id='".$stock_id."' and is_active='1'");
        
        if($stock_update)
        {
            echo "<script>alert('Success! Stock values updated.');location.href='stock.php'</script>";
        }
            
        else {
            
            echo "<script>alert('Oops! Something went wrong.');location.href='stock.php'</script>";
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
		<title>Eternal Seasoning - Stock Details</title>
		
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
									<li class="breadcrumb-item active">Stock Details</li>
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
												   <th>Spices</th>
												   <th>Stock in KG</th>
												   <th>Stock Price/KG Before Profit</th>
												   <th>Stock Value Before Profit</th>
												   <th>Action</th>
												   <th>Profit (%)</th>
												   <th>Stock Price/KG After Profit</th>
												   <th>Stock Value After Profit</th>
												   <th>Status</th>
												</tr>
											</thead>
											<tbody>
										        <?php 
									                
                                        		$i=0;
                                        		$before_stock_price_profit_tot=0;
                                                $before_stock_value_profit_tot=0;
                                                $after_stock_price_profit_tot=0;
                                                $after_stock_value_profit_tot=0;
                                                
                                                $ingredients=mysqli_query($con,"SELECT * FROM spices_list where is_active='1' ORDER BY id DESC");
                                                while($ingredients_row=mysqli_fetch_array($ingredients)){
                                                $i++;
                                                
                                                $before_stock_price_profit_tot=$before_stock_price_profit_tot+$ingredients_row['price'];
                                                $before_stock_value_profit_tot=$before_stock_value_profit_tot+$ingredients_row['before_stock_value'];
                                                $after_stock_price_profit_tot=$after_stock_price_profit_tot+$ingredients_row['after_stock_price'];
                                                $after_stock_value_profit_tot=$after_stock_value_profit_tot+$ingredients_row['after_stock_value'];
                                        	    ?>
                                        	    
                                        	    <div class="modal fade" id="stock_modal_<?php echo $ingredients_row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Stock Update</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="post" >
                                                                <div class="modal-body">
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <input type="hidden" name="stock_id" id="stock_id" value="<?php echo $ingredients_row['id']; ?>">
                                                                        <h3 style="text-align:center;"><?php echo $ingredients_row['spices_name']; ?></h3>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label>Opening Stock</label>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="open_stock" value="<?php echo $ingredients_row['stock_qty']; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label>Opening Stock Price/KG</label>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="open_stock_price" id="open_stock_price" value="<?php echo $ingredients_row['price']; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label>New Stock</label>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="current_stock" id="current_stock" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label>New Stock Price/KG</label>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="current_stock_price" id="current_stock_price" required>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-6">
                                                                        <label>Profit Amount (%)</label>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="profit_amt" id="profit_amt" required>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" name="stock_update" class="btn btn-primary">Submit</button>
                                                                </div>
                                                          </form>    
                                                        </div>
                                                    </div>
                                                </div>
                                        	    
                                        	    
												<tr>
												    <td><?php echo $i; ?></td>
													<td><?php echo $ingredients_row['spices_name']; ?></td>
													<td><?php echo $ingredients_row['stock_qty']; ?></td>
													<td>£<?php echo number_format($ingredients_row['price'],2); ?></td>
													<td>£<?php echo number_format($ingredients_row['before_stock_value'],2); ?></td>
													<td class="text-right">
														<a class="btn btn-sm btn-info mr-2" href="javascript:void(0)" data-toggle="modal" data-target="#stock_modal_<?php echo $ingredients_row['id']; ?>">
															<i class="fas fa-edit mr-1"></i> Update
														</a>
													</td>
													<td><?php echo $ingredients_row['profit_amt']; ?>%</td>
													<td>£<?php echo number_format($ingredients_row['after_stock_price'],2); ?></td>
													<td>£<?php echo number_format($ingredients_row['after_stock_value'],2); ?></td>
													<td>
													 
													 <?php if($ingredients_row['stock_qty'] >= 2 ) { ?>
													  
													  <span class="badge bg-success-light">In Stock</span>
													  
													 <?php } else { ?>
													 
													   <span class="badge bg-danger-light">Out of Stock</span>
													   
													 <?php } ?>
													    
													</td>
													
												</tr>
												
												<?php } ?>
												
											</tbody>
											
											<tfoot>
											    <th colspan="3">Total</th>
											    <th>£<?php echo number_format($before_stock_price_profit_tot,2); ?></th>
											    <th>£<?php echo number_format($before_stock_value_profit_tot,2); ?></th>
											    <th colspan="2">&nbsp;</th>
											    <th>£<?php echo number_format($after_stock_price_profit_tot,2); ?></th>
											    <th>£<?php echo number_format($after_stock_value_profit_tot,2); ?></th>
											    <th>&nbsp;</th>
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