<?php 
require 'config/database.php'; 
if (isset($_SESSION['signin-data'])) {
    $username_email = $_SESSION['signin-data']['username_email'] ?? null;
    $password = $_SESSION['signin-data']['password'] ?? null;

    unset($_SESSION['signin-data']);
} else {
    // Handle the case where 'signin-data' is not set in the session
    // For example, you might want to redirect the user to a login page
    $username_email = '';
    $password = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Multipage Blog Website</title>
    <!--Custom stylesheet-->
    <link rel="stylesheet" href="<?= ROOT_URL?>css/style.css">
    <!--Icons-->    
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <!--Menu and close icons-->
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/menu.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/close.css' rel='stylesheet'>
    <!--fonds (Montserrat)-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">    
</head>
<body>
    <section class="fomr_section">
        <div class="container form_section-container">
            <h2>Sign In</h2>
            <?php if(isset($_SESSION['signUp-success'])) {?>
                <div class="alert_messege success">
                    <p>
                        <?=$_SESSION['signUp-success'];
                        unset($_SESSION['signUp-success']);?>
                    </p>
                </div>
            <?php }else if(isset($_SESSION['signIn'])){?>
            <div class="alert_messege error">
                    <p>
                        <?=$_SESSION['signIn'];
                        unset($_SESSION['signUp-success']);?>
                    </p>
                </div>
            <?php }?>
            <form action="<?= ROOT_URL ?>signin-logic.php" method="POST">
                <input type="text" name="username_email" value="<?= $username_email?>" placeholder="Username or Email">
                <input type="password" name="password" value="<?= $password?>" placeholder="Password">                                
                <button type="submit" name="submit" class="btn">Sign In</button>
                <small>Don't have account?<a href="signUp.php">Sign Up</a></small>
            </form>
        </div>
    </section>
</body>
</html>