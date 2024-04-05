<?
session_start();
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

    $userID = $_SESSION["user_id"];
    $planName = mysqli_real_escape_string($conn, $_POST["planName"]);
    $planDescription = mysqli_real_escape_string($conn, $_POST["planDescription"]);



    // Insert plan into plan workout table
    $sql_insert_plan = "
        INSERT INTO WorkoutPlans (UserID , PlanName, Description)
        VALUES ('$userID', '$planName', '$planDescription')
    ";

    if ($conn->query($sql_insert_plan) === TRUE) {
        
        header("Location: communityPage.php");
        exit();
    } else {
        echo "Error Adding plan: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>