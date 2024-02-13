<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Delete dish review</title>
</head>
<body>
<?php
// Instantiate the dish review object
$dr = new createReviews.dish_review();

// Delete dish review and display appropriate message
if ($dr->deleteDishReview()) {
    echo "<h1>Dish review deleted successfully!</h1>";
} else {
    echo "<h1>Dish review delete failed</h1>";
}
?>

<form action="view_dishreview.jsp" method="post">
    <button type="submit">Find another review</button>
</form>

<form action="mainpage.jsp" method="post">
    <button type="submit">Return to main menu</button>
</form>
</body>
</html>
