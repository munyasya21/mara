<?php 

// session_start();
include('config.php');
include('admin/account/config.php');
include(INCLUDE_PATH . '/logic/account_api.php'); 
error_reporting(0);

?>
<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/invoice-view.html  30 Nov 2019 04:12:19 GMT -->
<head>
		<meta charset="utf-8">
		<title>Bethelex Health Care Services</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<!-- <link href="assets/img/favicon.png" rel="icon"> -->
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
			<?php //include(INCLUDE_PATH . '/consts/header.php') ?>
			<!-- /Header -->
			
			<!-- Breadcrumb -->
			<!-- <div style="background-color: #09e5ab;" class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Receipt View</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Receipt View</h2>
						</div>
					</div>
				</div>
			</div> -->
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
				<?php
											$bid =$_GET['receipt'];
											$sql = "SELECT * from booking where bid=:bid";
											$query = $dbh->prepare($sql);
											$query->bindParam(':bid', $bid, PDO::PARAM_STR);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {	?>

					<div class="row">
						<div class="col-lg-8 offset-lg-2">
							<div class="invoice-content">
								<div class="invoice-item">
									<div class="row">
										<div class="col-md-6">
											<div class="invoice-logo">
												<!-- <img src="assets/img/logo.png" alt="logo"> -->
												<span style="font-weight:700; font-size:36px; color: #09e5ab;" >BHCS</span>
											</div>
										</div>
										<div class="col-md-6">
											<p class="invoice-details">
												<strong>Order:</strong> #INV-<?php echo htmlentities($result->bid); ?> <br>
												<strong>Issued:</strong> <?php echo htmlentities($result->date); ?>
											</p>
										</div>
									</div>
								</div>
								
								<!-- Invoice Item -->
								<div class="invoice-item">
									<div class="row">
										<div class="col-md-6">
											<div class="invoice-info">
												<strong class="customer-text">Receipt From</strong>
												<p class="invoice-details invoice-details-two">
												Bethelex Health Care Services
												</p>
											</div>
										</div>
										<div class="col-md-6">
											<div class="invoice-info invoice-info2">
												<strong class="customer-text">Receipt To</strong>
												<p class="invoice-details">
												<?php echo htmlentities($result->patient_fname); ?>&nbsp;<?php echo htmlentities($result->patient_lname); ?><br>
												<?php echo htmlentities($result->patient_email); ?>

												</p>
											</div>
										</div>
									</div>
								</div>
								<!-- /Invoice Item -->
								
								<!-- Invoice Item -->
								<div class="invoice-item">
									<div class="row">
										<div class="col-md-12">
											<!-- <div class="invoice-info">
												<strong class="customer-text">Payment Method</strong>
												<p class="invoice-details invoice-details-two">
													Debit Card <br>
													XXXXXXXXXXXX-2541 <br>
													HDFC Bank<br>
												</p>
											</div> -->
										</div>
									</div>
								</div>
								<!-- /Invoice Item -->
								
								<!-- Invoice Item -->
								<div class="invoice-item invoice-table-wrap">
									<div class="row">
										<div class="col-md-12">
											<div class="table-responsive">
												<table class="invoice-table table table-bordered">
													<thead>
														<tr>
															<th>Doctor</th>
															<th class="text-center">Description</th>
															<!-- <th class="text-center">VAT</th> -->
															<th class="text-right">Total(Ksh.)</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><?php if($result->doc_id){
																		$doc_id = $result->doc_id;
																		$sql1 = "SELECT * from users where uid=:doc_id";
																		$query1 = $dbh -> prepare($sql1);
																		$query1-> bindParam(':doc_id', $doc_id, PDO::PARAM_STR);
																		$query1->execute();
																		$results1=$query1->fetchAll(PDO::FETCH_OBJ);
																		$cnt=1;
																		if($query->rowCount() > 0)
																			{
																			foreach($results1 as $result1)
																			{ 
																	 ?>
																	 <?php echo htmlentities($result1->firstname); ?>&nbsp;<?php echo htmlentities($result1->lastname); ?>&nbsp;
																	 <span class="badge badge-pill bg-success-light"><?php echo htmlentities($result1->category); ?></span>
																	 <?php }}} ?>
																	 </td>
															<td class="text-center"><?php echo htmlentities($result->appt_desc); ?></td>
															<!-- <td class="text-center">$0</td> -->
															<td class="text-right"><?php echo htmlentities($result->booking_amount); ?></td>
														</tr>
														
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-md-6 col-xl-4 ml-auto">
											<div class="table-responsive">
												<table class="invoice-table-two table">
													<tbody>
													<tr>
														<th>Subtotal:</th>
														<td><span><?php echo htmlentities($result->booking_amount); ?></span></td>
													</tr>
													<tr>
														<th>Paid Amount:</th>
														<td><span><?php echo htmlentities($result->paid_amount); ?></span></td>
													</tr>
													<tr>
														<th>Total Remaining:</th>
														<td><span><?php $booking_amount=$result->booking_amount;
														$paid_amount=$result->paid_amount;
														$total_amount=($booking_amount-$paid_amount);
														echo"$total_amount";
														 ?></span></td>
													</tr>
													<tr>
														<!-- <th>Paid Amount:</th> -->
														<td><span><?php if($result->paid_amount == 0){
															echo'<span class="badge badge-pill bg-danger-light">Not Paid</span>';
														} else if($result->paid_amount > 0 && $result->paid_amount < $result->booking_amount){
															echo'<span class="badge badge-pill bg-warning-light">Balance Remaing</span>';
														} else if($result->paid_amount == $result->booking_amount){
															echo'<span class="badge badge-pill bg-success-light">Paid</span>';
														} else if($result->paid_amount > $result->booking_amount){
															echo'<span class="badge badge-pill bg-primary-light">Excess</span>';
														}?></span></td>
													</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<!-- /Invoice Item -->
								
								<!-- Invoice Information -->
								<div class="other-info">
									<h4>Other information</h4>
									<p class="text-muted mb-0">For More Inquery call or text 0712345678</p>
									<div class="">
                                                <a onclick="window.print();return false;"><i class="fa fa-print"></i>Print</a>
											</div>
								</div>
								<!-- /Invoice Information -->
								
							</div>
						</div>
					</div>
					<?php }} ?>
				</div>

			</div>		
			<!-- /Page Content -->
   
			<!-- Footer -->
			<?php //include(INCLUDE_PATH . '/consts/footer.php') ?>
			<!-- /Footer -->
		   
		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

<!-- doccure/invoice-view.html  30 Nov 2019 04:12:20 GMT -->
</html>