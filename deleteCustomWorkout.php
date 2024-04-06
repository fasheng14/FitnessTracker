<?php
session_start();

// Check if UserID is set in session
if (!isset($_SESSION["user_id"])) {
    // Redirect to the sign-in page or handle the situation accordingly
    header("Location: signIn.php");
    exit; // Stop further execution
}

// Check if CustomWorkoutID is provided
if (!isset($_POST['workout_id'])) {
    echo json_encode(array("success" => false, "error" => "CustomWorkoutID not provided."));
    exit;
}

$userID = $_SESSION["user_id"];
$customWorkoutID = $_POST['workout_id'];

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

// Prepare SQL statement to delete the custom workout from the database
$sql_delete_workout = "DELETE FROM CustomWorkouts WHERE UserID = ? AND CustomWorkoutID = ?";
$stmt = $conn->prepare($sql_delete_workout);
$stmt->bind_param("ii", $userID, $customWorkoutID);

// Execute the statement
if ($stmt->execute()) {
    // Workout deleted successfully
    echo json_encode(array("success" => true));
} else {
    // Error occurred while deleting workout
    echo json_encode(array("success" => false, "error" => "Failed to delete workout."));
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
