<?php
session_start(); // Start the session

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["user_id"])) {
    header("Location: signIn.php");
    exit;
}

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

// Get user ID from session
$userID = $_SESSION["user_id"];

// Prepare SQL statement to fetch workouts from the database for the logged-in user
$sql_select_workouts = "SELECT Name, DayOfWeek, Sets, Reps, Weight, Distance, Duration FROM CustomWorkouts WHERE UserID = ?";
$stmt = $conn->prepare($sql_select_workouts);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

// Array to store workouts
$workouts = array();

// Fetch and store workouts
while ($row = $result->fetch_assoc()) {
    $workouts[] = $row;
}

// Close statement and connection
$stmt->close();
$conn->close();

// Return workouts data as JSON
echo json_encode($workouts);
?>
