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

		<!-- <style>
	body {visibility:hidden;}
.print {visibility:visible;}
		</style> -->

		<!-- <type="text/css" media="print" /> -->

<!-- <script type="text/javascript">  
    function PrintDiv() 
   {  
       var divContents = document.getElementById("printdivcontent").innerHTML;  
       var printWindow = window.open('', '', 'height=200,width=400');  
       printWindow.document.write('<html><head><title>Bethelex Health Care Services</title>');  
       printWindow.document.write('</head><body >');  
       printWindow.document.write(divContents);  
       printWindow.document.write('</body></html>');  
       printWindow.document.close();  
       printWindow.print();  
    }  
</script>  -->
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
			<?php //include(INCLUDE_PATH . '/consts/header.php') ?>
			<!-- /Header -->
			
			<!-- Breadcrumb -->
			<!-- <div style="" class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Medical Record</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Medical Record</h2>
						</div>
					</div>
				</div>
			</div> -->
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
				<?php
											$mrid =$_GET['mrid'];
											$sql = "SELECT * from medicalrec where mrid=:mrid";
											$query = $dbh->prepare($sql);
											$query->bindParam(':mrid', $mrid, PDO::PARAM_STR);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {	?>

					<div class="row">
					<?php if($error){?><div class="errorWrap" style="background-color: #fa2837; color: #ffffff; margin:10px; padding:10px;"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"  style="background-color: #2dcc70; color: #ffffff;margin:10px; padding:10px;"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
						<div id="printdivcontent" class="col-lg-8 offset-lg-2">
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
												<strong>Medical Report:</strong> #MR-<?php echo htmlentities($result->mrid); ?> <br>
												<strong>Issued:</strong> <?php echo htmlentities($result->created_at); ?>
											</p>
										</div>
									</div>
								</div>

								<div>
								<h4>Medical Record For</h4>
								</div>
								
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
													<!-- <thead>
														<tr>
															<th>Patient</th>
															<th class="text-center">Description</th>
															<th class="text-right">Total(Ksh.)</th>
														</tr>
													</thead> -->
													<tbody>
														<tr>
															<th>Name</th>
															<td><?php if($result->p_id){
																		$p_id = $result->p_id;
																		$sql1 = "SELECT * from users where uid=:p_id";
																		$query1 = $dbh -> prepare($sql1);
																		$query1-> bindParam(':p_id', $p_id, PDO::PARAM_STR);
																		$query1->execute();
																		$results1=$query1->fetchAll(PDO::FETCH_OBJ);
																		$cnt=1;
																		if($query1->rowCount() > 0)
																			{
																			foreach($results1 as $result1)
																			{ 
																	 ?>
																	 <?php echo htmlentities($result1->firstname); ?>&nbsp;<?php echo htmlentities($result1->lastname); ?>&nbsp;
																	 <span class="badge badge-pill bg-success-light"><?php echo htmlentities($result1->category); ?></span>
																	 <?php }}} ?>
																	 </td>
														</tr>
														<tr>
															<th>Purpose</th>
															<td>
															<?php if($result->appt_id);{
															$bid = $result->appt_id;
															$sql2 = "SELECT * from booking where bid=:bid";
																		$query2 = $dbh -> prepare($sql2);
																		$query2-> bindParam(':bid', $bid, PDO::PARAM_STR);
																		$query2->execute();
																		$results2=$query2->fetchAll(PDO::FETCH_OBJ);
																		$cnt=1;
																		if($query2->rowCount() > 0)
																			{
																			foreach($results2 as $result2)
																			{ 
															 ?>
															 <?php echo htmlentities($result2->appt_desc); ?>
															 <?php }}} ?>
															</td>
														</tr>
														<tr>
															<th>Appt Date</th>
															<td><?php echo htmlentities($result2->appt_date); ?>&nbsp;<span style="color: blue;"><?php echo htmlentities($result2->appt_time); ?></span></td>
														</tr>
														<tr>
															<th>Medicine</th>
															<td><?php echo htmlentities($result->medicine); ?></td>
														</tr>
														<tr>
															<th>Prescription</th>
															<td><?php echo htmlentities($result->m_desc); ?></td>
														</tr>
														<!-- <tr>
															<th>Medicine</th>
															<td>Doctors Information</td>
														</tr> -->
														<tr>
															<th>Doctors Name</th>
															<td><?php if($result->d_id){
																		$d_id = $result->d_id;
																		$sql3 = "SELECT * from users where uid=:d_id";
																		$query3 = $dbh -> prepare($sql3);
																		$query3-> bindParam(':d_id', $d_id, PDO::PARAM_STR);
																		$query3->execute();
																		$results3=$query3->fetchAll(PDO::FETCH_OBJ);
																		$cnt=1;
																		if($query3->rowCount() > 0)
																			{
																			foreach($results3 as $result3)
																			{ 
																	 ?>
																	 <?php echo htmlentities($result3->firstname); ?>&nbsp;<?php echo htmlentities($result3->lastname); ?>&nbsp;
																	 <span class="badge badge-pill bg-success-light"><?php echo htmlentities($result3->category); ?></span>
																	 <?php }}} ?>
																	 </td>
														</tr>
														<tr>
															<th>Doctor Email</th>
															<td><?php echo htmlentities($result3->email); ?></td>
														</tr>
														
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<!-- /Invoice Item -->
								<br> <br>
								<!-- Invoice Information -->
								<div class="other-info">
									<h4>Other information</h4>
									<p class="text-muted mb-0">For More Inquery call or text 0712345678</p>
								</div>
								<!-- /Invoice Information -->

								<!-- <div class="card-body">
									<form method="post">
											<div class="form-group row">
												<label class="col-form-label col-md-2">Amount</label>
												<div class="col-md-10">
													<input type="text" name="paid_amount" class="form-control" placeholder="Enter amount to pay" required>
												</div>
											</div>
											<div class="text-right">
												<a href="patient-dashboard.php" class="btn btn-danger">Cancle</a>
                                                <button type="submit" name="submit" class="btn btn-primary">Make Payment</button>
											</div>
                                            
									</form>
								</div> -->

											<div class="">
                                                <a onclick="window.print();return false;"><i class="fa fa-print"></i>Print</a>
											</div>
											
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