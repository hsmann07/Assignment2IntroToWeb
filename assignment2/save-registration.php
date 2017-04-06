<?php ob_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save Registration</title>
</head>
<body>

<?php
// save user inputs to variables
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;
// validate inputs
if (empty($username)) {
    echo 'Username is required<br />';
    $ok = false;
}
if (empty($password) || (strlen($password) < 8)) {
    echo 'Password is invalid<br />';
    $ok = false;
}
if ($password != $confirm) {
    echo 'Passwords do not match<br />';
    $ok = false;
}
try{
if ($ok) {
    // connect
    require_once ('db.php');
    // set up sql insert
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    // hash the password!!!
    $password = password_hash($password, PASSWORD_DEFAULT);
    // execute the save
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
    $cmd->execute();
    // disconnect
    $conn = null;
    header('location:adminstrators.php');
	}
}
catch(exceptiom $e){
	header('location:error.php');
}
?>
</body>
</html>
<?php ob_flush(); ?>
