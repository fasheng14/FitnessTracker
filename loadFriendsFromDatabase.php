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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare statement it grabs all the friends that user 1 has added
$sql_fetch_friends = "SELECT F.*, U2.Username AS FriendUsername
                      FROM friends F
                      JOIN User U2 ON F.UserID2 = U2.UserID
                      WHERE F.UserID1 = ?";

$stmt = $conn->prepare($sql_fetch_friends);
if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("i", $userID);

// Execute statement
if (!$stmt->execute()) {
    die("Error executing statement: " . $stmt->error);
}

// Get result
$result = $stmt->get_result();

// Check if there are any friends
$friends = array();
if ($result->num_rows > 0) {
    // Fetch associative array of friends
    while ($row = $result->fetch_assoc()) {
        $friends[] = $row;
    }
}

// Close statement and connection
$stmt->close();
$conn->close();

// Return friends as JSON
header('Content-Type: application/json');
echo json_encode($friends);

?>