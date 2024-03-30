<?php
    include_once 'BE_Account.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Rating Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="taskbar"></header>

    <?php
    $account = new create_acc();
    error_reporting(E_ERROR | E_PARSE);
    session_destroy();
    ?>
    <main>
        <!--Login div-->
        <div id="login">
            <form class="textbox_border" method="post">
                <h3>Log in</h3>

                <div class="textbox">
                    <label for="email">Email:</label>
                    <input type="text" class="login_input" id="email" name="email" required>
                    
                    <label for="password">Password:</label>
                    <input type="password" class="login_input" id="password" name="password" required>
                </div>
                    
                <button type="submit" name="login">Login</button>
            </form>
        
            <button onclick="hide(this); show(create_account)">Don't have an account? Sign up now!</button>  
            <?php
                if(isset($_POST['login'])){
                    //Verify login credentials; if valid then redirect to main page and store login into $_SESSION variable, otherwise redirect back here

                    $email = $_POST['email'];
                    $pass = $_POST['password'];

                    if ($account->log_in($email, $pass)){
                        session_start();
                        $data = $account->searchEmail($email); 
                        
                        $_SESSION['email'] = $email;
                        $_SESSION['first_name'] = $data['first_name'];
                        $_SESSION['middle_initial'] = $data['middle_initial'];
                        $_SESSION['last_name'] = $data['last_name'];
                        $_SESSION['gender'] = $data['gender'];
                        $_SESSION['birthday'] = $data['birthday'];
                        $_SESSION['user_id'] = $data['user_id'];
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['bio'] = $data['bio'];
                        $_SESSION['account_type'] = $data['account_type'];
                        
                        header("Location: MAIN_page.php");
                    } else {
                        echo "<p style='color: red;'>Login invalid</p>";
                    }                    
                    exit;
                }
            ?>
        </div>

        <!--Create account div-->
        <div id="create_account" style="display: none;">
            <form class="textbox_border" method="post">
                <h3>Create an account!</h3>

                <div class="textbox">
                    <h4>Personal details</h4>

                    <label for="firstname">First Name: </label>
                    <input type="text" class = "login_input" name="first_name" required>
                    
                    <label for="middle_initial">Middle Initial: </label>
                    <input type="text" class = "login_input" name="middle_initial" maxlength = "1" required>
                    
                    <label for="last_name">Last Name: </label>
                    <input type="text" class = "login_input" name="last_name" required>
                    
                    <label for="birthday">Birthday: </label>
                    <input type="date" class = "login_input" name="birthday" style="width: 45%" required>
                    
                    <label for="gender">Gender: </label>
                    <select id="gender" name="gender" class = "login_input" style="width: 45%;">  
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="non-binary">Non-binary</option>
                        <option value="unknown">Prefer not to say</option> 
                    </select>

                    <label for="email">Email: </label>
                    <input type="email" name="email_c" class="login_input" required>

                    <br><h4>Profile details</h4>

                    <label for="username">Username: </label>
                    <input type="text" class = "login_input" name="username" required>

                    <label for="password">Password: </label>
                    <input type="password" class="login_input" name="password_c" required>

                    <label for="account_type">Account type:</label><br>
                    <input type="radio" id="user" name="acc_type" value="regular" required>
                    <label for="user">User</label>
                    <input type="radio" id="business" name="acc_type" value="business" required>
                    <label for="business">Business</label>
                </div>
                
                <button type="submit" name="create">Create Account</button>
            </form>

            <button onclick="hide(this); show(login)" type="submit" style="background-color: red;">Cancel</button>
            <?php
                if(isset($_POST['create'])){
                    if($account->isEmail_taken($_POST['email_c']) == 0 && $account->isUsernname_Taken($_POST['username']) == 0){
                        $email = $_POST['email_c'];
                        $password = $_POST['password_c'];
                        $firstname = $_POST['first_name'];
                        $middleinitial = $_POST['middle_initial'];
                        $lastname = $_POST['last_name'];
                        $birthday = $_POST['birthday'];
                        $gender = $_POST['gender'];
                        $username = $_POST['username'];
                        $acctype = $_POST['acc_type'];
                        if ($account->register_user($firstname, $lastname, $middleinitial, $gender, $birthday, $email, $username, $password, "", $acctype)){
                            session_start();

                            $_SESSION['email'] = $email;
                            $_SESSION['first_name'] = $firstname;
                            $_SESSION['middle_initial'] = $middleinitial;
                            $_SESSION['last_name'] = $lastname;
                            $_SESSION['gender'] = $gender;
                            $_SESSION['birthday'] = $birthday;
                            $_SESSION['user_id'] = $account->searchEmail($email)['user_id'];
                            $_SESSION['username'] = $username;
                            $_SESSION['bio'] = "";
                            $_SESSION['account_type'] = $acctype;

                            header("Location: MAIN_page.php");
                            exit;
                        } else {
                            echo "<p style='color: red;'>There was an unexpected issue. Please try again.</p>";
                        }
                        exit;
                    } else if ($account->isEmail_taken($_POST['email_c'])){
                        echo "<p style='color: red;'>Email already taken</p>";
                    } else {
                        echo "<p style='color: red;'>Username already taken</p>";
                    }
                    exit;
                }
            ?>
        </div>
    </main>

    <script src="script.js"></script>
</body>
</html>