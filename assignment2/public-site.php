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
<body style="background-image: url(https://image.freepik.com/free-vector/abstract-background-with-a-watercolor-texture_1048-2144.jpg);">

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
$conn = null;
			 ?>

<?php
require('db.php');
 $sql= " SELECT * FROM pages ORDER BY title";

 // run query and store results
 $cmd = $conn->prepare($sql);
 $cmd->execute();
 $pages = $cmd->fetchAll();

 foreach($pages as $page){
 		echo '<li><a href="default.php?page_id=' . $page['page_id'] . '">' . $page['title'] . '</a></li>';
 	}
echo '<li><a href="home.php">Home</a></li>';
 ?>
    </ul>

    <?php
    if (!empty($_SESSION['userId'])) {
        echo '<div class="navbar-text pull-right">' . $_SESSION['username'] . '</div>';
    }
    ?>
</nav>
