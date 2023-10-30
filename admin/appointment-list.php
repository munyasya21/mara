<?php 

// session_start();
include('../config.php');
include('account/config.php');
include('account/middleware.php');
include(INCLUDE_PATH . '/logic/account_api.php'); 
error_reporting(0);

if (isset($_GET['bconf'])) {
    $bid = $_GET['bconf'];
    $status = 2;
    $sql = "UPDATE booking SET status=:status where bid =:bid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':bid', $bid, PDO::PARAM_STR);
    $query->execute();

    $msg = "Appointment Approved";
    header('location: appointment-list.php');
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
	header('location: appointment-list.php');
}

?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/appointment-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:46 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>BHCS - Appointment List Page</title>
		
		<!-- Favicon -->
        <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png"> -->
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="assets/css/feathericon.min.css">
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            
			<!-- /Header -->
			
			<!-- Sidebar -->
            
			<!-- /Sidebar -->
			<?php include('const/header.php') ;
			  include('const/sidenav.php') ;
		?>
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Appointments</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Appointments</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="row">
						<div class="col-md-12">

						<?php if($error){?><div class="errorWrap" style="background-color: #fa2837; color: #ffffff; margin:10px; padding:10px;"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"  style="background-color: #2dcc70; color: #ffffff;margin:10px; padding:10px;"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
						
							<!-- Recent Orders -->
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table class="datatable table table-hover table-center mb-0">
											<thead>
												<tr>
													<th>Doctor Name</th>
													<!-- <th>Speciality</th> -->
													<th>Patient Name</th>
													<th>Apointment Time</th>
													<th>Description</th>
													<th>Amount</th>
													<th>Amount paid</th>
													<th>Balance</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											<?php 
																
												$sql = "SELECT * from booking";
												$query = $dbh -> prepare($sql);
												// $query-> bindParam(':patient_id', $patient_id, PDO::PARAM_STR);
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
																				<img class="avatar-img rounded-circle" src="assets/img/profile/<?php echo htmlentities($result1->profile_picture); ?>" alt="User Image">
																			</a>
																			<a href="javascript:void(0);"><?php echo htmlentities($result1->firstname); ?>&nbsp;<?php echo htmlentities($result1->lastname); ?> <span><?php echo htmlentities($result1->category); ?></span></a>
																		</h2>
																		<?php }}} ?>
													</td>
													<!-- <td>Dental</td> -->
													<td>
													<?php if($result->patient_id){
																		$patient_id = $result->patient_id;
																		$sql2 = "SELECT * from users where uid=:patient_id";
																		$query2 = $dbh -> prepare($sql2);
																		$query2-> bindParam(':patient_id', $patient_id, PDO::PARAM_STR);
																		$query2->execute();
																		$results2=$query2->fetchAll(PDO::FETCH_OBJ);
																		$cnt=1;
																		if($query2->rowCount() > 0)
																			{
																			foreach($results2 as $result2)
																			{ 
																	 ?>
																		<h2 class="table-avatar">
																			<a href="javascript:void(0);" class="avatar avatar-sm mr-2">
																			<?php if($result2->profile_picture == null) { ?>
																				<img class="avatar-img rounded-circle" src="assets/img/profile/No-image-available.png" alt="User Image">
																				<?php } else { ?>
																					<img class="avatar-img rounded-circle" src="assets/img/profile/<?php echo htmlentities($result1->profile_picture); ?>" alt="User Image">
																					<?php } ?>
																			</a>
																			<a href="javascript:void(0);"><?php echo htmlentities($result2->firstname); ?>&nbsp;<?php echo htmlentities($result2->lastname); ?></a>
																		</h2>
																		<?php }}} ?>
													</td>
													<td><?php echo htmlentities($result->appt_date); ?><span class="d-block text-info"><?php echo htmlentities($result->appt_time); ?></span></td>
													<td><?php echo htmlentities($result->appt_desc); ?></td>
													<td><?php echo htmlentities($result->booking_amount); ?></td>
													<td><?php echo htmlentities($result->paid_amount); ?></td>
													<td><?php $bal = ($result->booking_amount - $result->paid_amount); echo $bal ?></td>
													<td><?php if($result->status ==1 ){ echo'<span class="badge badge-pill bg-warning-light">Pending</span>'; }
																	 else if($result->status ==2 ){ echo'<span class="badge badge-pill bg-success-light">Confirmed</span>'; } 
																	 else if($result->status ==3 ){ echo'<span class="badge badge-pill bg-danger-light">Canceled</span>'; } ?></td>
													<td class="text-right">
														<div class="table-action">
																			<!-- <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																				<i class="fas fa-print"></i> Print
																			</a> -->
															<a href="appointment-list.php?bconf=<?php echo htmlentities($result->bid); ?>" onclick="return confirm('Do you really want to Confirm this Appointment?')" class="btn btn-sm bg-success-light">
																 Confirm
															</a>
															<a href="appointment-list.php?bcncl=<?php echo htmlentities($result->bid); ?>" onclick="return confirm('Do you really want to Cancel this Appointment?')" class="btn btn-sm bg-danger-light">
																 Cancel
															</a>
															
														</div>
													</td> 
																	 
												</tr>
												<?php } } ?>
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- /Recent Orders -->
							
						</div>
					</div>
				</div>			
			</div>
			<!-- /Page Wrapper -->
		
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
        <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		
		<!-- Datatables JS -->
		<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/datatables/datatables.min.js"></script>
		
		<!-- Custom JS -->
		<script  src="assets/js/script.js"></script>
		
    </body>

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/appointment-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:49 GMT -->
</html>