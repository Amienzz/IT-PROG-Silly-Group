<?php
    include 'BE_Dish.php';
    include 'BE_Dish_Review.php';
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Restaurant Reviews</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="taskbar"></header>

    <div id="create_restoreview">
        <select id="rating" name="rating" required>
            <option value="" selected disabled hidden>Select an option</option>
            <option value="Excellent">Excellent</option>
            <option value="Good">Good</option>
            <option value="Average">Average</option>
            <option value="Fair">Fair</option>
            <option value="Poor">Poor</option>

        Write a Review:
        <textarea id="review" name="review" rows="5" cols="60" required></textarea><br>

        <button>Submit</button>

        <br><button onclick="window.location.href='MAIN_page.php'">Return</button>
    </div>

    <div id="view_restoreview" style="display: none;">
        <table>
            <thead>
                <tr>
                    <th>Review ID</th>
                    <th>Username</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Date</th>
                    <th>Modify</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($R->review_idlist); $i++) {
                    ?>
                    <tr>
                        <td><?php echo $R->review_idlist[$i]; ?></td>
                        <td><?php echo $R->user_namelist[$i]; ?></td>
                        <td><?php echo $R->rating_list[$i]; ?></td>
                        <td><?php echo $R->review_textlist[$i]; ?></td>
                        <td><?php echo $R->review_datelist[$i]; ?></td>
                        <td>
                            <?php if ($R->user_namelist[$i] == $loggedInUser) { ?>
                                <a class="update" href="restaurantreview_update.php?i=<?php echo $i; ?>&source=list">Update</a>
                                <a class="delete" href="restaurantreview_delete_processing.php?i=<?php echo $i; ?>&source=list">Delete</a><br>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody> 
        </table>
    </div>

    <div id="update_restoreview" style="display: none;">
        
    </div>

    <div id="delete_restoreview" style="display: none;">
        
    </div>

    <script src="script.js"></script>
</body>
</html>

<?php

    
    if(isset($_POST['A'])) //if the form name is A in the main page this will be executed(updating the dish)
    {

        $dish = new Dish();
        $dish_id = $_POST['dish_id'];
        $dish_price = $_POST['dish_price'];
        $dish_name = $_POST['dish_name'];
        $dish->modify_dish($dish_id, $dish_price, $dish_name);

    }

    if(isset($_POST['B'])) // if the form name is B in the main page this will be executed(adding the dish)
    {
        $dish = new Dish();
        $dish_name = $_POST['dish_name'];
        $dish_price = $_POST['dish_price'];
        $dish_name = $_POST['dish_name'];
        $category = $_POST['category'];
        $resto_id = $_POST['resto_id'];

        $dish->add_dish($dish_name, $dish_price, $category, $resto_id);

    }
    if(isset($_POST['C'])) // if the form name is C in the main page this will be executed(deleting the dish)
    {
        $dish = new Dish();
        $dish_id = $_POST['dish_id'];
        $dish->remove_dish($dish_id);
    }

    if(isset($_POST['D'])) // if the form name is D in the main page this will be executed(show all the dish)
    {
        $dish = new Dish();
        $dish->get_dish_list();
    }
    if(isset($_POST['E'])) // if the form name is D in the main page this will be executed(show the current dish of the user may include all the resto he created and all the dishes in the restos)
    {
        $dish = new Dish();
        $user_id = $_POST['user_id'];
        $dish->get_dish_list_given_dish_category($user_id);
    }


?>

<!-- OLD CODE FOR DISHES

delete_dish_category.html

<!DOCTYPE html>

To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

<html>
    <head>
        <title>delete_dish_category</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
         <form action="delete_dish.jsp">
             <label for="category">Category: </label>
            <select id="category" name="category">
                <option value="Soup">Soup</option>
                 <option value="Salad">Salad</option>
                <option value="Main course">Main course</option>
                <option value="Pasta">Pasta</option> 
                <option value="Sandwiches">Sandwiches</option> 
                <option value="Sides">Sides</option> 
                <option value="Dessert">Dessert</option> 
                <option value="Special">Special</option> 
            </select>
            <input type="submit" value="Submit">
         </form>
        <form action= "edit_dish.html" method="post">
            <button type="submit">Back</button>
     </form>
    </body>
</html>

search_dishes.php

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Search dishes</title>
</head>
<body>
<?php
// Instantiate the dish object
$d = new createReviews.dish();

// Get dish categories
$dish_categories = $d->get_dishCategories();
?>
<form action="searchresult_dishes.php" method="post">
    <label for="cb1">Dish Category:</label>
    <input type="checkbox" id="cb1" name="cb1" onclick="toggleInput('search_dishCategory', 'cb1')" value="on">
    <select id="search_dishCategory" name="search_dishCategory" class="hidden">
        <?php foreach ($dish_categories as $dish_category): ?>
            <option value="<?= $dish_category ?>"><?= $dish_category ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label for="cb2">Price range:</label>
    <input type="checkbox" id="cb2" name="cb2" onclick="toggleInput('upload_date_range', 'cb2')" value="on">
    <div id="upload_date_range" class="hidden">
        Format [xxx.xx]<br>
        Below:
        <input type="text" id="price_ceiling" name="price_ceiling" pattern="[0-9]*\.[0-9]{2}" title="price_ceiling" size="4"><br>
        Above:
        <input type="text" id="price_floor" name="price_floor" pattern="[0-9]*\.[0-9]{2}" title="price_floor" size="4"><br>
    </div><br>
    <button type="submit">Search dish</button>
</form>

<br>

<a href="mainpage.php">Return to main menu</a>

<script>
    function toggleInput(inputId, checkboxId) {
        var inputField = document.getElementById(inputId);
        var checkbox = document.getElementById(checkboxId);

        inputField.style.display = (checkbox.checked) ? 'block' : 'none';
        inputField.required = checkbox.checked;
    }
</script>
</body>
</html>

view_dishes.php

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>View dish</title>
    <style>
        .hidden {
            display: none;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            text-decoration: none;
            color: #fff;
            background-color: #5dd55d;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #2aa22a;
        }

        select {
            width: 50%;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<?php
// Instantiate the dish object
$d = new createReviews.dish();

// Get dish names and ids
$dish_names = $d->get_dishList();
$dish_ids = $d->get_dishIds();
?>
<form action="viewresult_dishes.php" method="post">
    <label for="view_dish">View dish:  </label>
    <select id="view_dish" name="view_dish">
        <?php foreach ($dish_ids as $index => $dish_id): ?>
            <option value="<?= $dish_id ?>"><?= $dish_names[$index] ?></option>
        <?php endforeach; ?>
    </select><br>
    <button type="submit">View dish</button>
</form>
<a href="mainpage.php">Return to main menu</a>
</body>
</html>

add_dish.html

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="add_dish_process.jsp">
        <label for="new_dish">Dish name:</label>
        <input type="text" id="new_dish" name="new_dish" required><br>
        
        <label for="new_dish">Dish Price:</label>
        <input type="text" id="dish_price" name="dish_price" required pattern="[0-9]+(\.[0-9]+)?" maxlength="11" title="Please enter numbers only (you can use decimals)">
        <br>
        
        <label for="category">Category: </label>
            <select id="category" name="category">
                <option value="Soup">Soup</option>
                <option value="Salad">Salad</option>
                <option value="Main course">Main course</option> 
                <option value="Pasta">Pasta</option> 
                <option value="Sandwiches">Sandwiches</option> 
                <option value="Sides">Sides</option> 
                <option value="Dessert">Dessert</option> 
                <option value="Special">Special</option> 
            </select>
        <br>
        <input type="submit" value="Submit">
        <a href="edit_dish.html">BACK</a><br>
        
  
    </form>
    </body>
</html>



