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
session_start();
?> 

<header class="taskbar"></header>

<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
<h1>Bio: <?php echo $_SESSION['description']; ?> </h1>

<div>
    <h1>Restaurant</h1>
    <p>Address: One Archers Place, 2311 Taft Ave, 
        Malate, Manila, 1004 Metro Manila
        <br>
        Number: 111-1111
        <br>
        Operating Hours: 10:00 AM - 8:00 PM Everyday
    </p>
</div>

<!-- Main page div -->
<div id="mainpage">
    <main>
        
        <?php if (strcmp($_SESSION['account_type'], "regular") == 0){
            //User account functions
            echo "<button class='mainstyle' onclick='toggle(review_restaurant); toggle(mainpage)'>Review the restaurant</button><br>
                  <button class='mainstyle' onclick='toggle(review_dish); toggle(mainpage)'>Review a dish</button><br>";
        } else if (strcmp($_SESSION['account_type'], "business") == 0){
            //Business account functions
            echo "<button class='mainstyle' onclick='toggle(dishes); toggle(mainpage)'>Dishes [SERVERSIDE]</button><br>";
            echo "<button class='mainstyle' onclick='toggle(brr); toggle(mainpage)' style='height: auto;'>Sort Reviews of your<br>Account & Dishes</button><br>";
        }?>

        <!-- Any account functions -->
        <button class="mainstyle" onclick="toggle(profile); toggle(mainpage)">Account Settings</button><br>
        <button class="mainstyle" onclick="toggle(search); toggle(mainpage)">Search Account</button><br>
        <button class="mainstyle" onclick="window.location.href='index.php'">Logout</button><br>
    </main>
</div>

<!--Review Restaurant div-->
<div id="review_restaurant" style="display: none;">
    <main>
        <form action="FUNC_RR.php" method="get">
            <button class="mainstyle" type="submit" name="action" value="create">Review the Restaurant</button><br>
            <button class="mainstyle" type="submit" name="action" value="list">List Restaurant Reviews</button><br>
            <button class="mainstyle" type="submit" name="action" value="update_delete" style="height: auto;">Update/Delete<br>Own Restaurant Reviews</button><br>
            <button class="mainstyle" type="submit" name="action" value="search">Search Restaurant Reviews</button><br>
            <button class="mainstyle" type="submit" name="action" value="report" style="height: auto;">Restaurant Reviews<br>Monthly Report</button><br>
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

<!--Reviews Business Side-->
<div id="brr" style="display: none;">
    <main>
        <form action="XMLAscMP_RR.php"><button type="submit" class="mainstyle" style="height: auto;">Ascending<br>Restaurant Reviews</button></form>
        <form action="XMLDescMP_RR.php"><button type="submit" class="mainstyle" style="height: auto;">Descending<br>Restaurant Reviews</button></form>
        <form action="XMLAscMP.php"><button type="submit" class="mainstyle">Ascending Dish Reviews</button></form>
        <form action="XMLDescMP.php"><button type="submit" class="mainstyle">Descending Dish Reviews</button></form>

        <button onclick="toggle(brr); toggle(mainpage)">Return to Main Menu</button><br>
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

<!--Search Users div-->
<div id="search" style="display: none;">
    <main>
        <form action="FUNC_Search.php" method="get">
            <button class="mainstyle" type="submit" name="action" value="search_users">Search All Users</button><br>

        <button onclick="toggle(search_users); toggle(mainpage)">Return to Main Menu</button><br>
    </main>
</div>

<script src="script.js"></script>
</body>
</html>
