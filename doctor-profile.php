<?php 

// session_start();
include('config.php');
include('admin/account/config.php');
include(INCLUDE_PATH . '/logic/account_api.php'); 
error_reporting(0);

if(isset($_POST['btn_booking']))
{
$status = 1;	
$paid_amount= 0;
$appt_date=$_POST['appt_date'];
$appt_time=$_POST['appt_time'];
$doc_id=$_POST['doc_id'];
$patient_id=$_POST['patient_id'];
$patient_fname=$_POST['patient_fname'];
$patient_lname=$_POST['patient_lname'];
$patient_phone=$_POST['patient_phone'];
$patient_email=$_POST['patient_email'];
$booking_amount=$_POST['booking_amount'];
$appt_desc=$_POST['appt_desc'];
$sql="INSERT INTO  booking(appt_date, status, paid_amount, appt_time, doc_id, patient_id, booking_amount, patient_fname,patient_lname, patient_phone, patient_email, appt_desc) 
VALUES(:appt_date, :status, :paid_amount, :appt_time, :doc_id, :patient_id, :booking_amount, :patient_fname, :patient_lname, :patient_phone, :patient_email, :appt_desc)";
$query = $dbh->prepare($sql);
$query->bindParam(':appt_date',$appt_date,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':paid_amount',$paid_amount,PDO::PARAM_STR);
$query->bindParam(':appt_time',$appt_time,PDO::PARAM_STR);
$query->bindParam(':doc_id',$doc_id,PDO::PARAM_STR);
$query->bindParam(':patient_id',$patient_id,PDO::PARAM_STR);
$query->bindParam(':patient_fname',$patient_fname,PDO::PARAM_STR);
$query->bindParam(':patient_lname',$patient_lname,PDO::PARAM_STR);
$query->bindParam(':patient_phone',$patient_phone,PDO::PARAM_STR);
$query->bindParam(':patient_email',$patient_email,PDO::PARAM_STR);
$query->bindParam(':booking_amount',$booking_amount,PDO::PARAM_STR);
$query->bindParam(':appt_desc',$appt_desc,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Booking successful";
}
else
{
$error="Something went wrong. Please try again";
}

}


?>
<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/doctor-profile.html  30 Nov 2019 04:12:16 GMT -->
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
		
		<!-- Fancybox CSS -->
		<link rel="stylesheet" href="assets/plugins/fancybox/jquery.fancybox.min.css">
		
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
		
		<?php include(INCLUDE_PATH . '/consts/header.php') ?>
			
			<!-- Breadcrumb -->
			<div style="background-color: #09e5ab;" class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Doctor Profile</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Doctor Profile</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container">

				<div class="mt-4 mb-4"><?php if($error){?><div class="errorWrap" style="background-color: #fa2837; color: #ffffff; margin:10px; padding:10px;"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"  style="background-color: #2dcc70; color: #ffffff;margin:10px; padding:10px;"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?></div>

					<!-- Doctor Widget -->
					<div class="card">
						<div class="card-body">
										<?php
											$uid =$_GET['id'];
											$sql = "SELECT * from users where uid=:uid";
											$query = $dbh->prepare($sql);
											$query->bindParam(':uid', $uid, PDO::PARAM_STR);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {	?>
							<div class="doctor-widget">
								<div class="doc-info-left">
									<div class="doctor-img">
										<img src="admin/assets/img/profile/<?php echo htmlentities($result->profile_picture); ?>" class="img-fluid" alt="User Image">
									</div>
									<div class="doc-info-cont">
										<h4 class="doc-name"><?php echo htmlentities($result->firstname); ?>&nbsp;<?php echo htmlentities($result->lastname); ?></h4>
										<p class="doc-speciality"><?php echo htmlentities($result->description); ?></p>
										<p class="doc-department"><?php echo htmlentities($result->category); ?></p>
										<div class="rating">
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star"></i>
											<!-- <span class="d-inline-block average-rating">(35)</span> -->
										</div>
									</div>
								</div>
								<div class="doc-info-right">
									<div class="clini-infos">
										<ul>
											<li><i class="far fa-thumbs-up"></i> 99%</li>
											<li><i class="far fa-money-bill-alt"></i>Ksh.<?php echo htmlentities($result->price); ?> </li>
										</ul>
									</div>
									<!-- <div class="clinic-booking">
										<a class="apt-btn" href="booking.php">Book Appointment</a>
									</div> -->
								</div>
							</div>
						</div>
					</div>
					<!-- /Doctor Widget -->
					
					<!-- Doctor Details Tab -->
					<div class="card">
						<div class="card-body pt-0">
							<div class="row">
								<div class="col-sm-12">
									<h1 class="text-center mt-4 mb-4">Business Hours</h1>
								</div>
								<div class="col-sm-12">
									<!-- <div class="day">Monday</div>
									<div class="time-items">
									<span class="time">07:00 AM - 09:00 PM</span>
									</div> -->

									<div class="table-responsive">
										<table class="table table-center mb-0">
											<thead >
												<tr>
													<th>Monday</th>
													<th>Tuesday</th>
													<th>Wednesday</th>
													<th>Thursday</th>
													<th>Friday</th>
													<th>Saturday</th>
													<th>Sunday</th>
												</tr>
											</thead>
											<tbody >
												<tr>
													<td><?php echo htmlentities($result->monday); ?></td>
													<td><?php echo htmlentities($result->tuesday); ?></td>
													<td><?php echo htmlentities($result->wednesday); ?></td>
													<td><?php echo htmlentities($result->thursday); ?></td>
													<td><?php echo htmlentities($result->friday); ?></td>
													<td><?php echo htmlentities($result->saturday); ?></td>
													<td><?php echo htmlentities($result->sunday); ?></td>
												</tr>
											</tbody>
										</table>
									</div>
									
								</div>
								<?php }} ?>

								<?php if (isset($_SESSION['user']) == null) {
                    			?>

								<div class="col-sm-12 mt-5">
									<div class="clinic-booking">
										<a class="apt-btn" href="login.php">Login to Book Appointment</a>
									</div>
								</div>
								<?php } else { 
									if (isset($_SESSION['user']) != null) {
										
										$patient_id = $_SESSION['user']['uid'];
										$patient_fname = $_SESSION['user']['firstname'];
										$patient_lname = $_SESSION['user']['lastname'];
										$patient_phone = $_SESSION['user']['phone'];
										$patient_email = $_SESSION['user']['email'];
										?>
									
								<div class="col-sm-12 mt-5">
									<div class="clinic-booking">
									
									<h5 class="mt-4 mb-4">Enter booking details in the form below</h5>
									<?php
											$uid =$_GET['id'];
											$sql2 = "SELECT * from users where uid=:uid";
											$query2 = $dbh->prepare($sql2);
											$query2->bindParam(':uid', $uid, PDO::PARAM_STR);
											$query2->execute();
											$results1 = $query2->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results1 as $result) {	?>
										<form method="post" action="">
											<div class="form-group col-sm-3">
												<label for="">Choose Appointment Date</label>
												<input type="date" class="form-control" name="appt_date" placeholder="Enter date" reqiured>
											</div>
											<div class="form-group col-sm-3">
												<label for="">Choose Time</label>
												<input type="time" class="form-control" name="appt_time" placeholder="Enter time" reqiured>
											</div>
											<div class="form-group col-sm-3">
												<label for="">Description</label>
												<textarea class="form-control" placeholder="Type something..." name="appt_desc" rows="3" required></textarea>
											</div>
											<div class="form-group col-sm-3">
												<!-- <label for="">Enter Doctor UID</label> -->
												<input type="text" class="form-control" name="doc_id" value="<?php echo htmlentities($result->uid); ?>" placeholder="Enter First Name" hidden reqiured>
											</div>
											<div class="form-group col-sm-3">
												<!-- <label for="">Enter patient First Name</label> -->
												<input type="text" class="form-control" name="patient_id" value="<?php echo htmlentities($patient_id); ?>" placeholder="Enter First Name" hidden reqiured>
											</div>
											<div class="form-group col-sm-3">
												<!-- <label for="">Enter patient First Name</label> -->
												<input type="text" class="form-control" name="patient_fname" value="<?php echo htmlentities($patient_fname); ?>" placeholder="Enter First Name" hidden reqiured>
											</div>
											<div class="form-group col-sm-3">
												<!-- <label for="">Enter patient First Name</label> -->
												<input type="text" class="form-control" name="patient_lname" value="<?php echo htmlentities($patient_lname); ?>" placeholder="Enter First Name" hidden reqiured>
											</div>
											<div class="form-group col-sm-3">
												<!-- <label for="">Enter patient First Name</label> -->
												<input type="text" class="form-control" name="patient_phone" value="<?php echo htmlentities($patient_phone); ?>" placeholder="Enter First Name" hidden reqiured>
											</div>
											<div class="form-group col-sm-3">
												<!-- <label for="">Enter patient First Name</label> -->
												<input type="text" class="form-control" name="patient_email" value="<?php echo htmlentities($patient_email); ?>" placeholder="Enter First Name" hidden reqiured>
											</div>
											<div class="form-group col-sm-3">
												<!-- <label for="">Booking amount</label> -->
												<input type="text" class="form-control" name="booking_amount" value="<?php echo htmlentities($result->price); ?>" placeholder="Enter First Name" hidden reqiured>
											</div>
											
											<button name="btn_booking" class="btn btn-primary">Book Appointment</button>
										</form>
										<?php }} ?>
									</div>
								</div>

								<?php }} ?>
							</div>
							<!-- /row -->

						</div>
					</div>
					<!-- /Doctor Details Tab -->

					

				</div>
			</div>		
			<!-- /Page Content -->
   
			<!-- Footer -->
			<?php include(INCLUDE_PATH . '/consts/footer.php') ?>
			<!-- /Footer -->
		   
		</div>
		<!-- /Main Wrapper -->
		
		<!-- Voice Call Modal -->
		<div class="modal fade call-modal" id="voice_call">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<!-- Outgoing Call -->
						<div class="call-box incoming-box">
							<div class="call-wrapper">
								<div class="call-inner">
									<div class="call-user">
										<img alt="User Image" src="assets/img/doctors/doctor-thumb-02.jpg" class="call-avatar">
										<h4>Dr. Darren Elder</h4>
										<span>Connecting...</span>
									</div>							
									<div class="call-items">
										<a href="javascript:void(0);" class="btn call-item call-end" data-dismiss="modal" aria-label="Close"><i class="material-icons">call_end</i></a>
										<a href="voice-call.html" class="btn call-item call-start"><i class="material-icons">call</i></a>
									</div>
								</div>
							</div>
						</div>
						<!-- Outgoing Call -->

					</div>
				</div>
			</div>
		</div>
		<!-- /Voice Call Modal -->
		
		<!-- Video Call Modal -->
		<div class="modal fade call-modal" id="video_call">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">
					
						<!-- Incoming Call -->
						<div class="call-box incoming-box">
							<div class="call-wrapper">
								<div class="call-inner">
									<div class="call-user">
										<img class="call-avatar" src="assets/img/doctors/doctor-thumb-02.jpg" alt="User Image">
										<h4>Dr. Darren Elder</h4>
										<span>Calling ...</span>
									</div>							
									<div class="call-items">
										<a href="javascript:void(0);" class="btn call-item call-end" data-dismiss="modal" aria-label="Close"><i class="material-icons">call_end</i></a>
										<a href="video-call.html" class="btn call-item call-start"><i class="material-icons">videocam</i></a>
									</div>
								</div>
							</div>
						</div>
						<!-- /Incoming Call -->
						
					</div>
				</div>
			</div>
		</div>
		<!-- Video Call Modal -->
		
		<!-- jQuery -->
		<script src="assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Fancybox JS -->
		<script src="assets/plugins/fancybox/jquery.fancybox.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

<!-- doccure/doctor-profile.html  30 Nov 2019 04:12:16 GMT -->
</html>