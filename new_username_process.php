<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>mobile_number</title>
</head>
<body>
<?php
// Instantiate the profile object
$P = new user_management.profile();

// Start the session
session_start();
$loggedInUser = $_SESSION["loggedInUser"];

// Receive parameters from the request
$v_new_name = $_POST["new_name"];
$P->username = $v_new_name;

// Check if the new username is taken
$status1 = $P->isUsernameTaken();

if ($status1 == 1) {
    echo "<h1>Username has been taken.</h1>";
    echo "<form action=\"edit_username.html\" method=\"post\">";
    echo "<button type=\"submit\">BACK!</button>";
    echo "</form>";
} else {
    // Set the new username
    $P->username = $loggedInUser;
    $P->new_username = $v_new_name;
    $P->setUsername();

    // Update session with the new username
    $_SESSION["loggedInUser"] = $P->new_username;

    echo "<h1>New Username has been set!</h1>";
    echo "<form action=\"mainpage.jsp\" method=\"post\">";
    echo "<button type=\"submit\">BACK!</button>";
    echo "</form>";
}
?>
</body>
</html>
