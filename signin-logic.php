<?php
require 'config/database.php';

    if(isset($_POST['submit'])){
        //get form data
        $username_email = filter_var($_POST['username_email'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_var($_POST['password'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(!$username_email){
            $_SESSION['signIn'] = "Username or Email required";
        }else if(!$password){
            $_SESSION['signIn'] = "Password required";
        }else{
            //fetch from database
            $fetch_use_querry = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
            $fetch_user_result = mysqli_query($connection,$fetch_use_querry);

            if(mysqli_num_rows($fetch_user_result) == 1){
                // convert the record into assoc array
                $user_record = mysqli_fetch_assoc($fetch_user_result);
                $db_password = $user_record['password'];
                //compare form password with databse password
                if(password_verify($password, $db_password)){
                    // set session for acces control
                    $_SESSION['user-id'] = $user_record['id'];
                    // set session if user is an admin
                    if($user_record['is_admin'] ==1){
                        $_SESSION['user_is_admin'] = true;
                    }
                    //log user in
                    header('location: '. ROOT_URL . 'admin/');
                }else{
                    $_SESSION['signIn']="Please check your input";
                }
            }else{
                $_SESSION['signIn'] = "User not found";
            }
        }
        //if any problem,redirect back to sigin page with login data
        if(isset($_SESSION['signIn'])){
            $_SESSION['signin-data'] = $_POST;
            header('location:'. ROOT_URL . 'signIn.php');
            die();
        }
    }else{
        header('location:'. ROOT_URL . 'signIn.php');
        die();
    }
?>