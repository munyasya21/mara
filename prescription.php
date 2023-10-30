<?php 

// session_start();
include('config.php');
include('admin/account/config.php');
include(INCLUDE_PATH . '/logic/account_api.php'); 
error_reporting(0);

if(isset($_POST['submit']))
{
$medicine=$_POST['medicine'];
$m_desc=$_POST['m_desc'];
$p_id=$_POST['p_id'];
$d_id=$_POST['d_id'];
$appt_id=$_POST['appt_id'];
$sql="INSERT INTO  medicalrec(medicine, m_desc, p_id, d_id, appt_id) 
VALUES(:medicine, :m_desc, :p_id, :d_id, :appt_id)";
$query = $dbh->prepare($sql);
$query->bindParam(':medicine',$medicine,PDO::PARAM_STR);
$query->bindParam(':m_desc',$m_desc,PDO::PARAM_STR);
$query->bindParam(':p_id',$p_id,PDO::PARAM_STR);
$query->bindParam(':d_id',$d_id,PDO::PARAM_STR);
$query->bindParam(':appt_id',$appt_id,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Prescription Added successfully";
}
else
{
$error="Something went wrong. Please try again";
}
}
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
			<?php include(INCLUDE_PATH . '/consts/header.php') ?>
			<!-- /Header -->
			
			<!-- Breadcrumb -->
			<div style="" class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Prescriptions</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Prescriptions Overview</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
				<?php
											$bid =$_GET['pid'];
											$sql = "SELECT * from booking where bid=:bid";
											$query = $dbh->prepare($sql);
											$query->bindParam(':bid', $bid, PDO::PARAM_STR);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {	?>

					<div class="row">
					<?php if($error){?><div class="errorWrap" style="background-color: #fa2837; color: #ffffff; margin:10px; padding:10px;"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"  style="background-color: #2dcc70; color: #ffffff;margin:10px; padding:10px;"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
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
											<!-- <p class="invoice-details">
												<strong>Order:</strong> #INV-<?php echo htmlentities($result->bid); ?> <br>
												<strong>Issued:</strong> <?php echo htmlentities($result->date); ?>
											</p> -->
										</div>
									</div>
								</div>

								<div>
								<h3>Medical Prescription For?</h3>
								
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
													<thead>
														<tr>
															<th>Patient Name</th>
															<th class="text-center">Description</th>
															<!-- <th class="text-center">VAT</th> -->
															<th class="text-right">Total(Ksh.)</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><?php if($result->patient_id){
																		$patient_id = $result->patient_id;
																		$sql1 = "SELECT * from users where uid=:patient_id";
																		$query1 = $dbh -> prepare($sql1);
																		$query1-> bindParam(':patient_id', $patient_id, PDO::PARAM_STR);
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
															<td class="text-right"><?php echo htmlentities($result->paid_amount); ?>
															&nbsp;<span><?php if($result->paid_amount == 0){
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
								<!-- <div class="other-info">
									<h4>Other information</h4>
									<p class="text-muted mb-0">For More Inquery call or text 0712345678</p>
								</div> -->
								<!-- /Invoice Information -->

								<div class="card-body">
									<form method="post">
											<div class="form-group row">
												<label class="col-form-label col-md-2">Medicine</label>
												<div class="col-md-10">
													<input type="text" name="medicine" class="form-control" placeholder="name of medicine" required>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-form-label col-md-2">Description</label>
												<div class="col-md-10">
												<textarea rows="5" name="m_desc" cols="5" class="form-control" placeholder="Enter description"></textarea>
												</div>
											</div>
											<input type="text" name="p_id" class="form-control" value="<?php echo htmlentities($result->patient_id); ?>" placeholder="name of medicine" hidden required>
											<input type="text" name="d_id" class="form-control" value="<?php echo htmlentities($result->doc_id); ?>" placeholder="name of medicine" hidden required>
											<input type="text" name="appt_id" class="form-control" value="<?php echo htmlentities($result->bid); ?>" placeholder="name of medicine" hidden required>

											<div class="text-right">
												<a href="doctor-dashboard.php" class="btn btn-danger">Back</a>
                                                <button type="submit" name="submit" class="btn btn-primary">Add Prescription</button>
											</div>
                                            
									</form>
								</div>
							</div>
							
						</div>
						
					</div>
					<?php }} ?>
					
				</div>

			</div>		
			<!-- /Page Content -->
   
			<!-- Footer -->
			<?php include(INCLUDE_PATH . '/consts/footer.php') ?>
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