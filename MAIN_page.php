<!DOCTYPE html>
<html>
<head>
    <title>Restaurant</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
/** 
// Include necessary PHP files and configurations

// Assuming the user_management.php file is included
include_once 'user_management.php';

// Instantiate the profile class
$P = new profile();

// Retrieve the username from the session
session_start();
$loggedInUser = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : '';
$P->username = $loggedInUser;

// Get bio from the profile
$bio = $P->getBio();*/
?> 

<header class="taskbar"></header>
<!--
<h1>Welcome, <?php echo $loggedInUser; ?>!</h1>
<h1>Bio: <?php echo $bio; ?> </h1>

<div>
    <h1>Restaurant</h1>
    <p>Address: One Archers Place, 2311 Taft Ave, 
        Malate, Manila, 1004 Metro Manila
        <br>
        Number: 111-1111
        <br>
        Operating Hours: 10:00 AM - 8:00 PM Everyday
    </p>
</div>-->

<style>
    .mainstyle {
        width: 250px; 
        height: 40px; 
        padding: 10px; 
        font-size: 16px;    
        margin-bottom: 10px; 
        cursor: pointer; 
        border: none; 
        background-color: #52bd52; /
        color: #fff; 
        border-radius: 5px; 
    }
    .mainstyle:hover {
        background-color: #3c6444; 
    }

    .button-container {
        display: flex;
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
    }
</style>

<!-- Main page div -->
<div id="mainpage">
    <main>
        <!-- User account functions -->
        <button class="mainstyle" onclick="toggle(review_restaurant); toggle(mainpage)">Review the restaurant</button><br>
        <button class="mainstyle" onclick="toggle(review_dish); toggle(mainpage)">Review a dish</button><br>

        <!-- Business account functions -->
        <button class="mainstyle" onclick="toggle(dishes); toggle(mainpage)">Dishes [SERVERSIDE]</button><br>

        <!-- Any account functions -->
        <button class="mainstyle" onclick="toggle(profile); toggle(mainpage)">Account Settings</button><br>
        <button class="mainstyle" onclick="toggle(search_account); toggle(mainpage)">Search Account</button><br>
        <button class="mainstyle" onclick="window.location.href='index.php'">Logout</button><br>
    </main>
</div>

<!--Review Restaurant div-->
<div id="review_restaurant" style="display: none;">
    <main>
        <form action="FUNC_RR.php" name="review" method="get">
            <input type="hidden" name="create" value="create">
            <button type="submit">Review the Restaurant</button>
        </form>

        <form action="FUNC_RR.php" method="get">
            <input type="hidden" name="list" value="list">
            <button type="submit">List Restaurant Reviews</button>
        </form>

        <form action="FUNC_RR.php" method="get">
            <input type="hidden" name="update" value="update">
            <button type="submit">Update Restaurant Reviews</button>
        </form>

        <form action="FUNC_RR.php" method="get">
            <input type="hidden" name="delete" value="delete">
            <button type="submit">Delete Restaurant Reviews</button>
        </form>

        <form action="FUNC_RR.php" method="get">
            <input type="hidden" name="action" value="view">
            <button type="submit">View Restaurant Reviews</button>
        </form>

        <form action="FUNC_RR.php" method="get">
            <input type="hidden" name="search" value="search">
            <button type="submit">Search Restaurant Reviews</button>
        </form>

        <form action="FUNC_RR.php" method="get">
            <input type="hidden" name="report" value="report">
            <button type="submit">Restaurant Reviews Monthly Report</button>
        </form>

        <button onclick="toggle(review_restaurant); toggle(mainpage)">Return to Main Menu</button><br>
    </main>
</div>

<!--Review dish div-->
<div id="review_dish" style="display: none;">
    <main>
        
        <form action="FUNC_DR.php" method="get">
            <input type="hidden" name="action" value="create">
            <button class="mainstyle" onclick="handleButtonClick('create')">Create a Dish Review</button>
        </form>

        <form action="FUNC_DR.php" method="get">
            <input type="hidden" name="action" value="view">
            <button onclick="handleButtonClick('view')">View, Update, or Modify Dish Review</button>
        </form>

        <form action="FUNC_DR.php" method="get">
            <input type="hidden" name="action" value="search">
            <button onclick="handleButtonClick('search')">Search a Dish Review</button>
        </form>

        <button onclick="toggle(review_dish); toggle(mainpage)">Return to main menu</button><br>
    </main>
</div>

<!--Dishes div-->
<div id="dishes" style="display: none;">
    <main>
        <form action="FUNC_Dish.php" method="get">
            <input type="hidden" name="action" value="add">
            <button type="submit">Add Dish</button>
        </form>

        <form action="FUNC_Dish.php" method="get">
            <input type="hidden" name="action" value="view">
            <button type="submit">View & Update Dish</button>
        </form>

        <form action="FUNC_Dish.php" method="get">
            <input type="hidden" name="action" value="search">
            <button type="submit">Search Dish</button>
        </form>

        <form action="FUNC_Dish.php" method="get">
            <input type="hidden" name="action" value="delete">
            <button type="submit">Delete Dish</button>
        </form>

        <button onclick="toggle(dishes); toggle(mainpage)">Return to Main Menu</button><br>
    </main>
</div>

<!--Profile div-->
<div id="profile" style="display: none;">
    <main>
        <form action="FUNC_Profile.php" method="get">
            <input type="hidden" name="action" value="username">
            <button type="submit">Edit Username</button>
        </form>

        <form action="FUNC_Profile.php" method="get">
            <input type="hidden" name="action" value="bio">
            <button type="submit">Edit Bio</button>
        </form>

        <form action="FUNC_Profile.php" method="get">
            <input type="hidden" name="action" value="number">
            <button type="submit">Edit Number</button>
        </form>

        <button onclick="toggle(profile); toggle(mainpage)">Return to Main Menu</button><br>
    </main>
</div>

<!--Search Account div-->
<div id="search_account" style="display: none;">
    <main>
        <form action = "FUNC_Search.php"> 
            <label for="gender">Gender: </label>
            <select id="gender" name="gender">  
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                 <option value="Non-binary">Non-binary</option>
                <option value="Prefer not to say">Prefer not to say</option> 
            </select>
            <br>
            <button onclick="">Search Account</button>
        </form>
        <button onclick="toggle(search_account); toggle(mainpage)">Return to Main Menu</button>
    </main>
</div>

<script src="script.js"></script>
</body>
</html>