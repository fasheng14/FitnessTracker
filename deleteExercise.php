<?php
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

// SQL statement to delete related entries from userexerciselibrary table
$sql_delete_user_exercises = "DELETE FROM userExerciseLibrary WHERE ExerciseID='$exerciseId'";

// SQL statement to delete exercise from database
$sql_delete_exerciseId = "DELETE FROM ExerciseLibrary WHERE ExerciseID='$exerciseId'";

if ($conn->query($sql_delete_user_exercises) === TRUE) {
    // Once related entries are deleted, proceed to delete the exercise from ExerciseLibrary table
    $sql_delete_exerciseId = "DELETE FROM ExerciseLibrary WHERE ExerciseID='$exerciseId'";
    
    if ($conn->query($sql_delete_exerciseId) === TRUE) {
        echo "Exercise deleted successfully.";
    } else {
        echo "Error deleting exercise: " . $conn->error;
    }
} else {
    echo "Error deleting related entries from userExerciseLibrary: " . $conn->error;
}

// Close connection
$conn->close();
?>