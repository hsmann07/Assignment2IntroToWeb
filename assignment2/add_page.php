<?php
ob_start();
$pageTitle = 'Pages';
require_once('header.php');
//starting session
session_start();

// access current session
session_start();
if (!empty($_SESSION['userId'])) {

}
try {
    $title = null;
    $content = null;
    $page_id =null;
    //Checking for ID
		if(!empty($_GET['page_id'])){
    if (is_numeric($_GET['page_id'])) {
        //Storing id

        $page_id = $_GET['page_id'];

        //Connecting to DB

        require('db.php');


        $sql = "SELECT * FROM pages WHERE page_id = :page_id";
        $cmd = $conn->prepare($sql);

        $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);

        $cmd->execute();


        $pages = $cmd->fetch();

            $content = $pages['content'];
            $title = $pages['title'];
    }
		}
}
catch (exception $e) {
//    send exception on mail to my email
    mail('200354653@student.georgianc.on.ca', 'Something wrong with page', $e);
    header('location:error.php');
}



?>

    <!--form for saving pages-->

    <h1 class="col-sm-offset-2">Add New Page</h1>
    <form method="post" action="save_pages.php" class="form-horizontal">

            

        <div class="form-group">
            <label for="title" class="col-sm-2  col-md-offset-2" >Page Title:</label>
            <div class="col-sm-6">

                <input id="title" type="text" name="title" class="form-control" value="<?php echo $title ?>" />
            </div>
        </div>

           <div class="form-group width">
            <label for="content" class="col-sm-2  col-md-offset-2">Content:</label>
            <div class="col-sm-6">
						<textarea cols="25" rows="10" id="content" name="content" class="form-control"><?php echo $content ?></textarea>
            </div>
        </div>
                           
        <div class="col-sm-offset-3">
                    <input type="hidden" name="page_id" id="page_id" value="<?php echo $page_id ?>"/>
                    <input type="submit" value="save" class="btn btn-success"/>
                
        </div>

    </form>

    <br/>

<?php require_once('footer.php');
ob_flush(); ?>
