<?php
    include('includes/config.php');
    session_start();
    
     if(isset($_POST['update_incometax']))
    {
        $income_tax_value=$_POST['incometax_value'];
        
        
        $income_tax_update=mysqli_query($con,"update profile set incom_tax='".$income_tax_value."' where id='1' and is_active='1'");
        
        if($income_tax_update==true)
        {
            
            echo "<script>alert('Success! Income tax value updated.');location.href='proft_loss.php';</script>";
        }
            
        else {
            
           echo "<script>alert('Oops! Something went wrong.');location.href='proft_loss.php';</script>";
          
        }
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Eternal Seasoning - Profit & Loss</title>
		
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
		
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

		
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
									<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Profit & Loss</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<?php 
					$profile_details=mysqli_fetch_array(mysqli_query($con,"select * from profile where id='1' and is_active='1'"));
					?>
						<!-- Search Filter -->
					<div id="filter_inputs" class="card filter-card" style="display:block;">
						<div class="card-body pb-0">
						    <form method="POST">
						        <div class="row">
    								<div class="col-md-4">
    									<div class="form-group">
    										<label>Income Tax</label>
    										 <input class="form-control" type="text" name="incometax_value" id="incometax_value" value="<?php echo $profile_details['incom_tax']; ?>">
    									  </div>
    								</div>
    								<div class="col-md-4">
    								    <div class="form-group">
    								        <label></label>
    								        <button type="submit" name="update_incometax" class="btn btn-success" style="margin-top: 30px;"><i class="fas fa-check"></i> Update</button>
    								    </div>
    								</div>
							    </div>
						    </form>
						</div>
					</div>
					<!-- /Search Filter -->
					
					<!-- Search Filter -->
					<div id="filter_inputs" class="card filter-card" style="display:block;">
						<div class="card-body pb-0">
						    <form method="POST">
						        <div class="row">
    								
    								<div class="col-md-4">
    									<div class="form-group">
    										<label>From Date</label>
    										<div class="cal-icon">
    											<input class="form-control datetimepicker" type="text" name="from_date" value="<?php if(isset($_POST['search_date'])) {  echo $_POST['from_date'];  } ?>">
    										</div>
    									</div>
    								</div>
    								<div class="col-md-4">
    									<div class="form-group">
    										<label>To Date</label>
    										<div class="cal-icon">
    											<input class="form-control datetimepicker" type="text" name="to_date" value="<?php if(isset($_POST['search_date'])) {  echo $_POST['to_date'];  } ?>">
    										</div>
    									</div>
    								</div>
    								<div class="col-md-4">
    								    <div class="form-group">
    								        <label></label>
    								        <button type="submit" name="search_date" class="btn btn-success" style="margin-top: 30px;"><i class="fas fa-search"></i></button>
    								        <a href="proft_loss.php" class="btn btn-info" style="margin-top: 30px;"><i class="fa fa-times"></i></a>
    								    </div>
    								</div>
							    </div>
						    </form>
						</div>
					</div>
					<!-- /Search Filter -->
					
					<?php 
                      
                      $form_date='';
                      $end_date='';
                      
                      if(isset($_POST['search_date']))
                      {
                      
                        
                       $form_date=date('Y-m-d',strtotime($_POST['from_date']));
                      
                       $end_date=date('Y-m-d',strtotime($_POST['to_date']));      
                          
                     } else {
                        
                       $form_date=date('Y-m-d', strtotime('first day of january this year'));
                      
                       $end_date=date('Y-m-d', strtotime('last day of december this year'));             
                          
                      }
                      
                      ?>
					
					<div class="row">
						<div class="col-sm-12">
						   
							<div class="card card-table"> 
								<div class="card-body">
									<div class="table-responsive">
									  <table class="table table-striped table-bordered" >
                                      <thead>
                                        <tr>
                                            <th style="font-weight:bold;"></th>
                                            <th>Amount</th>
                                            <th>Amount</th>
                                            <th>Percentage</th>
                                        </tr>
                                      </thead>  
                                      <tbody>
                                        
                                         <tr>
                                         <th colspan="4" style="font-weight: bold;padding: 10px 30px;">Sales</th>
                                        </tr>  
                                          
                                        <tr>
                                         <td style="padding-left: 50px;">Revenue</td>
                                           <?php 
                                            $revenue_total=0;
                							$sales_total=mysqli_query($con,"SELECT * FROM orders where status='4' and order_date between '".$form_date."' and '".$end_date."' and is_active='1'");
                                            while($row_sales=mysqli_fetch_array($sales_total)){
                                                
                                                $revenue_total=$revenue_total+$row_sales['total_price'];
                                            } 
                                            ?>  
                                         <td>£<?php echo number_format($revenue_total,2); ?></td>    
                                         <td>&nbsp;</td>
                                         <td>&nbsp;</td>   
                                        </tr>
                                        
                                        <tr>
                                         <td  style="font-weight: bold;">Total Sales</td>
                                         <td>&nbsp;</td>
                                         <td style="font-weight: bold;">£<?php echo number_format($revenue_total,2); ?></td>
                                         <td>&nbsp;</td>
                                        </tr>
                                        
                                        <tr>
                                         <th colspan="4" style="font-weight: bold;padding: 10px 30px;">Direct Cost</th>
                                        </tr>
                                        
                                        <tr>
                                         <td style="padding-left: 50px;">Purchase</td>
                                           <?php 
                                            $pur_total=mysqli_query($con,"SELECT sum(grand_total) as total FROM invoiceinfo_clb where invdate between '".$form_date."' and '".$end_date."' and is_active=1");
                                            $pur_total_row=mysqli_fetch_array($pur_total);
                                            
                                            $purchase_tot=$pur_total_row['total'];
                                            
                                            ?>  
                                           <td>£<?php echo number_format($purchase_tot,2); ?></td>
                                           <td>&nbsp;</td>
                                           <td>&nbsp;</td>   
                                         </tr>
                                         
                                          <tr>
                                         <td style="padding-left: 50px;">HR Expenses</td>
                                           <?php 
                                            $manpower_expenses=mysqli_query($con,"SELECT sum(amount) as total FROM expenses_receipt where exp_category='4' and date between '".$form_date."' and '".$end_date."' and is_active=1");
                                            $manpower_expenses_row=mysqli_fetch_array($manpower_expenses);
                                            
                                            $man_exp_tot=$manpower_expenses_row['total'];
                                            
                                            ?>  
                                           <td>£<?php echo number_format($man_exp_tot,2); ?></td>
                                           <td>&nbsp;</td>
                                           <td>&nbsp;</td>   
                                         </tr>
                                        
                                        <tr>
                                         <td style="padding-left: 50px;">Direct Cost Expenses </td>
                                           <?php 
                                            $dir_cost_expenses=mysqli_query($con,"SELECT sum(amount) as total FROM expenses_receipt where exp_category='1' and date between '".$form_date."' and '".$end_date."' and is_active=1");
                                            $dir_cost_expenses_row=mysqli_fetch_array($dir_cost_expenses);
                                            
                                            $dircost_exp_tot=$dir_cost_expenses_row['total'];
                                            
                                            ?>  
                                           <td>£<?php echo number_format($dircost_exp_tot,2); ?></td>
                                           <td>&nbsp;</td>
                                           <td>&nbsp;</td>   
                                         </tr>
                               
                                         <tr>
                                         <td style="font-weight: bold;" >Total Direct Cost</td>
                                         <td>&nbsp;</td>
                                         <?php 
                                         
                                         $tot_direct_tot = $purchase_tot + $man_exp_tot + $dircost_exp_tot;
                                         
                                         ?>
                                         <td style="font-weight: bold;">£<?php echo number_format($tot_direct_tot,2); ?></td>
                                         <td>&nbsp;</td>
                                        </tr>
                                        
                                        <tr>
                                         <td style="font-weight: bold;">Gross Margin</td>
                                         <td>&nbsp;</td>
                                         <?php 
                                         $gross_pro_tot=0;
                                         $gross_profit_tot= $revenue_total - $tot_direct_tot;  
                                         ?>
                                        <td style="font-weight: bold;">£<?php echo number_format($gross_profit_tot,2); ?></td>
                                        <td>&nbsp;</td>
                                        </tr>
                                        
                                        <tr>
                                         <td colspan="4" style="font-weight: bold;padding: 10px 30px;">Operating Expenses</td>
                                        </tr>
                                        
                                        
                                        <tr>
                                         <td style="padding-left: 50px;">Operating Expenses</td>
                                           <?php 
                                            $operating_expenses=mysqli_query($con,"SELECT sum(amount) as total FROM expenses_receipt where exp_category='2' and date between '".$form_date."' and '".$end_date."' and is_active=1");
                                            $operating_expenses_row=mysqli_fetch_array($operating_expenses);
                                            
                                            $operating_expenses_tot=$operating_expenses_row['total'];
                                            
                                            ?>  
                                           <td>£<?php echo number_format($operating_expenses_tot,2); ?></td>
                                           <td>&nbsp;</td>
                                           <td>&nbsp;</td>   
                                         </tr>
                                        
                                        
                                        <tr>
                                          <td style="font-weight:bold;">Operating Income </td>
                                           <td>&nbsp;</td>
                                           <?php
                                           $operating_income=$gross_profit_tot - $operating_expenses_tot; 
                                           ?>
                                           <td style="font-weight:bold;">£<?php echo number_format($operating_income,2); ?></td>
                                           <td>&nbsp;</td>
                                        </tr>
                                        
                                        <tr>
                                          <td>Income Tax</td>
                                           <?php $income_tax_tot=$profile_details['incom_tax']; ?>
                                           <td>£<?php echo number_format($income_tax_tot,2); ?></td>
                                           <td>&nbsp;</td>
                                           <td>&nbsp;</td>
                                        </tr>
                                        
                                        <tr>
                                          <td>Depreciation & Amorization</td>
                                          <?php 
                                            $assets_expenses=mysqli_query($con,"SELECT sum(amount) as total FROM expenses_receipt where exp_category='3' and date between '".$form_date."' and '".$end_date."' and is_active=1");
                                            $assets_expenses_row=mysqli_fetch_array($assets_expenses);
                                            
                                            $depreciation_tax_tot=$assets_expenses_row['total'];
                                            
                                            ?>  
                                           <td>£<?php echo number_format($depreciation_tax_tot,2); ?></td>
                                           <td>&nbsp;</td>
                                           <td>&nbsp;</td>
                                        </tr>
                                        
                                        <tr>
                                          <td style="font-weight:bold;">Total Expenses</td>
                                          <td>&nbsp;</td>
                                           <?php 
                                           $total_expenses_amt= $tot_direct_tot + $operating_expenses_tot + $income_tax_tot + $depreciation_tax_tot;
                                          ?>
                                          <td style="font-weight:bold;">£<?php echo number_format($total_expenses_amt,2); ?></td>
                                          <td>&nbsp;</td>
                                        </tr>
                                        
                                        <tr>
                                          <td style="font-weight:bold;">Net Profit/Loss</td>
                                          <td>&nbsp;</td>
                                          <?php 
                                          $net_profit= $operating_income - $income_tax_tot - $depreciation_tax_tot;
                                          ?>
                                          <td style="font-weight:bold;">£<?php echo number_format($net_profit,2); ?></td>
                                          <td>&nbsp;</td>
                                        </tr>
                                        
                                      </tbody>
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
		
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	
	</body>
</html>