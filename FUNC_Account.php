<?php
    include_once 'BE_Account.php';
    include_once 'BE_Restaurant.php';
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
    <?php session_start();?>
    <br><div class="textbox_border_nf">
        <form class="textbox" id="acc_details" action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <h3>Edit Account Details</h3>

            <label for="firstname">First Name: </label>
            <input type="text" class = "login_input" name="first_name" required style="width: 45%;" value="<?php echo $_SESSION['first_name'];?>">
                    
            <label for="middle_initial">Middle Initial: </label>
            <input type="text" class = "login_input" name="middle_initial" maxlength = "1" required style="width: 10%;" value="<?php echo $_SESSION['middle_initial'];?>">
                    
            <label for="last_name">Last Name: </label>
            <input type="text" class = "login_input" name="last_name" required style="width: 45%;" value="<?php echo $_SESSION['last_name'];?>">

            <label for="gender">Gender: </label>
                <select id="gender" name="gender" class = "login_input" style="width: 45%;">  
                    <option value="male" <?php if (strcmp("male", $_SESSION['gender']) == 0) echo "selected";?>>Male</option>
                    <option value="female" <?php if (strcmp("female", $_SESSION['gender']) == 0) echo "selected";?>>Female</option>
                    <option value="non-binary" <?php if (strcmp("non-binary", $_SESSION['gender']) == 0) echo "selected";?>>Non-binary</option>
                    <option value="unknown" <?php if (strcmp("unknown", $_SESSION['gender']) == 0) echo "selected";?>>Prefer not to say</option> 
                </select>

            <label for="birthday">Birthday: </label>
            <input type="date" class = "login_input" name="birthday" style="width: 45%" required value="<?php echo $_SESSION['birthday'];?>">

            <label for="email">Email: </label>
            <input type="email" name="email" class="login_input" required value="<?php echo $_SESSION['email']?>">

            <label for="username">Username: </label>
            <input type="text" class = "login_input" name="username" required value="<?php echo $_SESSION['username']?>">

            <label for="bio">Bio: </label>
            <textarea class='login_input' name='bio' rows='5' cols='50'><?php echo $_SESSION['bio'];?></textarea>

            <br><label for="password">Confirm changes with password: </label>
            <input type="password" class="login_input" name="password" required>

            <button type='submit'>Submit</button>
        </form>
    </div>

    <a href='FUNC_Password.php'><button>Change Password</button></a>
    <a href='MAIN_page.php'><button>Return to Main Page</button></a><br>

    <?php
    if (isset($_POST['username'])){
        $account = new create_acc();
        if ($account->log_in($_SESSION['email'], $_POST['password'])){
            if ($account->isEmail_taken($_POST['email']) && strcmp($_POST['email'], $_SESSION['email'])){
                echo "<br><label style='color: red;'> Email is already in use</label><br>";
            } else if ($account->isUsernname_Taken($_POST['username'] && strcmp($_POST['username'], $_SESSION['username']))){
                echo "<br><label style='color: red;'> Username already taken</label><br>";
            } else {
                if ($account->updateUser($_POST['first_name'], $_POST['last_name'], $_POST['middle_initial'], $_POST['gender'], $_POST['birthday'], $_POST['email'], $_POST['username'], $_POST['bio'], $_SESSION['user_id'])){
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['first_name'] = $_POST['first_name'];
                    $_SESSION['middle_initial'] = $_POST['middle_initial'];
                    $_SESSION['last_name'] = $_POST['last_name'];
                    $_SESSION['gender'] = $_POST['gender'];
                    $_SESSION['birthday'] = $_POST['birthday'];
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['bio'] = $_POST['bio'];
                    if (strcmp($_SESSION['account_type'], "business"))
                        echo "<label>Updated details!</label>";
                    else {
                        $resto = new resto();
                        $restaurant = $resto->get_resto_list_given_id($_SESSION['resto_id']);
                        if ($resto->modify_resto($restaurant['resto_name'], $restaurant['resto_description'], $_POST['email'], $restaurant['resto_websitelink'], $_SESSION['resto_id']) == 100)
                            echo "<label>Updated details!</label>";
                        else echo "<br><label style='color: red;'>An unexpected error occurred.</label><br>";
                    }
                }
            }
        } else
            echo "<br><label style='color: red;'> Incorrect Password</label><br>";
    }
    ?>

    <script src="script.js"></script>
</body>
</html>