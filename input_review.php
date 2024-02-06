<!DOCTYPE html>
<html>
<head>
    <title>Create a dish review</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <h2>Create a dish review</h2>

    <form action="review_dish.php" method="POST">
        <!--Dynamic dropdown to select a dish to rate-->
        <label for="selectDish">Select a dish to rate: </label>
        <select id="selectDish" name="selectDish" required>
            <option value="">Select an option</option>
            <?php
            // Add dynamic dish options using your PHP logic here
            // For example:
            $dish_names = array("Dish 1", "Dish 2", "Dish 3");
            $dish_ids = array(1, 2, 3);
            for ($i = 0; $i < count($dish_ids); $i++) {
                echo "<option value='$dish_ids[$i]'>$dish_names[$i]</option>";
            }
            ?>
        </select>
        <br><br><br>

        <!--Dropdowns to select ratings-->
        <!-- Add dynamic options using your PHP logic here -->

        <label for="selectOverallRating">Select your overall rating for the dish: </label>
        <select id="selectOverallRating" name="selectOverallRating" required>
            <option value="">Select an option</option>
            <option value="5">Very Satisfied</option>
            <option value="4">Satisfied</option>
            <option value="3">Neutral</option>
            <option value="2">Dissatisfied</option>
            <option value="1">Very Dissatisfied</option>
        </select>
        <br>

        <!--Text input for the review-->
        <label for="inputReview">Review: </label>
        <input type="text" id="review_id" name="review_text" style="width: 300px; height:50px;" required><br>

        <!--Button to initiate the review upload-->
        <button type="submit">Submit</button>
    </form>

    <br>
    <form action="mainpage.php">
        <button type="submit">Return to main menu</button>
    </form>
</body>
</html>
