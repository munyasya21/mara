<?php include(INCLUDE_PATH . "/logic/public_functions.php"); ?>
<?php
// variable declaration
$role_id = 3;
$firstname = "";
$lastname = "";
$email  = "";
$errors  = [];
// SIGN UP USER
if (isset($_POST['signup'])) {
    // validate form values
    $errors = validateUser($_POST, ['signup']);

    // receive all input values from the form. No need to escape... bind_param takes care of escaping
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt the password before saving in the database
    $profile_picture = uploadProfilePicture();
    $created_at = date('Y-m-d H:i:s');
    // $role_id = $_POST['role_id'];

    // if no errors, proceed with signup
    if (count($errors) === 0) {
        // insert user into database
        $query = "INSERT INTO users SET role_id=?, firstname=?, lastname=?, email=?, password=?, profile_picture=?, created_at=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssss', $role_id, $firstname, $lastname, $email, $password, $profile_picture, $created_at);
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

// USER LOGIN
if (isset($_POST['login'])) {
    // validate form values
    $errors = validateUser($_POST, ['login']);
    $email = $_POST['email'];
    $password = $_POST['password']; // don't escape passwords.

    if (empty($errors)) {
        $sql = "SELECT * FROM users WHERE email=? LIMIT 1";
        $user = getSingleRecord($sql, 's', [$email]);

        if (!empty($user)) { // if user was found
            if (password_verify($password, $user['password'])) { // if password matches\
              $msg= "Login successful";
                // log user in
                loginById($user['uid']);
            } else { // if password does not match
                // $_SESSION['error_msg'] = "Wrong credentials";
                $error= "Wrong credentials";
            }
        } else { // if no user found
            // $_SESSION['error_msg'] = "Wrong credentials";
            $error= "Wrong credentials";
        }
    }
}

?>