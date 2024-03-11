<?php
session_start();

// Check if the user is logged in
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

// Get user ID from session
$userID = $_SESSION["user_id"];

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $weight = $_POST["weight"] ?? null;
    $benchPR = $_POST["benchPR"] ?? null;
    $squatPR = $_POST["squatPR"] ?? null;
    $longestDistanceRan = $_POST["longestDistanceRan"] ?? null;
    $longestWorkout = $_POST["longestWorkout"] ?? null;

    // Check if the user's data already exists
    $sql_check_existing_data = "SELECT * FROM BodyStats WHERE UserID = ?";
    $stmt_check_existing_data = $conn->prepare($sql_check_existing_data);
    $stmt_check_existing_data->bind_param("i", $userID);
    $stmt_check_existing_data->execute();
    $result_check_existing_data = $stmt_check_existing_data->get_result();

    if ($result_check_existing_data->num_rows > 0) {
        // Data exists, perform UPDATE query
        $sql_update_performance_stats = "UPDATE BodyStats SET Weight=?, BenchPressPR=?, SquatPR=?, LongestDistance=?, LongestWorkout=? WHERE UserID=?";
        $stmt_update_performance_stats = $conn->prepare($sql_update_performance_stats);
        $stmt_update_performance_stats->bind_param("dddi", $weight, $benchPR, $squatPR, $longestDistanceRan, $longestWorkout, $userID);
        $stmt_update_performance_stats->execute();
        $stmt_update_performance_stats->close();
    } else {
        // Data does not exist, perform INSERT query
        $sql_insert_performance_stats = "INSERT INTO BodyStats (UserID, Weight, BenchPressPR, SquatPR, LongestDistance, LongestWorkout) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert_performance_stats = $conn->prepare($sql_insert_performance_stats);
        $stmt_insert_performance_stats->bind_param("iddiii", $userID, $weight, $benchPR, $squatPR, $longestDistanceRan, $longestWorkout);
        $stmt_insert_performance_stats->execute();
        $stmt_insert_performance_stats->close();
    }

    // Close statement
    $stmt_check_existing_data->close();

    // Redirect back to the page after updating the stats
    header("Location: myPlan.php");
    exit;
} else {
    // Redirect to a proper error page or handle the situation accordingly
    header("Location: error.php");
    exit;
}
?>
