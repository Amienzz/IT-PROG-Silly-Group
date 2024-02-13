<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>remove_mobile</title>
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
