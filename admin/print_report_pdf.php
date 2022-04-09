<?php

    include('includes/config.php');
    session_start();
    
    require_once('TCPDF-master/tcpdf.php');

        class MYPDF extends TCPDF {

        // Page footer
         public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
    
    }


    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('');
    $pdf->SetTitle('UCS - Orders Report');
    $pdf->SetSubject('Orders Report');
    $pdf->SetKeywords('TCPDF, PDF');
    
    
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
    
    //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);

    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(true);
    
    
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
    
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
        
    $pdf->SetFont('dejavusans', '', 10);
    
    $pdf->AddPage();
    
    
    if($_SESSION['pch_form_date']!='' && $_SESSION['pch_to_date'])
    {
        
      $pch_from_date=date('Y-m-d',strtotime($_SESSION['pch_form_date']));  
      $pch_to_date=date('Y-m-d',strtotime($_SESSION['pch_to_date']));    
        
      $purchase_totals=mysqli_fetch_array(mysqli_query($con,"select sum(total) as grand_total from invoiceinfo_clb where invdate BETWEEN '".$pch_from_date."' AND '".$pch_to_date."' and is_active='1'"));    
      $purchase_recordss=mysqli_num_rows(mysqli_query($con,"select * from invoiceinfo_clb where invdate BETWEEN '".$pch_from_date."' AND '".$pch_to_date."' and is_active='1'"));    
        
    } else {
      
      $purchase_totals=mysqli_fetch_array(mysqli_query($con,"select sum(total) as grand_total from invoiceinfo_clb where is_active='1'"));    
      $purchase_recordss=mysqli_num_rows(mysqli_query($con,"select * from invoiceinfo_clb where is_active='1'")); 
        
    }    

    $html = '
    <table style="table-layout: fixed; width: 100%;">
        <tbody>
            <tr>
                <td>
                    <div class="col-md-7">
                        <img src="images/logo.png">
                        <p>Universal Computer Services<br>
                        1 Rochor Canal Road,<br>
                        #05-54,<br>
                        Sim Lim Square,<br>
                        Singapore - 188 504.<br>
                        sales@universalcomputer.com.sg
                        </p>
                    </div>
                </td>
                <td>    
                    <div class="col-md-5">
					<table>';
					
					 if($_SESSION['pch_form_date']!='' && $_SESSION['pch_to_date'])
                        {
						    $html.= '<tr >
						        <td height="20"><strong>Sales From Date</strong></td>
						        <td height="20">: '.date('d-m-Y',strtotime($_SESSION['pch_form_date'])).'</td>
						    </tr>
						    <tr>
						        <td height="20"><strong>Sales To Date</strong></td>
						        <td height="20">: '.date('d-m-Y',strtotime($_SESSION['pch_to_date'])).'</td>
						    </tr>';
                        }
						    $html.= '<tr>
						        <td height="20"><strong>Sales Total</strong></td>
						        <td height="20">: $'.number_format($purchase_totals['grand_total'],2).'</td>
						    </tr>
						    <tr>
						        <td height="20"><strong>No.of Records</strong></td>
						        <td height="20">: '.$purchase_recordss.'</td>
						    </tr>
						    
						</table>
					</div>
                </td>
            </tr>
        </tbody>
    </table>
    <h3 style="text-align:center;">Orders Report</h3>
    <p>&nbsp;</p>    
    <table border="1" cellpadding="3" width="100%">
                <tbody>
                    <tr>
                        <td height="30" style="font-weight: bold;" width="10%" align="center">S.No</td>
                        <td height="30" style="font-weight: bold;" width="15%" align="center">Order ID</td>
                        <td height="30"style="font-weight: bold;" width="15%" align="center">Order Date</td>
                        <td height="30" style="font-weight: bold;" width="20%" align="center">Received By</td>
                        <td height="30" style="font-weight: bold;" width="20%" align="center">Customer</td>
                        <td height="30" style="font-weight: bold;" width="20%" align="center">Total</td>
                    </tr>';
                    
                    if($_SESSION['pch_form_date']!='' && $_SESSION['pch_to_date']!='')
                    {
                        
                        $pch_from_date=date('Y-m-d',strtotime($_SESSION['pch_form_date']));  
                        $pch_to_date=date('Y-m-d',strtotime($_SESSION['pch_to_date']));       
                        
                     $sql=mysqli_query($con,"select * from invoiceinfo_clb where invdate BETWEEN '".$pch_from_date."' AND '".$pch_to_date."' and is_active='1'");    
                        
                    } else {
                      
                      $sql=mysqli_query($con,"select * from invoiceinfo_clb where is_active='1'");  
                        
                    }
                    
                    $i=1;
                    $grand_tot='0';
                    while($row=mysqli_fetch_array($sql))
                    {
                        
                        $total1=$row['total'];
                        $grand_tot=$grand_tot+$total1;
                    
                    $order_by_row=mysqli_fetch_array(mysqli_query($con,"select * from order_company where id='".$row['order_by']."' and is_active='1'"));
                        
                    $delivery_status_row=mysqli_fetch_array(mysqli_query($con,"select * from delivery_status where id='".$row['status']."' and is_active='1'"));
                            

                    $html.=' <tr>
                            <td height="30" align="center" width="10%" valign="top">'.$i.'</td>
                            <td height="30" align="center" width="15%" valign="top">'.$row['user_id'].'</td>
                            <td height="30" align="center" width="15%" valign="top" >'.date('d-m-Y',strtotime($row['invdate'])).'</td>
                            <td height="30" align="center" width="20%" valign="top">'.$order_by_row['comp_name'].'</td>
                            <td height="30" align="center" width="20%" valign="top">'.$row['rev_name'].'</td>
                            <td height="30" align="center" width="20%" valign="top">'.number_format($row['total'],2).'</td>
                        </tr> ';
                        
                        $i=$i+1;
                    }
                    
                $html.='</tbody>
                <tfoot>
    		        <tr>
        		        <th colspan="4"></th>
        		        <th style="text-align:center;"><b>Total </b></th>
        		        <th style="text-align:center;"><b>$'.number_format($grand_tot,2).'</b></th>
    		        </tr>
    	        </tfoot>
            </table>';

        $pdf->writeHTML($html, true, false, true, false, '');
        
        
        $pdf->Output('print_report_pdf.pdf', 'I');

?>