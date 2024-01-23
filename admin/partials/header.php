<?php 
require '../partials/header.php'; 
//check logn status 
if(!isset($_SESSION['user-id'])){
    header('location: ' . ROOT_URL . 'signIn.php');
    die();
}
?>
