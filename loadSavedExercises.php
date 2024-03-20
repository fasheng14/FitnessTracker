<?php
session_start();

// Check if UserID is set in session
if (!isset($_SESSION["user_id"])) {
    // Redirect to the sign-in page or handle the situation accordingly
    header("Location: signIn.php");
    exit; // Stop further execution
}

$userID = $_SESSION["user_id"];

// Database configuration
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "fitnessTrackDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch exercises from the user's library
$sql_fetch_exercises = "SELECT e.* FROM userExerciseLibrary uel
                        INNER JOIN ExerciseLibrary e ON uel.ExerciseID = e.ExerciseID
                        WHERE uel.UserID = $userID";

$result = $conn->query($sql_fetch_exercises);

$exerciseOptions = array();

// Check if there are any exercises
if ($result->num_rows > 0) {
    // Add each exercise to the array
    while ($row = $result->fetch_assoc()) {
        $exerciseOptions[] = array(
            "ExerciseID" => $row["ExerciseID"],
            "ExerciseName" => $row["ExerciseName"]
        );
    }
}

$conn->close();

// Return the exercise options as JSON
header('Content-Type: application/json');
echo json_encode($exerciseOptions);
?>