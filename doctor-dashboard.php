<?php 

// session_start();
include('config.php');
include('admin/account/config.php');
include(INCLUDE_PATH . '/logic/account_api.php'); 
error_reporting(0);

// authentication, checkng for required
if ($_SESSION['user'] == NULL) {

    header("location: " . BASE_URL . "login.php");

 } else if ($_SESSION['user'] != NULL) {

        $role = $_SESSION['user']['role_id'];
        
        if ($role != 2) {
            // header("location: " . BASE_URL . "admin/index.php");
            header("location: " . BASE_URL . "error-403.php");
        } 
 
}

if (isset($_GET['bconf'])) {
    $bid = $_GET['bconf'];
    $status = 2;
    $sql = "UPDATE booking SET status=:status where bid =:bid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':bid', $bid, PDO::PARAM_STR);
    $query->execute();

    $msg = "Appointment Approved";
    header('location: doctor-dashboard.php');
}

if (isset($_GET['bcncl'])) {
    $bid = $_GET['bcncl'];
    $status = 3;
    $sql = "UPDATE booking SET status=:status where bid =:bid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':bid', $bid, PDO::PARAM_STR);
    $query->execute();

    $msg = "Appointment Cancelled";
	header('location: doctor-dashboard.php');
}


if(isset($_GET['del']))
  {
  $mrid=$_GET['del'];
  $sql = "delete from medicalrec  WHERE mrid=:mrid";
  $query = $dbh->prepare($sql);
  $query -> bindParam(':mrid',$mrid, PDO::PARAM_STR);
  $query -> execute();
  $msg="Page data updated  successfully";
  header('location: doctor-dashboard.php');
  
  }

?>
<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/doctor-dashboard.html  30 Nov 2019 04:12:03 GMT -->
<head>
		<meta charset="utf-8">
		<title>MHC</title>
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
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
						<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
							
							<!-- Profile Sidebar -->
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
											<img class="avatar-img rounded-circle" src="admin/assets/img/profile/<?php echo htmlentities($result->profile_picture); ?>" alt="User Image">
										</a>
										<div class="profile-det-info">
											<h3><?php echo htmlentities($result->firstname); ?>&nbsp;<?php echo htmlentities($result->lastname); ?><br><span class="badge badge-success"><?php echo htmlentities($result->category); ?></span></h3>
											
											<div class="patient-details">
												<h5 class="mb-0"><?php echo htmlentities($result->description); ?></h5>
											</div>
										</div>
									</div>
								</div>
								<?php }}} ?>

								<div class="dashboard-widget">
									<nav class="dashboard-menu">
										<ul>
											<li class="active">
												<a href="doctor-dashboard.php">
													<i class="fas fa-columns"></i>
													<span>Dashboard</span>
												</a>
											</li>
											<!-- <li>
												<a href="appointments.php">
													<i class="fas fa-calendar-check"></i>
													<span>Appointments</span>
												</a>
											</li>
											<li>
												<a href="my-patients.php">
													<i class="fas fa-user-injured"></i>
													<span>My Patients</span>
												</a>
											</li>
											<li>
												<a href="schedule-timings.php">
													<i class="fas fa-hourglass-start"></i>
													<span>Schedule Timings</span>
												</a>
											</li>
											<li>
												<a href="invoices.php">
													<i class="fas fa-file-invoice"></i>
													<span>Invoices</span>
												</a>
											</li>
											<li>
												<a href="reviews.php">
													<i class="fas fa-star"></i>
													<span>Reviews</span>
												</a>
											</li>
											<li>
												<a href="chat-doctor.php">
													<i class="fas fa-comments"></i>
													<span>Message</span>
													<small class="unread-msg">23</small>
												</a>
											</li>
											<li>
												<a href="doctor-profile-settings.php">
													<i class="fas fa-user-cog"></i>
													<span>Profile Settings</span>
												</a>
											</li>
											<li>
												<a href="social-media.php">
													<i class="fas fa-share-alt"></i>
													<span>Social Media</span>
												</a>
											</li>
											<li>
												<a href="doctor-change-password.php">
													<i class="fas fa-lock"></i>
													<span>Change Password</span>
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
							<!-- /Profile Sidebar -->
							
						</div>
						
						<div class="col-md-7 col-lg-8 col-xl-9">

							<div class="row">
								<div class="col-md-12">
									<div class="card dash-card">
										<div class="card-body">
											<div class="row">
											<?php 
												$doc_id = $_SESSION['user']['uid'];
												$sql1 = "SELECT * from booking where doc_id=:doc_id ";
												$query1 = $dbh->prepare($sql1);
												$query1-> bindParam(':doc_id', $doc_id, PDO::PARAM_STR);
												$query1->execute();
												$results1 = $query1->fetchAll(PDO::FETCH_OBJ);
												$patients = $query1->rowCount();
												?>
												<div class="col-md-12 col-lg-4">
													<div class="dash-widget dct-border-rht">
														<div class="circle-bar circle-bar1">
															<div class="circle-graph1" data-percent="75">
																<img src="assets/img/icon-01.png" class="img-fluid" alt="patient">
															</div>
														</div>
														<div class="dash-widget-info">
															<h6>Total Patient</h6>
															<h3><?php echo htmlentities($patients); ?></h3>
															<p class="text-muted"> <script>
															document.write(new Date().getDate() + '/' + (new Date().getMonth()+1) +'/' + new Date().getFullYear())
															</script></p>
														</div>
													</div>
												</div>
												
										
												<div class="col-md-12 col-lg-4">
													<div class="dash-widget dct-border-rht">
														<div class="circle-bar circle-bar2">
															<div class="circle-graph2" data-percent="65">
																<img src="assets/img/icon-02.png" class="img-fluid" alt="Patient">
															</div>
														</div>
														<div class="dash-widget-info">
															<h6>Total Revenue</h6>
															<h3>Ksh.<?php
															$doc_id = $_SESSION['user']['uid'];
															$result = mysqli_query($conn, "SELECT SUM(paid_amount) AS value_sum FROM booking where doc_id = '$doc_id'"); 
															$row = mysqli_fetch_assoc($result); 
															$sum = $row['value_sum'];
															echo $sum;
															?></h3>
															<p class="text-muted"><script>
															document.write(new Date().getDate() + '/' + (new Date().getMonth()+1) +'/' + new Date().getFullYear())
															</script></p>
														</div>
													</div>
												</div>
												

												<?php 
												$doc_id = $_SESSION['user']['uid'];
												$sql2 = "SELECT * from booking where doc_id=:doc_id ";
												$query2 = $dbh->prepare($sql2);
												$query2-> bindParam(':doc_id', $doc_id, PDO::PARAM_STR);
												$query2->execute();
												$results2 = $query2->fetchAll(PDO::FETCH_OBJ);
												$appointments = $query2->rowCount();
												?>
												<div class="col-md-12 col-lg-4">
													<div class="dash-widget">
														<div class="circle-bar circle-bar3">
															<div class="circle-graph3" data-percent="50">
																<img src="assets/img/icon-03.png" class="img-fluid" alt="Patient">
															</div>
														</div>
														<div class="dash-widget-info">
															<h6>Total Appoinments</h6>
															<h3><?php echo htmlentities($appointments); ?></h3>
															<p class="text-muted"><script>
															document.write(new Date().getDate() + '/' + (new Date().getMonth()+1) +'/' + new Date().getFullYear())
															</script></p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<h4 class="mb-4">Patient Appoinment</h4>
									<div class="appointment-tab">
									
										<!-- Appointment Tab -->
										<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
											<li class="nav-item">
												<a class="nav-link active" href="#upcoming-appointments" data-toggle="tab">Appointments</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#today-appointments" data-toggle="tab">Medical Records</a>
											</li> 
										</ul>
										<!-- /Appointment Tab -->
										
										<div class="tab-content">
										
											<!-- Upcoming Appointment Tab -->
											<div class="tab-pane show active" id="upcoming-appointments">
												<div class="card card-table mb-0">
													<div class="card-body">
														<div class="table-responsive">
															<table class="table table-hover table-center mb-0">
																<thead>
																	<tr>
																		<th>Patient Name</th>
																		<th>Appt Date</th>
																		<th>Purpose</th>
																		<!-- <th>Type</th> -->
																		<th class="text-center">Paid Amount</th>
																		<th>Balance</th>
																		<th>Status</th>
																		<th>Action</th>
																	</tr>
																</thead>
																<tbody>
																<?php 
																
																	$doc_id = $_SESSION['user']['uid'];
																	$sql3 = "SELECT * from booking where doc_id=:doc_id ";
																	$query3 = $dbh->prepare($sql3);
																	$query3-> bindParam(':doc_id', $doc_id, PDO::PARAM_STR);
																	$query3->execute();
																	$results3=$query3->fetchAll(PDO::FETCH_OBJ);
																	$cnt=1;
																	if($query3->rowCount() > 0)
																		{
																			foreach($results3 as $result3)
																				{  ?>
																	<tr>
																		<td>
																		<?php if($result3->patient_id){
																		$patient_id = $result3->patient_id;
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
																		<td><?php echo htmlentities($result3->appt_date); ?><span class="d-block text-info"><?php echo htmlentities($result3->appt_time); ?></span></td>
																		<td><?php echo htmlentities($result3->appt_desc); ?></td>
																		<!-- <td>New Patient</td> -->
																		<td><?php echo htmlentities($result3->paid_amount); ?></td>
																		<td><?php $bal = ($result3->booking_amount - $result3->paid_amount); echo $bal ?></td>
																		<td><?php if($result3->status ==1 ){ echo'<span class="badge badge-pill bg-warning-light">Pending</span>'; }
																	 else if($result3->status ==2 ){ echo'<span class="badge badge-pill bg-success-light">Confirmed</span>'; } 
																	 else if($result3->status ==3 ){ echo'<span class="badge badge-pill bg-danger-light">Canceled</span>'; } ?></td>
																		<td class="text-right">
																			<div class="table-action">
																				<!-- <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
																					<i class="far fa-eye"></i> View
																				</a> -->
																				
																				<!-- <a href="javascript:void(0);" class="btn btn-sm bg-success-light">
																					<i class="fas fa-check"></i> Accept
																				</a>
																				<a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
																					<i class="fas fa-times"></i> Cancel
																				</a> -->
																				<a href="doctor-dashboard.php?bconf=<?php echo htmlentities($result3->bid); ?>" onclick="return confirm('Do you really want to Accept this Appointment?')" class="btn btn-sm bg-success-light">
																					Accept
																				</a>
																				<a href="doctor-dashboard.php?bcncl=<?php echo htmlentities($result3->bid); ?>" onclick="return confirm('Do you really want to Cancel this Appointment?')" class="btn btn-sm bg-danger-light">
																					Cancel
																				</a>
																				<?php $bal = ($result3->booking_amount - $result3->paid_amount); 
																					if ($bal == 0){
																				 ?>
																				<a href="prescription.php?pid=<?php echo htmlentities($result3->bid); ?>" class="btn btn-sm bg-warning-light">
																					Prescription
																				</a>
																				<?php }?>
																			</div>
																		</td>
																	</tr>
																	<?php } } ?>
																</tbody>
															</table>		
														</div>
													</div>
												</div>
											</div>
											<!-- /Upcoming Appointment Tab -->
									   
											<!-- Today Appointment Tab -->
											<div class="tab-pane" id="today-appointments">
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
																<tbody><?php
																    $d_id = $_SESSION['user']['uid'];
																	$sql5 = "SELECT * from medicalrec where d_id=:d_id ";
																	$query5 = $dbh->prepare($sql5);
																	$query5-> bindParam(':d_id', $d_id, PDO::PARAM_STR);
																	$query5->execute();
																	$results5=$query5->fetchAll(PDO::FETCH_OBJ);
																	$cnt=+1;
																	if($query5->rowCount() > 0)
																		{
																			foreach($results5 as $result5)
																				{  ?>
																	<tr>
																		<td>#MR-<?php echo htmlentities($result5->mrid );?></td>			
																		<td>
																		<?php if($result5->p_id){
																		$patient_id = $result5->p_id;
																		$sql6 = "SELECT * from users where uid=:patient_id";
																		$query6 = $dbh -> prepare($sql6);
																		$query6-> bindParam(':patient_id', $patient_id, PDO::PARAM_STR);
																		$query6->execute();
																		$results6=$query6->fetchAll(PDO::FETCH_OBJ);
																		$cnt=1;
																		if($query4->rowCount() > 0)
																			{
																			foreach($results6 as $result6)
																			{ 
																	 ?>
																		<h2 class="table-avatar">
																			<a href="javascript:void(0);" class="avatar avatar-sm mr-2">
																			<?php if($result6->profile_picture == null) { ?>
																				<img class="avatar-img rounded-circle" src="admin/assets/img/profile/No-image-available.png" alt="User Image">
																				<?php } else { ?>
																					<img class="avatar-img rounded-circle" src="admin/assets/img/profile/<?php echo htmlentities($result6->profile_picture); ?>" alt="User Image">
																					<?php } ?>
																			</a>
																			<a href="javascript:void(0);"><?php echo htmlentities($result6->firstname); ?>&nbsp;<?php echo htmlentities($result6->lastname); ?></a>
																		</h2>
																		<?php }}} ?>
																		</td>
																		<td>
																		<?php if($result5->appt_id){
																		$bid = $result5->appt_id;
																		$sql7 = "SELECT * from booking where bid=:bid";
																		$query7 = $dbh -> prepare($sql7);
																		$query7-> bindParam(':bid', $bid, PDO::PARAM_STR);
																		$query7->execute();
																		$results7=$query7->fetchAll(PDO::FETCH_OBJ);
																		$cnt=1;
																		if($query4->rowCount() > 0)
																			{
																			foreach($results7 as $result7)
																			{ 
																	 ?>
																		<?php echo htmlentities($result7->appt_date); ?><span class="d-block text-info"><?php echo htmlentities($result7->appt_time); ?></span>
																		<?php }}} ?>
																		</td>
																		<td><?php echo htmlentities($result7->appt_desc); ?></td>
																		<td><?php echo htmlentities($result5->medicine); ?></td>
																		<!-- <td><?php echo htmlentities($result5->m_desc); ?></td> -->
																		<td><?php echo htmlentities($result5->created_at); ?></td>
																		<td class="text-right">
																			<div class="table-action">
																				<a href="medical-record.php?mrid=<?php echo htmlentities($result5->mrid); ?>" class="btn btn-sm bg-info-light">
																					<i class="far fa-eye"></i> View
																				</a>
																				
																				<!-- <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
																					<i class="fas fa-bin"></i> Delete
																				</a> -->
																				<a class="btn btn-sm bg-danger-light" href = "doctor-dashboard.php?del=<?php echo htmlentities($result5->mrid);?>" onclick = "return confirm('Do you really want to Delete this Medical Record')"> <i class="fe fe-trash"></i> Delete</a>
																				<!-- <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
																					<i class="fas fa-times"></i> Cancel
																				</a> -->
																			</div>
																		</td>
																	</tr>
																	<?php } } ?>
																</tbody>
															</table>		
														</div>	
													</div>	
												</div>	
											</div>
											<!-- /Today Appointment Tab -->
											
										</div>
									</div>
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
		
		<!-- Circle Progress JS -->
		<script src="assets/js/circle-progress.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

<!-- doccure/doctor-dashboard.html  30 Nov 2019 04:12:09 GMT -->
</html>