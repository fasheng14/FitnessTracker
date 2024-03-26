<?php
// Start the session
session_start();

// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    // If logged in, destroy the session
    session_destroy();

    // Redirect the user to the sign-in page
    header("Location: index.php");
    exit();
} else {
    // If not logged in, redirect them to the sign-in page
    header("Location: index.php");
    exit();
}
?>
