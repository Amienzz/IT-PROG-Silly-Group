<?php
    include_once 'BE_Restaurant.php';
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
         error_reporting(E_ERROR | E_PARSE);
         session_start();
         $resto = new resto();
         $account = new create_acc();
         if (isset($_GET['action'])){
            $action = $_GET['action'];

            switch($action){
                case 'name':
                    echo "<br><div id='restoname' class='textbox_border_nf'>
                            <form action=".$_SERVER['PHP_SELF']." method='post' class='textbox'>
                            <label>Edit Restaurant Name:</label> <br>
                            <textarea class='login_input' name='resto_name' rows='1' cols='50' required>".($resto->get_resto_list_given_id($_SESSION['resto_id']))['resto_name']."</textarea>
                            <label>Confirm change with password</label>
                            <input type='password' class='login_input' name='password'>
                            <button type='submit'>Submit</button>
                            </form>
                         </div><a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                    break;
                case 'email':
                    echo "<br><div id='restoemail' class='textbox_border_nf'>
                            <form action=".$_SERVER['PHP_SELF']." method='post' class='textbox'>
                            <label>Edit Restaurant Email:</label> <br>
                            <input type='email' class='login_input' name='resto_email' value='".$resto->get_resto_list_given_id($_SESSION['resto_id'])['resto_email']."' required>
                            <label>Confirm change with password</label>
                            <input type='password' class='login_input' name='password'>
                            <button type='submit'>Submit</button>
                            </form>
                         </div><a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                    break;
                case 'link':
                    echo "<br><div id='restoemail' class='textbox_border_nf'>
                            <form action=".$_SERVER['PHP_SELF']." method='post' class='textbox'>
                            <label>Edit Restaurant Website:</label> <br>
                            <textarea class='login_input' name='resto_link' rows='1' cols='50' required>".($resto->get_resto_list_given_id($_SESSION['resto_id']))['resto_websitelink']."</textarea>
                            <label>Confirm change with password</label>
                            <input type='password' class='login_input' name='password'>
                            <button type='submit'>Submit</button>
                            </form>
                         </div><a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                    break;
                case 'description':
                    echo "<br><div id='restodesc' class='textbox_border_nf'>
                        <form action=".$_SERVER['PHP_SELF']." method='post' class='textbox'>
                        <label>Edit Restaurant Description:</label> <br>
                        <textarea class='login_input' name='resto_desc' rows='1' cols='50' required>".($resto->get_resto_list_given_id($_SESSION['resto_id']))['resto_description']."</textarea>
                        <label>Confirm change with password</label>
                        <input type='password' class='login_input' name='password'>
                        <button type='submit'>Submit</button>
                        </form>
                    </div><a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                    break;
            }
         } else if (isset($_POST['resto_name'])){
            if ($account->log_in($_SESSION['email'], $_POST['password'])){
                $restaurant = $resto->get_resto_list_given_id($_SESSION['resto_id']);
                if ($resto->modify_resto($_POST['resto_name'], $restaurant['resto_description'], $restaurant['resto_email'], $restaurant['resto_websitelink'], $_SESSION['resto_id']) == 100){
                    echo "<br><div id=restoname_result class='textbox_border_nf'>
                            <form class='textbox' action='MAIN_page.php'>
                                Restaurant name has been updated successfully!<br>
                                New Restaurant name: ".$_POST['resto_name']."<br>
                                <button type='submit'>Return to Main Page</button>
                            </form>
                        </div>";
                } else {
                    echo "<br><label style='color: red;'> An unexpected error occurred.</label><br>
                    <a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                }
            } else {
                echo "<br><label style='color: red;'> Incorrect Password</label><br>
                <a href='MAIN_page.php'><button>Return to Main Page</button></a>";
            }
         } else if (isset($_POST['resto_email'])){
            if ($account->log_in($_SESSION['email'], $_POST['password'])){
                $restaurant = $resto->get_resto_list_given_id($_SESSION['resto_id']);
                if ($resto->modify_resto($restaurant['resto_name'], $restaurant['resto_description'], $_POST['resto_email'], $restaurant['resto_websitelink'], $_SESSION['resto_id']) == 100
                    && $account->updateUser($_SESSION['first_name'], $_SESSION['last_name'], $_SESSION['middle_initial'], $_SESSION['gender'], $_SESSION['birthday'], $_POST['resto_email'], $_SESSION['username'], $_SESSION['bio'], $_SESSION['user_id'])){
                    $_SESSION['email'] = $_POST['resto_email'];
                        echo "<br><div id=restoname_result class='textbox_border_nf'>
                            <form class='textbox' action='MAIN_page.php'>
                                Restaurant email has been updated successfully!<br>
                                New Restaurant email: ".$_POST['resto_email']."<br>
                                <button type='submit'>Return to Main Page</button>
                            </form>
                        </div>";
                } else {
                    echo "<br><label style='color: red;'> An unexpected error occurred.</label><br>
                    <a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                }
            } else {
                echo "<br><label style='color: red;'> Incorrect Password</label><br>
                <a href='MAIN_page.php'><button>Return to Main Page</button></a>";
            }
         } else if (isset($_POST['resto_link'])){
            if ($account->log_in($_SESSION['email'], $_POST['password'])){
                $restaurant = $resto->get_resto_list_given_id($_SESSION['resto_id']);
                if ($resto->modify_resto($restaurant['resto_name'], $restaurant['resto_description'], $restaurant['resto_email'], $_POST['resto_link'], $_SESSION['resto_id']) == 100){
                    echo "<br><div id=restoname_result class='textbox_border_nf'>
                            <form class='textbox' action='MAIN_page.php'>
                                Restaurant website has been updated successfully!<br>
                                New Restaurant link: ".$_POST['resto_link']."<br>
                                <button type='submit'>Return to Main Page</button>
                            </form>
                        </div>";
                } else {
                    echo "<br><label style='color: red;'> An unexpected error occurred.</label><br>
                    <a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                }
            } else {
                echo "<br><label style='color: red;'> Incorrect Password</label><br>
                <a href='MAIN_page.php'><button>Return to Main Page</button></a>";
            }
         } else if (isset($_POST['resto_desc'])){
            if ($account->log_in($_SESSION['email'], $_POST['password'])){
                $restaurant = $resto->get_resto_list_given_id($_SESSION['resto_id']);
                if ($resto->modify_resto($restaurant['resto_name'], $_POST['resto_desc'], $restaurant['resto_email'], $restaurant['resto_websitelink'], $_SESSION['resto_id']) == 100){
                    echo "<br><div id=restoname_result class='textbox_border_nf'>
                            <form class='textbox' action='MAIN_page.php'>
                                Restaurant description has been updated successfully!<br>
                                New Restaurant description: ".$_POST['resto_desc']."<br>
                                <button type='submit'>Return to Main Page</button>
                            </form>
                        </div>";
                } else {
                    echo "<br><label style='color: red;'> An unexpected error occurred.</label><br>
                    <a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                }
            } else {
                echo "<br><label style='color: red;'> Incorrect Password</label><br>
                <a href='MAIN_page.php'><button>Return to Main Page</button></a>";
            }
         }
    ?>

    <script src="script.js"></script>
</body>
</html>