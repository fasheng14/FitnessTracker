<DOCTYPE html>
    <html lang=en>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Community Page</title>
        <link rel="stylesheet" type="text/css" href="communityStyle.css">

        <!-- Mate SC front from Google Fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
    </head>

    <body>
        <header>
            <h1>Fitness Tracker</h1>
            <h1>Community Page</h1>

            <!-- Navigation between site pages  -->
            <div class="dropDown">
                <button class="dropButton">Menu</button>
                <nav class="dropContent">
                    <a href="myPlan.php">My Plan</a>
                    <a href="userDashboard.php">My Dashboard</a>
                    <a href="exerciseLibrary.php">Exercise Library</a>
                </nav>
            </div>
        </header>

        <!-- Main Content  -->
        <main>
            <div class="container">

                <!-- Recommendation column (only 5 at a time) -->
                <!-- take and show name of user and description of workout -->
                <!-- Similar goal as you -->
                <div class="itemContainer" id="recommendation">
                    <h2>Recommendations</h2>
                    <div class="item" id="recommendationItem">
                        <h3>Recommendation 1</h3>
                    </div>
                    <div class="item" id="recommendationItem">
                        <h3>Recommendation 2</h3>
                    </div>
                    <div class="item" id="recommendationItem">
                        <h3>Recommendation 3</h3>
                    </div>
                    <div class="item" id="recommendationItem">
                        <h3>Recommendation 4</h3>
                    </div>
                    <div class="item" id="recommendationItem">
                        <h3>Recommendation 5</h3>
                    </div>
                </div>

                <!-- Workout column (take and show name of user and description of workout) -->
                <div class="itemContainer" id="workout">
                    <h2>Workouts</h2>
                    <div class="item" id="workoutItem">
                        <h3>[user's name] Workout</h3>
                        <p>This is where the description of what the workout does goes.</p>
                    </div>
                    <div class="item" id="workoutItem">
                        <h3>Ted's Workout</h3>
                    </div>
                    <div class="item" id="workoutItem">
                        <h3>Chris' Workout</h3>
                    </div>
                    <div class="item" id="workoutItem">
                        <h3>Gavin's Workout</h3>
                    </div>
                    <div class="item" id="workoutItem">
                        <h3>Gavin's Workout</h3>
                    </div>
                    <div class="item" id="workoutItem">
                        <h3>Michael's Workout</h3>
                    </div>
                </div>
            </div>
        </main>
    </body>

    <footer>

    </footer>

    </html>