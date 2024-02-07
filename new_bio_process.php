<?php
session_start();
require_once 'user_management.php'; // Assuming this file contains the necessary class definitions

$P = new Profile(); // Assuming Profile is the class name

// Receives from the create_account HTML
$loggedInUser = $_SESSION["loggedInUser"];
$v_new_bio = $_POST["new_bio"];

$P->new_bio = $v_new_bio;
$P->username = $loggedInUser;
$P->id_profile = $P->getProfileId();

$status1 = $P->setBio();

if ($status1 == 1) {
    echo "<h1>New Bio has been set!</h1>";
    echo "<form action='mainpage.php' method='post'>";
    echo "<button type='submit'>BACK!</button>";
    echo "</form>";
} else {
    echo "<h1>Bio has failed to set!</h1>";
    echo "<form action='mainpage.php' method='post'>";
    echo "<button type='submit'>BACK!</button>";
    echo "</form>";
}
?>
