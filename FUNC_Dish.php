<?php
    include_once 'BE_Dish.php';
    include_once 'BE_Restaurant.php';
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Dishes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="taskbar"></header>

    <?php
        error_reporting(E_ERROR | E_PARSE);
        
        $Dish = new Dish();
        $Restaurant = new resto();        
        
        if(isset($_GET['action'])){
            $action = $_GET['action'];

            switch($action){
                case 'add':
                    echo "<div class='add_dish'>";
        
                    echo "<form class='column_CRR' method='post' action='".$_SERVER['PHP_SELF']."'>
                            <input type='hidden' name='CRR_result' value='a'>";
                    echo "<h2>Create a Dish!</h2>";
        
                    echo "<label for='dish_name'>Dish Name:</label>";
                    echo "<input type='text' name='dish_name'><br>";
        
                    echo "<label for='dish_price'>Dish Price:</label>";
                    echo "<input type='text' name='dish_price'><br>";
        
                    echo "<label for='dish_category'>Dish Category:</label>";
                    echo "<select name='dish_category'>
                            <option value='main'>Main</option>
                            <option value='side'>Side</option>
                            <option value='dessert'>Dessert</option>
                          </select><br>";
                                        
                    echo "<label for='resto'>Restaurant:</label>";
                    echo "<select name='resto_id'>";
                    $data = $Restaurant->get_resto_list();
                    foreach($data as $Restaurants) {
                        echo "<option value='".$Restaurants['resto_id']."'>".$Restaurants['resto_name']."</option>";
                    }
                    echo "</select><br>";
        
                    echo "<input type='submit' value='Submit'>";
                    echo "</form>";
        
                    echo "<a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                    break;

                case 'update_delete':
                    echo "<div id='update_delete_dish'>";
                    echo "<table><tr>";
                    echo "<th>Dish ID</th>";
                    echo "<th>Dish Price</th>";
                    echo "<th>Dish Category</th>";
                    echo "<th>Actions</th>";

                    $data = $Dish->get_dish_list();
                    foreach($data as $row)
                    {
                        echo "<tr>";
                        echo "<td>" . $Dish->get_dish_list_given_id($row['dish_id'])['dish_name'] . '<br>';
                        echo "<td>". $row['dish_price'] . '<br>';
                        echo "<td>" . $row['dish_category'] . '<br>';

                        echo '<td><form action='.$_SERVER['PHP_SELF'].' method="get">';
                        echo '<input type="hidden" name="update" value="' . $row['dish_id'] . '">';
                        echo '<button type="submit">Update</button>';
                        echo '</form>';

                        echo '<form action='.$_SERVER['PHP_SELF'].' method="get">';
                        echo '<input type="hidden" name="delete" value="' . $row['dish_id'] . '">';
                        echo '<button type="submit">Delete</button>';
                        echo '</form>';
                        
                        echo "</tr>";
                    }
                    echo "</table></div>";
                    echo "<a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                    
                    break;
                case 'search':
                    echo "<div id='search_dish'>";
                    echo "<table><tr>";
                    echo "<th>Dish ID</th>";
                    echo "<th>Dish Name</th>";
                    echo "<th>Dish Price</th>";
                    echo "<th>Dish Category</th>";
                
                    $data = $Dish->get_dish_list();
                    foreach($data as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['dish_id'] . "</td>";
                        echo "<td>" . $row['dish_name'] . "</td>";
                        echo "<td>" . $row['dish_price'] . "</td>";
                        echo "<td>" . $row['dish_category'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table></div>";
                    echo "<a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                    break;
                
            }
        } else if (isset($_POST['CRR_result'])){
            $resto_review = new RestaurantReviews();
            $resto_id = $_POST['resto'];
            //$user_id = $_SESSION['user_id'];
            $resto_review_overall_rating = $_POST['rating'];
            $resto_review_text = $_POST['review'];
        
            //Remove after fixing $_SESSION
            $user_id = 1;

            if ($resto_review->add_resto_reviews($resto_id, $user_id, $resto_review_overall_rating, $resto_review_text) == 100){
                //TODO: Frontend shenanigans
                echo "WORK";
             } else echo "FAIL";
        }
    ?>

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
