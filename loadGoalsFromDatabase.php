<?php
// Start session
session_start();

// Same thing as loading Body stats
//Makes so this works when requested for other users other than the logged in one
if (!isset($_SESSION["user_id"])) {
    // Redirect to login page or handle the situation accordingly
   header("Location: signIn.php"); // Change the URL to your login page
   exit;
}

if (isset($_GET['userID'])) {
    // 'userID' GET variable exists
    $userID = $_GET['userID'];
}
else{
// Get UserID from session
    $userID = $_SESSION["user_id"];
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

// Prepare SQL statement to fetch goals for the logged-in user
$sql = "SELECT * FROM Goals WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

// Array to store goals
$goals = array();

// Fetch and store goals
while ($row = $result->fetch_assoc()) {
    $goals[] = $row;
}

// Close statement and connection
$stmt->close();
$conn->close();

// Return goals data as JSON
echo json_encode($goals);
?>
