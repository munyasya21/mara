<?php 

// session_start();
include('config.php');
include('admin/account/config.php');
include(INCLUDE_PATH . '/logic/account_api.php'); 
error_reporting(0);

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Mara Health Care | Home</title>

	<!-- Favicons -->
	<!-- <link type="image/x-icon" href="assets/img/favicon.png" rel="icon"> -->

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

	<?php include(INCLUDE_PATH . '/consts/header.php') ?>

		<!-- Home Banner -->
		<section style="background-color: #09e5ab;" class="section section-search">
			<div class="container-fluid">
				<div class="banner-wrapper">
					<div class="banner-header text-center">
					<h2 style="color: #000000;">Welcome to <span style="font-weight:600;">MARA HEALTH CARE</span></h2><br>
						<h1 style="color: #ffffff;">Search Doctor, Make an Appointment</h1>
						<p style="color: #ffffff;">Discover the best doctors from our clinic & hospital nearest to you.</p>
					</div>

					<!-- Search -->
					<div class="search-box">
						<!-- <form action=""> -->
							<!-- <div class="form-group search-location">
								<input type="text" class="form-control" placeholder="Search Location">
								<span class="form-text">Based on your Location</span>
							</div> -->
							<!-- <div class="form-group search-info">
								<input type="text" class="form-control"
									placeholder="Search Doctors, Clinics, Hospitals, Diseases Etc">
								<span class="form-text">Ex : Dental or Sugar Check up etc</span>
							</div> -->
							<!-- <button type="submit" class="btn btn-primary search-btn"><i class="fas fa-search"></i>
								<span>Search</span></button> -->
						<!-- </form> -->
					</div>

					<div class="col-sm-12 text-center">
					<a href="" class="btn btn-lg btn-warning">Search Doctor</a>
					</div>
					<!-- /Search -->

				</div>
			</div>
		</section>
		<!-- /Home Banner -->

		<!-- Clinic and Specialities -->
		<section class="section section-specialities">
			<div class="container-fluid">
				<div class="section-header text-center">
					<h2 style="color: #09e5ab;">Clinic and Specialities</h2>
					<!-- <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
						incididunt ut labore et dolore magna aliqua.</p> -->
				</div>
				<div class="row justify-content-center">
					<div class="col-md-9">
						<!-- Slider -->
						<div class="specialities-slider slider">

							<!-- Slider Item -->
							<!-- <div class="speicality-item text-center">
								<div class="speicality-img">
									<img src="assets/img/specialities/specialities-01.png" class="img-fluid"
										alt="Speciality">
									<span><i class="fa fa-circle" aria-hidden="true"></i></span>
								</div>
								<p>Urology</p>
							</div> -->
							<!-- /Slider Item -->

							<!-- Slider Item -->
							<!-- <div class="speicality-item text-center">
								<div class="speicality-img">
									<img src="assets/img/specialities/specialities-02.png" class="img-fluid"
										alt="Speciality">
									<span><i class="fa fa-circle" aria-hidden="true"></i></span>
								</div>
								<p>Neurology</p>
							</div> -->
							<!-- /Slider Item -->

							<!-- Slider Item -->
							<div class="speicality-item text-center">
								<div class="speicality-img">
									<img src="assets/img/specialities/specialities-02.png" class="img-fluid"
										alt="Speciality">
									<span><i class="fa fa-circle" aria-hidden="true"></i></span>
								</div>
								<p>Counselling</p>
							</div>
							<!-- /Slider Item -->

							<!-- Slider Item -->
							<div class="speicality-item text-center">
								<div class="speicality-img">
									<img src="assets/img/specialities/specialities-03.png" class="img-fluid"
										alt="Speciality">
									<span><i class="fa fa-circle" aria-hidden="true"></i></span>
								</div>
								<p>General Practionier</p>
							</div>
							<!-- /Slider Item -->

							<!-- Slider Item -->
							<div class="speicality-item text-center">
								<div class="speicality-img">
									<img src="assets/img/specialities/specialities-05.png" class="img-fluid"
										alt="Speciality">
									<span><i class="fa fa-circle" aria-hidden="true"></i></span>
								</div>
								<p>Dentist</p>
							</div>
							<!-- /Slider Item -->

						</div>
						<!-- /Slider -->

					</div>
				</div>
			</div>
		</section>
		<!-- Clinic and Specialities -->

		<!-- Popular Section -->
		<section  class="section section-doctor">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-header ">
							<h2 style="color: #09e5ab;">Book Our Doctor</h2>
							<!-- <p>Lorem Ipsum is simply dummy text </p> -->
						</div>
						
					</div>
					<?php $sql = "SELECT * from users where role_id = 2";
									$query = $dbh->prepare($sql);
									$query->execute();
									$results = $query->fetchAll(PDO::FETCH_OBJ);
									$cnt = 1;
									if ($query->rowCount() > 0) {
									foreach ($results as $result) {
									?>
					<div class="col-sm-3">
					
						<div class="doctor-slider slider">
						
							<!-- Doctor Widget -->
							
								
							<div class="profile-widget">
						
								<div class="doc-img">
									<a href="doctor-profile.php?id=<?php echo htmlentities($result->uid); ?>">
										<img class="img-fluid" alt="User Image" src="admin/assets/img/profile/<?php echo htmlentities($result->profile_picture); ?>">
									</a>
									<a href="javascript:void(0)" class="fav-btn">
										<i class="far fa-bookmark"></i>
									</a>
								</div>
								<div class="pro-content">
									<h3 class="title">
										<a href="doctor-profile.php?id=<?php echo htmlentities($result->uid); ?>"><?php echo htmlentities($result->firstname); ?>&nbsp;<?php echo htmlentities($result->lastname); ?></a>
										<i class="fas fa-check-circle verified"></i>
									</h3>
									<p class="speciality"><?php echo htmlentities($result->description); ?></p>
									<div class="rating">
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<span class="d-inline-block average-rating"></span>
									</div>
									<ul class="available-info">
										<!-- <li>
											<i class="fas fa-map-marker-alt"></i> Florida, USA
										</li>
										<li>
											<i class="far fa-clock"></i> Available on Fri, 22 Mar
										</li> -->
										<li>
											<i class="far fa-money-bill-alt"></i>Ksh.<?php echo htmlentities($result->price); ?>
											<i class="fas fa-info-circle" data-toggle="tooltip" title="Price"></i>
										</li>
									</ul>
									<div class="row row-sm">
										<!-- <div class="col-6">
											<a href="doctor-profile.php" class="btn view-btn">View Profile</a>
										</div> -->
										<div class="col-12">
											<a href="doctor-profile.php?id=<?php echo htmlentities($result->uid); ?>" class="btn book-btn">View/Book Now</a>
										</div>
									</div>
								</div>
							</div>
							
							<!-- /Doctor Widget -->

						</div>
						
					</div>
					<?php }} ?>
				</div>
			</div>
		</section>
		<!-- /Popular Section -->

		<!-- Availabe Features -->
		<section class="section section-features">
			<div class="container-fluid">
				<div class="row">

					<div class="col-md-7">
						<div class="section-header">
							<h2 style="color: #09e5ab;" class="mt-2">Cooming soon in Our Clinic</h2>
							<!-- <p>It is a long established fact that a reader will be distracted by the readable content of
								a page when looking at its layout. </p> -->
						</div>
						<div class="features-slider slider">
							<!-- Slider Item -->
							<div class="feature-item text-center">
								<img src="assets/img/features/feature-01.jpg" class="img-fluid" alt="Feature">
								<p>Patient Ward</p>
							</div>
							<!-- /Slider Item -->

							<!-- Slider Item -->
							<div class="feature-item text-center">
								<img src="assets/img/features/feature-02.jpg" class="img-fluid" alt="Feature">
								<p>Test Room</p>
							</div>
							<!-- /Slider Item -->

							<!-- Slider Item -->
							<div class="feature-item text-center">
								<img src="assets/img/features/feature-03.jpg" class="img-fluid" alt="Feature">
								<p>ICU</p>
							</div>
							<!-- /Slider Item -->

							<!-- Slider Item -->
							<div class="feature-item text-center">
								<img src="assets/img/features/feature-04.jpg" class="img-fluid" alt="Feature">
								<p>Laboratory</p>
							</div>
							<!-- /Slider Item -->

							<!-- Slider Item -->
							<div class="feature-item text-center">
								<img src="assets/img/features/feature-05.jpg" class="img-fluid" alt="Feature">
								<p>Operation</p>
							</div>
							<!-- /Slider Item -->

							<!-- Slider Item -->
							<div class="feature-item text-center">
								<img src="assets/img/features/feature-06.jpg" class="img-fluid" alt="Feature">
								<p>Medical</p>
							</div>
							<!-- /Slider Item -->
						</div>
					</div>
					<div class="col-md-5 features-img">
						<img src="assets/img/features/feature.png" class="img-fluid" alt="Feature">
					</div>
				</div>
			</div>
		</section>
		<!-- Availabe Features -->

		<?php include(INCLUDE_PATH . '/consts/footer.php') ?>
		

	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->
	<script src="assets/js/jquery.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- Slick JS -->
	<script src="assets/js/slick.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/script.js"></script>

</body>

<!-- doccure/index.html  30 Nov 2019 04:12:03 GMT -->

</html>