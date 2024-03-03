<?php
    include 'BE_RestaurantReviews.php';
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
    <h2>Review a Restaurant!</h2>
        <label for="restaurant_name">Restaurant Name:</label>
        <input type="text" id="restaurant_name" name="restaurant_name" required>
        <br>

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

    <?php
    //FOR THE PROCESSING
    if(isset($_POST['A'])) // if the form name is A in the main page this will be executed(updating the review)
    {
        $resto_review = new RestaurantReviews();
        $resto_review_id = $_POST['resto_review_id']; //the name of the input field in the form
        $resto_review_overall_rating = $_POST['resto_review_overall_rating'];
        $resto_review_text = $_POST['resto_review_text'];

        $resto_review->modify_resto_reviews($resto_review_id, $resto_review_overall_rating, $resto_review_text);
    }

    elseif(isset($_POST['B'])) // if the form name is B in the main page this will be executed(adding the review)
    {
        $resto_review = new RestaurantReviews();
        $resto_id = $_POST['resto_id'];
        $user_id = $_POST['user_id'];
        $resto_review_overall_rating = $_POST['resto_review_overall_rating'];
        $resto_review_text = $_POST['resto_review_text'];

        $resto_review->add_resto_reviews($resto_id, $user_id, $resto_review_overall_rating, $resto_review_text);
        
    }
    elseif(isset($_POST['C'])) // if the form name is C in the main page this will be executed(deleting the review)
    {
        $resto_review = new RestaurantReviews();
        $resto_review_id = $_POST['resto_review_id'];

        $resto_review->delete_resto_reviews($resto_review_id);
    }

    elseif(isset($_POST['D'])) // if the form name is D in the main page this will be executed(show all the CURRENTLY LOGIN USER REVIEW on restaurant)
    {
        $resto_review = new RestaurantReviews();
        $user_id = $_POST['user_id'];
        
        $resto_review->get_resto_review_given_user_id($user_id);
    }
    elseif(isset($_POST['E'])) // if the form name is D in the main page this will be executed(SHOWS ALL THE USER REVIEW on restaurant)
    {
        $resto_review = new RestaurantReviews();
        $user_id = $_POST['user_id'];
        
        $resto_review->get_resto_review_given_user_id($user_id);
    }
    elseif(isset($_POST['F'])) // gets the list of the restos available<this should be used to show what the user can rate>
    {
        $resto = new resto();
        $resto->get_resto_list();
    }
    elseif(isset($_POST['G']))
    {
        $resto_review = new RestaurantReviews(); // gets a specific review given the review_id
        $resto_id = $_POST['resto_id'];
        $resto_review->get_resto_review_given_resto_id($resto_id);
    }
    ?>

</body>
</html>