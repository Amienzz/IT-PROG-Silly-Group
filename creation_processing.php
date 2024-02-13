<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>ACCOUNT PROCESSING</title>
</head>
<body>
    <?php
        include_once 'user_management.php'; // Adjust the filename as needed
        $U = new User();

        // Receives from the create_account HTML
        $v_firstname = $_POST["firstname"];
        $v_last_name = $_POST["last_name"];
        $v_middle_initial = $_POST["middle_initial"];
        $v_birthdate = $_POST["birthday"];
        $v_gender = $_POST["gender"];

        $U->first_name = $v_firstname;
        $U->last_name = $v_last_name;
        $U->middle_initial = $v_middle_initial;
        $U->birthdate = $v_birthdate;
        $U->gender = $v_gender;

        $status = $U->register_user();

        if ($status == 1) {
    ?>
        <h1>INFORMATION SAVED!</h1>
        <form action="account_security.html" method="post">
            <button type="submit">Next Step</button>
        </form>
    <?php 
        } else {
    ?> 
        <h1>CREATION ACCOUNT FAILED!</h1>
    <?php
        }
    ?>    
</body>
</html>