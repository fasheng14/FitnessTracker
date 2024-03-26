<?php
session_start();

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

// Get the conversation ID from the request
$conversationID = $_POST['conversationID'];

// Fetch messages for the given conversation from the database
$sql = "SELECT m.MessageID, m.SenderID, m.Message, m.Timestamp, u.Username AS SenderUsername 
        FROM Messages m
        INNER JOIN User u ON m.SenderID = u.UserID
        WHERE m.ConversationID = '$conversationID'
        ORDER BY m.Timestamp ASC";

$result = $conn->query($sql);

if ($result) {
    $messages = array();
    while ($row = $result->fetch_assoc()) {
        // Build message object
        $message = array(
            "messageID" => $row["MessageID"],
            "senderID" => $row["SenderID"],
            "senderUsername" => $row["SenderUsername"],
            "message" => $row["Message"],
            "timestamp" => $row["Timestamp"]
        );
        // Add message to the array
        $messages[] = $message;
    }
    // Return messages as JSON response
    echo json_encode(array("success" => true, "messages" => $messages));
} else {
    // Return error response if fetching messages fails
    echo json_encode(array("success" => false, "error" => "Error fetching messages."));
}

$conn->close();
?>
