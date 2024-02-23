<?php
include 'BE_Dish_Review.php';
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
    $dish_review = new Dish_Review();
    //$dish_review->add_dish_review(6, 1, 5, 5, 5, "This is a good NO dish");
    //$dish_review->add_dish_review(6, 1, 5, 5, 5, "ThisDSA is a good  123dish");
    //$dish_review->add_dish_review(6, 1, 5, 5, 5, "ThisDSA is a good 12333 dish");

    //$dish_review->delete_dish_review(3);
    //$dish_review->modify_dish_review(4, 1, 1, 1, "This is a poor dish");

    $data = $dish_review->get_dish_review_list();
    foreach($data as $row)
    {
        echo $row['dish_review_id'] . '<br>';
        echo $row['dish_id'] . '<br>';
        echo $row['user_id'] . '<br>';
        echo $row['dish_overall_rating'] . '<br>';
        echo $row['dish_quality_rating'] . '<br>';
        echo $row['dish_price_rating'] . '<br>';
        echo $row['dish_review_text'] . '<br>';
        echo $row['dish_time_of_upload'] . '<br>';
    }
    
    $data2 = $dish_review->get_dish_review_given_dish(6);
    foreach($data2 as $row)
    {
        echo $row['dish_review_id'] . '<br>';
        echo $row['dish_id'] . '<br>';
        echo $row['user_id'] . '<br>';
        echo $row['dish_overall_rating'] . '<br>';
        echo $row['dish_quality_rating'] . '<br>';
        echo $row['dish_price_rating'] . '<br>';
        echo $row['dish_review_text'] . '<br>';
        echo $row['dish_time_of_upload'] . '<br>';
    }
    
    $data3 = $dish_review->get_dish_review_list_given_id(4);
    echo $data3['dish_review_id'] . '<br>';

    



?>
</body>
</html>