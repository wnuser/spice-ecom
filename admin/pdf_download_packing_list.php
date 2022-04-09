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
    
   $pdf->AddPage('L');
    
    $purchase_totals=mysqli_fetch_array(mysqli_query($con,"select sum(total) as grand_total from invoiceinfo_clb where status='1' and is_active='1'"));    
    $purchase_recordss=mysqli_num_rows(mysqli_query($con,"select * from invoiceinfo_clb where status='1' and is_active='1'")); 

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
					
				    $html.= '
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
    <h3 style="text-align:center;">Packing List</h3>
    <p>&nbsp;</p>    
    <table border="1" cellpadding="3" width="100%">
                <tbody>
                    <tr>
                        <td height="30" style="font-weight: bold;" align="center">Order ID</td>
                        <td height="30" style="font-weight: bold;" align="center">Reference ID</td>
                        <td height="30"style="font-weight: bold;" align="center">Order Date</td>
                        <td height="30" style="font-weight: bold;" align="center">Receiver Name</td>
                        <td height="30" style="font-weight: bold;" align="center">Phone No</td>
                        <td height="30" style="font-weight: bold;" align="center">Shipping To</td>
                        <td height="30" style="font-weight: bold;" align="center">Delivery</td>
                        <td height="30" style="font-weight: bold;" align="center">Product Name</td>
                        <td height="30" style="font-weight: bold;" align="center">Qty</td>
                    </tr>';
                    
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
                            

                    $html.=' <tr>
                            <td height="30" align="center" valign="top">'.$order_details_row['user_id'].'</td>
                            <td height="30" align="center" valign="top">'.$order_details_row['ref_id'].'</td>
                            <td height="30" align="center" valign="top" >'.date('d-m-Y',strtotime($order_details_row['invdate'])).'</td>
                            <td height="30" align="center" valign="top">'.$rev_name.'</td>
                            <td height="30" align="center" valign="top">'.$order_details_row['rev_phone'].'</td>
                            <td height="30" align="center" valign="top">'.$rev_address.'</td>
                            <td height="30" align="center" valign="top">'.$delivery_company['company_name'].'</td>
                            <td height="30" align="center" valign="top">'.$item_details_row['description'].'</td>
                            <td height="30" align="center" valign="top">'.$item_details_row['quantity'].'</td>
                        </tr> ';
                        
                        $i=$i+1;
                    }
                }    
                
                $html.='</tbody>
                
            </table>';

        $pdf->writeHTML($html, true, false, true, false, '');
        
        
        $pdf->Output('pdf_download_packing_list.pdf', 'I');

?>