<?php
    include_once 'BE_RestaurantReviews.php';
    include_once 'BE_Restaurant.php';
    include_once 'BE_Account.php';
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
        session_start();
        $resto = new resto();
        $restoreviews = new RestaurantReviews();
        $account = new create_acc();

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
                    echo "<div id='list_restoreview' class='grid_container'>";
                    $data = $restoreviews->get_resto_review_list();
                    foreach($data as $row)
                    {
                        echo "<div class='grid_item'>
                            <div class='textbox_border'>
                            <div class='textbox'>
                                Restaurant Name: ".$resto->get_resto_list_given_id($row['resto_id'])['resto_name']."<br>
                                Username: ".$account->searchID($row['user_id'])['username']."<br>
                                Date of Review: ".$row['resto_review_date']."
                                Rating: ".ucfirst($row['resto_review_overall_rating'])."<br>
                                Review: ".$row['resto_review_text']."<br>
                            </div></div></div>";
                    }
                    echo "</div><a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                    break;
                case 'update_delete':
                    echo "<div id='update_delete_restoreview' class='grid_container'>";

                    $data = $restoreviews->get_resto_review_list();
                    foreach($data as $row)
                    {
                        if ($_SESSION['user_id'] == $row['user_id']){
                            echo "<div class='grid_item'>
                                    <div class='textbox_border'>
                                        <div class='textbox'>
                                            Restaurant: ".$resto->get_resto_list_given_id($row['resto_id'])['resto_name']."<br>
                                            Date of Review: ".$row['resto_review_date']."<br>
                                            Rating: ".ucfirst($row['resto_review_overall_rating'])."<br>
                                            Review: ".$row['resto_review_text']."<br>

                                            <div class='button_container'>
                                                <form action=".$_SERVER['PHP_SELF']." method='get'>
                                                    <input type='hidden' name='update' value='".$row['resto_review_id']."'>
                                                    <button type='submit'>Update</button>
                                                </form>

                                                <form action=".$_SERVER['PHP_SELF']." method='get'>
                                                    <input type='hidden' name='delete' value='".$row['resto_review_id']."'>
                                                    <button type='submit'>Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                        }
                    }
                    echo "</div>";
                    echo "<a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                    break;
                case 'search':
                    echo "<div id='search_restoreview'>
                        <h2>Search for reviews</h2><br>
                        <h4>Fill out at least one field. Leave any unknown fields blank.</h4><br>

                        <div style='display: flex; justify-content: center;''>
                            <form action='".$_SERVER['PHP_SELF']."' method='post'>
                                <input type='hidden' name='SRR_result' value='a'>
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
                                                echo "<option value='".$row['resto_id']."'>". $row['resto_name']. "</option>";
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
                                        <input type='date' id='start_date' name='start_date'><br><br>

                                        <label for='end_date'>End Date<label><br>
                                        <input type='date' id='end_date' name='end_date'><br>
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

                    echo "<br><div id='report_restoreview' class='textbox_border_nf'>
                            <form class='textbox' method='post' action='".$_SERVER['PHP_SELF']."'>
                                <h3>Report on Restaurant Performance</h3>
                                <input type='hidden' name='RRR_result' value='a'>
                                Select a Restaurant:
                                <select name='restoreview' required>
                                    <option value='' selected disabled hidden>Select an option</option>";
                                    foreach ($data as $row) {
                                        echo "<option value='".$row['resto_id']."'>".$row['resto_name']."</option>";
                                    }
                    echo        "</select><br><br>
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

                echo "<br><div id='update_restoreview' class='textbox_border_nf'>
                            <form class='textbox' method='post' action='".$_SERVER['PHP_SELF']."'>
                                <h3>Update Review</h3>
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
            echo "<div class='textbox_border_nf'>
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
            $user_id = $_SESSION['user_id'];
            $resto_review_overall_rating = $_POST['rating'];
            $resto_review_text = $_POST['review'];

            if ($restoreviews->add_resto_reviews($resto_id, $user_id, $resto_review_overall_rating, $resto_review_text) == 100){
                echo "<div id='CRR_resultpage' class='textbox_border_nf'>
                        <form classs='textbox'>
                            <h4>Review successfully created!</h4><br>
                            Restaurant: ".$resto->get_resto_list_given_id($resto_id)['resto_name']."<br>
                            Date of Review: ".date('Y-m-d')."<br>
                            User: ".$account->searchID($user_id)['username']."<br>
                            Rating: ".$resto_review_overall_rating."<br>
                            Review: ".$resto_review_text."<br>
                        </form>
                    </div><a href='MAIN_page.php'><button>Return to Main Page</button></a>";
             } else echo "<label style='color: red;'>An unexpected error occurred.</label>";
        } else if (isset($_POST['URR_result'])){
            $restorev_id = $_POST['URR_result'];
            $rating = $_POST['rating'];
            $review = $_POST['review'];

            if ($restoreviews->modify_resto_reviews($restorev_id, $rating, $review) == 100){
                echo "<div id='URR_resultpage' class='textbox_border_nf'>
                        <form classs='textbox'>
                            <h4>Review successfully updated!</h4><br>
                            Restaurant: ".$resto->get_resto_list_given_id($restorev_id)['resto_name']."<br>
                            Updated on: ".date('Y-m-d')."<br>
                            User: ".$_SESSION['username']."<br>
                            Rating: ".$rating."<br>
                            Review: ".$review."<br>
                        </form>
                    </div><a href='MAIN_page.php'><button>Return to Main Page</button></a>
                ";
            } else echo "<label style='color: red;'>An unexpected error occurred.</label>";
        } else if (isset($_POST['DRR_result'])){
            if (strcmp($_POST['DRR_input'], "delete") == 0){
                if($restoreviews->delete_resto_reviews($_POST['DRR_result']) == 100){
                    echo "<h3>Successfully deleted!</h3>";
                } else echo "An unexpected error occurred.";
                echo "<a href='MAIN_page.php'><button>Return to Main Page</button></a>";
            } else {
                header("Location: MAIN_page.php");
            }
        } else if (isset($_POST['SRR_result'])){
            if (isset($_POST['cb1']))
                $username = $_POST['username'];
            else $username = "";

            if (isset($_POST['cb2']))
                $rating = strtolower($_POST['rating']);
            else $rating = "";

            if (isset($_POST['cb3'])){
                if (strlen($_POST['start_date']))
                    $startdate = $_POST['start_date'];
                else $startdate = "";

                if (strlen($_POST['end_date']))
                    $enddate = $_POST['end_date'];
                else $enddate = "";
            } else {
                $startdate = "";
                $enddate = "";
            }

            if (isset($_POST['cb4']))
                $resto_id = $_POST['search_restaurant'];
            else $resto_id = -1;

            $data = $restoreviews->get_resto_review_given_option($resto_id, $username, $rating, $startdate, $enddate);
            echo "<h3>Search Results</h3>";
            foreach($data as $row){
                echo "<div class='textbox_border'>
                        <form class='textbox'>
                            Restaurant: ".$resto->get_resto_list_given_id($row['resto_id'])['resto_name']."<br>
                            Username: ".$account->searchID($row['user_id'])['username']."<br>
                            Date: ".$row['resto_review_date']."<br>
                            Rating: ".ucfirst($row['resto_review_overall_rating'])."<br>
                            Review: ".$row['resto_review_text']."<br>
                    </form></div><br>";
            }

            echo "<a href='MAIN_page.php'><button>Return to Main Page</button></a>";
        } else if (isset($_POST['RRR_result'])){
            $data = $restoreviews->get_resto_review_list_average($_POST['restoreview']);
            echo "<br><div class='textbox_border_nf'>
                    <form class='textbox'>
                        <h3>Restaurant Review</h3>
                        Restaurant: ".$resto->get_resto_list_given_id($_POST['restoreview'])['resto_name']."<br>
                        Average Rating: ";
                        if ($data['average_rating'] === NULL) 
                            echo "No reviews available";
                        else echo $data['average_rating'];
                echo "<br>
                </form></div><br>
                <a href='MAIN_page.php'><button>Return to Main Page</button></a>";
        }
    ?>

    <script src="script.js"></script>
</body>
</html>