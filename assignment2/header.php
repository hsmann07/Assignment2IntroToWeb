<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">

    <!-- Custom css -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body style="background-image: url(https://previews.123rf.com/images/pockygallery/pockygallery1509/pockygallery150900253/45096866-ASSIGNMENT-red-stamp-text-on-white-Stock-Photo.jpg);">

<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <ul class="nav navbar-nav">
			<?php
session_start();
require_once('db.php');
$sql= " SELECT logo_id, logo_name FROM logo ORDER BY logo_id DESC LIMIT 1";

// run query and store results
$cmd = $conn->prepare($sql);
$cmd->execute();
$logos = $cmd->fetchAll();

foreach($logos as $logo){
	echo '<li>';
	if(!empty($logo['logo_name'])){
		echo '<a href="home.php"><img  alt="logo" src="uploads/' . $logo['logo_name'] . '" class="thumb" />';
	}
}

			 ?>

        <?php
        // check if user is logged in
        session_start();
        if (empty($_SESSION['userId'])) {
            // public links
            echo '<li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>';
        }
        else {
            // private link
            echo '  <li><a href="adminstrators.php">Adminstrators</a></li>
						<li><a href="page.php">Pages</a></li>
						      <li><a href="logo.php">Logo</a></li>
									<li><a href="public-site.php">Public Site</a></li>
				         <li><a href="logout.php">Logout</a></li>';
        }
        ?>
    </ul>

    <?php
    if (!empty($_SESSION['userId'])) {
        echo '<div class="navbar-text pull-right">' . $_SESSION['username'] . '</div>';
    }
    ?>
</nav>
