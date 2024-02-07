<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>delete_dish</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 50px;
        }

        form {
            display: inline-block;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        select {
            padding: 8px;
            font-size: 16px;
            width: 200px;
        }

        input[type="submit"] {
            background-color: #5dd55d;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #2aa22a;
        }
    </style>
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
