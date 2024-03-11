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
    $name = $_POST["name"];
    $sets = $_POST["sets"];
    $reps = $_POST["reps"];
    $weight = $_POST["weight"];
    $distance = $_POST["distance"];
    $duration = $_POST["duration"];
    $dayOfWeek = $_POST["dayOfWeek"];

    // Prepare SQL statement to insert custom workout into the database
    $sql_insert_custom_workout = "INSERT INTO CustomWorkouts (UserID, Name, Sets, Reps, Weight, Distance, Duration, DayOfWeek) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert_custom_workout);
    $stmt->bind_param("isiiidds", $userID, $name, $sets, $reps, $weight, $distance, $duration, $dayOfWeek);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Custom workout added successfully
        $stmt->close();
        $conn->close();
        // Redirect back to the same page
        header("Location: myPlan.php");
        exit;
    } else {
        // Error inserting custom workout
        echo "Error: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
