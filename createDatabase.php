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
    PlanID INT PRIMARY KEY,
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

$sql_create_nutritionlog_table = "
CREATE TABLE NutritionLog (
    LogID INT PRIMARY KEY,
    UserID INT,
    Date DATE,
    MealType VARCHAR(20),
    FoodItem VARCHAR(255),
    Quantity DECIMAL(6,2),
    CaloricContent DECIMAL(6,2),
    FOREIGN KEY (UserID) REFERENCES User(UserID)
)";

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

$sql_create_conversations_table = "
CREATE TABLE Conversations (
    ConversationID INT AUTO_INCREMENT PRIMARY KEY,
    User1ID INT,
    User2ID INT,
    FOREIGN KEY (User1ID) REFERENCES User(UserID),
    FOREIGN KEY (User2ID) REFERENCES User(UserID)
)";

$sql_create_messages_table = "
CREATE TABLE Messages (
    MessageID INT AUTO_INCREMENT PRIMARY KEY,
    ConversationID INT,
    SenderID INT,
    Message TEXT,
    Timestamp DATETIME,
    FOREIGN KEY (ConversationID) REFERENCES Conversations(ConversationID),
    FOREIGN KEY (SenderID) REFERENCES User(UserID)
)";


// Execute SQL statements to create tables
$conn->query($sql_create_user_table);
$conn->query($sql_create_activitylog_table);
$conn->query($sql_create_workoutplans_table);
$conn->query($sql_create_planexercises_table);
$conn->query($sql_create_exerciselibrary_table);
$conn->query($sql_create_nutritionlog_table);
$conn->query($sql_create_progresstracking_table);
$conn->query($sql_create_customworkouts_table);
$conn->query($sql_create_goals_table);
$conn->query($sql_create_bodystats_table);
$conn->query($sql_create_conversations_table);
$conn->query($sql_create_messages_table);




// Close connection
$conn->close();
?>
