<?php 

// session_start();
include('../config.php');
include('account/config.php');
include('account/middleware.php');
include(INCLUDE_PATH . '/logic/account_api.php'); 
error_reporting(0);


if(isset($_GET['del']))
  {
  $id=$_GET['del'];
  $sql = "delete from specialities  WHERE id=:id";
  $query = $dbh->prepare($sql);
  $query -> bindParam(':id',$id, PDO::PARAM_STR);
  $query -> execute();
  $msg="Page data updated  successfully";
  
  }

?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/doctor-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:51 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>BHCS - Specialities List Page</title>
		
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
								<h3 class="page-title">List of Specialities</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item"><a href="javascript:(0);">Specialities</a></li>
									<li class="breadcrumb-item active">Specialities</li>
								</ul>
								<a style="float:right;" class="btn btn-success" href="speciality-add.php">Add Speciality</a>
								<?php if($error){?><div class="errorWrap" style="background-color: #fa2837; color: #ffffff; margin:10px; padding:10px;"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"  style="background-color: #2dcc70; color: #ffffff;margin:10px; padding:10px;"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
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
												    <th>#</th>
													<th>Specialities</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											<?php $sql = 'SELECT * from specialities where id is not NULL';
												$query = $dbh -> prepare( $sql );
												$query->execute();
												$results = $query->fetchAll( PDO::FETCH_OBJ );
												$cnt = +1;
												if ( $query->rowCount() > 0 )
													{
													foreach ( $results as $result )
													{
													?>
												 <tr>
													 <td><?php echo htmlentities( $cnt );?></td>
													<td>
														<h2 class="table-avatar">
															<!-- <a href="profile.php?edit=<?php echo htmlentities($result->id);?>" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-10.jpg" alt="User Image"></a> -->
															<?php echo htmlentities( $result->name ); ?>
														</h2>
													</td>
													
													<td><a class="btn btn-sm bg-success-light" href = "speciality-edit.php?edit=<?php echo htmlentities($result->id);?>"> <i class="fe fe-pencil"></i> Edit</a>

                    <a class="btn btn-sm bg-danger-light" href = "specialities.php?del=<?php echo htmlentities($result->id);?>" onclick = "return confirm('Do you really want to Delete this speciality')"> <i class="fe fe-trash"></i> Delete</a>
                    </td>
												</tr> 
												<?php $cnt = $cnt + 1;
												}
											} ?>
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

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/doctor-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:51 GMT -->
</html>