<?php ob_start();
$pageTitle = 'Save Image';
require_once ('auth.php');
require_once ('header.php');
?>
<?php
try {
    $logoName = null;
    $ok = true;

    if (!empty($_FILES['anyFile']['name'])) {
        $imageTitle = $_FILES['anyFile']['name'];
        if(empty($imageTitle)) {
            echo '<h2 class="alert-warning" style="text-align: center">Please select a file</h2>';

        }
        $array = end(explode('.', $imageTitle));

        $lower = strtolower($array);


        $fileType = ['png', 'gif', 'svg','jpg'];

        if (!in_array($lower, $fileType)) {
            echo '<h2 class="alert-warning" style="text-align: center">Logo must be only Five types:<br /> .png or .gif or .svg<br/></h2>';
            $ok = false;
        }

        $fileSize = $_FILES['anyFile']['size'];
        if ($fileSize > 5242880) {
            echo '<h2 class="alert-warning" style="text-align: center">Please select Logo less than 5 MB<br /></h2>>';
            $ok = false;
        }

        $logoName = uniqid("") . "-$imageTitle";

        $temporaryName = $_FILES['anyFile']['tmp_name'];
        move_uploaded_file($temporaryName, "uploads/$logoName");

    }
    if ($ok) {

        require_once('db.php');


        if (empty($logo_id)) {
            $sql = "INSERT INTO logo (logo_name) VALUES (:logo_name)";
        }


        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':logo_name', $logoName, PDO::PARAM_STR, 500);

        if (!empty($logo_id)) {
            $cmd->bindParam(':logo_id', $logo_id, PDO::PARAM_INT);
        }

        $cmd->execute();

        $conn = null;
    }
header('location:logo.php');
}
catch (exception $e) {
	mail('200354653@student.georgianc.on.ca', 'Something Wrong with page', $e);
	header('location:error.php');
}
require_once ('footer.php');
?>
<?php ob_flush(); ?>
