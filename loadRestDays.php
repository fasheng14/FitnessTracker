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

// fetch rest days from the database for the logged-in user
$sql_select_rest_days = "SELECT DayOfWeek, RestDayID FROM RestDays WHERE UserID = ?";
$stmt = $conn->prepare($sql_select_rest_days);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

// Array to store rest days
$restDays = array();

// Fetch and store rest days
while ($row = $result->fetch_assoc()) {
    $restDays[] = $row; 
}

// Close statement and connection
$stmt->close();
$conn->close();

// Return rest days data as JSON
echo json_encode($restDays);
?>
