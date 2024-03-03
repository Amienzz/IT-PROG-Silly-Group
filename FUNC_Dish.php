<?php
    include 'BE_Dish.php';
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