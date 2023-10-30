<?php 

// session_start();
include('config.php');
include('admin/account/config.php');
include(INCLUDE_PATH . '/logic/account_api.php'); 
error_reporting(0);

?>
<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/patient-dashboard.html  30 Nov 2019 04:12:16 GMT -->
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
			<div style="background-color: #09e5ab;" class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Dashboard</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
						
						<!-- Profile Sidebar -->
						<div class="col-md-5 col-lg-3 col-xl-2 theiaStickySidebar">
							<div class="profile-sidebar">
								<?php  if ($_SESSION['user'] != NULL) {
									$uid = $_SESSION['user']['uid'];
									$sql = "SELECT * from users where uid=:uid";
									$query = $dbh -> prepare($sql);
									$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
									$query->execute();
									$results=$query->fetchAll(PDO::FETCH_OBJ);
									$cnt=1;
										if($query->rowCount() > 0)
											{
												foreach($results as $result)
											{ 
									?>
								<div class="widget-profile pro-widget-content">
									<div class="profile-info-widget">
										<a href="#" class="booking-doc-img">
										<?php if($result->profile_picture == null) { ?>
																				<img class="avatar-img rounded-circle" src="admin/assets/img/profile/No-image-available.png" alt="User Image">
																				<?php } else { ?>
																					<img class="avatar-img rounded-circle" src="admin/assets/img/profile/<?php echo htmlentities($result->profile_picture); ?>" alt="User Image">
																					<?php } ?>
										</a>
										<div class="profile-det-info">
											<h3><?php echo htmlentities($result->firstname); ?>&nbsp;<?php echo htmlentities($result->lastname); ?></h3>
											<div class="patient-details">
												<h5><?php echo htmlentities($result->email); ?></h5>
												<!-- <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Newyork, USA</h5> -->
											</div>
										</div>
									</div>
								</div>
								<?php }}} ?>

								<div class="dashboard-widget">
									<nav class="dashboard-menu">
										<ul>
											<li class="active">
												<a href="patient-dashboard.php">
													<i class="fas fa-columns"></i>
													<span>Dashboard</span>
												</a>
											</li>
											
											<!-- <li>
												<a href="profile-settings.php">
													<i class="fas fa-user-cog"></i>
													<span>Profile Settings</span>
												</a>
											</li> -->
											
											<li>
												<a href="logout.php">
													<i class="fas fa-sign-out-alt"></i>
													<span>Logout</span>
												</a>
											</li>
										</ul>
									</nav>
								</div>

							</div>
						</div>
						<!-- / Profile Sidebar -->
						
						<div class="col-md-7 col-lg-8 col-xl-10">
							<div class="card">
								<div class="card-body pt-0">
								
									<!-- Tab Menu -->
									<nav class="user-tabs mb-4">
										<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
											<li class="nav-item">
												<a class="nav-link active" href="#pat_appointments" data-toggle="tab">Appointments</a>
											</li>
											
											
											<li class="nav-item">
												<a class="nav-link" href="#pat_billing" data-toggle="tab">Billing</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#pat_medical_records" data-toggle="tab"><span class="med-records">Medical Records</span></a>
											</li>
										</ul>
									</nav>
									<!-- /Tab Menu -->
									
									<!-- Tab Content -->
									<div class="tab-content pt-0">
										
										<!-- Appointment Tab -->
										<div id="pat_appointments" class="tab-pane fade show active">
											<div class="card card-table mb-0">
												<div class="card-body">
													<div class="table-responsive">
													
														<table class="table table-hover table-center mb-0">
															<thead>
																<tr>
																	<th>Doctor</th>
																	<th>Appt Date</th>
																	<th>Booking Date</th>
																	<th>Amount(Ksh.)</th>
																	<th>Description</th>
																	<th>Status</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody>
															<!-- code for fetching appointments depending on the patient on session -->
															<?php if(isset($_SESSION['user']) != null){
																$patient_id=$_SESSION['user']['uid'];
																$sql = "SELECT * from booking where patient_id=:patient_id";
																$query = $dbh -> prepare($sql);
																$query-> bindParam(':patient_id', $patient_id, PDO::PARAM_STR);
																$query->execute();
																$results=$query->fetchAll(PDO::FETCH_OBJ);
																$cnt=1;
																if($query->rowCount() > 0)
																{
																foreach($results as $result)
																{  ?>
																<tr>
																	<td>
																	<?php if($result->doc_id){
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
																		<h2 class="table-avatar">
																			<a href="javascript:void(0);" class="avatar avatar-sm mr-2">
																				<img class="avatar-img rounded-circle" src="admin/assets/img/profile/<?php echo htmlentities($result1->profile_picture); ?>" alt="User Image">
																			</a>
																			<a href="javascript:void(0);"><?php echo htmlentities($result1->firstname); ?>&nbsp;<?php echo htmlentities($result1->lastname); ?> <span><?php echo htmlentities($result1->category); ?></span></a>
																		</h2>
																		<?php }}} ?>
																	</td>
																	<td><?php echo htmlentities($result->appt_date); ?><span class="d-block text-info"><?php echo htmlentities($result->appt_time); ?></span></td>
																	<td><?php echo htmlentities($result->date); ?></td>
																	<td><?php echo htmlentities($result->booking_amount); ?></td>
																	<td><?php echo htmlentities($result->appt_desc); ?></td>
																	<td><?php if($result->status ==1 ){ echo'<span class="badge badge-pill bg-warning-light">Pending</span>'; }
																	 else if($result->status ==2 ){ echo'<span class="badge badge-pill bg-success-light">Confirmed</span>'; } 
																	 else if($result->status ==3 ){ echo'<span class="badge badge-pill bg-danger-light">Canceled</span>'; } ?></td>
																	<td class="text-right">
																		<div class="table-action">
																			<!-- <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																				<i class="fas fa-print"></i> Print
																			</a> -->
																			<a href="invoice-view.php?invoice=<?php echo htmlentities($result->bid); ?>" class="btn btn-sm bg-info-light">
																				 View Invoice
																			</a>
																			<?php if($result->paid_amount < $result->booking_amount ){ ?> <a href="pay.php?inv=<?php echo htmlentities($result->bid); ?>" class="btn btn-sm bg-success-light">
																				 Pay balance
																			</a> <?php } ?>
																		</div>
																	</td>
																</tr>
																<?php }} else{
																	
																	echo '<div style="padding:20px;" class="col-md-12 text-center">
																	<h3 style="color:#ddd;" >There is no data available at this moment</h3>
																  </div>';
																}}  ?>
															</tbody>

														</table>
													</div>
												</div>
											</div>
										</div>
										<!-- /Appointment Tab -->
										
										<!-- Prescription Tab -->
										
										<!-- /Prescription Tab -->
											
										
										
										<!-- Billing Tab -->
										<div id="pat_billing" class="tab-pane fade">
											<div class="card card-table mb-0">
												<div class="card-body">
													<div class="table-responsive">
														<table class="table table-hover table-center mb-0">
															<thead>
																<tr>
																	<th>Invoice No</th>
																	<!-- <th>Doctor</th> -->
																	<th>Amount(Ksh.)</th>
																	<th>Amount Paid(Ksh.)</th>
																	<th>Paid On</th>
																	<th>Balance(Ksh.)</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody>
															<?php if(isset($_SESSION['user']) != null){
																$patient_id=$_SESSION['user']['uid'];
																$sql2 = "SELECT * from booking where patient_id=:patient_id and paid_amount > 0";
																$query2 = $dbh -> prepare($sql2);
																$query2-> bindParam(':patient_id', $patient_id, PDO::PARAM_STR);
																$query2->execute();
																$results2=$query2->fetchAll(PDO::FETCH_OBJ);
																$cnt=1;
																if($query2->rowCount() > 0)
																{
																foreach($results2 as $result2)
																{  ?>
																<tr>
																	<td>
																		<a href="invoice-view.php?invoice=<?php echo htmlentities($result2->bid); ?>">#INV-<?php echo htmlentities($result2->bid); ?></a>
																	</td>
																
																	<td><?php echo htmlentities($result2->booking_amount); ?></td>
																	<td><?php echo htmlentities($result2->paid_amount); ?></td>
																	<td><?php echo htmlentities($result2->date); ?></td>
																	<td><?php $amount= $result2->booking_amount;
																	$paid = $result2->paid_amount;
																	$balance=($amount-$paid);
																	echo $balance;
																	 ?></td>
																	<td class="text-right">
																		<div class="table-action">
																			<a target="_blank" href="receipt-view.php?receipt=<?php echo htmlentities($result2->bid); ?>" class="btn btn-sm bg-info-light">
																				<i class="far fa-eye"></i> View Receipt
																			</a>
																			<!-- <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																				<i class="fas fa-print"></i> Print
																			</a> -->
																		</div>
																	</td>
																</tr>
																<?php }}else{
																	
																	echo '<div style="padding:20px;" class="col-md-12 text-center">
																	<h3 style="color:#ddd;" >There is no data available at this moment</h3>
																  </div>';
																}} ?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
										<!-- /Billing Tab -->

										<!-- Medical Records Tab -->
										<div id="pat_medical_records" class="tab-pane fade">
											<div class="card card-table mb-0">
												<div class="card-body">
													<div class="table-responsive">
													<table class="table table-hover table-center mb-0">
																<thead>
																	<tr>
																		<th>ID</th>
																		<th>Patient Name</th>
																		<th>Appt Date</th>
																		<th>Purpose</th>
																		<th>Medicine</th>
																		<!-- <th>Prescription</th> -->
																		<th>Date</th>
																		<th>View</th>
																	</tr>
																</thead>
																<tbody><?php if(isset($_SESSION['user']) != null){
																    $p_id = $_SESSION['user']['uid'];
																	$sql3 = "SELECT * from medicalrec where p_id=:p_id";
																	$query3 = $dbh->prepare($sql3);
																	$query3-> bindParam(':p_id', $p_id, PDO::PARAM_STR);
																	$query3->execute();
																	$results3=$query3->fetchAll(PDO::FETCH_OBJ);
																	$cnt=+1;
																	if($query3->rowCount() > 0)
																		{
																			foreach($results3 as $result3)
																				{  ?>
																	<tr>
																		<td>#MR-<?php echo htmlentities( $cnt );?></td>			
																		<td>
																		<?php if($result3->p_id){
																		$patient_id = $result3->p_id;
																		$sql4 = "SELECT * from users where uid=:patient_id";
																		$query4 = $dbh -> prepare($sql4);
																		$query4-> bindParam(':patient_id', $patient_id, PDO::PARAM_STR);
																		$query4->execute();
																		$results4=$query4->fetchAll(PDO::FETCH_OBJ);
																		$cnt=1;
																		if($query4->rowCount() > 0)
																			{
																			foreach($results4 as $result4)
																			{ 
																	 ?>
																		<h2 class="table-avatar">
																			<a href="javascript:void(0);" class="avatar avatar-sm mr-2">
																			<?php if($result4->profile_picture == null) { ?>
																				<img class="avatar-img rounded-circle" src="admin/assets/img/profile/No-image-available.png" alt="User Image">
																				<?php } else { ?>
																					<img class="avatar-img rounded-circle" src="admin/assets/img/profile/<?php echo htmlentities($result4->profile_picture); ?>" alt="User Image">
																					<?php } ?>
																			</a>
																			<a href="javascript:void(0);"><?php echo htmlentities($result4->firstname); ?>&nbsp;<?php echo htmlentities($result4->lastname); ?></a>
																		</h2>
																		<?php }}} ?>
																		</td>
																		<td>
																		<?php if($result3->appt_id){
																		$bid = $result3->appt_id;
																		$sql5 = "SELECT * from booking where bid=:bid";
																		$query5 = $dbh -> prepare($sql5);
																		$query5-> bindParam(':bid', $bid, PDO::PARAM_STR);
																		$query5->execute();
																		$results5=$query5->fetchAll(PDO::FETCH_OBJ);
																		$cnt=1;
																		if($query5->rowCount() > 0)
																			{
																			foreach($results5 as $result5)
																			{ 
																	 ?>
																		<?php echo htmlentities($result5->appt_date); ?><span class="d-block text-info"><?php echo htmlentities($result5->appt_time); ?></span>
																		<?php }}} ?>
																		</td>
																		<td><?php echo htmlentities($result5->appt_desc); ?></td>
																		<td><?php echo htmlentities($result3->medicine); ?></td>
																		<!-- <td><?php echo htmlentities($result3->m_desc); ?></td> -->
																		<td><?php echo htmlentities($result3->created_at); ?></td>
																		<td class="text-right">
																			<div class="table-action">
																				<a href="medical-record.php?mrid=<?php echo htmlentities($result3->mrid); ?>" class="btn btn-sm bg-info-light">
																					<i class="far fa-eye"></i> View
																				</a>
																				
																				<!-- <a href="javascript:void(0);" class="btn btn-sm bg-success-light">
																					<i class="fas fa-check"></i> Accept
																				</a>
																				<a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
																					<i class="fas fa-times"></i> Cancel
																				</a> -->
																			</div>
																		</td>
																	</tr>
																	<?php } } else{
																	
																	echo '<div style="padding:20px;" class="col-md-12 text-center">
																	<h3 style="color:#ddd;" >There is no data available at this moment</h3>
																  </div>';
																}} ?>
																</tbody>
															</table>		
													</div>
												</div>
											</div>
										</div>
										<!-- /Medical Records Tab -->
										
									</div>
									<!-- Tab Content -->
									
								</div>
							</div>
						</div>
					</div>

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
		
		<!-- Sticky Sidebar JS -->
        <script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
        <script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

<!-- doccure/patient-dashboard.html  30 Nov 2019 04:12:16 GMT -->
</html>