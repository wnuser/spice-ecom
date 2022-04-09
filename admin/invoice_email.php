<?php

    if(isset($_POST['email_send']))	
    {

        $message = '';
        
        $connect = new PDO("mysql:host=localhost;dbname=lagpat_invdemo", "lagpat_invdemo", "uFn1y3ti2NQw");

        function fetch_customer_data($connect)
        {
    
            $user=$_POST['user_id'];
            $email=$_POST['use_email'];
            
        	$query = "select invoice.*,cur.* from invoiceinfo_clb as invoice,currency_master as cur where invoice.user_id='".$user."' and invoice.currency=cur.id and invoice.is_active='1'";
        	$statement = $connect->prepare($query);
        	$statement->execute();
        	$result = $statement->fetchAll();
        	
	        foreach($result as $row)
	        {
	    
            $user_id=$row['user_id'];
            $send_id=$row['send_id'];
            $address1=$row['address1'];
            $address2=$row['address2'];
            $address3=$row['address3'];
            $business_name=$row['business_name'];
            $rev_name=$row['rev_name'];
            $last_name=$row['last_name'];
            $rev_city=$row['rev_city'];
            $rev_pin=$row['rev_pin'];
            $rev_country=$row['rev_country'];
            $rev_phone=$row['rev_phone'];
            $pono=$row['pono'];
            $workorder=$row['workorder'];
            $invdate=date('d-m-Y',strtotime($row['invdate']));
            $quoterefno=$row['quoterefno'];
            $transchg=$row['transchg'];
            $total=$row['total'];
            $discount=$row['discount'];
            $refund=$row['refund'];
            $amount_paid=$row['amount_paid'];
            $balance=$row['balance'];
            $item_desc=$row['item_desc'];
            $rev_email=$row['rev_email'];
            $air_way=$row['air_way'];
            $paypal_id=$row['paypal_id'];
            $hs_code=$row['hs_code'];
            $currency=$row['currency_code'];
            
            if($row['paypal_paid_date']=='0000-00-00' || $row['paypal_paid_date']=='1970-01-01')
            { 
                
                $paypal_paid_date='';
            
            } else {
             
                $paypal_paid_date=date('d-m-Y',strtotime($row['paypal_paid_date']));
                
            }
            
               
            
    $output ='
    <table style="table-layout: fixed; width: 100%;">
        <tbody>
            <tr>
                <td>
                    <div class="col-md-5">
                        <img src="images/logo.png">
                    </div>
                    <div>
                        <span style="font-weight:bold;">Reg.No: 200508936C</span>
                    </div>
                </td>
                <td>    
                    <div class="col-md-7">
						<table>
						    <tr>
						        <td><strong>Invoice No</strong></td>
						        <td>: '.$user_id.'</td>
						    </tr>
						    <tr>
						        <td><strong>Currency</strong></td>
						        <td>: '.$currency.'</td>
						    </tr>
						    <tr>
						        <td><strong>Invoice Date</strong></td>
						        <td>: '.$invdate.'</td>
						    </tr>
						</table>
					</div>
                </td>
            </tr>
        </tbody>
    </table>
    
    <table style="table-layout: fixed; width: 100%;">
        <tbody>
            <tr>
                <td>
                    <div class="col-md-5">
						<table>';
						$sender_details = "select * from sender_details where id='".$send_id."' and is_active='1'";
                        $row_sender = $connect->prepare($sender_details);
                        $row_sender->execute();
                        $res_sender = $row_sender->fetchAll();
                        foreach($res_sender as $sender_row)
						{
                            $sen_name=$sender_row['name'];
                            $sen_address=$sender_row['address'];
                            $sen_address2=$sender_row['address2'];
                            $sen_address3=$sender_row['address3'];
                            $sen_pincode=$sender_row['pincode'];
                            $sen_country=$sender_row['country'];
                            $sen_email=$sender_row['email'];
                            $sen_phone=$sender_row['phone'];
						    $output.='
						    <tr>
						        <td></td>
						    </tr>
						    <tr>
						        <td></td>
						    </tr>
						    <tr>
						        <td></td>
						    </tr>
						    <tr>
						        <td><b><u>Invoice From</u></b></td>
						    </tr>
						    <tr>
    						        <td></td>
    						    </tr>';
    						    if($sen_name!='')
    						    {
        						    $output.='
        						    <tr>
        						        <td>'.$sen_name.'</td>
        						    </tr>';
					            }
    						    if($sen_address!='')
    						    {
        						    $output.='
        						    <tr>
        						        <td>'.$sen_address.'</td>
        						    </tr>';
					            }
    						    if($sen_address2!='')
    						    {
        						    $output.='
        						    <tr>
        						        <td>'.$sen_address2.'</td>
        						    </tr>';
					            }
					            if($sen_address3!='')
    						    {
        						    $output.='
        						    <tr>
        						        <td>'.$sen_address3.'</td>
        						    </tr>';
					            }
					            if($sen_pincode!='')
    						    {
        						    $output.='
        						    <tr>
        						        <td>'.$sen_pincode.'</td>
        						    </tr>';
					            }
					            if($sen_country!='')
    						    {
        						    $output.='
        						    <tr>
        						        <td>'.$sen_country.'</td>
        						    </tr>';
					            }
					            if($sen_email!='')
    						    {
        						    $output.='
        						    <tr>
        						        <td>'.$sen_email.'</td>
        						    </tr>';
					            }
					            if($sen_phone!='')
    						    {
        						    $output.='
        						    <tr>
        						        <td>'.$sen_phone.'</td>
        						    </tr>';
					            }
					        }
						$output.='</table>
				    </div>
                </td>
                <td>
                    <div class="col-md-7">
						<table>
						    <tr>
						        <td></td>
						    </tr>
						    <tr>
						        <td><b><u>Invoice To</u></b></td>
						    </tr>
						    <tr>
						        <td></td>
						    </tr>';
						    if($business_name!='')
						    {
						    $output.='<tr>
						        <td>'.$business_name.'</td>
						    </tr>';
						    }
						    if($rev_name!='')
						    {
						    $output.='<tr>
						        <td>'.$rev_name.' '.$last_name.'</td>
						    </tr>';
						    }
						    if($address1!='')
						    {
						    $output.='<tr>
						        <td>'.$address1.'</td>
						    </tr>';
						    }
						    if($address2!='')
						    {
						    $output.='<tr>
						        <td>'.$address2.'</td>
						    </tr>';
                            }
                            if($address3!='')
                            {
						    $output.='<tr>
						        <td>'.$address3.'</td>
						    </tr>';
                            }
                            if($rev_email!='')
                            {
						    $output.='<tr>
						        <td>'.$rev_email.'</td>
						    </tr>';
                            }
                            if($rev_phone!='')
                            {
						    $output.='<tr>
						        <td>'.$rev_phone.'</td>
						    </tr>';
                            }
						$output.='</table>
				    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <br/>
    <table align="left" style="width:100%;">
        <table border="1"  cellpadding="3" style="padding-right:10px; width:100%;">
            <tbody>
                <tr>
                    <td style="font-weight: bold;" width="10%" align="center" bgcolor="#f9fcfd" valign="middle">S.No</td>
                    <td style="font-weight: bold;" width="49%" align="center" bgcolor="#f9fcfd" valign="middle">Item Name</td>
                    <td style="font-weight: bold;" width="16%" align="center" bgcolor="#f9fcfd" valign="middle">Quantity</td>
                    <td style="font-weight: bold;" width="15%" align="center" bgcolor="#f9fcfd" valign="middle">Price</td>
                    <td style="font-weight: bold;" width="15%" align="center" bgcolor="#f9fcfd" valign="middle">Amount</td>
                </tr>';
                $query2 = "select * from itemtable_clb where user_id='".$user_id."' and is_active='1'";
                $statement2 = $connect->prepare($query2);
                $statement2->execute();
                $result2 = $statement2->fetchAll();      
        	 
                $k=1;
                $grand_tot='0';
                foreach($result2 as $row2)
                {
              
                    $item=$row2['description'];
                    $prize=$row2['prize'];
                    $quantity=$row2['quantity'];
                    $total1=$row2['total'];
                    $grand_tot=$grand_tot+$total1;
               
                    $output.=' <tr>
                    <td height="20" width="10%" align="center" valign="top">'.$k.'</td>
                    <td height="20" width="49%" align="left" valign="top">&nbsp;'.$item.'</td>
                    <td height="20" width="16%" align="center" valign="top">'.$quantity.'</td>
                    <td height="20" width="15%" align="center" valign="top">'.$prize.'</td>
                    <td height="20" width="15%" align="center" valign="top">'.$total1.'</td>
                    </tr> ';
                    $k++;
                }
                
	        $discount_reduce= ($grand_tot * ($row['discount'] / 100));
            		        
            $reduce_total= $grand_tot - $discount_reduce;  
	            
            $output.='</tbody>
            <tfoot>
    		    <tr>
    		        <th colspan="3"></th>
    		        <th style="text-align:center;"><b>Sub Total ('.$currency.')</b></th>
    		        <th style="text-align:center;"><b>'.$symbols.''.number_format($grand_tot,2).'</b></th>
    		    </tr>
    		    <tr>
		        <th colspan="3"></th>';
		        
		        if($row['discount']!='0')
		        {
		        
		            $output.='<th style="text-align:center;"><b>Discount '.$row['discount'].'%</b></th>';
		        
		        } else {
		            
		            $output.='<th style="text-align:center;"><b>Discount %</b></th>';
		        }
		        
		        $output.='<th style="text-align:center;"><b>'.number_format($discount_reduce,2).'</b></th>
		        
		     </tr>
    		    <tr>
    		        <th colspan="3"></th>
    		        <th style="text-align:center;"><b>Total ('.$currency.')</b></th>
    		        <th style="text-align:center;"><b>'.$symbols.''.number_format($reduce_total,2).'</b></th>
    		    </tr>
		    </tfoot>
        </table>
    </table>';
    
    if($refund=='1')
    {
    $output.='<br/><table align="left" style="width:100%;">
        <table cellpadding="3" style="padding-right:10px; width:100%;">
            <tbody>
                <tr>
                    <td><h3>Amount Refund Details</h3></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;" width="30%" align="center">Refund Date</td>
                    <td style="font-weight: bold;" width="35%" align="center">Refund Amount</td>
                    <td style="font-weight: bold;" width="35%" align="center">Refund Remarks</td>
                </tr>';
                $inv_refund = "select * from invrefund_amount where user_id='".$user_id."' and user_id!='' and is_active='1'";
                $row_refund = $connect->prepare($inv_refund);
                $row_refund->execute();
                $result3 = $row_refund->fetchAll();
                foreach($result3 as $row3)
                {
                    $refund_date=date('d-m-Y',strtotime($row3['refund_date']));
                    $refund_amount=$row3['refund_amount'];
                    $refund_remarks=$row3['refund_remarks'];
                $output.='<tr>
                    <td height="20" width="30%" align="center" valign="top">'.$refund_date.'</td>
                    <td height="20" width="35%" align="center" valign="top">'.$refund_amount.'</td>
                    <td height="20" width="35%" align="center" valign="top" >'.$refund_remarks.'</td>
                </tr>';
                }
            $output.='</tbody>
        </table>
    </table>';
    }
    
    $bank_details="select * from bank_details where is_active='1'";
    $bank_datas=$connect->prepare($bank_details);
    $bank_datas->execute();
    $bank_row=$bank_datas->fetchAll();
    
    foreach($bank_row as $row_value){
        $account_name=$row_value['account_name'];
        $account_no=$row_value['account_no'];
        $bank_name=$row_value['bank_name'];
        $swift_code=$row_value['swift_code'];
        $country=$row_value['country'];
    }
    
    $output.='
    <br/>
    <table style="table-layout: fixed; width: 100%;">
        <tbody>
            <tr>
                <td>
                    <div class="col-md-5">
                        <table>
                            <tr>
                                <td></td>
                            </tr>
						    <tr>
						        <td><strong>Account Name</strong></td>
						        <td>: '.$account_name.'</td>
						    </tr>
						    <tr>
						        <td><strong>Account No</strong></td>
						        <td>: '.$account_no.'</td>
						    </tr>
						    <tr>
						        <td><strong>Bank Name</strong></td>
						        <td>: '.$bank_name.'</td>
						    </tr>
						    <tr>
						        <td><strong>Swift Code</strong></td>
						        <td>: '.$swift_code.'</td>
						    </tr>
						    <tr>
						        <td><strong>Country</strong></td>
						        <td>: '.$country.'</td>
						    </tr>
						</table>
                    </div>
                </td>
                <td>    
                    <div class="col-md-7">
						<table>';
						    if($workorder!='')
						    {
						    $output.='<tr>
						        <td><strong>Shipping Company</strong></td>
						        <td>: '.$workorder.'</td>
						    </tr>';
						    }
						    if($hs_code!='')
						    {
						    $output.='<tr>
						        <td><strong>Hs Code</strong></td>
						        <td>: '.$hs_code.'</td>
						    </tr>';
						    }
						    if($quoterefno!='')
						    {
						    $output.='<tr>
						        <td><strong>Bill Tax & Duties</strong></td>
						        <td>: '.$quoterefno.'</td>
						    </tr>';
						    }
						    if($transchg!='')
						    {
						    $output.='<tr>
						        <td><strong>Bill Transport Charges</strong></td>
						        <td>: '.$transchg.'</td>
						    </tr>';
						    }
						    if($air_way!='')
						    {
						    $output.='<tr>
						        <td><strong>Air Waybill</strong></td>
						        <td>: '.$air_way.'</td>
						    </tr>';
						    }
						    if($paypal_id!='')
						    {
						    $output.='<tr>
						        <td><strong>Paypal Id</strong></td>
						        <td>: '.$paypal_id.'</td>
						    </tr>';
	                        }
	                        if($paypal_paid_date!='')
	                        {
						    $output.='<tr>
						        <td><strong>Paypal Paid Date</strong></td>
						        <td>: '.$paypal_paid_date.'</td>
						    </tr>';
	                        }
						$output.='</table>
					</div>
                </td>
            </tr>
        </tbody>
    </table>';

	    
	}
	
	return $output;
}


    $email=$_POST['use_email'];
   
    $arrway_file=$_POST['arrway_file'];

	include('pdf.php');
	
	$file_name = md5(rand()) . '.pdf';
	
	$html_code = '<link rel="stylesheet" href="assets/css/bootstrap.min.css">';
	$html_code .= fetch_customer_data($connect);
	$pdf = new Pdf();
	$pdf->load_html($html_code);
	$pdf->render();
	$file = $pdf->output();
	file_put_contents($file_name, $file);
	
	require 'class/class.phpmailer.php';
	$mail = new PHPMailer;
	$mail->Host = 'www.lagpat.com';
	$mail->Port = $_SERVER['SERVER_PORT'];
	$mail->SMTPDebug  = 1;                            
	$mail->SMTPAuth = true;							
	$mail->SetFrom("anbu@lagpat.com","www.lagpat.com");
	$mail->SMTPSecure = 'ssl';							
	$mail->From = 'anbu@lagpat.com';		
	$mail->FromName = 'www.lagpat.com';		
	$mail->AddAddress($email, 'Lagpat - Invoice');	
	$mail->IsHTML(true);									
	$mail->AddAttachment($file_name); 
	$mail->Subject = 'Lagpat Invoice Report PDF';
	$mail->Body = 'Please Collect Your Invoice Report.';	

	if($mail->Send())						
	{
    
    	echo "<script>alert('Your Invoice has been sent successfully...');window.location= 'reportsall.php';</script>";

	} else {
	     
	     echo "<script>alert('something went wrong...');window.location= 'reportsall.php';</script>";
    }
	 
	unlink($file_name);

}




