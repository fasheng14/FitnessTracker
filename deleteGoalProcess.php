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

// Get goal text from request
$goalText = $_POST['goalText'];

// SQL to delete goal from database
$sql_delete_goal = "DELETE FROM Goals WHERE goalText='$goalText'";

if ($conn->query($sql_delete_goal) === TRUE) {
    echo "Goal deleted successfully";
} else {
    echo "Error deleting goal: " . $conn->error;
}

// Close connection
$conn->close();
?>
