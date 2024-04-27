<?php
session_start();

// Check if UserID is set in session
if (!isset($_SESSION["user_id"])) {
    // Redirect to the sign-in page or handle the situation accordingly
    header("Location: signIn.php");
    exit; // Stop further execution
}


$restdayID = $_POST['restDayID'];

print_r($_POST);



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

//  delete the rest day
$sql_delete_restday = "DELETE FROM RestDays WHERE RestDayID = ?";
$stmt = $conn->prepare($sql_delete_restday);
$stmt->bind_param("i", $restdayID);

// Execute the statement
if ($stmt->execute()) {
    // restday deleted successfully
    echo json_encode(array("success" => true));
} else {
    // Error occurred while deleting rest day
    echo json_encode(array("success" => false, "error" => "Failed to delete rest day."));
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
