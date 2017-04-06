<?php ob_start();
// accessing the current session
session_start();
// removing all session variables
session_destroy();
// redirect to home or login page
header('location:login.php');
ob_flush(); ?>
