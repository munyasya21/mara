<?php 
// session_start();
include('config.php');
include('admin/account/config.php');
include(INCLUDE_PATH . '/logic/account_api.php'); 

error_reporting(0);
?>


<!DOCTYPE html>
<html lang="en">

<!-- doccure/register.html  30 Nov 2019 04:12:20 GMT -->

<head>
	<meta charset="utf-8">
	<title>Clinical Appointment System | Register</title>
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

<body class="account-page">

	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->

		<!-- /Header -->

		<!-- Page Content -->
		<div class="content">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-8 offset-md-2">

						<!-- Register Content -->
						<div class="account-content">
							<div class="row align-items-center justify-content-center">
								<div class="col-md-7 col-lg-12">
									<h1 style="text-align: center; font-weight: 600; margin-bottom: 60px; color: #09e5ab;">Bethelex Clinical Appointment <br> and <br> Record Keeping System</h1>
								</div>
								<!-- <div class="col-md-7 col-lg-6 login-left"> -->
									<!-- <h1 style="text-align: center; font-weight: 600; margin-bottom: 60px; color: #09e5ab;">Clinical Appointment System</h1> -->
									<!-- <img src="assets/img/login-banner.png" class="img-fluid" alt="Doccure Register"> -->
								<!-- </div> -->
								<div class="col-md-12 col-lg-6 login-right">
									<div class="login-header">
										<h3>Register as Patient</h3>
									</div>

									<!-- Register Form -->
									<form method="post" action="" name="signup" onSubmit="return valid();">
									<?php if($error){?><div class="errorWrap" style="background-color: #fa2837; color: #ffffff; margin:10px; padding:10px;"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"  style="background-color: #2dcc70; color: #ffffff;margin:10px; padding:10px;"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
										<div class="form-group form-focus">
											<input type="text" name="firstname" class="form-control floating" required>
											<label class="focus-label">First Name</label>
										</div>
										<div class="form-group form-focus">
											<input type="text" name="lastname" class="form-control floating" required>
											<label class="focus-label">Last Name</label>
										</div>
										<div class="form-group form-focus">
											<input type="email" name="email" class="form-control floating" required>
											<label class="focus-label">Email Address</label>
										</div>
										<div class="form-group form-focus">
											<input type="password" name="password" class="form-control floating" required>
											<label class="focus-label">Create Password</label>
										</div>
										<!-- <div class="form-group form-focus">
											<input type="password" name="Confirm_password" class="form-control floating" required>
											<label class="focus-label">Confirm Password</label>
										</div> -->
										<div class="text-right">
											<a class="forgot-link" href="login.php">Already have an account?</a>
										</div>
										<input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-primary btn-block btn-lg login-btn"/>
									</form>
									<!-- /Register Form -->

								</div>
							</div>
						</div>
						<!-- /Register Content -->

					</div>
				</div>

			</div>

		</div>
		<!-- /Page Content -->

		<!-- Footer -->

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

<!-- <script type="text/javascript">
function valid()
{
if(document.signup.password.value!= document.signup.confirm_password.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.signup.confirm_password.focus();
return false;
}
return true;
}
</script> -->

</body>

<!-- doccure/register.html  30 Nov 2019 04:12:20 GMT -->

</html>