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
        <a href="addExercise.php">Add exercise to library</a>
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

            // Fetch exercises from the database
            $sql_fetch_exercises = "SELECT * FROM ExerciseLibrary";
            $result = $conn->query($sql_fetch_exercises);

            // Check if there are any exercises
            if ($result->num_rows > 0) {
                // Displays the results in sepreate conntainer for each exercise
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='exercise-container'>";
                    echo "<h3>" . $row["ExerciseName"] . "</h3>";
                    echo "<p>Muscle Group: " . $row["MuscleGroup"] . "</p>";
                    echo "<p>Number of the days of the week: " . $row["Days"] . "</p>";
                    echo "<p>Number of sets: " . $row["Sets"] . "</p>";
                    echo "<p>Descripton: " . $row["Description"] . "</p>";
                    //if there is no rating yet then nothing is there 
                    echo "<p>Rating: " . ($row["Rating"] !== null ? $row["Rating"] : "Not rated yet") . "</p>";
                    echo "<button>Rate this Exercise </button>";
                    echo "<button>Save this Exercise</button>";
                    echo "</div>";


                }
            } else {
                echo "No exercises found";
            }



            // Close the database connection
            $conn->close();
            ?>

        </div>
    </main>