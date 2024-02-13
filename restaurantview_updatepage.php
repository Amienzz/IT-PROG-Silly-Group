<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Update Restaurant Reviews</title>
</head>
<body>
    <?php
    // Include necessary PHP files and configurations

    // Assuming the restaurant_review_mgt.php file is included
    include_once 'restaurant_review_mgt.php';

    // Instantiate the resto_review class
    $R = new resto_review();

    // Start the session
    session_start();

    // Retrieve the username from the session
    $loggedInUser = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : '';

    // Get the restaurant review list
    $R->restaurant_review_list();
    ?>

    <form action="restaurantreview_update.php" method="post">
        <label for="selectReviewID">Select Review ID: </label>
        <select id="review_id" name="i" required>
            <?php
            for ($i = 0; $i < count($R->review_idlist); $i++) {
                if ($R->user_namelist[$i] == $loggedInUser) {
                    ?>
                    <option value ="<?php echo $i; ?>"><?php echo $R->review_idlist[$i]; ?></option>
            <?php } } ?>
        </select>
        <button type="submit">Submit</button>
        <button type="button" onclick="history.back()">Back</button>
    </form>
            
</body>
</html>