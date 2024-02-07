<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Update Dish Review</title>
    <style>
        body {
            text-align: center;
        }

        form {
            display: inline-block;
            text-align: left;
            margin: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #32a852;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="button"] {
            margin-right: 10px;
        }
    </style>
</head>
<body>
<?php
// Instantiate the dish review object
$dr = new createReviews.dish_review();

// Update dish review and display appropriate message
$dr->overall_rating = intval($_POST["selectOverallRating"]);
$dr->quality_rating = intval($_POST["selectQualityRating"]);
$dr->price_rating = intval($_POST["selectPriceRating"]);
$dr->review_text = $_POST["review_text"];

if ($dr->updateDishReview()) {
    echo "<h1>Review updated!</h1>";
    if ($dr->viewDishReview($dr->review_id) == 1) {
        echo "Review ID: <textarea id='review_id' name='review_id' readonly>{$dr->review_id}</textarea><br>";
        echo "Username: <textarea id='user_name' name='user_name' readonly>{$dr->user_name}</textarea><br>";
        echo "Dish: <textarea id='dish_name' name='dish_name' readonly>{$dr->dish_name}</textarea><br>";
        echo "Dish category: <textarea id='dish_category' name='dish_category' readonly>{$dr->dish_category}</textarea><br>";
        echo "Uploaded by: <textarea id='time_of_upload' name='time_of_upload' readonly>{$dr->time_of_upload}</textarea><br><br>";
        echo "Overall rating: <textarea id='overall_rating' name='overall_rating' readonly>{$dr->overall_rating_text()}</textarea><br>";
        echo "Quality rating: <textarea id='quality_rating' name='quality_rating' readonly>{$dr->quality_rating_text()}</textarea><br>";
        echo "Price rating: <textarea id='price_rating' name='price_rating' readonly>{$dr->price_rating_text()}</textarea><br>";
        echo "Review: <textarea id='review_text' name='review_text' readonly>{$dr->review_text}</textarea><br><br>";
    }
} else {
    echo "<h1>Review upload failed.</h1><br><h2>Try again later.</h2>";
}
?>

<!-- Form to return to main menu -->
<form action="mainpage.jsp" method="post">
    <button type="submit">Return to main menu</button>
</form>

<!-- Form to find another review -->
<form action="view_dishreview.jsp" method="post">
    <button type="submit">Find another review</button>
</form>

</body>
</html>
