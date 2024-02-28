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


<!-- OLD CODE FOR PROFILE

edit_bio.html

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    <form action="new_bio_process.jsp">
    <label for="new_bio">New Bio:</label>
    <input type="text" id="new_bio" name="new_bio" required><br>
    <input type="submit" value="Submit">
     <a href="edit_profile.html">BACK</a><br>
        
  
    </form>

 
</body>
</html>


edit_number.html

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Rating Application</title>
</head>
<body>
    <h1>Which one would you like to edit?</h1>
    <a href="mobile_number.html">Add Mobile Number</a>
    <a href="choose_mobile.jsp">Remove Mobile Number</a>
    <a href="mainpage.jsp">BACK</a>
</body>
</html>

edit_username.html  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    <form action="new_username_process.jsp">
    <label for="new_name">New UserName:</label>
    <input type="text" id="new_name" name="new_name" required><br>
    <input type="submit" value="Submit">
     <a href="edit_profile.html">BACK</a><br>
        
  
    </form>

 
</body>
</html>
                            -->