<?php
session_start();

// Check if UserID is set in session
if (!isset($_SESSION["user_id"])) {
    // Redirect to the sign-in page or handle the situation accordingly
    header("Location: signIn.php");
    exit; // Stop further execution
}


$FriendshipID = $_POST['friendshipID'];

print_r($_POST);



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

// Prepare SQL statement to delete the friend
$sql_delete_friend = "DELETE FROM friends WHERE FriendshipID = ?";
$stmt = $conn->prepare($sql_delete_friend);
$stmt->bind_param("i", $FriendshipID);

// Execute the statement
if ($stmt->execute()) {
    // friend deleted successfully
    echo json_encode(array("success" => true));
} else {
    // Error occurred while deleting friend
    echo json_encode(array("success" => false, "error" => "Failed to delete friend."));
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
