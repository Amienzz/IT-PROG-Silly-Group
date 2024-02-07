<?php
// Instantiate the dish object
$D = new createReviews.dish();

// Receive parameters from the request
$v_dish = $_POST["new_dish"];
$v_dish_price = $_POST["dish_price"];
$v_category = $_POST["category"];

// Set parameters to the dish object
$D->dish = $v_dish;
$D->dish_price = floatval($v_dish_price);
$D->category = $v_category;

// Call the method to add the dish
$status = $D->getDish();

// Display appropriate message based on the status
if ($status == 1) {
    echo "<h1>DISH ALREADY ADDED!</h1>";
} else {
    $D->addDish();
    echo "<h1>DISH ADDED!</h1>";
}
?>

<form action="add_dish.html" method="post">
    <button type="submit">BACK</button>
</form>
