<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>delete_dish</title>
</head>
<body>
<?php
// Instantiate the dish object
$D = new createReviews.dish();

// Receive parameter from the request
$v_category = $_POST["category"];

// Set parameter to the dish object
$D->category = $v_category;

// Get dishes based on the category
$multipleDishes = $D->getDishes();
?>
<form
    <?php if (!empty($multipleDishes)): ?>
        action="delete_dish_process.php"
    <?php else: ?>
        action="delete_dish_category.html"
    <?php endif; ?>
    method="post">

    <label for="dishesDropDown">Select Dish:</label>
    <select name="dishesDropDown" id="dishesDropDown">
        <?php if (!empty($multipleDishes)): ?>
            <?php foreach ($multipleDishes as $md): ?>
                <option value="<?= $md ?>"><?= $md ?></option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="" disabled selected>No dish found in this category.</option>
        <?php endif; ?>
    </select>

    <br>
    <input type="submit" value="Next">
</form>
<form action="delete_dish_category.html" method="post">
    <button type="submit">Back</button>
</form>
</body>
</html>
