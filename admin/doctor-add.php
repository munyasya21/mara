<?php 

// session_start();
include('../config.php');
include('account/config.php');
include('account/middleware.php');
include(INCLUDE_PATH . '/logic/public_functions.php'); 
error_reporting(0);

$role_id = 2;
$firstname = "";
$lastname = "";
$email  = "";
$phone  = "";
$description= "";
$address  = "";
$category  = "";
$price  = "";
$monday  = "";
$tuesday  = "";
$wednesday  = "";
$thursday  = "";
$friday  = "";
$saturday  = "";
$sunday  = "";
$profile_picture="";
$errors  = [];
// SIGN UP USER
if (isset($_POST['register_doctor'])) {
    // validate form values
    $errors = validateUser($_POST, ['register_doctor']);

    // receive all input values from the form. No need to escape... bind_param takes care of escaping
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
	$phone = $_POST['phone'];
	$description= $_POST['description'];
	$address = $_POST['address'];
	$category = $_POST['category'];
	$price = $_POST['price'];
	$monday = $_POST['monday'];
	$tuesday = $_POST['tuesday'];
	$wednesday = $_POST['wednesday'];
	$thursday = $_POST['thursday'];
	$friday = $_POST['friday'];
	$saturday = $_POST['saturday'];
	$sunday = $_POST['sunday'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt the password before saving in the database
    $profile_picture = $_FILES["profile_picture"]["name"];
    $created_at = date('Y-m-d H:i:s');
	move_uploaded_file($_FILES["profile_picture"]["tmp_name"], "assets/img/profile/" . $_FILES["profile_picture"]["name"]);
    // $role_id = $_POST['role_id'];

    // if no errors, proceed with signup
    if (count($errors) === 0) {
        // insert user into database
        $query = "INSERT INTO users SET role_id=?, firstname=?, lastname=?, email=?, phone=?, description=?,
		password=?, profile_picture=?, created_at=?, address=?, category=?, price=?, monday=?,
		tuesday=?, wednesday=?, thursday=?, friday=?, saturday=?, sunday=? ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssssssssssssssss', $role_id, $firstname, $lastname, $email, $phone, $description,
		$password, $profile_picture, $created_at, $address, $category, $price, $monday,
		$tuesday, $wednesday, $thursday, $friday, $saturday, $sunday);
        $result = $stmt->execute();
        if ($result) {
            // $user_id = $stmt->insert_id;
            // $stmt->close();
            // loginById($uid); // log user in
            $msg= "Account created Sucessful";
        } else {
            $error = "Database error: Could not register user";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/doctor-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:51 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>BHCS - Doctor List Page</title>
		
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

		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/css/select2.min.css">
		
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
								<h3 class="page-title">New Doctor</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item"><a href="javascript:(0);">Users</a></li>
									<li class="breadcrumb-item active">Doctor</li>
								</ul>
								<!-- <a style="float:right;" class="btn btn-success" href="">Add Doctor</a> -->
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
								<form method="post" enctype="multipart/form-data">
										<div class="row">
											<div class="col-xl-6">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">First Name</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="firstname" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Last Name</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="lastname" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Email</label>
													<div class="col-lg-9">
														<input type="email" class="form-control" name="email" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Phone</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="phone" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-md-3">Description</label>
													<div class="col-md-12">
														<textarea rows="5" name="description" cols="5" class="form-control" placeholder="Enter description"></textarea>
													</div>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Address</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="address" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Speciality</label>
													<div class="col-lg-9">
														<select name="category" class="select" required>
															<option>Select</option>
															<?php $spec = "select * from specialities";
																  $query = $dbh->prepare($spec);
																  $query->execute();
																  $result1 = $query->fetchAll(PDO::FETCH_OBJ);
																	if ($query->rowCount() > 0) {
																		foreach ($result1 as $results) {
																	?>
																	<option value="<?php echo htmlentities($results->name); ?>"><?php echo htmlentities($results->name); ?></option>
															<?php }} ?>
														</select>
													</div>
												</div>
												<!-- <div class="form-group row"> -->
													<!-- <label class="col-lg-3 col-form-label">role</label> -->
													<!-- <div class="col-lg-9">
														<input type="text" name="role_id" value="2" class="form-control"hidden>
													</div> -->
												<!-- </div> -->
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Charges(Ksh.)</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="price" required>
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Password</label>
													<div class="col-lg-9">
														<input type="password" class="form-control" name="password" required>
													</div>
												</div>
											</div>
										</div>
										<h4 class="card-title">Availability</h4>
										<div class="row">
											<div class="col-xl-6">
											<div class="form-group row">
													<label class="col-lg-3 col-form-label">Monday</label>
													<div class="col-lg-9">
														<select class="select" name="monday" required>
															<option>Select</option>
															<option value="9:00 AM - 10:00 AM">9:00 AM - 10:00 AM</option>
															<option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
															<option value="11:00 AM - 12:00 PM">11:00 AM - 12:00 PM</option>
															<option value="12:00 PM - 1:00 PM">12:00 PM - 1:00 PM</option>
															<option value="1:00 PM - 2:00 PM">1:00 PM - 2:00 PM</option>
															<option value="2:00 PM - 3:00 PM">2:00 PM - 3:00 PM</option>
															<option value="3:00 PM - 4:00 PM">3:00 PM - 4:00 PM</option>
															<option value="4:00 PM - 5:00 PM">4:00 PM - 5:00 PM</option>
															<option value="Not Available">Not Available</option>
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Tuesday</label>
													<div class="col-lg-9">
														<select class="select" name="tuesday" required>
															<option>Select</option>
															<option value="9:00 AM - 10:00 AM">9:00 AM - 10:00 AM</option>
															<option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
															<option value="11:00 AM - 12:00 PM">11:00 AM - 12:00 PM</option>
															<option value="12:00 PM - 1:00 PM">12:00 PM - 1:00 PM</option>
															<option value="1:00 PM - 2:00 PM">1:00 PM - 2:00 PM</option>
															<option value="2:00 PM - 3:00 PM">2:00 PM - 3:00 PM</option>
															<option value="3:00 PM - 4:00 PM">3:00 PM - 4:00 PM</option>
															<option value="4:00 PM - 5:00 PM">4:00 PM - 5:00 PM</option>
															<option value="Not Available">Not Available</option>
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Wednesday</label>
													<div class="col-lg-9">
														<select class="select" name="wednesday" required>
															<option>Select</option>
															<option value="9:00 AM - 10:00 AM">9:00 AM - 10:00 AM</option>
															<option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
															<option value="11:00 AM - 12:00 PM">11:00 AM - 12:00 PM</option>
															<option value="12:00 PM - 1:00 PM">12:00 PM - 1:00 PM</option>
															<option value="1:00 PM - 2:00 PM">1:00 PM - 2:00 PM</option>
															<option value="2:00 PM - 3:00 PM">2:00 PM - 3:00 PM</option>
															<option value="3:00 PM - 4:00 PM">3:00 PM - 4:00 PM</option>
															<option value="4:00 PM - 5:00 PM">4:00 PM - 5:00 PM</option>
															<option value="Not Available">Not Available</option>
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Thursday</label>
													<div class="col-lg-9">
														<select class="select" name="thursday" required>
															<option>Select</option>
															<option value="9:00 AM - 10:00 AM">9:00 AM - 10:00 AM</option>
															<option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
															<option value="11:00 AM - 12:00 PM">11:00 AM - 12:00 PM</option>
															<option value="12:00 PM - 1:00 PM">12:00 PM - 1:00 PM</option>
															<option value="1:00 PM - 2:00 PM">1:00 PM - 2:00 PM</option>
															<option value="2:00 PM - 3:00 PM">2:00 PM - 3:00 PM</option>
															<option value="3:00 PM - 4:00 PM">3:00 PM - 4:00 PM</option>
															<option value="4:00 PM - 5:00 PM">4:00 PM - 5:00 PM</option>
															<option value="Not Available">Not Available</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-xl-6">
											<div class="form-group row">
													<label class="col-lg-3 col-form-label">Friday</label>
													<div class="col-lg-9">
														<select class="select" name="friday" required>
															<option>Select</option>
															<option value="9:00 AM - 10:00 AM">9:00 AM - 10:00 AM</option>
															<option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
															<option value="11:00 AM - 12:00 PM">11:00 AM - 12:00 PM</option>
															<option value="12:00 PM - 1:00 PM">12:00 PM - 1:00 PM</option>
															<option value="1:00 PM - 2:00 PM">1:00 PM - 2:00 PM</option>
															<option value="2:00 PM - 3:00 PM">2:00 PM - 3:00 PM</option>
															<option value="3:00 PM - 4:00 PM">3:00 PM - 4:00 PM</option>
															<option value="4:00 PM - 5:00 PM">4:00 PM - 5:00 PM</option>
															<option value="Not Available">Not Available</option>
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Saturday</label>
													<div class="col-lg-9">
														<select class="select" name="saturday" required>
															<option>Select</option>
															<option value="9:00 AM - 10:00 AM">9:00 AM - 10:00 AM</option>
															<option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
															<option value="11:00 AM - 12:00 PM">11:00 AM - 12:00 PM</option>
															<option value="12:00 PM - 1:00 PM">12:00 PM - 1:00 PM</option>
															<option value="1:00 PM - 2:00 PM">1:00 PM - 2:00 PM</option>
															<option value="2:00 PM - 3:00 PM">2:00 PM - 3:00 PM</option>
															<option value="3:00 PM - 4:00 PM">3:00 PM - 4:00 PM</option>
															<option value="4:00 PM - 5:00 PM">4:00 PM - 5:00 PM</option>
															<option value="Not Available">Not Available</option>
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Sunday</label>
													<div class="col-lg-9">
														<select class="select" name="sunday" required>
															<option>Select</option>
															<option value="9:00 AM - 10:00 AM">9:00 AM - 10:00 AM</option>
															<option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
															<option value="11:00 AM - 12:00 PM">11:00 AM - 12:00 PM</option>
															<option value="12:00 PM - 1:00 PM">12:00 PM - 1:00 PM</option>
															<option value="1:00 PM - 2:00 PM">1:00 PM - 2:00 PM</option>
															<option value="2:00 PM - 3:00 PM">2:00 PM - 3:00 PM</option>
															<option value="3:00 PM - 4:00 PM">3:00 PM - 4:00 PM</option>
															<option value="4:00 PM - 5:00 PM">4:00 PM - 5:00 PM</option>
															<option value="Not Available">Not Available</option>
														</select>
													</div>
												</div>
												
											</div>
											<h4 class="card-title col-md-12">Profile Picture</h4>
											<div class="form-group row">
											<!-- <label class="col-form-label col-md-12">Profile pic</label> -->
											<div class="col-md-10">
												<input name="profile_picture" class="form-control" type="file">
											</div>
										</div>
										</div>
										<div class="text-right">
											<button type="submit" name="register_doctor" class="btn btn-primary">Submit</button>
										</div>
									</form>
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

		<!-- Select2 JS -->
		<script src="assets/js/select2.min.js"></script>
		
		
		<!-- Custom JS -->
		<script  src="assets/js/script.js"></script>

		
    </body>

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/doctor-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:51 GMT -->
</html>