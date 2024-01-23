<?php
require 'config/constansts.php';
//destroy all session and redirect user to login page
session_destroy();
header('location: ' . ROOT_URL);
die();
?>