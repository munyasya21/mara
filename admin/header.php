<!-- Header -->
<header class="header">
			<nav class="navbar navbar-expand-lg header-nav">
				<div class="navbar-header">
					<a id="mobile_btn" href="javascript:void(0);">
						<span class="bar-icon">
							<span></span>
							<span></span>
							<span></span>
						</span>
					</a>
					<a href="index.php" class="navbar-brand logo">
						<!-- <img src="assets/img/logo.png" class="img-fluid" alt="Logo"> -->
						<span style="font-weight:700; font-size:36px;" >MHC</span>
					</a>
				</div>
				<div class="main-menu-wrapper">
					<div class="menu-header">
						<a href="index.php" class="menu-logo">
							<!-- <img src="assets/img/logo.png" class="img-fluid" alt="Logo"> -->
						</a>
						<a id="menu_close" class="menu-close" href="javascript:void(0);">
							<i class="fas fa-times"></i>
						</a>
					</div>
					<?php if (isset($_SESSION['user']) == null) {
                    ?>
					<ul class="main-nav">
						<li class="active">
							<a href="index.php">Home</a>
						</li>
						
						<li>
							<a href="admin/index.php" target="_blank">Admin</a>
						</li>
						<!-- <li class="login-link">
							<a href="login.php">Login / Signup</a>
						</li> -->
					</ul>
				</div>
				<ul class="nav header-navbar-rht">
					<li class="nav-item contact-item">
						<div class="header-contact-img">
							<i class="far fa-hospital"></i>
						</div>
						<div class="header-contact-detail">
							<!-- <p class="contact-header">Contact</p> -->
							<p class="contact-info-header"> +254 712 345 678</p>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link header-login" href="login.php">login / Signup </a>
					</li>
				</ul>
				<?php } else { ?>
					<ul class="main-nav">
						<li class="active">
							<a href="index.php">Home</a>
						</li>
						<?php if($_SESSION['user'] != NULL) {
							$role_id = $_SESSION['user']['role_id'];
							//for doctors drop down
							if($role_id === 2){
						 	?>
						<li class="has-submenu">
						<a href="#">Doctors <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
									<li class="active"><a href="doctor-dashboard.php">Doctor Dashboard</a></li>
									<!-- <li><a href="appointments.php">Appointments</a></li>
									<li><a href="schedule-timings.php">Schedule Timing</a></li>
									<li><a href="my-patients.php">Patients List</a></li>
									<li><a href="patient-profile.php">Patients Profile</a></li>
									<li><a href="chat-doctor.php">Chat</a></li>
									<li><a href="invoices.php">Invoices</a></li>
									<li><a href="doctor-profile-settings.php">Profile Settings</a></li>
									<li><a href="reviews.php">Reviews</a></li>
									<li><a href="doctor-register.php">Doctor Register</a></li> -->
								</ul>
							</li>
							<?php } //for patients drop down
							 else if($role_id === 3){
						 	?>
						<li class="has-submenu">
								<a href="#">Patients <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
									<!-- <li><a href="search.php">Search Doctor</a></li> -->
									<!-- <li><a href="doctor-profile.php">Doctor Profile</a></li> -->
									<!-- <li><a href="booking.php">Booking</a></li>
									<li><a href="checkout.php">Checkout</a></li>
									<li><a href="booking-success.php">Booking Success</a></li> -->
									<li><a href="patient-dashboard.php">Patient Dashboard</a></li>
									<!-- <li><a href="favourites.php">Favourites</a></li>
									<li><a href="chat.php">Chat</a></li>
									<li><a href="profile-settings.php">Profile Settings</a></li>
									<li><a href="change-password.php">Change Password</a></li> -->
								</ul>
							</li>
							<?php }} ?>
					</ul>
				</div>
				<ul class="nav header-navbar-rht">
					<li class="nav-item contact-item">
						<div class="header-contact-img">
							<i class="far fa-user"></i>
						</div>
						<div class="header-contact-detail">
							<!-- <p class="contact-header">Contact</p> -->
							<?php  if ($_SESSION['user'] != NULL) {
								$firstname = $_SESSION['user']['firstname'];
								$lastname = $_SESSION['user']['lastname'];


								echo "<p style='font-size: 18px;' class='contact-info-header'>$firstname&nbsp;$lastname</p>";

								} ?>
							<!-- <p class="contact-info-header"> +254 712 345 678</p> -->
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link header-login" href="logout.php">logout </a>
					</li>
				</ul>
				<?php } ?>
			</nav>
		</header>
		<!-- /Header -->