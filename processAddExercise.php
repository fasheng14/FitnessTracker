<?
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $exercise = mysqli_real_escape_string($conn, $_POST["exercise"]);
    $muscle = mysqli_real_escape_string($conn, $_POST["muscle"]);
    $days = intval($_POST["days"]);
    $sets = intval($_POST["sets"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $video = mysqli_real_escape_string($conn, $_POST["video"]);


    // Insert exercise into the table
    $sql_insert_exercise = "
        INSERT INTO ExerciseLibrary (ExerciseName, MuscleGroup, Days, Sets, Description, DemoVideoLink)
        VALUES ('$exercise', '$muscle', '$days', '$sets', '$description', '$video')
    ";

    if ($conn->query($sql_insert_exercise) === TRUE) {
        
        header("Location: exerciseLibrary.php");
        exit();
    } else {
        echo "Error Adding Exercise: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
