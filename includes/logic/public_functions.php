<?php
// Accept a user ID and returns true if user is admin and false if otherwise
function isAdmin($uid)
{
    global $conn;
    $sql = "SELECT * FROM users WHERE uid=? AND role_id = 1 LIMIT 1";
    $user = getSingleRecord($sql, 'i', [$uid]); // get single user from database
    if (!empty($user)) {
        return true;
    } else {
        return false;
    }
}
function isDoctor($uid)
{
    global $conn;
    $sql = "SELECT * FROM users WHERE uid=? AND role_id = 2 LIMIT 1";
    $user = getSingleRecord($sql, 'i', [$uid]); // get single user from database
    if (!empty($user)) {
        return true;
    } else {
        return false;
    }
}
function isPatient($uid)
{
    global $conn;
    $sql = "SELECT * FROM users WHERE uid=? AND role_id = 3 LIMIT 1";
    $user = getSingleRecord($sql, 'i', [$uid]); // get single user from database
    if (!empty($user)) {
        return true;
    } else {
        return false;
    }
}
function loginById($uid)
{
    global $conn;
    $sql = "SELECT u.uid, u.role_id, u.firstname, u.lastname, u.email, r.name as role FROM users u LEFT JOIN roles r ON u.role_id=r.id WHERE u.uid=? LIMIT 1";
    $user = getSingleRecord($sql, 'i', [$uid]);

    if (!empty($user)) {

        $_SESSION['user'] = $user;
        $_SESSION['success_msg'] = "You are now logged in";
        if (isAdmin($uid)) {
            // header('location: ' . BASE_URL . 'admin/dashboard.php');
            echo "<script> window.location.assign('admin/index.php'); </script>";
        } else  if (isPatient($uid)) {
            // header('location: ' . BASE_URL . 'index.php');
            echo "<script> window.location.assign('index.php'); </script>";
        } else  if (isDoctor($uid)) {
            // header('location: ' . BASE_URL . 'index.php');
            echo "<script> window.location.assign('doctor-dashboard.php'); </script>";
        }
        exit(0);
    }
}

// Accept a user object, validates user and return an array with the error messages
function validateUser($user, $ignoreFields)
{
    global $conn;
    $errors = [];
    // password confirmation
    if (isset($user['passwordConf']) && ($user['password'] !== $user['passwordConf'])) {
        $errors['passwordConf'] = "The two passwords do not match";
    }
    // if passwordOld was sent, then verify old password
    if (isset($user['passwordOld']) && isset($user['uid'])) {
        $sql = "SELECT * FROM users WHERE uid=? LIMIT 1";
        $oldUser = getSingleRecord($sql, 'i', [$user['uid']]);
        $prevPasswordHash = $oldUser['password'];
        if (!password_verify($user['passwordOld'], $prevPasswordHash)) {
            $errors['passwordOld'] = "The old password does not match";
        }
    }
    // the email should be unique for each user for cases where we are saving admin user or signing up new user
    if (in_array('save_user', $ignoreFields) || in_array('signup', $ignoreFields)) {
        $sql = "SELECT * FROM users WHERE email=? LIMIT 1";
        $oldUser = getSingleRecord($sql, 's', [$user['email']]);
        if (!empty($oldUser['email']) && $oldUser['email'] === $user['email']) { // if user exists
            $errors['email'] = "Email already exists";
        }
    }

    // required validation
    foreach ($user as $key => $value) {
        if (in_array($key, $ignoreFields)) {
            continue;
        }
        if (empty($user[$key])) {
            $errors[$key] = "This field is required";
        }
    }
    return $errors;
}
// upload's user profile profile picture and returns the name of the file
function uploadProfilePicture()
{
    // if file was sent from signup form ...
    if (!empty($_FILES) && !empty($_FILES['profile_picture']['name'])) {
        // Get image name
        $profile_picture = date("Y.m.d") . $_FILES['profile_picture']['name'];
        // define Where image will be stored
        $target = ROOT_PATH . "/assets/images/" . $profile_picture;
        // upload image to folder
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target)) {
            return $profile_picture;
            exit();
        } else {
            echo "Failed to upload image";
        }
    }
}

// Accept a post object, validates post and return an array with the error messages
function validateRole($role, $ignoreFields)
{
    global $conn;
    $errors = [];
    foreach ($role as $key => $value) {
        if (in_array($key, $ignoreFields)) {
            continue;
        }
        if (empty($role[$key])) {
            $errors[$key] = "This field is required";
        }
    }
    return $errors;
}
