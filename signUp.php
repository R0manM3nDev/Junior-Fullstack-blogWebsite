<?php 
require'config/database.php'; 
// get back form data if there was a registration error
$firstname = $_SESSION['signUp-data']['firstname'] ?? null;
$lastname = $_SESSION['signUp-data']['lastname'] ?? null;
$username = $_SESSION['signUp-data']['username'] ?? null;
$email = $_SESSION['signUp-data']['email'] ?? null;
$createpassword = $_SESSION['signUp-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signUp-data']['confirmpassword'] ?? null;
//delete signup data session
unset($_SESSION['signUp-data']);
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
            <h2>Sign Up</h2>

            <?php if(isset($_SESSION['signUp'])){ ?>
                <div class="alert_messege error">
                <p>
                    <?= $_SESSION['signUp'];
                    unset($_SESSION['signUp']);
                    ?>
                </p>
            </div>
            <?php } ?>
            
            <form action="<?=ROOT_URL?>signup-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="firstname" value="<?=$firstname?>" placeholder="Fisrt Name">
                <input type="text" name="lastname" value="<?=$lastname?>" placeholder="Last Name">
                <input type="text" name="username" value="<?=$username?>" placeholder="Userame">
                <input type="email" name="email" value="<?=$email?>" placeholder="Email">
                <input type="password" name="createpassword" value="<?=$createpassword?>" placeholder="Create Password">
                <input type="password" name="confirmpassword" value="<?=$confirmpassword?>" placeholder="Confirm Password">
                <div class="form_control">
                    <label for="avatar">User Avatar</label>
                    <input type="file" name="avatar" id="avatar">
                </div>
                <button type="submit" name="submit"class="btn">Sign Up</button>
                <small>Already have an account?<a href="signIn.php">Sign In</a></small>
            </form>
        </div>
    </section>
</body>
</html>