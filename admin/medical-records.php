<?php 

// session_start();
include('../config.php');
include('account/config.php');
include('account/middleware.php');
include(INCLUDE_PATH . '/logic/account_api.php'); 
error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/transactions-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:52 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>MHC - Medical Records</title>
		
		<!-- Favicon -->
        <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png"> -->
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
				<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
		
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
								<h3 class="page-title">Medical Records</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Medical Records</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table class="datatable table table-hover table-center mb-0">
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
											<tbody>
												<?php 
													// $p_id = $_SESSION['user']['uid'];
													$sql3 = "SELECT * from medicalrec";
													$query3 = $dbh->prepare($sql3);
													// $query3-> bindParam(':p_id', $p_id, PDO::PARAM_STR);
													$query3->execute();
													$results3=$query3->fetchAll(PDO::FETCH_OBJ);
													$cnt=+1;
													if($query3->rowCount() > 0)
														{
															foreach($results3 as $result3)
																{  ?>				  
																	
													<tr>
															<td>#MR-<?php echo htmlentities($result3->mrid); ?></td>			
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
																				<img class="avatar-img rounded-circle" src="assets/img/profile/No-image-available.png" alt="User Image">
																				<?php } else { ?>
																					<img class="avatar-img rounded-circle" src="assets/img/profile/<?php echo htmlentities($result4->profile_picture); ?>" alt="User Image">
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
																				<a href="../medical-record.php?mrid=<?php echo htmlentities($result3->mrid); ?>" class="btn btn-sm bg-info-light">
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
												<?php }} ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>			
					</div>
				</div>			
			</div>
			<!-- /Page Wrapper -->
		
		<!-- Delete Modal -->
			<div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
					<!--	<div class="modal-header">
							<h5 class="modal-title">Delete</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>-->
						<div class="modal-body">
							<div class="form-content p-2">
								<h4 class="modal-title">Delete</h4>
								<p class="mb-4">Are you sure want to delete?</p>
								<button type="button" class="btn btn-primary">Save </button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Delete Modal -->
		
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

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/transactions-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:53 GMT -->
</html>