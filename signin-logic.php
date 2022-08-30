<?php
require 'config/database.php';
if (isset($_POST['submit'])) {

    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
    if (!$username_email) {
        $_SESSION['signin'] = "User name or Email required";
    } else if (!$password) {


        $_SESSION['signin'] = "Password Required";
    } else {

        $fetch_user_query = "Select * FROM users WHERE username='$username_email' OR email='$username_email' ";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        if (mysqli_num_rows($fetch_user_result) == 1) {
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];
            //compare form pass with database pass

            if (password_verify($password, $db_password)) {

                $_SESSION['user-id'] = $user_record['id'];
                if ($user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }


                header('location:' . ROOT_URL . 'admin/');
            } else {

                $_SESSION['signin'] = "Password does not match ";
            }
            //if any problem
            if (isset($_SESSION['signin'])) {


                $_SESSION['signin-data'] = $_POST;
                header('location:' . ROOT_URL . 'signin.php');
                die();
            }
        } else {

            $_SESSION['signin'] = "User not found";
            header('location:' . ROOT_URL . 'signin.php');
            die();
        }
    }
} else {


    header('location:' . ROOT_URL . 'signin/php');
    die();
}
