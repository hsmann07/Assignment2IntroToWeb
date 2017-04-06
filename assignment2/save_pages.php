<?php ob_start();
require('header.php');
try {

    // $title = null;
    // $content = null;

// storing values
    $title = $_POST['title'];
    $content = $_POST['content'];
		$page_id = $_POST['page_id'];
    $ok = true;

    //connecting to db
    require_once('db.php');


    // sql to insert values
		if (empty($page_id)) {
			$sql = "INSERT INTO pages (title, content) VALUES (:title, :content)";
		}
		else {
			$sql = "UPDATE pages SET title=:title,content=:content WHERE page_id=:page_id";
		}

    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
    $cmd->bindParam(':content', $content, PDO::PARAM_STR, 400);

if(!empty($page_id)){
	$cmd->bindParam(':page_id',$page_id,PDO::PARAM_INT);
}
    // execute the save
    $cmd->execute();

    // disconnect
    $conn = null;

    header('location:page.php');

}catch (exception $e) {
//    send exception on mail to my email
    mail('200354653@student.georgianc.on.ca', 'Something Wrong with page', $e);
    header('location:error.php');
}

require('footer.php');
ob_flush(); ?>
