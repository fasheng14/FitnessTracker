<?php
// Start session
session_start();

// Check if UserID is set in session
if (!isset($_SESSION["user_id"])) {

    // Redirect to login page or handle the situation accordingly
   header("Location: signIn.php"); // Change the URL to your login page
    exit;
}

// Get UserID from session
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare data for insertion
    $goalText = $_POST['goalText'];
    $goalCategory = $_POST['goalCategory'];

    // Prepare SQL statement to insert data into Goals table
    $sql = "INSERT INTO Goals (UserID, GoalText, Category) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute statement
    $stmt->bind_param("iss", $userID, $goalText, $goalCategory);
    if ($stmt->execute()) {
        // Close statement
        $stmt->close();
        // Redirect back to the same page
        header("Location: myPlan.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
