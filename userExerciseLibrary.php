<?php
session_start();

// Grabs the username of the logged-in user
$userID = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise Library</title>
    <link rel="stylesheet" type="text/css" href="exerciseLibraryStyle.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <h1>Fitness Tracker</h1>
        <nav>
            <a href="userDashboard.php">User Dashboard</a>
            <a href="">My Plan</a>
            <a href="communityPage.php">Community</a>
        </nav>
    </header>

    <main>
        <h2>Exercise Library</h2>
        <a href="exerciseLibrary.php" class="addLibrary">All Exercises</a>
        <div class="container">
            <?php
            // Database configuration
            $servername = "localhost";
            $username = "root";
            $password = "mysql";
            $dbname = "fitnessTrackDB";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch exercises from the user's library
            $sql_fetch_exercises = "SELECT e.* FROM userExerciseLibrary uel
                                    INNER JOIN ExerciseLibrary e ON uel.ExerciseID = e.ExerciseID
                                    WHERE uel.UserID = $userID";

            $result = $conn->query($sql_fetch_exercises);

            // Check if there are any exercises
            if ($result->num_rows > 0) {
                // Displays the results in a separate container for each exercise
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='exercise-container'>";
                    echo "<h3>" . $row["ExerciseName"] . "</h3>";
                    echo "<p><b>Muscle Group:</b> " . $row["MuscleGroup"] . "</p>";
                    echo "<p><b>Number of days</b>: " . $row["Days"] . "</p>";
                    echo "<p><b>Number of sets:</b> " . $row["Sets"] . "</p>";
                    echo "<p><b>Descripton:</b> " . $row["Description"] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "No exercises found in your library.";
            }

            // Close the database connection
            $conn->close();
            ?>

        </div>
    </main>

</body>
</html>