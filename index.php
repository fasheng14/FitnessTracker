<?php
session_start();

// Grabs the username of the logged in user
$username = $_SESSION['username'];

//checks if user signed in or not
if($username != null){
    header("Location: loggedHome.php");
} else {
    header("Location: unloggedHome.html");
}

?>