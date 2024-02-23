<?php
include 'BE_Dish.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
    $dish = new dish();
    //$dish->add_dish("Adobo", 100, "Drinks", 5);
    //$dish->remove_dish(4);
    //$dish->add_dish("Sinigang", 100, "main", 5);
    //$dish->add_dish("Adobo", 100, "side", 5);
    //$dish->modify_dish(5, 200000, "Adobo");
    

    $data = $dish->get_dish_list();
    foreach($data as $row)
    {
        echo $row['dish_id'] . '<br>';
        echo $row['dish_name'] . '<br>';
        echo $row['dish_price'] . '<br>';
        echo $row['dish_category'] . '<br>';
        echo $row['resto_id'] . '<br>';
    }

    $data2 = $dish->get_dish_list_given_id(6);
    echo $data2['dish_id'] . '<br>';


    $data3 = $dish->get_dish_list_given_dish_category("main"); //given dish category will return all dish that is main
    foreach($data3 as $row)
    {
        echo $row['dish_id'] . '<br>';
        echo $row['dish_name'] . '<br>';
        echo $row['dish_price'] . '<br>';
        echo $row['dish_category'] . '<br>';
        echo $row['resto_id'] . '<br>';
    }    



?>
</body>
</html>