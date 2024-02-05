<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Restaurant Reviews</title>
    <style>
        body {
            text-align: center;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            display: inline-block;
            margin: 5px;
            padding: 8px 15px;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
        }

        a.update {
            background-color: #28a745; /* Green color for update button */
        }

        a.delete {
            background-color: #dc3545; /* Red color for delete button */
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #32a852;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
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