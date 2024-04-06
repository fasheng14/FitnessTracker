<?php
session_start();

$userId = $_SESSION['user_id'];

// Database configuration
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "fitnessTrackDB";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$presetWorkoutId = $_GET['presetWorkoutId'];

// Insert the user's ID and the ID of the preset workout they saved into the userExerciseLibrary table
$sql_insert_userPresetWorkout = "
    INSERT INTO userExerciseLibrary (UserID, PresetWorkoutID)
    VALUES ('$userId', '$presetWorkoutId')
";

if ($conn->query($sql_insert_userPresetWorkout) === TRUE) {
    exit();
} else {
    echo "Error Adding Preset Workout: " . $conn->error;
}

// Close connection
$conn->close();
?>
