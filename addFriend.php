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
print_r($_POST);
print_r($_SESSION);

// if their post data sent
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user ID from session
    $userID1 = $_SESSION["user_id"];
    //Grabs the userID of their friend to be added
    $userID2 = $_POST['userID']; 
    

    // Check if the user has already added this user
    $stmt = $conn->prepare("SELECT COUNT(*) FROM friends WHERE (UserID1 = ? AND UserID2 = ?)");
    $stmt->bind_param("ii", $userID1, $userID2);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    // If the user already has than it is not readded to the database
    if ($count > 0) {
        $response = array("success" => true, "message" => "User is already your friend");
    } else {
        // Prepare SQL statement to add friend
        $stmt = $conn->prepare("INSERT INTO friends (UserID1, UserID2) VALUES (?, ?)");
        $stmt->bind_param("ii", $userID1, $userID2);

        // Execute SQL statement
        if ($stmt->execute()) {
            // Friend added successfully
            $response = array("success" => true, "message" => "Friend added successfully");
        } else {
            // Error adding friend
            $response = array("success" => false, "message" => "Error adding friend to database");
        }

        // Close statement
        $stmt->close();
    }
} else {
    $response = array("success" => false, "message" => "Invalid request method");
}

// Close connection
$conn->close();

// Send JSON response
echo json_encode($response);
?>