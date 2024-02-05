<?php
// Assuming necessary PHP includes and configurations

// Instantiate the account class (assuming user_management.php is included)
$S = new account();

// Receive parameters from the login HTML form
$v_password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
$v_email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';

// Set values in the account object
$S->password = $v_password;
$S->email = $v_email;

// Call login_credentials method
$status = $S->login_credentials();

// Check status and display appropriate message
if ($status == 1) {
    $S->getUsername();
    $ses = $_SESSION;
    $ses['loggedInUser'] = $S->username;
    $S->set_logDate();
    echo '<h1>Successfully Logged In!</h1>';
} else {
    echo '<h1>Email or Password Mismatch</h1>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Login Verification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        button {
            background-color: #5dd55d;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2aa22a;
        }
    </style>
</head>
<body>
    <form action="mainpage.php" method="post">
        <button type="submit">Next</button>
    </form>
    <form action="login.html" method="post">
        <button type="submit">Back</button>
    </form>
</body>
</html>
