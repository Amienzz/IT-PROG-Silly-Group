<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>mobile_number</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 50px;
        }

        h1 {
            color: #333;
        }

        button {
            background-color: #5dd55d;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2aa22a;
        }
    </style>
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
