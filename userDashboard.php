<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Dashboard</title>
        <link rel="stylesheet" type="text/css" href="userDashboardStyle.css">
    </head>
    <body>
        <header>
            <h1>Fitness Tracker</h1>

            <!-- Navigation between site pages  -->
            <nav>
                <a href="">My Plan</a>
                <a href="">Community</a>
                <a href="">Exercise Library</a>
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

                <!-- Ddaily report item box  -->
                <div class="item" id="dailyReport">
                    <h3>Daily Report</h3>
                </div>

                <!-- Goals item box  -->
                <div class="item" id="goals">
                    <h3>Goals</h3>
                </div>

                <!-- Current body stats item box  -->
                <div class="item" id="currentBodyStats">
                    <h3>Current Body Stats</h3>
                </div>
            </div>

        </main>
    </body>
    <footer>

    </footer>
</html>