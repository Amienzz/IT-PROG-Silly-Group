<?php
session_start();
require_once 'user_management.php'; // Assuming this file contains the necessary class definitions

$P = new Profile(); // Assuming Profile is the class name

// Retrieve the username from the session
$loggedInUser = $_SESSION["loggedInUser"];
$P->username = $loggedInUser;

$status = $P->deleteProfile();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>JSP Page</title>
</head>
<body>
<?php
if ($status == 1) {
    ?>
    <form action="index.html" method="post">
        <button type="submit">Delete Success!</button>
    </form>
    <?php
} else {
    ?>
    <form action="mainpage.php" method="post">
        <button type="submit">Failed! Going back to mainpage</button>
    </form>
    <?php
}
?>
</body>
</html>
