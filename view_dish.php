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
