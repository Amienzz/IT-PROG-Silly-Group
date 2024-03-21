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
        
            <?php
                if(isset($_POST['login'])){
                    //Verify login credentials; if valid then redirect to main page and store login into $_SESSION variable, otherwise redirect back here
                    
                    //Only for testing purposes, put inside proper conditional parameters
                    header("Location: MAIN_page.php");
                    exit;
                }
            ?>

            <button onclick="hide(this); show(create_account)">Don't have an account? Sign up now!</button>  
        </div>

        <!--Create account div-->
        <div id="create_account" style="display: none;">
            <form class="textbox_border" method="post">
                <h3>Create an account!</h3>

                <div class="textbox">
                    <h4>Personal details</h4>

                    <label for="firstname">First Name: </label>
                    <input type="text" class = "login_input" id="firstname" name="firstname" required>
                    
                    <label for="middle_initial">Middle Initial: </label>
                    <input type="text" class = "login_input" id="middle_initial" name="middle_initial" maxlength = "1" required>
                    
                    <label for="last_name">Last Name: </label>
                    <input type="text" class = "login_input" id="last_name" name="last_name" required>
                    
                    <label for="birthday">Birthday: </label>
                    <input type="date" class = "login_input" id="birthday" name="birthday" style="width: 45%" required>
                    
                    <label for="gender">Gender: </label>
                    <select id="gender" name="gender" class = "login_input" style="width: 45%;">  
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Non-binary">Non-binary</option>
                        <option value="Prefer not to say">Prefer not to say</option> 
                    </select>

                    <label for="email">Email: </label>
                    <input type="email" id="email" name="email" class="login_input" required>

                    <label for="email">Email: </label>
                    <input type="email" id="email" name="email" class="login_input" required>

                    <br><h4>Profile details</h4>

                    <label for="username">Username: </label>
                    <input type="text" class = "login_input" id="username" name="username" required>

                    <label for="password">Password: </label>
                    <input type="password" class="login_input" id="password" name="password" required>

                    <label for="account_type">Account type:</label><br>
                    <input type="radio" id="user" name="acc_type" value="user" required>
                    <label for="user">User</label>
                    <input type="radio" id="business" name="acc_type" value="business" required>
                    <label for="business">Business</label>
                </div>
                
                <button type="submit" name="create">Create Account</button>
            </form>

            <?php
                if(isset($_POST['login'])){
                    //Verify login credentials; if valid then redirect to main page and store login into $_SESSION variable, otherwise redirect back here
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    $login_details = new create_acc();

                    if($login_details->log_in($email, $password)){
                        //Store login details in $_SESSION variable

                        header("Location: mainpage.php");
                        exit;
                    }

                    //Only for testing purposes, put inside proper conditional parameters
                    header("Location: MAIN_page.php");
                    exit;
                }
            ?>

            <button onclick="hide(this); show(login)" type="submit" style="background-color: red;">Cancel</button>
        </div>
    </main>

    <script src="script.js"></script>
</body>
</html>