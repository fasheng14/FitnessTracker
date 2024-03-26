<?php
session_start();

// Grabs the username of the logged in user
$username = $_SESSION['username'];

$isAdmin = $_SESSION['isAdmin'];

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
            <img src="images/fitnessLogo.png" width="100px">
        </a>
        <h1>Exercise Library</h1>
        <div class="dropDown">
            <button class="dropButton">Menu</button>
            <nav class="dropContent">
                <a href="HomePages/loggedHome.php">Home Page</a>
                <a href="userDashboard.php">My Profile</a>
                <a href="myPlan.php">My Plan</a>
                <a href="communityPage.php">Community</a>
                <a href="logout.php">Sign out </a>
            </nav>
        </div>
    </header>

    <main>
        <!--adds a nav for users to view their saved exercises -->
        <div class="options-container">
            <a href="addExercise.php" class="addLibrary">Add exercise to library</a><br>
            <a href="userExerciseLibrary.php" class="savedLibrary">Saved exercises</a>
            <!-- Allows user to sort the exercises by musicle group that they are interested in -->
            <form action="" method="get" id="exerciseSortForm">
                <label for="exerciseSort">Sort by Muscle Group:</label>
                <!--calls the submit form function onces the changes the selection -->
                <select name="exerciseSort" id="exerciseSort" onchange="submitForm()">
                    <option value="">Select</option>
                    <option value="all">All</option>
                    <option value="Full-body">Full Body</option>
                    <option value="Legs">Legs</option>
                    <option value="Arms">Arms</option>
                    <option value="Chest">Chest</option>
                    <option value="Back">Back</option>
                </select>
            </form>
        </div>
        <div class="container">
            <?php
            // Database configuration
            $servername = "localhost";
            $username = "root";
            $password = "mysql";
            $dbname = "fitnessTrackDB";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die ("Connection failed: " . $conn->connect_error);
            }

            //Checks if the exercises was sorted, if not defaults to all from the database
            $sort = isset ($_GET['exerciseSort']) ? $_GET['exerciseSort'] : 'all';

            // Fetches exercises from the database based on sorting option selected 
            if ($sort == 'all') {
                $sql_fetch_exercises = "SELECT * FROM ExerciseLibrary";
            } else {
                $sql_fetch_exercises = "SELECT * FROM ExerciseLibrary WHERE MuscleGroup = '$sort'";
            }

            $result = $conn->query($sql_fetch_exercises);

            // Check if there are any exercises for that group
            if ($result->num_rows > 0) {
                // Displays the results in sepreate conntainer for each exercise
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='exercise-container'>";
                    echo "<h3>" . $row["ExerciseName"] . "</h3>";
                    echo "<p><b>Muscle Group:</b> " . $row["MuscleGroup"] . "</p>";
                    echo "<p><b>Number of days</b>: " . $row["Days"] . "</p>";
                    echo "<p><b>Number of sets:</b> " . $row["Sets"] . "</p>";
                    echo "<p><b>Descripton:</b> " . $row["Description"] . "</p>";
                    if ($isAdmin == 1) {
                        echo "<button onclick= 'deleteExercise(" . $row['ExerciseID'] . ")'>Delete this Exercise</button>";
                    }
                    echo "<button onclick='saveExercise(" . $row['ExerciseID'] . ")'>Save this Exercise</button>";
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
    <script>
        //function for the user saving an exercise
        function saveExercise(exerciseId) {
            // Make an AJAX request to the server to save the exercise to the library using saveExercise.php
            var httpRequest = new XMLHttpRequest();
            httpRequest.open("GET", "saveExercise.php?exerciseId=" + exerciseId, true);
            httpRequest.send();
        }

        //function for deleting exercise for admins
        function deleteExercise(exerciseId) {
            var httpRequest = new XMLHttpRequest();
            httpRequest.open("GET", "deleteExercise.php?exerciseId=" + exerciseId, true);
            httpRequest.send();
            //Refreshes the page, so that delete will be shown 
            setTimeout(function () {
                location.reload();
            }, 100);
        }





        //function that submits the form when user makes a sorting selection 
        function submitForm() {
            document.getElementById("exerciseSortForm").submit();
        }
    </script>

</body>