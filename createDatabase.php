<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "fitnessTrackDB";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Added this to remake the database, 
//Has to be reacreated at least once so the admin field added to the user table is added
//otherwise some errors will pop up
$sql_drop_db = "DROP DATABASE IF EXISTS $dbname";
if ($conn->query($sql_drop_db) === TRUE) {
    echo "Database dropped successfully\n";
} else {
    echo "Error dropping database: " . $conn->error;
}

// Create database
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db($dbname);

// SQL statements to create tables 

$sql_create_user_table = "
CREATE TABLE User (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(50),
    lname VARCHAR(50),
    Username VARCHAR(255),
    Email VARCHAR(255),
    Password VARCHAR(255),
    Height DECIMAL(5,2),
    Weight DECIMAL(5,2),
    Age INT,
    Gender VARCHAR(10),
    isAdmin TINYINT(1)
)";

$sql_create_activitylog_table = "
CREATE TABLE ActivityLog (
    LogID INT PRIMARY KEY,
    UserID INT,
    ActivityType VARCHAR(50),
    DateTime DATETIME,
    Duration INT,
    Distance DECIMAL(5,2),
    CaloricBurn DECIMAL(6,2),
    Notes TEXT,
    FOREIGN KEY (UserID) REFERENCES User(UserID)
)";

$sql_create_workoutplans_table = "
CREATE TABLE WorkoutPlans (
    PlanID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    PlanName VARCHAR(255),
    Description TEXT,
    FOREIGN KEY (UserID) REFERENCES User(UserID)
)";

$sql_create_planexercises_table = "
CREATE TABLE PlanExercises (
    PlanID INT,
    ExerciseName VARCHAR(255),
    Sets INT,
    Reps INT,
    Weight DECIMAL(5,2),
    FOREIGN KEY (PlanID) REFERENCES WorkoutPlans(PlanID)
)";

//Made some edits to the table 
$sql_create_exerciselibrary_table = "
CREATE TABLE ExerciseLibrary (
    ExerciseID INT AUTO_INCREMENT PRIMARY KEY,
    ExerciseName VARCHAR(255),
    MuscleGroup VARCHAR(50),
    Days INT,
    Sets INT,
    Description TEXT,
    DemoVideoLink VARCHAR(255) NULL,
    Rating INT NULL
)";

//Table for exercise saved by user table
// Can be used to import
$sql_create_userExerciseLibrary_table = "
CREATE TABLE userExerciseLibrary (
    UserID INT,
    ExerciseID INT,
    PresetWorkoutID INT,
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    FOREIGN KEY (ExerciseID) REFERENCES ExerciseLibrary(ExerciseID),
    FOREIGN KEY (PresetWorkoutID) REFERENCES PresetWorkouts(PresetWorkoutID)

)";

//Workouts that are available on MagnCreo 
$sql_create_presetWorkouts_table = "
CREATE TABLE PresetWorkouts (
    PresetWorkoutID INT AUTO_INCREMENT PRIMARY KEY,
    PresetExerciseName VARCHAR(255) NOT NULL,
    MuscleGroup VARCHAR(50) NOT NULL,
    Days INT NOT NULL,
    Sets INT NOT NULL,
    Description TEXT,
    DemoVideoLink VARCHAR(255) NOT NULL
)";

// Insert initial preset workouts data 
$sql_insert_presetWorkouts_data = "
INSERT INTO PresetWorkouts (PresetExerciseName, MuscleGroup, Days, Sets, Description, DemoVideoLink)
VALUES
('Squats', 'Legs', 4, 8, 'Squat exercise for lower body strength and muscle development.', 'https://www.youtube.com/watch?v=QKKZ9AGYTi4'),
    ('Deadlifts', 'Back', 4, 6, 'Deadlift exercise for building back muscles and overall strength.', 'https://www.youtube.com/watch?v=op9kVnSso6Q'),
    ('Bench Press', 'Chest', 4, 8, 'Bench press exercise for chest muscle development.', 'https://www.youtube.com/watch?v=SCVCLChPQFY'),
    ('Pull-Ups', 'Back', 3, 10, 'Pull-up exercise for back and bicep strength.', 'https://www.youtube.com/watch?v=eGo4IYlbE5g'),
    ('Bicep Curls', 'Arms', 3, 12, 'Bicep curl exercise for building arm muscles.', 'https://www.youtube.com/watch?v=ZqcXZW0v3QM'),
    ('Lunges', 'Legs', 3, 10, 'Lunge exercise for leg strength and balance.', 'https://www.youtube.com/watch?v=-bXyrHtcR3U'),
    ('Push-Ups', 'Chest', 4, 15, 'Push-up exercise for chest and tricep development.', 'https://www.youtube.com/watch?v=IODxDxX7oi4'),
    ('Bent-Over Rows', 'Back', 4, 8, 'Bent-over row exercise for back and arm strength.', 'https://www.youtube.com/watch?v=G8l_8chR5BE'),
    ('Leg Press', 'Legs', 3, 12, 'Leg press exercise for building leg strength and muscle.', 'https://www.youtube.com/watch?v=O3nvzH8ONFw'),
    ('Tricep Dips', 'Arms', 3, 10, 'Tricep dip exercise for targeting the triceps.', 'https://www.youtube.com/watch?v=0326dy_-CzM'),
    ('Chest Flyes', 'Chest', 3, 10, 'Chest flye exercise for chest muscle isolation.', 'https://www.youtube.com/watch?v=b9L1B6hMffI'),
    ('Barbell Rows', 'Back', 4, 8, 'Barbell row exercise for back and arm development.', 'https://www.youtube.com/watch?v=G8l_8chR5BE'),
    ('Leg Extensions', 'Legs', 3, 12, 'Leg extension exercise for quadriceps isolation.', 'https://www.youtube.com/watch?v=YyvSfVjQeL0'),
    ('Hammer Curls', 'Arms', 3, 12, 'Hammer curl exercise for targeting the biceps.', 'https://www.youtube.com/watch?v=TwD-YGVP4Bk'),
    ('Incline Bench Press', 'Chest', 4, 8, 'Incline bench press for upper chest development.', 'https://www.youtube.com/watch?v=esQi683XR44'),
    ('Lat Pulldowns', 'Back', 4, 10, 'Lat pulldown exercise for back muscle growth.', 'https://www.youtube.com/watch?v=r7GA2FvqYsk'),
    ('Calf Raises', 'Legs', 3, 15, 'Calf raise exercise for strengthening calf muscles.', 'https://www.youtube.com/watch?v=05zgnAWHd2Q'),
    ('Skull Crushers', 'Arms', 3, 10, 'Skull crusher exercise for tricep development.', 'https://www.youtube.com/watch?v=-RhqgYDvjrk'),
    ('Pullovers', 'Chest', 3, 12, 'Pullover exercise for chest and back engagement.', 'https://www.youtube.com/watch?v=BJJFf1M2JN4'),
    ('T-Bar Rows', 'Back', 4, 8, 'T-bar row exercise for building back strength.', 'https://www.youtube.com/watch?v=edzSb0vI_bY')
";


$sql_create_progresstracking_table = "
CREATE TABLE ProgressTracking (
    ProgressID INT PRIMARY KEY,
    UserID INT,
    Date DATE,
    Weight DECIMAL(5,2),
    BodyFatPercentage DECIMAL(5,2),
    ProgressPhotos VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES User(UserID)
)";

// New table for custom workouts
$sql_create_customworkouts_table = "
CREATE TABLE CustomWorkouts (
    CustomWorkoutID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    Name VARCHAR(255),
    Sets INT,
    Reps INT,
    Weight DECIMAL(5,2),
    Distance DECIMAL(5,2),
    Duration INT,
    DayOfWeek VARCHAR(20),
    FOREIGN KEY (UserID) REFERENCES User(UserID)
)";

$sql_create_restday_table = "
CREATE TABLE RestDays (
    RestDayID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    DayOfWeek VARCHAR(20),
    FOREIGN KEY (UserID) REFERENCES User(UserID)
)";

// create the goals table
$sql_create_goals_table = "
CREATE TABLE Goals (
    GoalID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    GoalText VARCHAR(255),
    Category VARCHAR(50),
    FOREIGN KEY (UserID) REFERENCES User(UserID)
)";

$sql_create_bodystats_table = "
CREATE TABLE BodyStats (
    UserID INT NOT NULL,
    Weight DECIMAL(5,2),
    BenchPressPR DECIMAL(5,2),
    SquatPR DECIMAL(5,2),
    LongestDistance DECIMAL(5,2),
    LongestWorkout INT,
    PRIMARY KEY (UserID),
    FOREIGN KEY (UserID) REFERENCES User(UserID)
)";


$sql_create_messages_table = "
CREATE TABLE Messages (
    MessageID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    Message TEXT,
    Timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (UserID) REFERENCES User(UserID)
)";

//New Table for the friends list
//A user can add one user to their own list
$sql_create_friends_table = "
CREATE TABLE friends (
    FriendshipID INT AUTO_INCREMENT PRIMARY KEY,
    UserID1 INT,
    UserID2 INT,
    FOREIGN KEY (UserID1) REFERENCES User(UserID),
    FOREIGN KEY (UserID2) REFERENCES User(UserID)
)";


// Execute SQL statements to create tables
$conn->query($sql_create_user_table);
$conn->query($sql_create_activitylog_table);
$conn->query($sql_create_workoutplans_table);
$conn->query($sql_create_planexercises_table);
$conn->query($sql_create_exerciselibrary_table);
$conn->query($sql_create_presetWorkouts_table);
$conn->query($sql_create_userExerciseLibrary_table);
$conn->query($sql_create_progresstracking_table);
$conn->query($sql_create_customworkouts_table);
$conn->query($sql_create_goals_table);
$conn->query($sql_create_bodystats_table);
$conn->query($sql_create_messages_table);
$conn->query($sql_create_friends_table);
$conn->query($sql_create_restday_table);
$conn->query($sql_insert_presetWorkouts_data);




// Close connection
$conn->close();
?>