<?php
session_start();

// Grabs the username of the logged-in user
$userID = $_SESSION['user_id'];

$username = $_SESSION['username'];

//checks if user signed in or not
//If not sends back to home, so that they can log in
if ($username === null) {
    header("Location: HomePages/unloggedHome.html");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise Library</title>
    <link rel="stylesheet" type="text/css" href="exerciseLibraryStyles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <a class="logo" href="HomePages/loggedHome.php">
            <!-- Image -->
            <img src="HomePages/graphic/fitnessLogo.png" alt="MagnCreo Logo" width="150px">
        </a>
        <div class="name">
            <h1 style="font-size: 3em;">Personal Exercise Library</h1>
        </div>
        <div class="dropDown">
            <button class="dropButton">Menu</button>
            <nav class="dropContent">
                <a href="HomePages/loggedHome.php">Home Page</a>
                <a href="userDashboard.php">My Profile</a>
                <a href="accountInfo.php">Account</a>
                <a href="myPlan.php">My Plan</a>
                <a href="communityPage.php">Community</a>
                <a href="logout.php">Sign out </a>
            </nav>
        </div>
    </header>

    <main>
        <h2>Personal Exercise Library</h2>
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
            $sql_fetch_exercises = "SELECT e.*, pw.* FROM userExerciseLibrary uel
                                    LEFT JOIN ExerciseLibrary e ON uel.ExerciseID = e.ExerciseID
                                    LEFT JOIN PresetWorkouts pw ON uel.PresetWorkoutID = pw.PresetWorkoutID
                                    WHERE uel.UserID = $userID";

            $result = $conn->query($sql_fetch_exercises);

            // Check if there are any exercises
            if ($result->num_rows > 0) {
                // Displays the results in a separate container for each exercise
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='exercise-container'>";
                    // Check if the exercise is from ExerciseLibrary or PresetWorkouts
                    if ($row["ExerciseID"] !== null) {
                        echo "<h3>" . $row["ExerciseName"] . "</h3>";
                        echo "<p><b>Muscle Group:</b> " . $row["MuscleGroup"] . "</p>";
                        echo "<p><b>Number of days</b>: " . $row["Days"] . "</p>";
                        echo "<p><b>Number of sets:</b> " . $row["Sets"] . "</p>";
                        echo "<p><b>Description:</b> " . $row["Description"] . "</p>";
                    } elseif ($row["PresetWorkoutID"] !== null) {
                        echo "<h3>" . $row["PresetExerciseName"] . "</h3>";
                        echo "<p><b>Muscle Group:</b> " . $row["MuscleGroup"] . "</p>";
                        echo "<p><b>Number of days</b>: " . $row["Days"] . "</p>";
                        echo "<p><b>Number of sets:</b> " . $row["Sets"] . "</p>";
                        echo "<p><b>Description:</b> " . $row["Description"] . "</p>";
                    }
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
    <script>
        //function for deleting exercise for admins
        function deleteExercise(exerciseId) {
            var httpRequest = new XMLHttpRequest();
            httpRequest.open("GET", "deleteUserExercise.php?exerciseId=" + exerciseId, true);
            httpRequest.send();
            //Refreshes the page, so that delete will be shown 
            setTimeout(function () {
                location.reload();
            }, 100);
        }
    </script>

</body>

</html>