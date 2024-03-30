<?php
session_start();
// Database configuration
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "fitnessTrackDB";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Sorry, there was a problem connecting to our database.");
}

// Sanitize user inputs
$message = htmlspecialchars($_GET['message']);

if ($message == "") {
    die("Message cannot be empty.");
}

// Get UserID from session
$userID = $_SESSION["user_id"];

// Prepare and bind the INSERT statement
$stmt = $db->prepare("INSERT INTO Messages (UserID, Message) VALUES (?, ?)");
$stmt->bind_param("is", $userID, $message);

// Execute the statement
$stmt->execute();

// Check if the message was successfully inserted
if ($stmt->affected_rows > 0) {
    echo "Message inserted successfully.";
} else {
    echo "Failed to insert message.";
}

// Close the statement and database connection
$stmt->close();
$db->close();
?>

<!--REFERENCES
https://github.com/howCodeORG/Messenger/blob/master/update-messages.php
-->

