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
