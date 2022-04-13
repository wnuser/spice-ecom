<?php

    include('includes/config.php');
    session_start();
    
    require_once('TCPDF-master/tcpdf.php');

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('');
    $pdf->SetTitle('Eternal Seasoning - Invoice Order');
    $pdf->SetSubject('Invoice Order');
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
    $sql=mysqli_query($con,"select * from orders_table where order_id='".$id."' and is_active='1'");
    while($row=mysqli_fetch_array($sql))
    {
        
        
    $customers_row=mysqli_fetch_array(mysqli_query($con,"select * from customers where id='".$row['customer_id']."' and is_active='1'"));
                        
    $delivery_status_row=mysqli_fetch_array(mysqli_query($con,"select * from delivery_status where id='".$row['status']."' and is_active='1'"));  
        
    $user_id=$row['order_id'];
  
    $invdate=date('d-m-Y',strtotime($row['created_at']));
   
    $rev_name=$customers_row['first_name'];
    $last_name=$customers_row['last_name'];
    $address1=$customers_row['address'];
    $address2=$customers_row['address2'];
    $rev_pin=$customers_row['postal_code'];
    $rev_country=$customers_row['country'];
    $rev_email=$customers_row['email_id'];
    $rev_phone=$customers_row['phone'];
    
    
    $delivery_date=date('d-m-Y',strtotime($row['delivered_date']));
    
    $shipping_amont=$row['ship_amount'];
    $total=$row['total_price'];
    $amount_paid=$row['amount_paid'];
    $balance=$row['balance'];
    $discount=$row['discount'];
    $refund=$row['amount_refund'];
    // $send_id=$row['send_id'];
    // $item_desc=$row['item_desc'];
   
        
    $pdf->SetFont('dejavusans', '', 10);
    
    $pdf->AddPage();

    $html = '
    <table style="table-layout: fixed; width: 100%;">
        <tbody>
            <tr>
                <td>
                    <div class="col-md-7">
                        <img src="images/logo.png">
                    </div>
                </td>
                <td>    
                    <div class="col-md-5">
						<table>
						    <tr>
						        <td><strong>Order ID</strong></td>
						        <td>: '.$user_id.'</td>
						    </tr>
						    <tr>
						        <td><strong>Order Date</strong></td>
						        <td>: '.$invdate.'</td>
						    </tr>
						</table>
					</div>
                </td>
            </tr>
        </tbody>
    </table>
        
    <div style="padding-top: 1cm; padding-bottom: 1cm;">
        <table style="table-layout: fixed; width: 100%;">
            <tbody>
                <tr>
                    <td width="38%">
                        <table>';
                            $sender_details=mysqli_query($con,"select * from sender_details where id='1' and is_active='1'");
					        while($row_sender=mysqli_fetch_array($sender_details)){
                                $sen_name=$row_sender['name'];
                                $sen_address=$row_sender['address'];
                                $sen_address2=$row_sender['address2'];
                                $sen_address3=$row_sender['address3'];
                                $sen_pincode=$row_sender['pincode'];
                                $sen_country=$row_sender['country'];
                                $sen_email=$row_sender['email'];
                                $sen_phone=$row_sender['phone'];
    						    $html.='
    						    <tr>
    						        <td><strong><u>Sold By</u></strong></td>
    						    </tr>
    						    <tr>
    						        <td></td>
    						    </tr>';
    						    if($sen_name!='')
    						    {
        						    $html.='
        						    <tr>
        						        <td>'.$sen_name.'</td>
        						    </tr>';
					            }
    						    if($sen_address!='')
    						    {
        						    $html.='
        						    <tr>
        						        <td>'.$sen_address.'</td>
        						    </tr>';
					            }
    						    if($sen_address2!='')
    						    {
        						    $html.='
        						    <tr>
        						        <td>'.$sen_address2.'</td>
        						    </tr>';
					            }
					            if($sen_address3!='')
    						    {
        						    $html.='
        						    <tr>
        						        <td>'.$sen_address3.'</td>
        						    </tr>';
					            }
					            if($sen_pincode!='')
    						    {
        						    $html.='
        						    <tr>
        						        <td>'.$sen_pincode.'</td>
        						    </tr>';
					            }
					            if($sen_country!='')
    						    {
        						    $html.='
        						    <tr>
        						        <td>'.$sen_country.'</td>
        						    </tr>';
					            }
					            if($sen_email!='')
    						    {
        						    $html.='
        						    <tr>
        						        <td>'.$sen_email.'</td>
        						    </tr>';
					            }
					            if($sen_phone!='')
    						    {
        						    $html.='
        						    <tr>
        						        <td>'.$sen_phone.'</td>
        						    </tr>';
					            }
					        }
    						$html.='</table>
					   
                    </td>
                    
                    <td width="35%">
    						<table>
    						    <tr>
    						        <td><strong><u>Shipping To</u></strong></td>
    						    </tr>
    						    <tr>
    						        <td></td>
    						    </tr>';
    						    if($business_name!='')
    						    {
    						    $html.='<tr>
    						        <td>'.$business_name.'</td>
    						    </tr>';
    						    }
    						    if($rev_name!='')
    						    {
    						    $html.='<tr>
    						        <td>'.$rev_name.' '.$last_name.'</td>
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
    						   
    						    if($rev_pin!='')
    						    {
    						    $html.='<tr>
    						        <td>'.$rev_pin.'</td>
    						    </tr>';
    						    }
    						    if($rev_country!='')
    						    {
    						    $html.='<tr>
    						        <td>'.$rev_country.'</td>
    						    </tr>';
    						    }
    						    if($rev_email!='')
    						    {
    						    $html.='<tr>
    						        <td>'.$rev_email.'</td>
    						    </tr>';
    						    }
    						    if($rev_phone!='')
    						    {
    						    $html.='<tr>
    						        <td>'.$rev_phone.'</td>
    						    </tr>';
    						    }
    						$html.='</table>
					  
                    </td>
                    
                    <td width="27%">
                       
						<table>
						    <tr>
						        <td><strong><u>Delivery Details</u></strong></td>
						    </tr>
						    <tr>
						    <td></td>
						    </tr>
						    <tr>
						        <td><b>Date</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.date('d-m-Y',strtotime($row['delivery_date'])).'</td>
						    </tr>
						    
						    <tr>
						        <td><b>Status</b> &nbsp;&nbsp;&nbsp;&nbsp; : '.$delivery_status_row['sts_option'].'</td>
						    </tr>
						    
						    </table>
					    
                    </td>
                    
                </tr>
            </tbody>
        </table>
    </div>
    
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
                $sql2=mysqli_query($con,"select * from order_product where order_id='".$row['order_g_id']."' and is_active='1'");
                $i=1;
                $grand_tot='0';
                while($row2=mysqli_fetch_array($sql2))
                {

					if($row2['product_id'])
					{
						$order_items = mysqli_query($con,"select * from our_products where id='".$row2['product_id']."' and is_active='1'");
						$order_item_product = mysqli_fetch_array($order_items);
						
						$item=$order_item_product['product_name'];
						$quantity=$row2['product_quantity'];
						$prize=$row2['product_price'];
						$total1=$row2['product_total'];
						$grand_tot=$grand_tot+$total1;

					} else {
						$order_items = mysqli_query($con,"select * from reacipies where id='".$row2['reacipie_id']."' ");
						$order_item_product = mysqli_fetch_array($order_items);
						
						$recID = $order_item_product['id']; 
						$item=$order_item_product['recipe_name'];
						$quantity=$row2['product_quantity'];
						$prize=$row2['product_price'];
						$total1=$row2['product_total'];
						$grand_tot=$grand_tot+$total1;
					}

                    // $item=$row2['product_name'];

                    // $prize=$row2['unit_price'];
                    // $quantity=$row2['quantity'];
                    // $total1=$row2['product_price'];
                    // $grand_tot=$grand_tot+$total1;
               
                    $html.=' <tr>
                        <td height="20" width="8%" align="center" valign="top">'.$i.'</td>
                        <td height="20" width="45%" align="left" valign="top">'.$item.'</td>
                        <td height="20" width="12%" align="center" valign="top" >'.$quantity.'</td>
                        <td height="20" width="20%" align="center" valign="top">£'.number_format($prize,2).'</td>
                        <td height="20" width="15%" align="center" valign="top">£'.number_format($total1,2).'</td>
                    </tr> ';
                    $i=$i+1;
                }
                
            $discount_reduce= ($grand_tot * ($row['discount'] / 100));
            		        
            $reduce_total= $grand_tot - $discount_reduce;    
                
                $html.='</tbody>
            <tfoot>
    		    <tr>
    		        <th colspan="3"></th>
    		        <th style="text-align:center;"><b>Sub Total (GBP)</b></th>
    		        <th style="text-align:center;"><b>£'.number_format($row['total_price'],2).'</b></th>
    		    </tr>
    		    
    		     <tr>
    		        <th colspan="3"></th>
    		        <th style="text-align:center;"><b>Discount</b></th>
    		        <th style="text-align:center;"><b>£'.number_format($row['discount'],2).'</b></th>
    		    </tr>
    		    
    		    <tr>
    		        <th colspan="3"></th>
    		        <th style="text-align:center;"><b>Vat (20%)</b></th>
    		        <th style="text-align:center;"><b>£'.number_format($row['vat_amt'],2).'</b></th>
    		    </tr>
    		    
		        <tr>
    		        <th colspan="3"></th>
    		        <th style="text-align:center;"><b>Shipping (GBP)</b></th>
    		        <th style="text-align:center;"><b>£'.number_format($row['ship_amount'],2).'</b></th>
    		    </tr>
    		    
    		    <tr>
    		        <th colspan="3"></th>
    		        <th style="text-align:center;"><b>Total (GBP)</b></th>
    		        <th style="text-align:center;"><b>£'.number_format($row['total_price'],2).'</b></th>
    		    </tr>
		    </tfoot>
        </table>
    </table>';
    
    if($refund=='1')
    {
    $html.='<table align="left" style="width:100%;">
        <table cellpadding="3" style="padding-right:10px; width:100%;">
            <h3>Amount Refund Details</h3>
            <tbody>
                <tr>
                    <td style="font-weight: bold;" width="30%" align="center">Refund Date</td>
                    <td style="font-weight: bold;" width="35%" align="center">Refund Amount</td>
                    <td style="font-weight: bold;" width="35%" align="center">Refund Remarks</td>
                </tr>';
                $inv_refund=mysqli_query($con,"select * from invrefund_amount where user_id='".$row['order_id']."' and user_id!='' and is_active='1'");
                while($row_refund=mysqli_fetch_array($inv_refund))
                {
                    $refund_date=date('d-m-Y',strtotime($row_refund['refund_date']));
                    $refund_amount=$row_refund['refund_amount'];
                    $refund_remarks=$row_refund['refund_remarks'];
                $html.='<tr>
                    <td height="20" width="30%" align="center" valign="top">'.$refund_date.'</td>
                    <td height="20" width="35%" align="center" valign="top">'.$refund_amount.'</td>
                    <td height="20" width="35%" align="center" valign="top" >'.$refund_remarks.'</td>
                </tr>';
                }
            $html.='</tbody>
        </table>
    </table>';
    }
   
    
    }


$pdf->writeHTML($html, true, false, true, false, '');


$pdf->Output('invoice_viewpdf.pdf', 'I');

?>