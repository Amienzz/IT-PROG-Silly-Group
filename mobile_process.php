<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>mobile_number</title>
</head>
<body>
<?php
// Instantiate the mobile object
$M = new user_management.mobile();

// Receive parameters from the request
session_start();
$loggedInUser = $_SESSION["loggedInUser"];
$v_mobile = $_POST["mobile"];

// Set parameters to the mobile object
$M->mobile = $v_mobile;
$M->userName = $loggedInUser;

// Get mobile status and display appropriate message
$status1 = $M->getMobile();

if ($status1 == 1) {
    echo "<h1>Mobile Number has been taken.</h1>";
} else {
    $M->setMobile();
    echo "<h1>Mobile Number added!</h1>";
}
?>

<!-- Form to return to main menu -->
<form action="mainpage.jsp" method="post">
    <button type="submit">BACK!</button>
</form>
</body>
</html>
