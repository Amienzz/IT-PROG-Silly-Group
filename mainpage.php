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

<!--Main page div-->
<div id="mainpage">
    <main>
        <!--User account functions-->
        <button onclick="toggle(review_restaurant); toggle(mainpage)">Review the restaurant</button><br>
        <button onclick="toggle(review_dish); toggle(mainpage)">Review a dish</button><br>

        <!--Business account functions-->
        <button onclick="toggle(dishes)">Dishes</button><br>

        <!--Any account functions-->
        <button onclick="toggle(review_dish); toggle(mainpage)">Account Settings</button><br>
        <button onclick="toggle(search_account); toggle(mainpage)">Search Account</button><br>
        <button onclick="window.location.href='index.html'">Logout</button><br>                                                 <!--Fix functionality here-->
    </main>
</div>

<!--Review Restaurant div-->
<div id="review_restaurant" style="display: none;">
    <main>
        <form action="restaurantreview_functions.php" method="get">
            <input type="hidden" name="action" value="create">
            <button type="submit">Review the Restaurant</button>
        </form>

        <form action="restaurantreview_functions.php" method="get">
            <input type="hidden" name="action" value="list">
            <button type="submit">List Restaurant Reviews</button>
        </form>

        <form action="restaurantreview_functions.php" method="get">
            <input type="hidden" name="action" value="update">
            <button type="submit">Update Restaurant Reviews</button>
        </form>

        <form action="restaurantreview_functions.php" method="get">
            <input type="hidden" name="action" value="delete">
            <button type="submit">Delete Restaurant Reviews</button>
        </form>

        <form action="restaurantreview_functions.php" method="get">
            <input type="hidden" name="action" value="view">
            <button type="submit">View Restaurant Reviews</button>
        </form>

        <form action="restaurantreview_functions.php" method="get">
            <input type="hidden" name="action" value="search">
            <button type="submit">Search Restaurant Reviews</button>
        </form>

        <form action="restaurantreview_functions.php" method="get">
            <input type="hidden" name="action" value="report">
            <button type="submit">Restaurant Reviews Monthly Report</button>
        </form>

        <button onclick="toggle(review_restaurant); toggle(mainpage)">Return to Main Menu</button><br>
    </main>
</div>

<!--Review dish div-->
<div id="review_dish" style="display: none;">
    <main>
        <button onclick="window.location.href='input_review.php'">Create a dish review</button><br>
        <button onclick="window.location.href='view_dishreview.php'">View, Update, and Delete a review</button><br>
        <button onclick="window.location.href='search_review.php'">Search a dish review</button><br>
        <button onclick="toggle(review_dish); toggle(mainpage)">Return to main menu</button><br>
    </main>
</div>

<!--Dishes div-->
<div id="dishes" style="display: none;">
    <main>
        <button onclick="window.location.href='add_dish.html'">Add Dish</button>
        <button onclick="window.location.href='view_dish.jsp'">View & Update Dish</button>
        <button onclick="window.location.href='search_dishes.jsp'">Search Dish</button>
        <button onclick="window.location.href='delete_dish_category.html'">Delete Dish</button><br>
        <button onclick="toggle(review_dish); toggle(mainpage)">Return to Main Menu</button>
    </main>
</div>

<!--Profile div-->
<div id="profile" style="display: none;">
    <main>
        <button onclick="window.location.href='edit_username.html'">Edit Username</button>
        <button onclick="window.location.href='edit_bio.html'">Edit Bio</button>
        <button onclick="window.location.href='edit_number.html'">Edit Number</button>
        <button onclick="toggle(profile); toggle(mainpage)">Return to Main Menu</button>
    </main>
</div>

<!--Search Account div-->
<div id="search_account" style="display: none;">
    <main>
        <form action = "process_view.jsp">                                                                  <!--Fix input here-->
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