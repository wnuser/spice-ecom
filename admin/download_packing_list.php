<?php

    include('includes/config.php');
    session_start();
    
     date_default_timezone_set('Asia/Calcutta');
     define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
       
      $orders_id=array();

      $today_date=date('d-m-Y');

      require_once 'PHPExcel-1.8/Classes/PHPExcel.php';	
    
      $objPHPExcel = new PHPExcel();
    
      $mail=$_POST['email_id'];
    
      $orders_id=$_POST['orders_id'];
     
    
    	$objPHPExcel->getProperties()->setCreator("Universal Computer Services")->setLastModifiedBy("Universal Computer Services");
    	$objPHPExcel = PHPExcel_IOFactory::load("template/Orders-Export-Template.xlsx");		
    
    	$row_no = 2; 
			      
        	
        $order_details=mysqli_query($con,"SELECT * FROM invoiceinfo_clb where status='1' and is_active='1'");
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
	
	
	$objPHPExcel->getActiveSheet()->setTitle('Today Orders - '.$today_date);
	$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_FOLIO);

	
	$objPHPExcel->setActiveSheetIndex(0);
	
	$stamp='Today_orders_'.date('d-m-Y').'_'.date('U').'.xlsx';
	
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    
    // We'll be outputting an excel file
    header('Content-type: application/vnd.ms-excel');
    
    // It will be called file.xls
    header('Content-Disposition: attachment; filename='.$stamp.'');
    
    // Write file to the browser
    $objWriter->save('php://output');
             
?>