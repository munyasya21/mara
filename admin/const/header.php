<!-- Header -->
<div class="header">
			
            <!-- Logo -->
            <div class="header-left">
                <a href="index.php" class="logo">
                    <!-- <img src="assets/img/logo.png" alt="Logo"> -->
                    <span style="font-weight:700; font-size:36px;" >MHC</span>
                </a>
                <a href="index.php" class="logo logo-small">
                    <!-- <img src="assets/img/logo-small.png" alt="Logo" width="30" height="30"> -->
                    <span style="font-weight:700; font-size:30px;" >MHC</span>
                </a>
            </div>
            <!-- /Logo -->
            
            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fe fe-text-align-left"></i>
            </a>
            
            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control" placeholder="Search here">
                    <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            
            <!-- Mobile Menu Toggle -->
            <a class="mobile_btn" id="mobile_btn">
                <i class="fa fa-bars"></i>
            </a>
            <!-- /Mobile Menu Toggle -->
            
            <!-- Header Right Menu -->
            <ul class="nav user-menu">

                <!-- User Menu -->
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/profiles/avatar-04.jpg" width="31" alt="Ryan Taylor"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img src="assets/img/profiles/avatar-04.jpg" alt="User Image" class="avatar-img rounded-circle">
                            </div>
                            <?php  if ($_SESSION['user'] != NULL) {
                            $firstname = $_SESSION['user']['firstname'];
                            $lastname = $_SESSION['user']['lastname'];
                            ?>
                            <div class="user-text">
                                <?php echo "<h6>$firstname&nbsp;$lastname</h6>"; ?>
                                <p class="text-white mb-0 badge badge-warning">Administrator</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="profile.php">My Profile</a>
                        <!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                        <?php } ?>
                    </div>
                </li>
                <!-- /User Menu -->
                
            </ul>
            <!-- /Header Right Menu -->
            
        </div>
        <!-- /Header -->