<?php 

if ($_SESSION['user'] == NULL) {

    header("location: " . BASE_URL . "login.php");

 } else if ($_SESSION['user'] != NULL) {

        $role = $_SESSION['user']['role_id'];
        
        if ($role != 1) {
            // header("location: " . BASE_URL . "admin/index.php");
            header("location: " . BASE_URL . "admin/error-403.php");
        } 
 
}
