<?php
session_start();

// Check if UserID is set in session
if (!isset($_SESSION["user_id"])) {
    // Redirect to the sign-in page or handle the situation accordingly
    header("Location: signIn.php");
    exit; // Stop further execution
}

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

// Gets plans from other users, but not from the logged-in user
$sql_fetch_plans = "SELECT WorkoutPlans.*, User.Username
                    FROM WorkoutPlans
                    INNER JOIN User ON WorkoutPlans.UserID = User.UserID
                    WHERE WorkoutPlans.UserID != ? 
                    ORDER BY WorkoutPlans.PlanID DESC";

$stmt = $conn->prepare($sql_fetch_plans);
if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $userID);

// Execute statement
if (!$stmt->execute()) {
    die("Error executing statement: " . $stmt->error);
}

// Get result
$result = $stmt->get_result();

// Check if there are any plans
if ($result->num_rows > 0) {
    // Fetch associative array of plans
    while ($row = $result->fetch_assoc()) {
        $plans[] = $row;
    }
}

// Close statement and connection
$stmt->close();
$conn->close();

// Return plans as JSON
header('Content-Type: application/json');
echo json_encode($plans);

?>