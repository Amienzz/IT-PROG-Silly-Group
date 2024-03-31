<?php
    include_once 'BE_Account.php';
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Restaurant Reviews</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="taskbar"></header>
    <?php 
    session_start();
    $account = new create_acc();
    ?>

    <br><div class="textbox_border_nf">
        <form class="textbox" id="pass_change" action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <h3>Edit Password</h3>

            <br><label for="password">Old Password: </label>
            <input type="password" class="login_input" name="old_password" required>

            <label for="password">New Password: </label>
            <input type="password" class="login_input" name="new_password" required>

            <label for="password">Confirm New Password: </label>
            <input type="password" class="login_input" name="con_password" required>

            <button type='submit'>Change Password</button>
        </form>
    </div>

    <a href='MAIN_page.php'><button>Return to Main Menu</button></a><br>

    <?php
    if (isset($_POST['new_password'])){
        $result = $account->updatePassword($_SESSION['email'], $_POST['old_password'], $_POST['new_password'], $_POST['con_password']);
        if ($result === false)
            echo "<label style='color: red;'>An unexpected error occurred.</label>";
        else if ($result === 1)
            echo "<label style='color: red;'>Wrong password.</label>";
        else if ($result === 2)
            echo "<label style='color: red;'>Passwords do not match.</label>";
        else if ($result === 0)
            echo "<label>Password updated successfully!</label>";
        
    }
    ?>

    <script src="script.js"></script>
</body>
</html>