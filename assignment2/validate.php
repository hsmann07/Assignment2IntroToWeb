<?php ob_start();
$username = $_POST['username'];
$password = $_POST['password'];
require_once ('db.php');
$sql = "SELECT userId, password FROM users WHERE username = :username";
$cmd = $conn->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->execute();
$user = $cmd->fetch();
if (password_verify($password, $user['password'])) {
    // user found
    session_start(); // access the existing session
    $_SESSION['userId'] = $user['userId']; // store the user's id in a session variable
    $_SESSION['username'] = $username;
    header('location:adminstrators.php');  // take authenticated user to adminstrators page
}
else {
    // user not found redirect it to login.php
    header('location:login.php?invalid=true');
    exit();
}
$conn = null;
ob_flush(); ?>
