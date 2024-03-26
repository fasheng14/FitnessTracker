<?php
session_start(); // Start the session

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

// Get the current day of the week (1 for Monday, 2 for Tuesday, etc.)
$currentDayOfWeek = date("l");

// Query to fetch today's workout data based on the current day of the week
$sql_select_today_workout = "SELECT Name, Sets, Reps, Weight, Distance, Duration FROM CustomWorkouts WHERE DayOfWeek = ?";
$stmt = $conn->prepare($sql_select_today_workout);
$stmt->bind_param("s", $currentDayOfWeek);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" type="text/css" href="userDashboardStyle.css">
    <!-- Mate SC front from Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Fitness Tracker</h1>
        <h1>Performance Hub</h1>
        <!-- Navigation between site pages  -->
        <div class="dropDown">
            <button class="dropButton">Menu</button>
            <nav class="dropContent">
                <a href="myPlan.php">My Plan</a>
                <a href="communityPage.php">Community</a>
                <a href="exerciseLibrary.php">Exercise Library</a>
                <a href="signIn.php" id="signOutLink">Sign Out</a>
            </nav>
        </div>
    </header>

    <!-- Main Content  -->
    <main>
        <div class="container">
            <!-- Today's workout item box  -->
            <div class="item" id="todayWorkout">
                <h3>Today's Workout</h3>
                <table>
                    <tr>
                        <th>Exercises</th>
                        <th>Sets</th>
                        <th>Reps</th>
                        <th>Weight</th>
                        <th>Distance</th>
                        <th>Duration</th>
                    </tr>
                    <?php
                    // Populate the table rows with fetched workout data
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
                    ?>
                </table>
            </div>

            <!-- Daily Report item box  -->
            <div class="item" id="dailyReport">
                <h3>Daily Report</h3>
                <p>Date: [Today's Date]</p>
                <p>Weight: [User's Weight] lb</p>
                <p>Caloric Intake: [Calories Consumed] kcal</p>
                <p>Exercise Duration: [Total Exercise Duration] mins</p>
                <p>Water Intake: [Water Consumed] ml</p>
            </div>

            <!-- Goals item box -->
            <div class="item" id="goals">
                <h3>Goals</h3>
                <h4>Weekly Workout Goals</h4>
                <p id="weeklyWorkoutGoal"></p>
                <h4>Weight Loass Goals</h4>
                <p id="weightLossGoal"> </p>
                <h4>Nutrition Goals</h4>
                <p id="nutritionalGoal"> </p>
            </div>

            <!-- Current body stats item box  -->
            <div class="item" id="currentBodyStat">
                <h3>My Personal Records</h3>
                <p id="weight"></p>
                <p id="benchPressPR"></p>
                <p id="squatPR"></p>
                <p id="longestDistance"></p>
                <p id="longestWorkout"></p>
            </div>
        </div>
    </main>

    <footer>
    </footer>

    <!-- JavaScript libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
       $(document).ready(function() {
            // Event listener for the "Sign Out" link
            $("#signOutLink").click(function(event) {
                event.preventDefault(); // Prevent the default action of the link

                // Make an AJAX request to the signOutProcess.php file
                $.ajax({
                    url: "signOutProcess.php",
                    method: "GET",
                    success: function(response) {
                        // Handle success, such as redirecting the user to the sign-in page
                        window.location.href = "signIn.php";
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(xhr.responseText);
                    }
                });
            });

            // Function to load goals for the dashboard
            function loadGoalsForDashboard() {
                $.ajax({
                    url: 'loadGoalsFromDatabase.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Iterate through each goal
                        data.forEach(function(goal) {
                            switch (goal.Category) {
                                case 'weekly':
                                    // Append a new paragraph for each weekly goal
                                    $('#weeklyWorkoutGoal').append('<p>' + goal.GoalText + '</p>');
                                    break;
                                case 'nutrition':
                                    // Append a new paragraph for each nutritional goal
                                    $('#nutritionalGoal').append('<p>' + goal.GoalText + '</p>');
                                    break;
                                case 'weightLoss':
                                    // Append a new paragraph for each weight loss goal
                                    $('#weightLossGoal').append('<p>' + goal.GoalText + '</p>');
                                    break;
                                default:
                                    break;
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading goals for dashboard:', status, error);
                    }
                });
            }

            // Call the function to load goals for the dashboard
            loadGoalsForDashboard();

            // Function to fetch body stats data from the server
            function loadBodyStats() {
                $.ajax({
                    url: 'loadBodyStats.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Check if data is empty
                        if (data.length > 0) {
                            // Extract the first row of data (assuming there's only one row per user)
                            var bodyStats = data[0];

                            // Populate the HTML elements with body stats data
                            $('#weight').text('Weight: ' + bodyStats.Weight + ' lb');
                            $('#benchPressPR').text('Bench Press PR: ' + bodyStats.BenchPressPR + ' lb');
                            $('#squatPR').text('Squat PR: ' + bodyStats.SquatPR + ' lb');
                            $('#longestDistance').text('Longest Distance Ran: ' + bodyStats.LongestDistance + ' mi');
                            $('#longestWorkout').text('Longest Workout: ' + bodyStats.LongestWorkout + ' minutes');
                        } else {
                            // If no data is returned, display a message
                            $('#currentBodyStat').append('<p>No body stats available.</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading body stats:', status, error);
                    }
                });
            }

            // Call the function to load body stats when the page is ready
            loadBodyStats();
        });
    </script>
</body>
</html>

<?php
// Close prepared statement
$stmt->close();

// Close connection
$conn->close();
?>
