<?php
ob_start();
$pageTitle = 'Pages';
require_once('header.php');
//starting session
session_start();

// access current session
session_start();
if (!empty($_SESSION['userId'])) {
    echo '<a href="add_page.php">ADD NEW PAGE</a> ';
}

try {
    //connecting
    include('db.php');

    //Querry
    $sql="SELECT * FROM pages ORDER BY title";
    $cmd = $conn->prepare($sql);

    //run Querry
    $cmd->execute();
    $pages = $cmd->fetchAll();

    //Table
		echo '<table class="table table-inverse table-hover">
    <tr><th>Title</th>';
    if (!empty($_SESSION['userId'])) {
        echo '<th>Edit</th><th>Delete</th>';
    }
    echo '</tr>';

		foreach ($pages as $page) {
				// print each adminstrator as a new row
				echo '<tr><td>' . $page['title'] . '</td>';
				if (!empty($_SESSION['userId'])) {
						echo '<td><a href="add_page.php?page_id=' . $page['page_id'] . '" class="btn btn-info">Edit</a></td>
						<td><a href="delete_page.php?page_id=' . $page['page_id'] . '"
						class="btn btn-danger confirmation">Delete</a></td>';
				}
				echo '</tr>';
		}
		// end table
		echo '</table>';
}
catch (exception $e) {
//    send exception on mail to my email
    mail('200354653@student.georgianc.on.ca', 'Something Wrong with page', $e);
    header('location:error.php');
}

?>
