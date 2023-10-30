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
        <title>MHC - Transactions List Page</title>
		
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
								<h3 class="page-title">Transactions</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Transactions</li>
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
													<th>Invoice Number</th>
													<!-- <th>Patient ID</th> -->
													<th>Patient Name</th>
													<th>Total Paid</th>
													<th class="text-center">Status</th>
													<!-- <th class="text-right">Actions</th> -->
												</tr>
											</thead>
											<tbody>
											<?php 
																
												$sql = "SELECT * from booking Where paid_amount > 0";
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
													<td><a href="#">#INV-<?php echo htmlentities($result->bid); ?></td>
													<!-- <td>#PT001</td> -->
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
													<td><?php echo htmlentities($result->paid_amount); ?></td>
													<td class="text-center">
													<?php 
													if($result->paid_amount == $result->booking_amount){
														echo'<span class="badge badge-pill bg-success inv-badge">Complete</span>';
													} else if($result->paid_amount < $result->booking_amount){
														echo'<span class="badge badge-pill bg-warning inv-badge">Incomplete</span>';
													}
													 ?>
														</td>

													<!-- <td class="text-right">
														<div class="actions">
															<a class="btn btn-sm bg-danger-light" data-toggle="modal" href="#delete_modal">
																<i class="fe fe-trash"></i> Delete
															</a>
														</div>
													</td> -->
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