<?php
session_start();
require_once 'user_management.php'; // Assuming this file contains the necessary class definitions

$P = new Profile(); // Assuming Profile is the class name

// Receives from the create_account HTML
$v_gender = $_POST["gender"];

$P->gender = $v_gender;

$userNames = $P->getUsername();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>process_view</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 50px;
        }

        p {
            color: #333;
            background-color: #5dd55d;
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
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
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2aa22a;
        }
    </style>
</head>
<body>
    <form action="view_user.php" method="post">
        <button type="submit">Back</button>
    </form>

<?php
if (!empty($userNames)) {
    foreach ($userNames as $userName) {
        echo "<p>User: $userName</p>";
    }
} else {
    echo "<p>No users found with the specified gender.</p>";
}
?>

</body>
</html>
