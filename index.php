<?php
session_start();

// Grabs the username of the logged in user
$username = $_SESSION['username'];

//checks if user signed in or not
if($username != null){
   header("Location: HomePages/loggedHome.php");
} else {
    header("Location: HomePages/unloggedHome.html");
}

?>