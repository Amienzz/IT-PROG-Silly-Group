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
<?php echo $_SESSION['bio'];?>

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
            echo "<button class='mainstyle' onclick='toggle(resto_settings); toggle(mainpage)'>Restaurant Settings</button><br>";
        }?>

        <!-- Any account functions -->
        <form action="FUNC_Account.php"><button class="mainstyle" type="submit">Account Settings</button></form>
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
            <button class="mainstyle" onclick="handleButtonClick('view')" style="height: auto">View, Update, or Modify<br>Dish Review</button>
        </form>

        <form action="FUNC_DR.php" method="get">
            <input type="hidden" name="action" value="search">
            <button class="mainstyle" onclick="handleButtonClick('search')">Search a Dish Review</button>
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
            <input type="hidden" name="action" value="update">
            <button type="submit">Update a Dish</button>
        </form>        

        <form action="FUNC_Dish.php" method="get">
            <input type="hidden" name="action" value="delete">
            <button type="submit">Delete a Dish</button>
        </form>

        <form action="FUNC_Dish.php" method="get">
            <input type="hidden" name="action" value="search">
            <button type="submit">Search for a Dish</button>
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

<!--Restaurant Settings div-->
<div id="resto_settings" style="display: none;">
    <main>
        <form action="FUNC_Resto.php" method="get">
            <button class="mainstyle" type="submit" name="action" value="name">Edit Restaurant Name</button><br>
            <button class="mainstyle" type="submit" name="action" value="email">Edit Restaurant Email</button><br>
            <button class="mainstyle" type="submit" name="action" value="link" style="height: auto;">Edit Restaurant<br>Website Link</button><br>
            <button class="mainstyle" type="submit" name="action" value="description">Edit Restaurant Description</button><br>
        </form>

        <button onclick="toggle(resto_settings); toggle(mainpage)">Return to Main Menu</button><br>
    </main>
</div>

<!--Search Users div-->
<div id="search" style="display: none;">
    <main>
        <form action="FUNC_Search.php" method="get">
            <button class="mainstyle" type="submit" name="action" value="search_users">Search All Users</button><br>

        <button onclick="toggle(search); toggle(mainpage)">Return to Main Menu</button><br>
    </main>
</div>

<script src="script.js"></script>
</body>
</html>
