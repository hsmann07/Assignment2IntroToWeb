<?php ob_start();
$pageTitle = 'Adminstrators List';
require_once('header.php'); ?>

<h1>Adminstrators</h1>

<?php
// access current session
session_start();
if (!empty($_SESSION['userId'])) {
    echo '<a href="register.php">Add a Adminstrator</a> ';
}
try {
    // connect to DataBase
    require_once('db.php');
    // set up query
    $sql = "SELECT userId, userName FROM users ORDER BY userId";
    // run query and store results
    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $users = $cmd->fetchAll();
    // start table and headings
    echo '<table class="table table-inverse table-hover">
    <tr><th>Adminstrators</th>';
    if (!empty($_SESSION['userId'])) {
        echo '<th>Edit</th><th>Delete</th>';
    }
    echo '</tr>';
    // loop through data
    foreach ($users as $user) {
        // print each adminstrator as a new row
        echo '<tr><td>' . $user['userName'] . '</td>';
        if (!empty($_SESSION['userId'])) {
            echo '<td><a href="register.php?userId=' . $user['userId'] . '" class="btn btn-info">Edit</a></td>
            <td><a href="delete-adminstrator.php?userId=' . $user['userId'] . '"
            class="btn btn-danger confirmation">Delete</a></td>';
        }
        echo '</tr>';
    }
    // end table
    echo '</table>';
    // disconnect
    $conn = null;
}
catch (exception $e) {
    mail('200354653@student.georgianc.on.ca', 'Adminstrator Page Error', $e);
    header('location:error.php');
}
?>

<?php require_once('footer.php');
ob_flush(); ?>
