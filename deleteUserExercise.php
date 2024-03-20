<?php
session_start();

//grabs the logged in user id for deleting their exercise 
$userID = $_SESSION['user_id'];

// Database configuration
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "fitnessTrackDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$exerciseId = $_GET['exerciseId'];

// SQL statement to delete the exercise from personal library 
$sql_delete_user_exercises = "DELETE FROM userExerciseLibrary WHERE ExerciseID='$exerciseId' AND UserID='$userID'";


if ($conn->query($sql_delete_user_exercises) === TRUE) {
        echo "Exercise deleted successfully.";
} else {
    echo "Error deleting related entries from userExerciseLibrary: " . $conn->error;
}

// Close connection
$conn->close();
?>