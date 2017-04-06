<?php ob_start();
// auth check
require_once ('auth.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting Page...</title>
</head>
<body>

<?php
try {
    $page_id = null;
    // 1. Get the albumId from the URL, check it has a numeric value
    if (!empty($_GET['page_id'])) {
        if (is_numeric($_GET['page_id'])) {
            $page_id = $_GET['page_id'];
        }
    }
    if (!empty($page_id)) {
        // 2. Connect
        require_once('db.php');
        // 3. Set up and run the SQL DELETE COMMAND
        $sql = "DELETE FROM pages WHERE page_id = :page_id";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
        $cmd->execute();
        // 4. Disconnect
        $conn = null;
    }
    // 5. Redirect to refresh the albums page
    header('location:page.php');
}
catch (exception $e) {
    header('location:error.php');
}
?>

</body>
</html>

<?php ob_flush(); ?>
