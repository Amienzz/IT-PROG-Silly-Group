<?php
include 'BE_RestaurantReviews.php';
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
    $restaurantreviewZ = new RestaurantReviews();
    //$restaurantreviewZ->add_resto_reviews(5, 1, "good", "This is a good restaurant");

    //$restaurantreviewZ->delete_resto_reviews(3);

    //$restaurantreviewZ->modify_resto_reviews(7, "poor", "This is a poor restaurant", );
    $data = $restaurantreviewZ->get_resto_review_list();

    foreach($data as $row)
    {
        echo $row['resto_id'] . '<br>';
        echo $row['user_id'] . '<br>';
        echo $row['resto_review_overall_rating'] . '<br>';
        echo $row['resto_review_text'] . '<br>';
        echo $row['resto_review_date'] . '<br>';
    }

    $data2 = $restaurantreviewZ->get_resto_review_given_id(7); // resto review given id
    echo $data2['resto_id'] . '<br>';


    $data3 = $restaurantreviewZ->get_resto_review_given_resto_id(4); // this is the all the ressto review given resto id
    foreach($data3 as $row)
    {
        echo $row['resto_id'] . '<br>';
        echo $row['user_id'] . '<br>';
        echo $row['resto_review_overall_rating'] . '<br>';
        echo $row['resto_review_text'] . '<br>';
        echo $row['resto_review_date'] . '<br>';
    }

    echo "dDJWIDJAWIDJAWDIJAWDAIWJDiji";
    $data4 = $restaurantreviewZ->get_resto_review_given_user_id(1); // this is the all the ressto review given user id
    foreach($data4 as $row)
    {
        echo $row['resto_id'] . '<br>';
        echo $row['user_id'] . '<br>';
        echo $row['resto_review_overall_rating'] . '<br>';
        echo $row['resto_review_text'] . '<br>';
        echo $row['resto_review_date'] . '<br>';
    }






?>
</body>
</html>