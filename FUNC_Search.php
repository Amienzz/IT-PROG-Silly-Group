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

<!-- OLD CODE FOR SEARCH


process_view.php

<?php
session_start();
require_once 'user_management.php'; // Assuming this file contains the necessary class definitions

$P = new Profile(); // Assuming Profile is the class name

// Receives from the create_account HTML
$v_gender = $_POST["gender"];

$P->gender = $v_gender;

$userNames = $P->getUsername();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>process_view</title>
</head>
<body>
    <form action="view_user.php" method="post">
        <button type="submit">Back</button>
    </form>

<?php
if (!empty($userNames)) {
    foreach ($userNames as $userName) {
        echo "<p>User: $userName</p>";
    }
} else {
    echo "<p>No users found with the specified gender.</p>";
}
?>

</body>
</html>

>