<?php
//This page is very similer to the user dashboard
//Just slight changes and is used for the user to look at  other users stats and schedules 
session_start(); // Start the session

// Check if user_id is set in session
if (!isset($_SESSION["user_id"])) {
    // Redirect to the sign-in page or handle the situation accordingly
    header("Location: signIn.php");
    exit; // Stop further execution
}

// Grabs the id that was sent for the dashboard to be looked at
$userID = $_POST["UserID"];






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
$currentDayOfWeek = date("l");

//grabs the username of whose dashboard is being looked at
$sql_select_username = "SELECT Username FROM User WHERE UserID = ?";
$stmt = $conn->prepare($sql_select_username);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result_username = $stmt->get_result();
if ($result_username->num_rows > 0) {
    $username = $result_username->fetch_assoc()['Username'];
}




// This fetechs the full workout of the user, so the user can see their full schedule 
$sql_select_workouts = "SELECT * FROM CustomWorkouts WHERE UserID = ?";
$stmt = $conn->prepare($sql_select_workouts);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Error executing query: " . $conn->error);
}

// Initialize $userWeight variable
$userWeight = null;

// Query to fetch the user's weight from the database
$sql_select_user_weight = "SELECT Weight FROM BodyStats WHERE UserID = ?";
$stmt_weight = $conn->prepare($sql_select_user_weight);
$stmt_weight->bind_param("i", $userID);
$stmt_weight->execute();
$result_weight = $stmt_weight->get_result();

// Check if the query returned any rows
if ($result_weight->num_rows > 0) {
    // Fetch the user's weight
    $userWeight = $result_weight->fetch_assoc()['Weight'];
}

// Query to fetch the total exercise duration for the current day from the database
$sql_select_total_exercise_duration = "SELECT SUM(Duration) AS TotalDuration FROM CustomWorkouts WHERE DayOfWeek = ? AND UserID = ?";
$stmt_duration = $conn->prepare($sql_select_total_exercise_duration);
$stmt_duration->bind_param("si", $currentDayOfWeek, $userID);
$stmt_duration->execute();
$result_duration = $stmt_duration->get_result();
$totalExerciseDuration = $result_duration->fetch_assoc()['TotalDuration'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?echo $username?> Dashboard</title>
    <link rel="stylesheet" type="text/css" href="userDashboardStyle.css">
    <!-- Link to the CSS file for messaging component -->
    <link rel="stylesheet" type="text/css" href="messenger.css">
    <!-- Mate SC front from Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
</head>
<body>
    <header>
         <div class="homeLogo" href="HomePages/loggedHome.php">
            <!-- Image -->
            <img src="HomePages/graphic/fitnessLogo.png" alt="MagnCreo Logo" width="150px">
        </div>
        <div class="name">
            <h1 style="font-size: 2em;"><?echo $username?>'s Hub</h1>
        </div>
        <!-- Navigation between site pages  -->
        <div class="dropDown">
            <button class="dropButton">Menu</button>
            <nav class="dropContent">
                <a href="HomePages/loggedHome.php">Home</a>
                <a href="myPlan.php">My Plan</a>
                <a href="communityPage.php">Community</a>
                <a href="exerciseLibrary.php">Exercise Library</a>
                <a href="logout.php">Sign out </a>
            </nav>
        </div>
    </header>

    <!-- Main Content  -->
    <main>


        <div class="container">
            <!-- Full workout schedule -->
            <div class="item" id="todayWorkout">
                <h3>Today's Workout</h3>
                <table>
                    <tr>
                        <th>Day</th>
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
                        echo "<td>" . $row['DayOfWeek'] . "</td>";
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
                <!--This button does not do anything yet, but will be used so the user can use other
                users workouts and schedule, if they would like -->
                <button class="addPlan">Use this Routine</button>
            </div>

            <!-- Daily Report item box  -->
            <div class="item" id="dailyReport">
                <h3 class="report-title">Daily Report</h3>
                <div class="report-info">
                    <div class="report-item">
                        <span class="item-label">Date:</span>
                        <span class="item-value"><?php echo date("Y-m-d"); ?></span>
                    </div>
                    <div class="report-item">
                        <span class="item-label">Weight:</span>
                        <span class="item-value"><?php echo $userWeight . ' lb'; ?></span>
                    </div>
                    <div class="report-item">
                        <span class="item-label">Exercise Duration:</span>
                        <span class="item-value"><?php echo $totalExerciseDuration; ?> mins</span>
                    </div>
                </div>
            </div>

            <!-- Goals item box -->
            <div class="item" id="goals">
                <h3>Goals</h3>
                <h4>Weekly Workout Goals</h4>
                <p id="weeklyWorkoutGoal"></p>
                <h4>Weight Loss Goals</h4>
                <p id="weightLossGoal"> </p>
                <h4>Nutrition Goals</h4>
                <p id="nutritionalGoal"> </p>
            </div>

            <!-- Current body stats item box  -->
            <div class="item" id="currentBodyStat">
                <h3><?php echo $username?>'s Records</h3>
                <p id="weight"></p>
                <p id="benchPressPR"></p>
                <p id="squatPR"></p>
                <p id="longestDistance"></p>
                <p id="longestWorkout"></p>
            </div>
        </div>

        <!-- Messaging button -->
        <button class="messenger-button" onclick="toggleMessenger()">Messenger</button>

        <!-- Messenger container -->
        <div class="msg-container" id="msg-container">
            <div class="header" onclick="toggleMessenger()">Messenger <span class="close-btn"></span></div>
            <div class="msg-area" id="msg-area"></div>
            <div class="bottom">
                <input type="text" name="msginput" class="msginput" id="msginput" placeholder="Enter your message here ... (Press enter to send message)">
            </div>
        </div>
    </main>

    <footer>
    </footer>

    <!-- Link to the JavaScript file for messaging component -->
    <script src="messenger.js"></script>

    <!-- JavaScript libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
       $(document).ready(function() {
            // Event listener for the "Sign Out" link
            $("#signOutLink").click(function(event) {
                event.preventDefault(); 

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

            // Function to load goals for the dashboard, sends the id of the user who owns the dashboard
            function loadGoalsForDashboard() {
                $.ajax({
                    url: 'loadGoalsFromDatabase.php',
                    type: 'GET',
                    dataType: 'json',
                    data: {userID: <?php echo $userID; ?>},
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
                    data: {userID: <?php echo $userID; ?>},
                    success: function(data) {
                        // Check if data is empty
                        if (data.length > 0) {
                            // Extract the first row of data
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