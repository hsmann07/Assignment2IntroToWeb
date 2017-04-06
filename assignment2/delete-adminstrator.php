<?php ob_start();
// auth check
require_once ('auth.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting Adminstrator...</title>
</head>
<body>

<?php
try {
    $userId = null;
    // 1. Get the userId from the URL, check it has a numeric value
    if (!empty($_GET['userId'])) {
        if (is_numeric($_GET['userId'])) {
            $userId = $_GET['userId'];
        }
    }
    if (!empty($userId)) {
        // 2. Connect
        require_once('db.php');
        // 3. Set up and run the SQL DELETE COMMAND
        $sql = "DELETE FROM users WHERE userId = :userId";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
        $cmd->execute();
        // 4. Disconnect
        $conn = null;
    }
    // 5. Redirect to refresh the adminstrator page
    header('location:adminstrators.php');
}
catch (exception $e) {
    header('location:error.php');
}
?>

</body>
</html>

<?php ob_flush(); ?>
