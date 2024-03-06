<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Plan</title>
    <link rel="stylesheet" type="text/css" href="myPlanStyle.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>
    <header>
        <h1>Fitness Tracker</h1>
        <div class="dropDown">
            <button class="dropButton">Menu</button>
            <nav class="dropContent">
                <a href="userDashboard.php">My Dashboard</a>
                <a href="communityPage.php">Community</a>
                <a href="exerciseLibrary.php">Exercise Library</a>
            </nav>
        </div>

    </header>

    <h2>My Plan</h2>
    <main>

        <div class="container">
            <div class="left-column">
                <!-- Workout Schedule Box -->
                <div class="box" id="workoutScheduleBox">
                    <h3>Workout Schedule</h3>
                    <!-- generated days of the week -->
                    <div class="workout-day" id="Monday">
                        <h4 class="workout-day-header">Monday</h4>
                        <div class="workout-list" id="MondayWorkoutList">
                            <!-- workouts -->
                        </div>
                    </div>
                    <div class="workout-day" id="Tuesday">
                        <h4 class="workout-day-header">Tuesday</h4>
                        <div class="workout-list" id="TuesdayWorkoutList">
                            <!-- workouts  -->
                        </div>
                    </div>
                    <div class="workout-day" id="Wednesday">
                        <h4 class="workout-day-header">Wednesday</h4>
                        <div class="workout-list" id="WednesdayWorkoutList">
                            <!-- workouts  -->
                        </div>
                    </div>
                    <div class="workout-day" id="Thursday">
                        <h4 class="workout-day-header">Thursday</h4>
                        <div class="workout-list" id="ThursdayWorkoutList">
                            <!-- workouts -->
                        </div>
                    </div>
                    <div class="workout-day" id="Friday">
                        <h4 class="workout-day-header">Friday</h4>
                        <div class="workout-list" id="FridayWorkoutList">
                            <!--  workouts  -->
                        </div>
                    </div>
                    <div class="workout-day" id="Saturday">
                        <h4 class="workout-day-header">Saturday</h4>
                        <div class="workout-list" id="SaturdayWorkoutList">
                            <!--  workouts  -->
                        </div>
                    </div>
                    <div class="workout-day" id="Sunday">
                        <h4 class="workout-day-header">Sunday</h4>
                        <div class="workout-list" id="SundayWorkoutList">
                            <!--  workouts -->
                        </div>
                    </div>

                    <!-- Add Workout Section -->
                    <div class="add-workout-section" id="addWorkoutSection">
                        <h3>Add a Workout</h3>
                        <div class="workout-options">
                            <button class="selectCustomWorkout">Custom Workout</button>
                            <button class="selectExerciseLibrary">Choose from Exercise Library</button>
                            <button class="selectNoWorkout">Rest Day</button>
                        </div>
                        <!-- Custom Workout Form (initially hidden) -->
                        <form id="customWorkoutForm" class="hidden">
                            <label for="dayOfWeek">Day of the Week:</label>
                            <select id="dayOfWeek">
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select><br><br>
                            <label for="name">Name:</label>
                            <textarea id="name" name="name"></textarea><br><br>
                            <label for="sets">Sets:</label>
                            <input type="number" id="sets" name="sets"><br><br>
                            <label for="reps">Reps:</label>
                            <input type="number" id="reps" name="reps"><br><br>
                            <label for="weight">Weight:</label>
                            <input type="number" id="weight" name="weight"><br><br>
                            <label for="distance">Distance:</label>
                            <input type="number" id="distance" name="distance"><br><br>
                            <label for="duration">Duration:</label>
                            <input type="number" id="duration" name="duration"><br><br>
                            <button type="submit">Add Custom Workout</button>
                        </form>

                        <!-- Rest Day Form (initially hidden) -->
                        <form id="restDayForm" class="hidden">
                            <label for="restDayOfWeek">Select Day for Rest:</label>
                            <select id="restDayOfWeek">
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select><br><br>
                            <button type="submit">Add Rest Day</button>
                        </form>
                    </div>

                </div>
                <!-- Current Body Stats Box -->
                <div class="box" id="currentBodyStatsBox">
                    <h3>Current Body and Performance Stats</h3>
                    <form id="currentBodyStatsForm">
                        <label for="weight">Weight (lb):</label>
                        <input type="number" id="weight" name="weight" required><br><br>
                        <label for="benchPR">Bench Press Personal Record (lb):</label>
                        <input type="number" id="benchPR" name="benchPR"><br><br>

                        <label for="squatPR">Squat Personal Record (lb):</label>
                        <input type="number" id="squatPR" name="squatPR"><br><br>

                        <label for="longestDistanceRan">Longest Distance Ran (mi):</label>
                        <input type="number" id="longestDistanceRan" name="longestDistanceRan"><br><br>

                        <label for="longestWorkout">Longest Workout (minutes):</label>
                        <input type="number" id="longestWorkout" name="longestWorkout"><br><br>
                        <button type="submit">Update Stats</button>
                        <button type="button" id="addCategoryButton">Add Category</button>
                    </form>
                </div>
            </div>

            <div class="right-column">
                <!-- Goals Box -->
                <div class="box" id="goalsBox">
                    <h3>Goals</h3>
                    <!-- Form to add new goal -->
                    <form id="addGoalForm">
                        <input type="text" id="newGoalInput" placeholder="Enter new goal">
                        <label for="goalCategory">Select Category:</label>
                        <select id="goalCategory">
                            <option value="weekly">Weekly Workout Goals</option>
                            <option value="nutrition">Nutrition Goals</option>
                            <option value="weightLoss">Weight Loss Goals</option>
                        </select>
                        <button type="submit">Add Goal</button>
                    </form>

                    <!-- Goals list -->
                    <div id="weeklyGoal">
                        <h4>Weekly Workout Goal</h4>
                        <ul class="goalsList" id="weeklyGoalsList">
                        </ul>
                    </div>

                    <div id="nutritionGoal">
                        <h4>Nutrition Goal</h4>
                        <ul class="goalsList" id="nutritionGoalsList">
                            <!-- Nutrition goals will be populated here -->
                        </ul>
                    </div>

                    <div id="weightLossGoal">
                        <h4>Weight Loss Goal</h4>
                        <ul class="goalsList" id="weightLossGoalsList">
                            <!-- Weight loss goals will be populated here -->
                        </ul>
                    </div>
                </div>



                <div class="box" id="nutrition">
                    <h3>Nutrition Information</h3>
                    <form id="nutritionForm">
                        <label for="calorieIn">Caloric Intake:</label>
                        <input type="number" id="cal" name="cal" required><br><br>
                        <label for="calorieOut">Calories Burned:</label>
                        <input type="number" id="calOut" name="calOut"><br><br>
                        <button type="submit">Update Nutrition</button>
                    </form>
                </div>


            </div>
        </div>


    </main>

    <script>
        $(document).ready(function () {
            // Function to handle adding a new goal
            $("#addGoalForm").submit(function (event) {
                event.preventDefault(); // Prevent default form submission

                // Get the value of the new goal input and selected category
                var newGoal = $("#newGoalInput").val().trim();
                var category = $("#goalCategory").val();

                // Check if the input is not empty
                if (newGoal !== "") {
                    // Create a new list item for the goal
                    var newGoalItem = "<li><span class='goalText'>" + newGoal + "</span>" +
                        "<div class='dropdown'>" +
                        "<button class='optionsButton'>...</button>" +
                        "<div class='dropdown-content'>" +
                        "<button class='modifyGoalButton'>Modify</button>" +
                        "<button class='deleteGoalButton'>Delete</button>" +
                        "</div>" +
                        "</div>" +
                        "</li>";

                    // Append the new goal item to the selected category's goals list
                    $("#" + category.replace(/\s+/g, "_") + "GoalsList").append(newGoalItem);

                    // Clear the input field
                    $("#newGoalInput").val("");
                }
            });

            // Handle modification of goal
            $("#goalsBox").on("click", ".modifyGoalButton", function () {
                var goalText = $(this).closest("li").find(".goalText");
                var modifiedGoal = prompt("Modify Goal", $(goalText).text());
                if (modifiedGoal !== null && modifiedGoal.trim() !== "") {
                    $(goalText).text(modifiedGoal);
                }
            });

            // Handle deletion of goal
            $("#goalsBox").on("click", ".deleteGoalButton", function () {
                $(this).closest("li").remove();
            });

            // Handle options button to show dropdown content
            $("#goalsBox").on("click", ".optionsButton", function (event) {
                event.stopPropagation();
                var dropdownContent = $(this).next(".dropdown-content");
                $(".dropdown-content").not(dropdownContent).removeClass("show");
                dropdownContent.toggleClass("show");
            });

            // Prevent dropdown from closing when clicking inside the dropdown
            $(".dropdown-content").on("click", function (event) {
                event.stopPropagation();
            });

            // Close dropdown when clicking outside the dropdown
            $(document).on("click", function () {
                $(".dropdown-content").removeClass("show");
            });

            // Show or hide workout options
            $(".add-workout-section h3").click(function () {
                $(".workout-options").toggleClass("show");
            });

            // Prevent workout options from closing when clicking inside
            $(".workout-options").on("click", function (event) {
                event.stopPropagation();
            });

            // Close workout options when clicking outside
            $(document).on("click", function () {
                $(".workout-options").removeClass("show");
            });

            // Select exercise library option
            $(".selectExerciseLibrary").click(function () {
                console.log("Exercise library selected");
            });

            // Select no workout option
            $(".selectNoWorkout").click(function () {
                console.log("No workout selected");
            });

            // Select custom workout option
            $(".selectCustomWorkout").click(function () {
                $("#customWorkoutForm").toggleClass("hidden");
            });

            // Hide custom workout form when other options are clicked
            $(".selectExerciseLibrary, .selectNoWorkout").click(function () {
                $("#customWorkoutForm").addClass("hidden");
            });

            // Handle submission of custom workout form
            $("#customWorkoutForm").submit(function (event) {
                event.preventDefault();
                // Get form data
                var name = $("#name").val();
                var dayOfWeek = $("#dayOfWeek").val();
                var sets = $("#sets").val();
                var reps = $("#reps").val();
                var weight = $("#weight").val();
                var distance = $("#distance").val();
                var duration = $("#duration").val();
                var description = $("#description").val();

                // Create the new workout item HTML
                var newWorkoutItem = "<div class='workout-list-item'>" +
                    "<strong>Name:</strong> " + name + "<br>" +
                    "<strong>Sets:</strong> " + sets + "<br>" +
                    "<strong>Reps:</strong> " + reps + "<br>" +
                    "<strong>Weight:</strong> " + weight + "<br>" +
                    "<strong>Distance:</strong> " + distance + "<br>" +
                    "<strong>Duration:</strong> " + duration +
                    "</div>";

                // Append the new workout item to the appropriate day of the week's workout list
                $("#" + dayOfWeek + "WorkoutList").append(newWorkoutItem);

                // Clear the form fields
                $("#sets").val("");
                $("#reps").val("");
                $("#weight").val("");
                $("#distance").val("");
                $("#duration").val("");
                $("#description").val("");

                // Hide the form
                $("#customWorkoutForm").addClass("hidden");

                console.log("Custom workout form submitted");
            });

            // Select rest day option
            $(".selectNoWorkout").click(function () {
                $("#restDayForm").toggleClass("hidden");
            });

            // Handle submission of rest day form
            $("#restDayForm").submit(function (event) {
                event.preventDefault();
                // Get selected day for rest
                var restDayOfWeek = $("#restDayOfWeek").val();

                // Create the new rest day item HTML
                var newRestDayItem = "<div class='workout-list-item'>Rest Day</div>";

                // Append the new rest day item to the appropriate day of the week's workout list
                $("#" + restDayOfWeek + "WorkoutList").append(newRestDayItem);

                // Hide the form
                $("#restDayForm").addClass("hidden");

                console.log("Rest day form submitted");
            });

        });

    </script>

</body>
<footer>
</footer>

</html>