<?php
    include_once 'BE_RestaurantReviews.php';
    include_once 'BE_Restaurant.php';

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Restaurant Reviews</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="taskbar"></header>

    <div id="create_restoreview">

    <?php
        $resto = new resto();
        $data = $resto->get_resto_list();
        echo "<div class='mainrestodiv'>";
        foreach($data as $row)
        {
            echo "<div class='restodiv'>";
            echo "Name: " . $row['resto_name'] . '<br>';
            echo "description: " . $row['resto_description'] . '<br>';
            echo "email: ". $row['resto_email'] . '<br>';
            echo "website link: " . $row['resto_websitelink'] . '<br>';
            echo "resto id: " . $row['resto_id'] . '<br>';
            echo "</div>";
        }
        echo "</div>";
                
        ?>
        
        <h2>Review a Restaurant!</h2>

        <label for="resto">Choose a Restaurant id:</label>

        <select name="resto" id="resto" required>
            <option value="" selected disabled hidden>Select an option</option>
            <?php
            foreach ($data as $row) {
                echo "<option value='" . $row['resto_id'] . "'>" . $row['resto_id'] . "</option>";
            }
            ?>
            </select>
            <br>
            Rate the restaurant:

        <select id="rating" name="rating" required>
            <option value="" selected disabled hidden>Select an option</option>
            <option value="Excellent">Excellent</option>
            <option value="Good">Good</option>
            <option value="Average">Average</option>
            <option value="Fair">Fair</option>
            <option value="Poor">Poor</option>
        </select>
            </br>
        Write a Review:
        <textarea id="review" name="review" rows="5" cols="60" required></textarea><br>

        <button>Submit</button>

        <br><button onclick="window.location.href='MAIN_page.php'">Return</button>
    </div>

    <div id="view_restoreview">
        <table>
            <tr>
                <th>resto id</th>
                <th>review id</th>
                <th>overall rating </th>
                <th>description</th>
                <th>Date</th>
            </tr>
            <?php
            $restoreviews = new RestaurantReviews();
            $data = $restoreviews->get_resto_review_list();
            foreach($data as $row)
            {
                echo "<tr>";
                echo "<td> resto id: " . $row['resto_id'] . '<br>';
                echo "<td> user id: " . $row['user_id'] . '<br>';
                echo "<td> overall rating: ". $row['resto_review_overall_rating'] . '<br>';
                echo "<td> description: " . $row['resto_review_text'] . '<br>';
                echo "<td> review date: " . $row['resto_review_date'] . '<br>';
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <div id="update_restoreview">
    <table>
        <tr>
            <th>resto id</th>
            <th>overall rating</th>
            <th>description</th>
            <th>resto review date</th>
            <th>actions</th>
        </tr>
    
    <?php
        $restoreviewsupdate = new RestaurantReviews();
        $data = $restoreviewsupdate->get_resto_review_list();
        foreach($data as $row)
        {
            echo "<tr>";
            echo "<td> resto id: " . $row['resto_id'] . '<br>';
            echo "<td> overall rating: ". $row['resto_review_overall_rating'] . '<br>';
            echo "<td> description: " . $row['resto_review_text'] . '<br>';
            echo "<td> review date: " . $row['resto_review_date'] . '<br>';


            echo '<td><form action="FUNC_RR.php" method="post">';
            echo '<input type="hidden" name="A" value="' . $row['resto_review_id'] . '">';
            echo '<button type="submit" name="Update">Update</button>';
            echo '</form>';

            echo '<form action="FUNC_RR.php" method="post">';
            echo '<input type="hidden" name="A" value="' . $row['resto_review_id'] . '">';
            echo '<button type="submit" name="Delete">Delete</button>';
            echo '</form>';

            
            echo "</tr>";
        }
    ?>
    </table>
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