<?php
session_start(); // Start the session

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

// I made a change so this can be used to load body stats for other users 
// it checks if a user id was sent them throgh GET
//if not that just means it for the User dashboard for the logged in user
if (isset($_GET['userID'])) {
    // 'userID' GET variable exists
    $userID = $_GET['userID'];
}
else{
// Get UserID from session
    $userID = $_SESSION["user_id"];
}

// Query to fetch body stats data for the logged-in user
$sql_select_body_stats = "SELECT * FROM BodyStats WHERE UserID = ?";
$stmt = $conn->prepare($sql_select_body_stats);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

// Initialize an array to store the fetched body stats
$bodyStats = array();

// Fetch body stats data and store it in the array
while ($row = $result->fetch_assoc()) {
    $bodyStats[] = $row;
}

// Close prepared statement
$stmt->close();

// Close connection
$conn->close();

// Return the fetched body stats as JSON
header('Content-Type: application/json');
echo json_encode($bodyStats);
?>
