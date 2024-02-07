<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>remove_mobile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 50px;
        }

        form {
            display: inline-block;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        select {
            padding: 8px;
            font-size: 16px;
            width: 200px;
        }

        input[type="submit"] {
            background-color: #5dd55d;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #2aa22a;
        }
    </style>
</head>
<body>
<?php
// Instantiate the mobile object
$M = new user_management.mobile();

// Start the session
session_start();
$loggedInUser = $_SESSION["loggedInUser"];
$M->userName = $loggedInUser;

// Get user mobile numbers
$mobileNumbers = $M->getUserMobile();
?>
<form action="<?php echo !empty($mobileNumbers) ? 'remove_mobile.php' : 'edit_number.html'; ?>" method="post">
    <label for="mobileNumberDropdown">Select Mobile Number:</label>
    <select name="mobileNumberDropdown" id="mobileNumberDropdown">
        <?php
        if (!empty($mobileNumbers)) {
            foreach ($mobileNumbers as $mobileNumber) {
                echo "<option value=\"$mobileNumber\">$mobileNumber</option>";
            }
        } else {
            echo "<option value='' disabled selected>No mobile numbers found for the user.</option>";
        }
        ?>
    </select>
    <br>
    <input type="submit" value="Next">
</form>
<form action="edit_number.html" method="post">
    <button type="submit">Back</button>
</form>
</body>
</html>
