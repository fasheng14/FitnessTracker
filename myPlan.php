<?php
session_start();

// Check if UserID is set in session
if (!isset($_SESSION["user_id"])) {
    // Redirect to the sign-in page or handle the situation accordingly
    header("Location: signIn.php");
    exit; // Stop further execution
}


$userID = $_SESSION["user_id"];
?>
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
                <a href="logout.php">Sign out </a>
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
                        <form id="customWorkoutForm" class="hidden" action="customWorkoutProcess.php" method="post">
                            <label for="dayOfWeek">Day of the Week:</label>
                            <select id="dayOfWeek" name="dayOfWeek">
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

                        <!-- Form for choosing from library (initially hidden) -->
                        <form id="personalLibraryForm" class="hidden" action="personalLibraryProcess.php" method="post">
                        <label for="dayOfWeek">Day of the Week:</label>
                            <select id="dayOfWeek" name="dayOfWeek">
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>><br><br>

                            <!-- Grabs from their saved library -->
                            <label for="exercise">Saved Exercises: </label>
                                <select id="exercise" name="exercise">
                                    <option value="">Select</option>
                                </select><br><br>

                            <!--Allows user to custimze aspects of the workout -->
                            <!--We can edit the exercise library database entry to include this information -->
                            <!--For the user, currently it takes the exercise name and the recomended number of sets -->
                            <!--And fills that in for the user automatically -->
                            <label for="reps">Reps:</label>
                            <input type="number" id="reps" name="reps"><br><br>
                            <label for="weight">Weight:</label>
                            <input type="number" id="weight" name="weight"><br><br>
                            <label for="distance">Distance:</label>
                            <input type="number" id="distance" name="distance"><br><br>
                            <label for="duration">Duration:</label>
                            <input type="number" id="duration" name="duration"><br><br>
                            <button type="submit">Add from Library</button>

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
                    <form id="currentBodyStatsForm" action="updatePerformanceStats.php" method="post">
                        <label for="weight">Weight (lb):</label>
                        <input type="number" id="weight" name="weight" ><br><br>
                        <label for="benchPR">Bench Press Personal Record (lb):</label>
                        <input type="number" id="benchPR" name="benchPR"><br><br>

                        <label for="squatPR">Squat Personal Record (lb):</label>
                        <input type="number" id="squatPR" name="squatPR"><br><br>

                        <label for="longestDistanceRan">Longest Distance Ran (mi):</label>
                        <input type="number" id="longestDistanceRan" name="longestDistanceRan"><br><br>

                        <label for="longestWorkout">Longest Workout (minutes):</label>
                        <input type="number" id="longestWorkout" name="longestWorkout"><br><br>

                        <!-- Submit button to update stats -->
                        <button type="submit">Update Stats</button>
                    </form>
                </div>
            </div>

            <div class="right-column">
                <!-- Goals Box -->
                <div class="box" id="goalsBox">
                    <h3>Goals</h3>
                    <!-- Form to add new goal -->
                    <form id="addGoalForm" action="addGoalProcess.php" method="post">
                        <input type="text" id="newGoalInput" name="goalText" placeholder="Enter new goal">
                        <label for="goalCategory">Select Category:</label>
                        <select id="goalCategory" name="goalCategory">
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
        $(document).ready(function() {
            // Show or hide workout options
            $(".add-workout-section h3").click(function() {
                $(".workout-options").toggleClass("show");
            });

            // Prevent workout options from closing when clicking inside
            $(".workout-options").on("click", function(event) {
                event.stopPropagation();
            });

            // Close workout options when clicking outside
            $(document).on("click", function() {
                $(".workout-options").removeClass("show");
            });

            // Select exercise library option
            $(".selectExerciseLibrary").click(function() {
                $("#personalLibraryForm").toggleClass("hidden");
            });

            // Select no workout option
            $(".selectNoWorkout").click(function() {
                console.log("No workout selected");
            });

            // Select custom workout option
            $(".selectCustomWorkout").click(function() {
                $("#customWorkoutForm").toggleClass("hidden");
            });

            // Hide custom workout form when other options are clicked
            $(".selectExerciseLibrary, .selectNoWorkout").click(function() {
                $("#customWorkoutForm").addClass("hidden");
            });

            // Hide Library Workout Form when other optons are clicked
            $(".selectCustomWorkout, .selectNoWorkout").click(function() {
                $("#personalLibraryForm").addClass("hidden");
            });

            // Select rest day option
            $(".selectNoWorkout").click(function() {
                $("#restDayForm").toggleClass("hidden");
            });

            // Handle options button to show dropdown content
            $("#goalsBox").on("click", ".optionsButton", function(event) {
                event.stopPropagation();
                var dropdownContent = $(this).next(".dropdown-content");
                $(".dropdown-content").not(dropdownContent).removeClass("show");
                dropdownContent.toggleClass("show");
            });

            // Prevent dropdown from closing when clicking inside the dropdown
            $(".dropdown-content").on("click", function(event) {
                event.stopPropagation();
            });

            // Close dropdown when clicking outside the dropdown
            $(document).on("click", function() {
                $(".dropdown-content").removeClass("show");
            });

            
            // Function to load goals
            function loadGoals() {
                $.ajax({
                    url: 'loadGoalsFromDatabase.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Populate each goal list
                        data.forEach(function(goal) {
                            switch (goal.Category) {
                                case 'weekly':
                                    $('#weeklyGoalsList').append('<li>' + goal.GoalText + '</li>');
                                    break;
                                case 'nutrition':
                                    $('#nutritionGoalsList').append('<li>' + goal.GoalText + '</li>');
                                    break;
                                case 'weightLoss':
                                    $('#weightLossGoalsList').append('<li>' + goal.GoalText + '</li>');
                                    break;
                                default:
                                    break;
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading goals:', status, error);
                    }
                });
            }

            // Load goals when the page is ready
            loadGoals();

            // Load custom workouts
            function loadCustomWorkouts() {
                $.ajax({
                    url: 'loadCustomWorkouts.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Populate each day of the week with custom workouts
                        data.forEach(function(workout) {
                            var dayOfWeek = workout.DayOfWeek;
                            var workoutName = workout.Name;
                            var workoutSets = workout.Sets;
                            var workoutReps = workout.Reps;
                            var workoutWeight = workout.Weight;
                            var workoutDistance = workout.Distance;
                            var workoutDuration = workout.Duration;
                            $('#' + dayOfWeek + 'WorkoutList').append('<p>' + "Name: " + workoutName + ' ' + "Sets: " + workoutSets + ' ' + "Reps: " + workoutReps + ' ' +  "Weight: " + workoutWeight + ' ' + "Distance: " + workoutDistance + ' ' + "Duration: " + workoutDuration +'</p>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading custom workouts:', status, error);
                    }
                });
            }

            // Load custom workouts when the page is ready
            loadCustomWorkouts();

            // Handle submission of custom workout form
            $("#customWorkoutForm").submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Serialize the form data
                var formData = $(this).serialize();

                // Submit the form via AJAX
                $.ajax({
                    url: 'customWorkoutProcess.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Reload custom workouts after successfully adding a new one
                        loadCustomWorkouts();

                        // Reset the form
                        $("#customWorkoutForm")[0].reset();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error submitting custom workout form:', status, error);
                    }
                });
            });
        });

        // Load Saved workouts
        function loadSavedExercises() {
                $.ajax({
                    url: 'loadSavedExercises.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var selectOptions = $('#exercise');
                        selectOptions.empty();
                        selectOptions.append($('<option>', {
                            value: '',
                            text: 'Select'
                        }));
                        //Puts in the saved exercise name as an option
                        $.each(data, function(index, exercise) {
                            selectOptions.append($('<option>', {
                                value: exercise.ExerciseID,
                                text: exercise.ExerciseName
                    }));
                });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading personal library options:', status, error);
                    } 
                });
            }

            loadSavedExercises();

            // Handle submission of  Library Exercise form
            $("#libraryExerciseForm").submit(function(event) {
                event.preventDefault(); 

                // Serialize the form data
                var formData = $(this).serialize();

                
                $.ajax({
                    url: 'personalLibraryProcess.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        
                        loadCustomWorkouts();

                        
                        $("#libraryExerciseForm")[0].reset();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error submitting Library Exercise form:', status, error);
                    }
                });
            });


        
    </script>


</body>
<footer>
</footer>

</html>
