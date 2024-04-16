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

// Get user ID from session and other user id from post
$userID = $_SESSION["user_id"];

$userID2 = $_POST['userID'];

// Prepare SQL statement to fetch workouts from the database from user2
$sql_select_workouts = "SELECT Name, Sets, Reps, Weight, Distance, Duration, DayOfWeek FROM CustomWorkouts WHERE UserID = ?";
$stmt = $conn->prepare($sql_select_workouts);
$stmt->bind_param("i", $userID2);
$stmt->execute();
$result = $stmt->get_result();

// Array to store workouts
$workouts = array();

// Fetch and store workouts
while ($row = $result->fetch_assoc()) {
    $workouts[] = $row;
}

// Close statement 
$stmt->close();

// Prepare SQL statement to insert fetched workouts for the logged in user
$sql_insert_workouts = "INSERT INTO CustomWorkouts (UserID, Name, Sets, Reps, Weight, Distance, Duration, DayOfWeek) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt_insert = $conn->prepare($sql_insert_workouts);

// Bind parameters and insert workouts for User
foreach ($workouts as $workout) {
    $stmt_insert->bind_param("isiiidds", $userID, $workout['Name'],  $workout['Sets'], $workout['Reps'], $workout['Weight'], $workout['Distance'], $workout['Duration'], $workout['DayOfWeek']);
    $stmt_insert->execute();
}

// Close statement and connection
$stmt_insert->close();
$conn->close();

?>
