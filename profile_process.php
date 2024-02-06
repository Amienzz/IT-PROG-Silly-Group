<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Profile Process</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 50px;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
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
        include_once 'user_management.php'; // Adjust the filename as needed
        $P = new Profile();

        // Receives from the create_account HTML
        $v_username = $_POST["username"];
        $v_bio = $_POST["bio"];

        $P->username = $v_username;
        $P->bio = $v_bio;

        $status = $P->isUsernameTaken();

        if ($status == 0) {
            $P->profileSetUp();
            session_start();
            $_SESSION["loggedInUser"] = $P->username;
    ?>
            <h1>Profile Set Up is Done!</h1>
            <form action="mainpage.php" method="post">
                <button type="submit">NEXT</button>
            </form>
    <?php
        } else {
    ?>
            <h1>USERNAME IS TAKEN! ENTER A NEW ONE</h1>
            <form action="profile_setup.html" method="post">
                <button type="submit">BACK</button>
            </form>
    <?php
        }
    ?>
</body>
</html>