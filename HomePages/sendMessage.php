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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user ID from session
    $userID = $_SESSION["user_id"];
    
    // Get data from request body
    $data = json_decode(file_get_contents("php://input"), true);
    $conversationID = $data["conversationID"];
    $message = $data["message"];

    // Prepare SQL statement to insert message into the database
    $sql_insert_message = "INSERT INTO Messages (ConversationID, SenderID, Message, Timestamp) 
                           VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql_insert_message);
    $stmt->bind_param("iis", $conversationID, $userID, $message);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Message inserted successfully
        $stmt->close();
        $conn->close();
        // Send response with success status
        http_response_code(200);
    } else {
        // Error inserting message
        http_response_code(500);
        echo "Error: " . $conn->error;
    }
} else {
    // Invalid request method
    http_response_code(405);
}
?>
