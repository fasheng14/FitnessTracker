<?
session_start();

$userId = $_SESSION['user_id'];

// Database configuration
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "fitnessTrackDB";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$exerciseId = $_GET['exerciseId'];

//inserts the userid of the user logged in and the id of the exercise they saved
$sql_insert_userExercise = "
        INSERT INTO userExerciseLibrary (UserID, ExerciseID)
        VALUES ('$userId', '$exerciseId')
    ";
    if ($conn->query($sql_insert_userExercise) === TRUE) {
        exit();
    } else {
        echo "Error Adding Exercise: " . $conn->error;
    }

      // Close connection
      $conn->close();

    ?>