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

    <?php
        error_reporting(E_ERROR | E_PARSE);
        $resto = new resto();
        $restoreviews = new RestaurantReviews();

        if(isset($_GET['action'])){
            $action = $_GET['action'];

            switch($action){
                case 'create':
                    echo "<div class='create_restoreview'>";

                    $data = $resto->get_resto_list();

                    echo "<div class='column_CRR'>
                    <form method='post' action='".$_SERVER['PHP_SELF']."'>
                            <input type='hidden' name='CRR_result' value='a'>";
                    echo "  <h2>Review a Restaurant!</h2>
                            <label for='resto'>Choose a Restaurant:</label>

                            <select name='resto' required style='border: 1px solid #8f8f8f;'>
                                <option value='' selected disabled hidden>Select an option</option>";
                                foreach ($data as $row) {
                                    echo "<option value='".$row['resto_id']."'";
                                    if ($_GET['resto_id'] == $row['resto_id']){
                                        echo " selected";
                                    }
                                    echo ">".$row['resto_name']."</option>";
                                }
                    echo "  </select><br>
                            Rate the restaurant:
                            <select name='rating' required>
                                <option value='' selected disabled hidden>Select an option</option>
                                <option value='Excellent'>Excellent</option>
                                <option value='Good'>Good</option>
                                <option value='Average'>Average</option>
                                <option value='Fair'>Fair</option>
                                <option value='Poor'>Poor</option>
                            </select>

                            <br>
                            Write a Review:
                            <textarea name='review' rows='5' cols='60' required></textarea><br>
                            <button type='submit'>Submit</button>
                        </form><a href='MAIN_page.php'><button>Return to Main Page</button></a></div>";

                    echo "<div class='column_CRR'>";
                    foreach($data as $row){
                        echo "<form action='". $_SERVER['PHP_SELF']. "' class='textbox_border' method='get'><div class='textbox'>";
                        echo "Name: " . $row['resto_name'] . '<br>';
                        echo "Description: " . $row['resto_description'] . '<br>';
                        echo "E-mail: ". $row['resto_email'] . '<br>';
                        echo "Website Link: " . $row['resto_websitelink'] . '<br>';
                        echo "<input type='hidden' name='resto_id' value='". $row['resto_id']. "'>";
                        echo "<button type='submit' name='action' value='create'>Select</button>";
                        echo "</div></form><br>";
                    }
                    echo "</div></div>";
                    break;
                case 'list':
                    echo "<div id='view_restoreview'>";

                    echo "<table><tr>";
                    echo "<th>Restaurant Name</th>";
                    echo "<th>User ID</th>";
                    echo "<th>Rating</th>";
                    echo "<th>Review</th>";
                    echo "<th>Date reviewed</th></tr>";

                    $data = $restoreviews->get_resto_review_list();
                    foreach($data as $row)
                    {
                        echo "<tr>";
                        echo "<td>". $resto->get_resto_list_given_id($row['resto_id'])['resto_name']."</td>";
                        echo "<td>" . $row['user_id'];
                        echo "<td>". $row['resto_review_overall_rating'];
                        echo "<td>" . $row['resto_review_text'];
                        echo "<td>" . $row['resto_review_date'];
                        echo "</tr>";
                    }

                    echo "</table></div>";
                    echo "<a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                    break;
                case 'update_delete':
                    echo "<div id='update_delete_restoreview'>";

                    echo "<table><tr>";
                    echo "<th>Resto ID</th>";
                    echo "<th>Overall Rating</th>";
                    echo "<th>Review</th>";
                    echo "<th>Date</th>";
                    echo "<th>Actions</th></tr>";

                    $data = $restoreviews->get_resto_review_list();
                    foreach($data as $row)
                    {
                        echo "<tr>";
                        echo "<td>" . $resto->get_resto_list_given_id($row['resto_id'])['resto_name'] . '<br>';
                        echo "<td>". $row['resto_review_overall_rating'] . '<br>';
                        echo "<td>" . $row['resto_review_text'] . '<br>';
                        echo "<td>" . $row['resto_review_date'] . '<br>';


                        echo '<td><form action='.$_SERVER['PHP_SELF'].' method="get">';
                        echo '<input type="hidden" name="update" value="' . $row['resto_review_id'] . '">';
                        echo '<button type="submit">Update</button>';
                        echo '</form>';

                        echo '<form action='.$_SERVER['PHP_SELF'].' method="get">';
                        echo '<input type="hidden" name="delete" value="' . $row['resto_review_id'] . '">';
                        echo '<button type="submit">Delete</button>';
                        echo '</form>';
                        
                        echo "</tr>";
                    }

                    echo "</table></div>";
                    echo "<a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                    break;
                case 'search':
                    echo "<div id='search_restoreview'>
                        <h2>Search for reviews</h2><br>
                        <h4>Fill out at least one field. Leave any unknown fields blank.</h4><br>


                        <div style='display: flex; justify-content: center;''>
                            <form action='".$_SERVER['PHP_SELF']."' method='post'>
                                <input type='checkbox' id='cb4' name='cb4' onclick='toggle(search_resto)' value='on'>
                                <label for='cb4'>Restaurant</label>

                                <input type='checkbox' id='cb1' name='cb1' onclick='toggle(search_username)' value='on'>
                                <label for='cb1'>Username</label>

                                <input type='checkbox' id='cb2' name='cb2' onclick='toggle(search_rating)' value='on'>
                                <label for='cb2'>Rating</label>

                                <input type='checkbox' id='cb3' name='cb3' onclick='toggle(search_date)' value='on'> 
                                <label for='Date'>Date</label>

                                <div style='display: flex; flex-wrap: wrap;'>
                                    "; 
                                $data = $resto->get_resto_list();
                                    
                    echo        "<div id='search_resto' class='textbox_border' style='display: none; margin: 20px;'>
                                        Restaurant
                                        <select id='restaurant' name='search_restaurant' class='login_input'>
                                            <option value='' selected disabled hidden>Select an option</option>
                                            ";
                                            
                                            foreach($data as $row){
                                                echo "<option value='". $row['resto_name']. "'>". $row['resto_name']. "</option>";
                                            }
                    echo                "</select>
                                    </div>

                                    <div id='search_username' class='textbox_border' style='display: none; margin: 20px;'>
                                        <label for='cb1'>Username</label><br>
                                        <input type='text' id='username' name='username'>
                                    </div>
                                    
                                    <div id='search_rating' class='textbox_border' style='display: none; margin: 20px;'>
                                        <label for='cb2'>Rating</label><br>
                                        <select id='rating' name='rating' class='login_input'>
                                            <option value='' selected disabled hidden>Select an option</option>
                                            <option value='Excellent'>Excellent</option>
                                            <option value='Good'>Good</option>
                                            <option value='Average'>Average</option>
                                            <option value='Fair'>Fair</option>
                                            <option value='Poor'>Poor</option>
                                        </select>
                                    </div>
                                
                                    <div id ='search_date' class='textbox_border' style='display: none; margin: 20px;'>
                                        <label for='start_date'>Start Date</label><br>
                                        <input type='date' id='start_date' required><br><br>

                                        <label for='end_date'>End Date<label><br>
                                        <input type='date' id='end_date' required><br>
                                    </div>
                                </div>
                                
                                <br> 
                                <button type='submit'>Search</button>
                            </form>
                        </div>
                        
                        </div>
                    ";
                    echo "<a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                    break;
                case 'report':
                    $data = $resto->get_resto_list();

                    echo "<div id='report_restoreview' class='textbox_border'>
                            <form class='textbox' method='post' action='".$_SERVER['PHP_SELF']."'>
                                <input type='hidden' name='RRR_result' value='a'>
                                Select a Restaurant:
                                <select name='restoreview' required>
                                    <option value='' selected disabled hidden>Select an option</option>";
                                    foreach ($data as $row) {
                                        echo "<option value='".$row['resto_id']."'>".$row['resto_name']."</option>";
                                    }
                    echo        "</select><br>
                                <button type='submit'>Search Results</button>
                            </form>
                        </div>";
                    echo "<a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                    break;
            }
        } else if (isset($_GET['update'])){
                $restorev_id = $_GET['update'];
                $review = $restoreviews->get_resto_review_given_id($restorev_id);
                $restaurant = $resto->get_resto_list_given_id($review['resto_id']);

                $rating_values = array("Excellent", "Good", "Average", "Fair", "Poor");

                echo "<div id='update_restoreview' class='textbox_border'>
                            <form class='textbox' method='post' action='".$_SERVER['PHP_SELF']."'>
                                <input type='hidden' name='URR_result' value='".$restorev_id."'>
                                Restaurant: ".$restaurant['resto_name']."<br>
                                Rating: 
                                <select name='rating' requiered>
                                ";
                                foreach($rating_values as $rating){
                                    echo "<option value='".$rating."'";
                                    if (strcmp(strtolower($rating), $review['resto_review_overall_rating']) == 0){
                                        echo "selected";
                                    }
                                    echo ">".$rating."</option>";
                                }               
                echo            "</select><br>
                                Review: <textarea name='review' rows='5' cols='50' required>".$review['resto_review_text']."</textarea><br>
                                <button type='submit'>Update</button>
                            </form>
                      </div>
                     <a href='MAIN_page.php'><button>Return to Main Page</button></a>";
        } else if (isset($_GET['delete'])){
            $resto_review = $restoreviews->get_resto_review_given_id($_GET['delete']);
            $restaurant = $resto->get_resto_list_given_id($resto_review['resto_id']);
            echo "<div class='textbox_border'>
                    <form class='textbox' method='post' action='".$_SERVER['PHP_SELF']."'>
                        <input type='hidden' name='DRR_result' value='".$_GET['delete']."'>
                        Are you sure you want to delete the following review?<br><br>

                        Restaurant: ".$restaurant['resto_name']."<br>
                        Review Date: ".$resto_review['resto_review_date']."<br>
                        Rating: ".$resto_review['resto_review_overall_rating']."<br>
                        Review: ".$resto_review['resto_review_text']."<br>
                        
                        <div><button name='DRR_input' type='submit' value='cancel'>Cancel</button>
                        <button name='DRR_input' type='submit' value='delete' style='background-color: red;' >Delete</button></div>
                    </form>
                  </div>";
        } else if (isset($_POST['CRR_result'])){
            $resto_id = $_POST['resto'];
            //$user_id = $_SESSION['user_id'];
            $resto_review_overall_rating = $_POST['rating'];
            $resto_review_text = $_POST['review'];
        
            //Remove after fixing $_SESSION
            $user_id = 1;

            if ($restoreviews->add_resto_reviews($resto_id, $user_id, $resto_review_overall_rating, $resto_review_text) == 100){
                //TODO: Frontend shenanigans
                echo "WORK";
             } else echo "FAIL";
        } else if (isset($_POST['URR_result'])){
            $restorev_id = $_POST['URR_result'];
            $rating = $_POST['rating'];
            $review = $_POST['review'];

            if ($restoreviews->modify_resto_reviews($restorev_id, $rating, $review) == 100){
                //TODO: Frontend shenanigans
                echo "WORK";
            } else echo "FAIL";
        } else if (isset($_POST['DRR_result'])){
            if (strcmp($_POST['DRR_input'], "delete") == 0){
                if($restoreviews->delete_resto_reviews($_POST['DRR_result']) == 100){
                    //TODO: Frontend shenanigans
                    echo "Deleted!";
                } else echo "FAIL";
            } else {
                header("Location: MAIN_page.php");
            }
        } else if (isset($_POST['RRR_result'])){
            //TODO: Implement report generation
        }
    ?>

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