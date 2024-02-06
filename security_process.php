<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Security Processing</title>
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
        include_once 'user_management.php'; // Adjust the filename as needed
        $A = new Account();

        // Receives from the create_account HTML
        $v_password = $_POST["password"];
        $v_verify = $_POST["verify"];
        $v_email = $_POST["email"];

        $A->password = $v_password;
        $A->verify_password = $v_verify;
        $A->email = $v_email;

        $status = $A->getEmail();
        $status1 = $A->password_verification();
        $status2 = $A->isEight();

        if ($status == 1) {
    ?>
        <h1>Email has been registered!</h1>
        <form action="account_security.html" method="post">
            <button type="submit">NEXT</button>
        </form>
    <?php
        } else {
            if ($status1 == 0) {
    ?> 
                <h1>Password Mismatch, Please type again!</h1>
                <form action="account_security.html" method="post">
                    <button type="submit">BACK</button>
                </form>
    <?php
            } else {
                if ($status2 == 1) {
    ?>
                    <h1>Password is less than eight characters!</h1>
                    <form action="account_security.html" method="post">
                        <button type="submit">BACK</button>
                    </form>
    <?php
                } else {
                    $A->account_assignment();
    ?>
                    <h1>Account Created, Proceed to the next step!</h1>
                    <form action="profile_setup.html" method="post">
                        <button type="submit">NEXT</button>
                    </form>
    <?php
                }
            }
        }
    ?>
</body>
</html>