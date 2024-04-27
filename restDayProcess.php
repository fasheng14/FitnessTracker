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

    // Get form data
    $dayOfWeek = $_POST["dayOfWeek"];

    // insert rest day into the database
    $sql_insert_rest_day = "INSERT INTO RestDays (UserID, DayOfWeek) 
                            VALUES (?, ?)";
    $stmt = $conn->prepare($sql_insert_rest_day);
    $stmt->bind_param("is", $userID, $dayOfWeek);

    // Execute the statement
    if ($stmt->execute()) {
        // Rest day added successfully
        $stmt->close();
        $conn->close();
        // Redirect back to the same page 
        header("Location: myPlan.php");
        exit;
    } else {
        // Error inserting rest day
        echo "Error: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
