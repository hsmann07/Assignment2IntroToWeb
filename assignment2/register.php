<?php
$pageTitle = 'Please Register';
require_once ('header.php');
$userName=null;
if (!empty($_GET['userId'])) {
    if (is_numeric($_GET['userId'])) {
        // userId in URL
        $userId = $_GET['userId'];
        // connect to DataBase
        require_once ('db.php');
        $sql = "SELECT userName FROM users WHERE userId = :userId";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
        $cmd->execute();
        $user = $cmd->fetch();
        // populate the values into variables
        $userName = $user['userName'];
				$password = $user['password'];
        // disconnect
        $conn = null;
    }
}?>

<main class="container">
    <h1>User Registration</h1>
    <div class="alert alert-info" id="message">Please add your account</div>

    <form method="post" action="save-registration.php">
    <fieldset class="form-group">
        <label for="username" class="col-sm-2">Username:</label>
        <input name="username" id="username" required type="email" placeholder="email@email.com"  value="<?php echo $userName ?>" />
    </fieldset>
    <fieldset class="form-group">
        <label for="password" class="col-sm-2">Password:</label>
        <input type="password" name="password" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
        <span id="result"></span>
    </fieldset>
    <fieldset class="form-group">
        <label for="confirm" class="col-sm-2">Confirm Password:</label>
        <input type="password" name="confirm" id="confirm" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
    </fieldset>
    <div class="col-sm-offset-2">
        <button class="btn btn-success btnRegister">Register</button>
    </div>
    </form>
</main>

<?php require_once('footer.php'); ?>
