<?php
session_start();
include 'Cart.php';
$cart = new Cart;
include ('includes/config.php');
if ($_SESSION['order_id'] != '') {
    $order_details = mysqli_fetch_array(mysqli_query($con, "select * from orders where order_id='" . $_SESSION['order_id'] . "' and status='1'"));
    $customers = mysqli_query($con, "select * from customers where id='" . $order_details['customer_id'] . "' and is_active=1");
    $cust_details = mysqli_fetch_array($customers);
    $first_name = $cust_details['first_name'];
    $last_name = $cust_details['last_name'];
    $cust_email_id = $cust_details['email_id'];
    $address = $cust_details['address'];
    $town_city = $cust_details['town_city'];
    $postal_code = $cust_details['postal_code'];
    $country = $cust_details['country'];
    date_default_timezone_set('Asia/Singapore');
    $avc = date('d M Y h:i:s');
    $message = '<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="width:100%;, helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">

    <head><meta charset="windows-1252">
    	
	
	<style type="text/css">
	#outlook a {
		padding: 0;
	}
	
	.ExternalClass {
		width: 100%;
	}
	
	.ExternalClass,
	.ExternalClass p,
	.ExternalClass span,
	.ExternalClass font,
	.ExternalClass td,
	.ExternalClass div {
		line-height: 100%;
	}
	
	.es-button {
		mso-style-priority: 100!important;
		text-decoration: none!important;
	}
	
	a[x-apple-data-detectors] {
		color: inherit!important;
		text-decoration: none!important;
		font-size: inherit!important;
		font-family: inherit!important;
		font-weight: inherit!important;
		line-height: inherit!important;
	}
	
	.es-desk-hidden {
		display: none;
		float: left;
		overflow: hidden;
		width: 0;
		max-height: 0;
		line-height: 0;
		mso-hide: all;
	}
	
	.es-button-border:hover a.es-button,
	.es-button-border:hover button.es-button {
		background: #7dbf44!important;
		border-color: #7dbf44!important;
	}
	
	.es-button-border:hover {
		background: #7dbf44!important;
		border-color: #7dbf44 #7dbf44 #7dbf44 #7dbf44!important;
	}
	
	[data-ogsb] .es-button {
		border-width: 0!important;
		padding: 10px 20px 10px 20px!important;
	}
	
	td .es-button-border:hover a.es-button-1 {
		background: #7dbf44!important;
		border-color: #7dbf44!important;
	}
	
	td .es-button-border-2:hover {
		background: #7dbf44!important;
	}
	
	@media only screen and (max-device-width:600px) {
		.es-content table,
		.es-header table,
		.es-footer table {
			width: 100%!important;
			max-width: 600px!important;
		}
	}
	
	@media only screen and (max-width:600px) {
		p,
		ul li,
		ol li,
		a {
			line-height: 150%!important
		}
		h1,
		h2,
		h3,
		h1 a,
		h2 a,
		h3 a {
			line-height: 120%!important
		}
		h1 {
			font-size: 30px!important;
			text-align: center
		}
		h2 {
			font-size: 22px!important;
			text-align: center
		}
		h3 {
			font-size: 20px!important;
			text-align: center
		}
		.es-header-body h1 a,
		.es-content-body h1 a,
		.es-footer-body h1 a {
			font-size: 30px!important
		}
		.es-header-body h2 a,
		.es-content-body h2 a,
		.es-footer-body h2 a {
			font-size: 22px!important
		}
		.es-header-body h3 a,
		.es-content-body h3 a,
		.es-footer-body h3 a {
			font-size: 20px!important
		}
		.es-menu td a {
			font-size: 16px!important
		}
		.es-header-body p,
		.es-header-body ul li,
		.es-header-body ol li,
		.es-header-body a {
			font-size: 16px!important
		}
		.es-content-body p,
		.es-content-body ul li,
		.es-content-body ol li,
		.es-content-body a {
			font-size: 14px!important
		}
		.es-footer-body p,
		.es-footer-body ul li,
		.es-footer-body ol li,
		.es-footer-body a {
			font-size: 14px!important
		}
		.es-infoblock p,
		.es-infoblock ul li,
		.es-infoblock ol li,
		.es-infoblock a {
			font-size: 12px!important
		}
		*[class="gmail-fix"] {
			display: none!important
		}
		.es-m-txt-c,
		.es-m-txt-c h1,
		.es-m-txt-c h2,
		.es-m-txt-c h3 {
			text-align: center!important
		}
		.es-m-txt-r,
		.es-m-txt-r h1,
		.es-m-txt-r h2,
		.es-m-txt-r h3 {
			text-align: right!important
		}
		.es-m-txt-l,
		.es-m-txt-l h1,
		.es-m-txt-l h2,
		.es-m-txt-l h3 {
			text-align: left!important
		}
		.es-m-txt-r img,
		.es-m-txt-c img,
		.es-m-txt-l img {
			display: inline!important
		}
		.es-button-border {
			display: block!important
		}
		a.es-button,
		button.es-button {
			font-size: 20px!important;
			display: block!important;
			border-left-width: 0px!important;
			border-right-width: 0px!important
		}
		.es-btn-fw {
			border-width: 10px 0px!important;
			text-align: center!important
		}
		.es-adaptive table,
		.es-btn-fw,
		.es-btn-fw-brdr,
		.es-left,
		.es-right {
			width: 100%!important
		}
		.es-content table,
		.es-header table,
		.es-footer table,
		.es-content,
		.es-footer,
		.es-header {
			width: 100%!important;
			max-width: 600px!important
		}
		.es-adapt-td {
			display: block!important;
			width: 100%!important
		}
		.adapt-img {
			width: 100%!important;
			height: auto!important
		}
		.es-m-p0 {
			padding: 0px!important
		}
		.es-m-p0r {
			padding-right: 0px!important
		}
		.es-m-p0l {
			padding-left: 0px!important
		}
		.es-m-p0t {
			padding-top: 0px!important
		}
		.es-m-p0b {
			padding-bottom: 0!important
		}
		.es-m-p20b {
			padding-bottom: 20px!important
		}
		.es-mobile-hidden,
		.es-hidden {
			display: none!important
		}
		tr.es-desk-hidden,
		td.es-desk-hidden,
		table.es-desk-hidden {
			width: auto!important;
			overflow: visible!important;
			float: none!important;
			max-height: inherit!important;
			line-height: inherit!important
		}
		tr.es-desk-hidden {
			display: table-row!important
		}
		table.es-desk-hidden {
			display: table!important
		}
		td.es-desk-menu-hidden {
			display: table-cell!important
		}
		.es-menu td {
			width: 1%!important
		}
		table.es-table-not-adapt,
		.esd-block-html table {
			width: auto!important
		}
		table.es-social {
			display: inline-block!important
		}
		table.es-social td {
			display: inline-block!important
		}
	}
	</style>
</head>

<body style="width:100%;font-family:arial, helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
	<div class="es-wrapper-color" style="background-color:#F6F6F6">
	
					<table cellpadding="0" cellspacing="0" class="es-header" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
						<tr style="border-collapse:collapse">
							<td align="center" style="padding:0;Margin:0">
								<table class="es-header-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
									<tr style="border-collapse:collapse">
										<td align="left" style="Margin:0;padding-bottom:10px;padding-top:20px;padding-left:20px;padding-right:20px">
											
											<table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
												<tr style="border-collapse:collapse">
													<td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:270px">
														<table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
															<tr style="border-collapse:collapse">
																<td align="left" style="padding:0;Margin:0;padding-left:20px;font-size:0px">
																	<a target="_blank" href="https://czarmedias.com/BlendUrSpice/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#659C35;font-size:16px"><img src="https://czarmedias.com/BlendUrSpice/admin/assets/img/profiles/16-09-2021-3251-blend-new-logo.png" alt="Eternal Seasoning" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" class="adapt-img" width="200" title="Eternal Seasoning" height="55"></a>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											
											<table class="es-right" cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
												<tr style="border-collapse:collapse">
													<td align="left" style="padding:0;Margin:0;width:270px">
														<table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
															<tr style="border-collapse:collapse">
																<td style="padding:0;Margin:0">
																	<table class="es-menu" width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
																		<tr class="links" style="border-collapse:collapse">
																			<td style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0" width="50%" valign="top" bgcolor="transparent" align="center"><a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial,  helvetica, sans-serif;color:#659C35;font-size:16px" href="tel:1234567890">+01 1234567890</a></td>
																		</tr>
																	</table>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
						<tr style="border-collapse:collapse">
							<td align="center" style="padding:0;Margin:0">
								<table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
									<tr style="border-collapse:collapse">
										<td align="left" style="padding:0;Margin:0;background-position:center top">
											<table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
												<tr style="border-collapse:collapse">
													<td align="center" valign="top" style="padding:0;Margin:0;width:600px">
														<table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
															<tr style="border-collapse:collapse">
																<td align="center" style="padding:0;Margin:0;position:relative">
																	<a target="_blank" href="javascript:void(0)" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#659C35;font-size:14px"><img class="adapt-img" src="https://lgqnfy.stripocdn.email/content/guids/bannerImgGuid/images/91191577364120504.png" alt title width="600" height="300" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
						<tr style="border-collapse:collapse">
							<td align="center" style="padding:0;Margin:0">
								<table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
									<tr style="border-collapse:collapse">
										<td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;background-position:center top">
											<table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
												<tr style="border-collapse:collapse">
													<td align="center" valign="top" style="padding:0;Margin:0;width:560px">
														<table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
															<tr style="border-collapse:collapse">
																<td align="center" style="padding:0;Margin:0">
																	<h2 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:arial,  helvetica, sans-serif;font-size:26px;font-style:normal;font-weight:bold;color:#659c35">Your order is on its way</h2> </td>
															</tr>
															<tr style="border-collapse:collapse">
																<td align="center" style="padding:0;Margin:0;padding-top:10px">
																	<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial,  helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">Delivery of healthy food is the best solution for business people. Who wants to eat right, look healthy and work productively all day.</p>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<br><br>
									<tr style="border-collapse:collapse">
										<td align="left" style="Margin:0;padding-bottom:10px;padding-top:20px;padding-left:20px;padding-right:20px;background-position:center top;background-color: #efefef;">
										
											<table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
												<tr style="border-collapse:collapse">
													<td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:280px">
														<table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-left:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;background-color:#efefef;background-position:center top" width="100%" cellspacing="0" cellpadding="0" bgcolor="#efefef" role="presentation">
															<tr style="border-collapse:collapse">
																<td align="left" style="Margin:0;padding-bottom:10px;padding-top:20px;padding-left:20px;padding-right:20px">
																	<h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:arial,  helvetica, sans-serif;color:#659c35">SUMMARY:</h4> </td>
															</tr>
															<tr style="border-collapse:collapse">
																<td align="left" style="padding:0;Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px">
																	<table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" align="left" role="presentation">
																		<tr style="border-collapse:collapse">
																			<td style="padding:0;Margin:0;font-size:14px;line-height:21px">Order #:</td>
																			<td style="padding:0;Margin:0"><strong><span style="font-size:14px;line-height:21px">' . $order_details['order_id'] . '</span></strong></td>
																		</tr>
																		<tr style="border-collapse:collapse">
																			<td style="padding:0;Margin:0;font-size:14px;line-height:21px">Order Date:</td>
																			<td style="padding:0;Margin:0"><strong><span style="font-size:14px;line-height:21px">' . date('M d, Y', strtotime($order_details['created'])) . '</span></strong></td>
																		</tr>
																		<tr style="border-collapse:collapse">
																			<td style="padding:0;Margin:0;font-size:14px;line-height:21px">Order Total:</td>
																			<td style="padding:0;Margin:0"><strong><span style="font-size:14px;line-height:21px">£ ' . $order_details['total_price'] . '</span></strong></td>
																		</tr>
																	</table>
																	<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial,  helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
																		<br>
																	</p>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											
											<table class="es-right" cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
												<tr style="border-collapse:collapse">
													<td align="left" style="padding:0;Margin:0;width:280px">
														<table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;background-color:#efefef;background-position:center top" width="100%" cellspacing="0" cellpadding="0" bgcolor="#efefef" role="presentation">
															<tr style="border-collapse:collapse">
																<td align="left" style="Margin:0;padding-bottom:10px;padding-top:20px;padding-left:20px;padding-right:20px">
																	<h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:arial,  helvetica, sans-serif;color:#659c35">DELIVERY ADDRESS:</h4> </td>
															</tr>
															<tr style="border-collapse:collapse">
																<td align="left" style="padding:0;Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px">
																	<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial,  helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">' . $first_name . ' ' . $last_name . '</p>
																	<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial,  helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">' . $address . '</p>
																	<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial,  helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">' . $town_city . '</p>
																	<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial,  helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">' . $country . ' - ' . $postal_code . '</p>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
					
						<tr style="border-collapse:collapse">
							<td align="center" style="padding:0;Margin:0">
								<table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">';
    $order_items = mysqli_query($con, "select * from order_items where order_id='" . $order_details['order_id'] . "'");
    $order_items_count = mysqli_num_rows($order_items);
    while ($order_items_row = mysqli_fetch_array($order_items)) {
        $message.= '<tr style="border-collapse:collapse">
										<td align="left" style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;background-position:center top">
											
											<table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
												<tr style="border-collapse:collapse">
													<td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:154px">
														<table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-position:left top" role="presentation">
															<tr style="border-collapse:collapse">
																<td align="center" style="padding:0;Margin:0;font-size:0">
																	<a target="_blank" href="https://czarmedias.com/BlendUrSpice/index.php" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#659C35;font-size:14px"><img class="adapt-img" src="https://czarmedias.com/BlendUrSpice/' . $order_items_row['product_img'] . '" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="75" height="75"></a>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										
											<table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
												<tr style="border-collapse:collapse">
													<td align="left" style="padding:0;Margin:0;width:386px">
														<table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
															<tr style="border-collapse:collapse">
																<td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px">
																	<h3 style="Margin:0;line-height:0px;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;font-size:16px;font-style:normal;font-weight:normal;color:#659c35"><strong>' . $order_items_row['product_name'] . '</strong></h3></td>
															</tr>															
															<tr style="border-collapse:collapse">
																<td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px">
																	<h3 style="Margin:0;line-height:30px;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;font-size:14px;font-style:normal;font-weight:normal;color:#659c35"><strong><span style="color:#000000">Qty:</span>&nbsp;' . $order_items_row['quantity'] . '</strong></h3></td>
															</tr>
															<tr style="border-collapse:collapse">
																<td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px">
																	<h3 style="Margin:0;line-height:10px;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;font-size:14px;font-style:normal;font-weight:normal;color:#659c35"><strong><span style="color:#000000">Price:</span>&nbsp;£' . $order_items_row['product_price'] . '</strong></h3></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										
										</td>
									</tr>';
    }
    $message.= '</table>
							</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
						<tr style="border-collapse:collapse">
							<td align="center" style="padding:0;Margin:0">
								<table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
									<tr style="border-collapse:collapse">
										<td align="left" style="padding:0;Margin:0;padding-top:15px;padding-left:20px;padding-right:20px;background-position:center top">
											<table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
												<tr style="border-collapse:collapse">
													<td align="center" valign="top" style="padding:0;Margin:0;width:560px">
														<table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;background-position:center top" role="presentation">
															<tr style="border-collapse:collapse">
																<td align="left" style="padding:0;Margin:0;padding-top:10px">
																	<table border="0" cellspacing="1" cellpadding="1" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:500px" class="cke_show_border" role="presentation">
																		<tr style="border-collapse:collapse">
																			<td style="padding:0;Margin:0">
																				<h4 style="Margin:0;line-height:200%;mso-line-height-rule:exactly;font-family:arial,  helvetica, sans-serif;color:#333333">Subtot<strong>al (' . $order_items_count . ' items):</strong></h4> </td>
																			<td style="padding:0;Margin:0;color:#659c35"><strong>£' . number_format($order_details['total_price'], 2) . '</strong></td>
																		</tr>
																		<tr style="border-collapse:collapse">
																			<td style="padding:0;Margin:0">
																				<h4 style="Margin:0;line-height:200%;mso-line-height-rule:exactly;font-family:arial,  helvetica, sans-serif;color:#333333">Shipping:</h4></td>
																			<td style="padding:0;Margin:0;color:#ff0000"><strong>Free</strong></td>
																		</tr>
																		
																		<tr style="border-collapse:collapse">
																			<td style="padding:0;Margin:0">
																				<h4 style="Margin:0;line-height:200%;mso-line-height-rule:exactly;font-family:arial,  helvetica, sans-serif;color:#333333">Order Total:</h4></td>
																			<td style="padding:0;Margin:0;color:#659c35"><strong>£' . number_format($order_details['total_price'], 2) . '</strong></td>
																		</tr>
																	</table>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
						<tr style="border-collapse:collapse">
							<td align="center" style="padding:0;Margin:0">
								<table class="es-footer-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#333333;width:600px" cellspacing="0" cellpadding="0" bgcolor="#333333" align="center">
									<tr style="border-collapse:collapse">
										<td style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:20px;padding-right:20px;background-position:center center;background-color:#659c35" bgcolor="#659C35" align="left">
											<table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
												<tr style="border-collapse:collapse">
													<td valign="top" align="center" style="padding:0;Margin:0;width:560px">
														<table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
															<tr style="border-collapse:collapse">
																<td align="center" style="padding:0;Margin:0;padding-bottom:15px;font-size:0">
																	<table class="es-table-not-adapt es-social" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
																		<tr style="border-collapse:collapse">
																			<td valign="top" align="center" style="padding:0;Margin:0;padding-right:15px">
																				<a target="_blank" href="https://www.facebook.com/profile.php?id=100076340330842" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#FFFFFF;font-size:14px"><img title="Facebook" src="https://lgqnfy.stripocdn.email/content/assets/img/social-icons/circle-white/facebook-circle-white.png" alt="Fb" width="32" height="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a>
																			</td>
																			<td valign="top" align="center" style="padding:0;Margin:0;padding-right:15px">
																				<a target="_blank" href="https://www.instagram.com/blendurspice/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#FFFFFF;font-size:14px"><img title="Instagram" src="https://lgqnfy.stripocdn.email/content/assets/img/social-icons/circle-white/instagram-circle-white.png" alt="Ig" width="32" height="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a>
																			</td>
																			<td valign="top" align="center" style="padding:0;Margin:0;padding-right:15px">
																				<a target="_blank" href="https://www.youtube.com/channel/UCzagYglJ1t3-jCfgtqMkfMQ" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#FFFFFF;font-size:14px"><img title="Youtube" src="https://lgqnfy.stripocdn.email/content/assets/img/social-icons/circle-white/youtube-circle-white.png" alt="Yt" width="32" height="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a>
																			</td>
																			<td valign="top" align="center" style="padding:0;Margin:0">
																				<a target="_blank" href="https://www.linkedin.com/in/blend-ur-spice-8a3b18229/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#FFFFFF;font-size:14px"><img title="Twitter" src="https://lgqnfy.stripocdn.email/content/assets/img/social-icons/circle-white/linkedin-circle-white.png" alt="Tw" width="32" height="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a>
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
															<tr style="border-collapse:collapse">
																<td align="center" style="padding:0;Margin:0;padding-bottom:10px;padding-top:15px;font-size:0"><img src="https://lgqnfy.stripocdn.email/content/guids/CABINET_c6d6983b8f90c1ab10065255fbabfbaf/images/15841556884046468.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="140" height="17"></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>					
				</td>
			</tr>
		</table>
	</div>
</body>

</html>';
    require_once ("PHPMailer/class.phpmailer.php");
    require_once ("PHPMailer/class.smtp.php");
    $mail = new PHPMailer();
    $mail->Host = "czarmedias.com";
    $mail->SMTPDebug = 1;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;
    $mail->IsHTML(true);
    $mail->Username = 'notification@czarmedias.com';
    $mail->Password = 'p9eoURvC1jrJ';
    $mail->SMTPAuth = true;
    $subject = "Eternal Seasoning - Order Details";
    $mail->Subject = $subject;
    $mail->SetFrom("blendurspice@gmail.com", "Eternal Seasoning");
    $mail->From = "blendurspice@gmail.com";
    $mail->FromName = "Eternal Seasoning";
    $mail->addAddress($cust_email_id, $first_name);
    // $mail->addCC("vasud14@gmail.com","Vasu");
    $mail->addBCC("gemonster021@gmail.com", "Testing");
    $mail->addBCC("kanimksd.ic@gmail.com", "Kani");
    $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    $mail->MsgHTML($message);
    $mail->Send();
}
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Eternal Seasoning - Checkout</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
        <!-- Place favicon.ico in the root directory -->

		<!-- CSS here -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="css/fontawesome-all.min.css">
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" href="css/flaticon.css">
        <link rel="stylesheet" href="css/aos.css">
        <link rel="stylesheet" href="css/slick.css">
        <link rel="stylesheet" href="css/default.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
    </head>
    <body>

        <!-- preloader -->
        <div id="preloader">
            <div id="loading-center">
                <div class="loader">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <!-- preloader-end -->

		<!-- Scroll-top -->
        <button class="scroll-top scroll-to-target" data-target="html">
            <i class="fas fa-angle-up"></i>
        </button>
        <!-- Scroll-top-end-->

        <!-- header-area -->
        <?php include ('includes/header.php'); ?>
        <!-- header-area-end -->


        <!-- main-area -->
        <main>

            <!-- breadcrumb-area -->
            <section class="breadcrumb-area breadcrumb-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">Order Successful</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Order Successful</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>        
            <!-- breadcrumb-area-end -->

            <!-- checkout-area -->
            <div class="checkout-area pt-90 pb-90">
                <div class="container">
                    
                   <form method="post" autocomplete="off">  
                   
                    <div class="row justify-content-center">
                        
                        <div class="col-lg-7">
                            <div class="checkout-progress-wrap">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="checkout-progress-step">
                                    <ul>
                                        <li>
                                            <div class="icon"><i class="fas fa-check"></i></div>
                                            <span>Shipping</span>
                                        </li>
                                        <li class="active">
                                            <div class="icon"><i class="fas fa-check"></i></div>
                                            <span>Order Successful</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="checkout-form-wrap">
                                <div class="form">
                                 
                                    <div class="checkout-form-top">
                                        <h5 class="title">Order Confirmation</h5>
                                        <div class="account-create-info">
                                            <a href="javascript:void(0)"><?php echo $_SESSION['login_user']; ?> <i class="fas fa-user"></i></a>
                                        </div>
                                    </div>
                                   
                                    <div class="building-info-wrap" style="background: #f7f7f7;">
                                        <div class="row justify-content-center">
                                          <img src="img/order-successfull-img.png">
                                        </div><br>
                                        <div style="text-align: center;">
                                          <h3>Order No : #<?php echo $_SESSION['order_id']; ?></h3>
                                          <p>Thank you for ordering. We received your order and will begin processing it soon. Your order information appears below.</p>
                                          <br>
                                          <a href="index.php" class="btn" >Back to Home</a>
                                          <br> <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="shop-cart-total order-summary-wrap">
                                <h3 class="title">Order Summary</h3>
                                <?php
$order_details = mysqli_fetch_array(mysqli_query($con, "select * from orders where order_id='" . $_SESSION['order_id'] . "' and is_active='1'"));
$order_items = mysqli_query($con, "select * from order_items where order_id='" . $_SESSION['order_id'] . "' and is_active='1'");
while ($order_items_rows = mysqli_fetch_array($order_items)) {
?>
                                <div class="os-products-item">
                                    <div class="thumb">
                                        <a href="javascript:void(0)"><img src="<?php echo $order_items_rows['product_img']; ?>" alt=""></a>
                                    </div>
                                    <div class="content">
                                        <h6 class="title"><a href="javascript:void(0)"><?php echo $order_items_rows['product_name']; ?></a></h6>
                                        <span class="price"><?php echo $order_items_rows['quantity']; ?> X £ <?php echo $order_items_rows['unit_price']; ?></span>
                                    </div>
                                </div>
                                <?php
} ?>
                                <div class="shop-cart-widget">
                                    <div class="form">
                                        <ul>
                                            <li class="sub-total"><span>Subtotal</span> £ <?php echo $order_details['total_price']; ?></li>
                                            <li class="sub-total"><span>Shipping (Free)</span> £ 0.00</li>
                                            <li class="cart-total-amount"><span>Total Price</span> <span class="amount">£ <?php echo $order_details['total_price']; ?></span></li>
                                        </ul>
                                    </div>
                               </div>
                            </div>
                        </div>
                    </div>
                  </form> 
                </div>
            </div>
            <!-- checkout-area-end -->

        </main>
        <!-- main-area-end -->

        <!-- footer-area -->
        <?php include ('includes/footer.php'); ?>
        <!-- footer-area-end -->


		<!-- JS here -->
        <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="js/vendor/jquery-3.6.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/isotope.pkgd.min.js"></script>
        <script src="js/imagesloaded.pkgd.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/jquery.countdown.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/ajax-form.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/aos.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
