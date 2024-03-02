
<?php
    include 'BE_Dish_Review.php';
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Restaurant Reviews</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="taskbar"></header>

    <div id="create_restoreview">
        <select id="rating" name="rating" required>
            <option value="" selected disabled hidden>Select an option</option>
            <option value="Excellent">Excellent</option>
            <option value="Good">Good</option>
            <option value="Average">Average</option>
            <option value="Fair">Fair</option>
            <option value="Poor">Poor</option>

        Write a Review:
        <textarea id="review" name="review" rows="5" cols="60" required></textarea><br>

        <button>Submit</button>

        <br><button onclick="window.location.href='MAIN_page.php'">Return</button>
    </div>

    <div id="view_restoreview" style="display: none;">
        <table>
            <thead>
                <tr>
                    <th>Review ID</th>
                    <th>Username</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Date</th>
                    <th>Modify</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($R->review_idlist); $i++) {
                    ?>
                    <tr>
                        <td><?php echo $R->review_idlist[$i]; ?></td>
                        <td><?php echo $R->user_namelist[$i]; ?></td>
                        <td><?php echo $R->rating_list[$i]; ?></td>
                        <td><?php echo $R->review_textlist[$i]; ?></td>
                        <td><?php echo $R->review_datelist[$i]; ?></td>
                        <td>
                            <?php if ($R->user_namelist[$i] == $loggedInUser) { ?>
                                <a class="update" href="restaurantreview_update.php?i=<?php echo $i; ?>&source=list">Update</a>
                                <a class="delete" href="restaurantreview_delete_processing.php?i=<?php echo $i; ?>&source=list">Delete</a><br>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody> 
        </table>
    </div>

    <div id="update_restoreview" style="display: none;">
        
    </div>

    <div id="delete_restoreview" style="display: none;">
        
    </div>

    <script src="script.js"></script>
</body>
</html>


<?php

    

    if(isset($_POST['A'])) //if the form name is A in the main page this will be executed(updating the review)
    {

        $dish_review = new Dish_Review();
        $dish_review_id = $_POST['dish_review_id'];
        $dish_overall_rating = $_POST['dish_overall_rating'];
        $dish_quality_rating = $_POST['dish_quality_rating'];
        $dish_price_rating = $_POST['dish_price_rating'];
        $dish_review_text = $_POST['dish_review_text'];

        $dish_review->modify_dish_review($dish_Review_id, $dish_overall_rating, $dish_quality_rating, $dish_price_rating, $dish_review_text);
    }

    if(isset($_POST['B'])) // if the form name is B in the main page this will be executed(adding the review)
    {
        $dish_review = new Dish_Review();
        $dish_id = $_POST['dish_id'];
        $user_id = $_POST['user_id'];
        $dish_overall_rating = $_POST['dish_overall_rating'];
        $dish_quality_rating = $_POST['dish_quality_rating'];
        $dish_price_rating = $_POST['dish_price_rating'];
        $dish_review_text = $_POST['dish_review_text'];
        $dish_review->add_dish_review($dish_id, $user_id, $dish_overall_rating, $dish_quality_rating, $dish_price_rating, $dish_review_text);

    }
    if(isset($_POST['C'])) // if the form name is C in the main page this will be executed(deleting the review)
    {
        $dish_review = new Dish_Review();
        $dish_review_id = $_POST['dish_review_id'];
        $dish_review->delete_dish_review($dish_review_id);

    }

    if(isset($_POST['D'])) // if the form name is D in the main page this will be executed(show all the CURRENTLY LOGIN USER REVIEW on dish
    {

        $dish_review = new Dish_Review();
        $user_id = $_POST['user_id'];
        $dish_review->get_dish_review_given_user($user_id);
    }
    if(isset($_POST['E'])) // if the form name is E in the main page this will be executed(show all the review on dish)
    {

        $dish_review = new Dish_Review();
        $dish_review->get_dish_review_list();
    }

?>
<!-- CODE FOR ALL THE EXISTING CODE:


search_reviews.php

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Search for reviews</title>
    <style>
        .hidden {
            display: none;
        }

        body {
            text-align: left;
        }

        h2, h4 {
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
</head>
<body>
<?php
    // Assume the $dishList object is available and contains dish details
    ?>
    <h2>Search for reviews</h2>
    <h4>Fill out at least one field. Leave any unknown fields blank.</h4>
    <form action="result_review.php" method="get">
        <label for="cb1">Username:</label>
        <input type="checkbox" id="cb1" name="cb1" onclick="toggleInput('user_name', 'cb1')" value="on">
        <input type="text" id="user_name" name="user_name" class="hidden">
        <br><br>
        
        <label for="cb2">Dish:</label>
        <input type="checkbox" id="cb2" name="cb2" onclick="toggleInput('search_dish', 'cb2')" value="on">
        <select id="search_dish" name="search_dish" class="hidden">
            <?php
            foreach ($dishList->get_dishList() as $index => $dish_name) {
                $dish_id = $dishList->get_dishIds()[$index];
                echo "<option value=\"$dish_id\">$dish_name</option>";
            }
            ?>
        </select>
        <br><br>
        
        <label for="cb4">Dish Category:</label>
        <input type="checkbox" id="cb4" name="cb4" onclick="toggleInput('search_dishCategory', 'cb4')" value="on">
        <select id="search_dishCategory" name="search_dishCategory" class="hidden">
            <?php
            foreach ($dishList->get_dishCategories() as $dish_category) {
                echo "<option value=\"$dish_category\">$dish_category</option>";
            }
            ?>
        </select>
        <br><br>
        
        <label for="cb3">Date:</label>
        <input type="checkbox" id="cb3" name="cb3" onclick="toggleInput('upload_date_range', 'cb3')" value="on">
        <div id="upload_date_range" class="hidden">
            Format: YYYY / MM / DD<br><br>
            Start Date: 
            <input type="text" id="start_year" name="start_year" pattern="\d{4}" title="YYYY" size="4"> / 
            <input type="text" id="start_month" name="start_month" pattern="\d{2}" title="MM" size="2"> / 
            <input type="text" id="start_date" name="start_date" pattern="\d{2}" title="DD" size="2"><br>
            End Date: 
            <input type="text" id="end_year" name="end_year" pattern="\d{4}" title="YYYY" size="4"> / 
            <input type="text" id="end_month" name="end_month" pattern="\d{2}" title="MM" size="2"> / 
            <input type="text" id="end_date" name="end_date" pattern="\d{2}" title="DD" size="2">
        </div>
        <br><br>

        <button type="submit">Search</button>
    </form>

    <form action="mainpage.php">
        <button type="submit">Return to main menu</button>
    </form>

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

viewresult_dishreview.php

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


input_review.php

<!DOCTYPE html>
<html>
<head>
    <title>Create a dish review</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
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
