<?php

    include('includes/config.php');
    session_start();
    
    require_once('TCPDF-master/tcpdf.php');

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('');
    $pdf->SetTitle('Blene Ur Spice - Purchase Invoice PDF');
    $pdf->SetSubject('Purchase Invoice');
    $pdf->SetKeywords('TCPDF, PDF');
    
    
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
    
    //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);

    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    
    
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
    
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }


    $id=$_GET['invno'];
    $sql=mysqli_query($con,"select * from invoiceinfo_clb where inv_id='".$id."' and is_active='1'");
    while($row=mysqli_fetch_array($sql))
    {
    
    $inv_id=$row['inv_id'];
    $currency=$row['currency_code'];
    $symbols=$row['symbols'];
    $invdate=date('d-m-Y',strtotime($row['invdate']));
    $purchase_no=$row['purchase_no'];
    $purchase_payment=$row['purchase_payment'];
    
    $com_name=$row['com_name'];
    $address1=$row['com_address'];
    $address2=$row['com_address2'];
    $address3=$row['com_address3'];
    $com_pin=$row['com_pin'];
    $com_country=$row['com_country'];
    $com_email=$row['com_email'];
    $com_phone=$row['com_phone'];
    
    $due_date=date('d-m-Y',strtotime($row['due_date']));
    
    $subtotal=$row['subtotal'];
    $gst=$row['gst'];
    $grand_total=$row['grand_total'];
        
    $pdf->SetFont('dejavusans', '', 10);
    
    $pdf->AddPage();

    $html = '
    <table style="table-layout: fixed; width: 100%;">
        <tbody>
            <tr>
                <td>
                    <div class="col-md-7">
                        <table>
    						    <tr>
    						        <td><strong><u>Purchase From</u></strong></td>
    						    </tr>
    						    <tr>
    						        <td></td>
    						    </tr>';
    						    if($com_name!='')
    						    {
    						    $html.='<tr>
    						        <td>'.$com_name.'</td>
    						    </tr>';
    						    }
    						    if($address1!='')
    						    {
    						    $html.='<tr>
    						        <td>'.$address1.'</td>
    						    </tr>';
    						    }
    						    if($address2!='')
    						    {
    						    $html.='<tr>
    						        <td>'.$address2.'</td>
    						    </tr>';
    						    }
    						    if($address3!='')
    						    {
    						    $html.='<tr>
    						        <td>'.$address3.'</td>
    						    </tr>';
    						    }
    						    if($com_pin!='')
    						    {
    						    $html.='<tr>
    						        <td>'.$com_pin.'</td>
    						    </tr>';
    						    }
    						    if($com_country!='')
    						    {
    						    $html.='<tr>
    						        <td>'.$com_country.'</td>
    						    </tr>';
    						    }
    						    if($com_email!='')
    						    {
    						    $html.='<tr>
    						        <td>'.$com_email.'</td>
    						    </tr>';
    						    }
    						    if($com_phone!='')
    						    {
    						    $html.='<tr>
    						        <td>'.$com_phone.'</td>
    						    </tr>';
    						    }
    						$html.='</table>
                    </div>
                </td>
                <td>    
                    <div class="col-md-5">
						<table>
						    <tr>
						        <td><strong>Purchase ID</strong></td>
						        <td>: '.$inv_id.'</td>
						    </tr>
						    <tr>
						        <td><strong>Purchase Date</strong></td>
						        <td>: '.$invdate.'</td>
						    </tr>';
						    if($purchase_payment!='')
						    {
						    $html.='<tr>
						        <td><strong>Payment Mode</strong></td>
						        <td>: '.$purchase_payment.'</td>
						    </tr>';
						    }
						$html.='<tr>
						        <td><strong>Due date</strong></td>
						        <td>: '.$due_date.'</td>
						    </tr></table>
					</div>
                </td>
            </tr>
        </tbody>
    </table>
    
    <table align="left" style="width:100%;">
        <table border="1" cellpadding="3" style="padding-right:10px; width:100%;">
            <tbody>
                <tr>
                    <td style="font-weight: bold;" width="8%" align="center">S.No</td>
                    <td style="font-weight: bold;" width="45%" align="center">Item Name</td>
                    <td style="font-weight: bold;" width="12%" align="center">Quantity</td>
                    <td style="font-weight: bold;" width="20%" align="center">Price</td>
                    <td style="font-weight: bold;" width="15%" align="center">Amount</td>
                </tr>';
                $sql2=mysqli_query($con,"select * from itemtable_clb where user_id='".$row['inv_id']."' and is_active='1'");
                $i=1;
                $grand_tot='0';
                while($row2=mysqli_fetch_array($sql2))
                {
                    $item=$row2['description'];
                    $prize=$row2['prize'];
                    $quantity=$row2['quantity'];
                    $total1=$row2['total'];
                    $grand_tot=$grand_tot+$total1;
               
                    $html.=' <tr>
                        <td height="20" width="8%" align="center" valign="top">'.$i.'</td>
                        <td height="20" width="45%" align="center" valign="top">'.$item.'</td>
                        <td height="20" width="12%" align="center" valign="top" >'.$quantity.'</td>
                        <td height="20" width="20%" align="center" valign="top">'.number_format($prize,2).'</td>
                        <td height="20" width="15%" align="center" valign="top">'.number_format($total1,2).'</td>
                    </tr> ';
                    $i=$i+1;
                }
                
            $html.='</tbody>
            <tfoot>
    		    <tr>
    		        <th colspan="3"></th>
    		        <th style="text-align:center;"><b>Sub Total </b></th>
    		        <th style="text-align:center;"><b>£'.number_format($row['subtotal'],2).'</b></th>
    		    </tr>';
    		      
    		      $html.=' <tr>
	                <th colspan="3"></th>
	                    <th style="text-align:center;"><b>Vat (20%)</b></th>';
	                    $html.='<th style="text-align:center;"><b>£'.number_format($row['gst'],2).'</b></th>
	                </tr>';
	           $html.=' <tr>
	                <th colspan="3"></th>
	                    <th style="text-align:center;"><b>Shipping</b></th>';
	                    $html.='<th style="text-align:center;"><b>£'.number_format($row['ship_cost'],2).'</b></th>
	                </tr>';     
	                
		        $html.='<tr>
    		        <th colspan="3"></th>
    		        <th style="text-align:center;"><b>Total </b></th>
    		        <th style="text-align:center;"><b>£'.number_format($row['grand_total'],2).'</b></th>
		        </tr>
	        </tfoot>
        </table>
    </table>';
    
    }


$pdf->writeHTML($html, true, false, true, false, '');


$pdf->Output('invoice_viewpdf.pdf', 'I');

?>