<?php
    // Start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    //Root
    if (!defined('ROOT_URL')) {
        define('ROOT_URL', 'http://localhost/Ejemplo/Blog/');
    }
    //DATABASE
    if (!defined('DB_HOST')) {
        define('DB_HOST', 'localhost');
    }
    if (!defined('DB_USER')) {
        define('DB_USER', 'rema');
    }
    if (!defined('DB_PASS')) {
        define('DB_PASS', 'admin');
    }
    if (!defined('DB_NAME')) {
        define('DB_NAME', 'blog');
    }
?>