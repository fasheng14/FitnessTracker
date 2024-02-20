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

        <!-- Navigation between site pages  -->
        <nav>
            <a href="myPlan.php">My Plan</a>
            <a href="communityPage.php">Community</a>
            <a href="exerciseLibrary.php">Exercise Library</a>
        </nav>
    </header>

    <!-- Main Content  -->
    <main>
        <h2>Performance Hub</h2>
        <div class="container">

            <!-- Today's workout item box  -->
            <div class="item" id="todayWorkout">
                <h3>Today's Workout</h3>

                <!-- Table for today's workout  -->
                <table>
                    <caption>Body Weight Workout</caption>
                    <tr>
                        <th>Exercises</th>
                        <th>Sets</th>
                        <th>Reps</th>
                        <th>Weight</th>
                        <th>Distance</th>
                        <th>Duration</th>
                    </tr>
                    <tr>
                        <td>Tricep Dips</td>
                        <td>3</td>
                        <td>8</td>
                        <td>Body</td>
                        <td>NA</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Push ups</td>
                        <td>5</td>
                        <td>10</td>
                        <td>Body</td>
                        <td>NA</td>
                        <td>NA</td>
                    </tr>
                    <tr>
                        <td>Treadmill Run</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>2 Miles</td>
                        <td></td>
                    </tr>
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

            <!-- Goals item box  -->
            <div class="item" id="goals">
                <h3>Goals</h3>
                <p>Current Plan: [Current Plan Name]</p>
                <p>Weekly Workout Goal: [Weekly Workout Goal] workouts</p>
                <p>Weight Loss Goal: [Weight Loss Goal] lb</p>
                <p>Nutritional Goal: [Nutritional Goal Description]</p>
            </div>

            <!-- Current body stats item box  -->
            <div class="item" id="currentBodyStats">
                <h3>Current Body Stats</h3>
                <p>Date: [Date]</p>
                <p>Weight: [User's Current Weight] lb</p>
                <p>Body Fat Percentage: [User's Body Fat Percentage]%</p>
                <p>Muscle Mass: [User's Muscle Mass] lb</p>
                <p>Resting Heart Rate: [User's Resting Heart Rate] bpm</p>
            </div>
        </div>

    </main>
</body>
<footer>

</footer>

</html>