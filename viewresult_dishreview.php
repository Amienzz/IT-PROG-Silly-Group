<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>View a dish review</title>
</head>
<style>
    body {
        text-align: center;
    }

    form {
        display: inline-block;
        text-align: left;
        margin: 20px;
    }

    p {
        color: #666;
    }

    label {
        display: block;
        margin-bottom: 10px;
        color: #333;
    }

    select, textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        background-color: #f8f9fa; 
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
<body>
    <h2>View a dish review</h2>
    <form action="mainpage.php">
        <?php
        // Use PHP logic to fetch and display the dish review details
        // For example:
        $review_id = $_GET['review_id'];
        // Assuming $dr object is available and contains dish review details
        
        if ($dr->viewDishReview($review_id) == 1) {
        ?>
            <label for="review_id">Review ID:</label>
            <textarea id="review_id" name="review_id" readonly><?php echo $dr->review_id; ?></textarea><br>
            <label for="user_name">Username:</label>
            <textarea id="user_name" name="user_name" readonly><?php echo $dr->user_name; ?></textarea><br>
            <label for="dish_name">Dish:</label>
            <textarea id="dish_name" name="dish_name" readonly><?php echo $dr->dish_name; ?></textarea><br>
            <!-- Add more fields here -->
            <button type="submit">Main Menu</button>
            <button type="button" onclick="history.back()">Back</button>
        <?php
        } else {
        ?>
            <p>Unknown error occurred.</p>
        <?php
        }
        ?>
    </form>
    
    <?php
    // Retrieve the username from the session
    session_start();
    $loggedInUser = $_SESSION["loggedInUser"];
    
    if ($dr->user_name === $loggedInUser) {
    ?>
        <form action="update_dishreview.php">
            <button type="submit">Update Dish Review</button>
        </form>

        <form action="delete_dishreview.php">
            <button type="submit">Delete Dish Review</button>
        </form>
    <?php
    }
    ?>
</body>
</html>
