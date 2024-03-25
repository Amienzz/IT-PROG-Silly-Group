
<?php
    include_once 'BE_Dish_Review.php';
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Dish Reviews</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
    $conn = mysqli_connect("localhost", "root", "") or die("Unable to connect!" . mysqli_error());
    mysqli_select_db($conn, "ratingsystem") or die("Unable to select database!" . mysqli_error());
    ?>
    <header class="taskbar"></header>

    <div id="create" class="dr-function">
        <h2>Create a Dish Review!</h2>
        <form action="FUNC_DR.php" method="post">
            <?php
            $studQuery = mysqli_query($conn, "SELECT * FROM dish ORDER BY dish_name");

            echo "<label for='dish_name'>Dish name:</label>";
            echo "<select id='dish_name'>";
            while($row = mysqli_fetch_array($studQuery))
            {
                echo "<option value='".$row['dish_id']."'>".$row['dish_name']."</option>";
            }
            echo "</select>";

            ?>
            <br><br>

            <label>Overall Rating:</label>
            <input type="radio" id="rating1" name="overall_rating" value="1" required>
            <label for="rating1">1</label>
            <input type="radio" id="rating2" name="overall_rating" value="2">
            <label for="rating2">2</label>
            <input type="radio" id="rating3" name="overall_rating" value="3">
            <label for="rating3">3</label>
            <input type="radio" id="rating4" name="overall_rating" value="4">
            <label for="rating4">4</label>
            <input type="radio" id="rating5" name="overall_rating" value="5">
            <label for="rating5">5</label>
            <br><br>

            <label for="review_text">Review:</label>
            <textarea id="review_text" name="review_text" rows="5" cols="40" required></textarea>
            <br>
            <button type="submit">Submit Review</button>
            <br>
            <button onclick="window.location.href='MAIN_page.php'">Head Back</button><br>
        </form>
    </div>

    <!-- View, Update, and Delete a Review div -->
    <div id="view" class="dr-function">
        <h2>View, Update, and Delete a Review</h2>
        <button class="mainstyle" onclick="toggle(review_dish); toggle(mainpage)">View Reviews</button><br>
        <button class="mainstyle" onclick="toggle(search_account); toggle(mainpage)">Update your Reviews</button><br>
        <button class="mainstyle" onclick="toggle(search_account); toggle(mainpage)">Delete your Reviews</button><br>
        <button class="mainstyle" onclick="window.location.href='index.php'">Logout</button><br>
    </div>
    
    <!-- Search a Dish Review div -->
    <div id="search" class="dr-function">
    <h2>Search for Dish Reviews!</h2>
    <form action="FUNC_DR.php" method="post">
    <?php
    $dishname = mysqli_query($conn, "SELECT * FROM dish ORDER BY dish_name");

    echo "<label for='dish_name'>Reviews For:</label>";
    echo "<select id='dish_id' name='dish_id'>"; // Added name attribute to the select tag
    while($row = mysqli_fetch_array($dishname))
    {
        echo "<option value='".$row['dish_id']."'>".$row['dish_name']."</option>";
    }
    echo "</select>";
    echo "<br>";
    echo "<button type='submit' name='search'>Search</button>"; // Changed type to 'submit' and added name attribute

    if(isset($_POST['search']) && isset($_POST['dish_id'])) {
        $dish_id = $_POST['dish_id'];
        $review = mysqli_query($conn, "SELECT * FROM dish_review WHERE dish_id = $dish_id");
        while($row = mysqli_fetch_array($review)){
            echo "<table>";
            echo "<tr>";
            echo "<th>Dish Review ID</th>";
            echo "<th>Overall Rating</th>";
            echo "<th>Quality Rating</th>";
            echo "<th>Price Rating</th>";
            echo "<th>Review Text</th>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>".$row['dish_review_id']."</td>";
            echo "<td>".$row['dish_overall_rating']."</td>";
            echo "<td>".$row['dish_quality_rating']."</td>";
            echo "<td>".$row['dish_price_rating']."</td>";
            echo "<td>".$row['dish_review_text']."</td>";
            echo "</tr>";
            echo"<br>";
            echo "</table>";
        }
    }
        
        

        
    
    ?>
</form>



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