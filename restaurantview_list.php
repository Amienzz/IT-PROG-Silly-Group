<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Restaurant Reviews</title>
</head>
<body>
    <?php
    // Include necessary PHP files and configurations

    // Assuming the restaurant_review_mgt.php file is included
    include_once 'restaurant_review_mgt.php';

    // Instantiate the resto_review class
    $R = new resto_review();

    // Retrieve the username from the session
    session_start();
    $loggedInUser = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : '';

    // Get the restaurant review list
    $R->restaurant_review_list();
    ?>
    
    <form action="mainpage.php" method="post">
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

        <input type="submit" value="Back to Main Menu">
    </form>
</body>
</html>