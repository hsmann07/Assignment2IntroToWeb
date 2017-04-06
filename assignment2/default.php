<?php
ob_start();

require_once ('public-site.php');


$page_id = null;
$Title = null;
$Content = null;

if (!empty($_GET['page_id'])) {
    if (is_numeric($_GET['page_id'])) {

        $page_id = $_GET['page_id'];
// connect to DataBase
        require_once ('db.php');

        $sql = "SELECT title, content  FROM pages WHERE page_id = :page_id";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
        $cmd->execute();
        $page = $cmd->fetch();

        $Title = $page['title'];
        $Content = $page['content'];


        $conn = null;
    }
}
echo '<title>'.$pages['Title'].'</title>';


?>
<!-- accessing the data from pages stored in db -->
<h1 style="text-align: center;"><?php echo $Title ?></h1>
<section style="text-align: center"><h3><?php echo $Content ?></h3></section>

<?php
require_once ('footer.php');
ob_flush();
?>
