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

// Get user ID from session
$userID = $_SESSION["user_id"];

// Get the current day of the week (e.g., Monday, Tuesday, etc.)
$currentDayOfWeek = date('l');

// Prepare SQL statement to fetch today's workout data
$sql_select_today_workouts = "SELECT Name, Sets, Reps, Weight, Distance, Duration 
                              FROM CustomWorkouts 
                              WHERE UserID = ? AND DayOfWeek = ?";
$stmt = $conn->prepare($sql_select_today_workouts);
$stmt->bind_param("is", $userID, $currentDayOfWeek);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any workouts for today
if ($result->num_rows > 0) {
    // Output table headers
    echo "<table>";
    echo "<caption>Schedule</caption>";
    echo "<tr>";
    echo "<th>Exercises</th>";
    echo "<th>Sets</th>";
    echo "<th>Reps</th>";
    echo "<th>Weight</th>";
    echo "<th>Distance</th>";
    echo "<th>Duration</th>";
    echo "</tr>";

    // Output table rows with workout data
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Name'] . "</td>";
        echo "<td>" . $row['Sets'] . "</td>";
        echo "<td>" . $row['Reps'] . "</td>";
        echo "<td>" . $row['Weight'] . "</td>";
        echo "<td>" . $row['Distance'] . "</td>";
        echo "<td>" . $row['Duration'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    // No workouts for today
    echo "<p>No workouts scheduled for today.</p>";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
