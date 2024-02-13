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
