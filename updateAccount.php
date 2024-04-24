<?php
session_start();

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

// Check if the form for updating password is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_password'])) {
        $newPassword = $_POST['password'];
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Hash the new password
        $userID = $_SESSION['user_id'];
        
        // Update the password in the database
        $sql = "UPDATE User SET Password = '$newPassword' WHERE UserID = $userID";
        if ($conn->query($sql) === TRUE) {
            echo "Password updated successfully";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    }

    // Check if the form for updating username is submitted
    if (isset($_POST['update_username'])) {
        $newUsername = $_POST['username'];
        $userID = $_SESSION['user_id'];
        
        // Update the username in the database
        $sql = "UPDATE User SET Username = '$newUsername' WHERE UserID = $userID";
        if ($conn->query($sql) === TRUE) {
            echo "Username updated successfully";
        } else {
            echo "Error updating username: " . $conn->error;
        }
    }

    // Update first name and last name
    if (isset($_POST['update_name'])) {
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $userID = $_SESSION['user_id'];
        
        // Update the first name and last name in the database
        $sql = "UPDATE User SET fname = '$firstName', lname = '$lastName' WHERE UserID = $userID";
        if ($conn->query($sql) === TRUE) {
            echo "Name updated successfully";
        } else {
            echo "Error updating name: " . $conn->error;
        }
    }

    // Update email
    if (isset($_POST['update_email'])) {
        $email = $_POST['email'];
        $userID = $_SESSION['user_id'];
        
        // Update the email in the database
        $sql = "UPDATE User SET Email = '$email' WHERE UserID = $userID";
        if ($conn->query($sql) === TRUE) {
            echo "Email updated successfully";
        } else {
            echo "Error updating email: " . $conn->error;
        }
    }

    // Update height, weight, and age
    if (isset($_POST['update_body'])) {
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $age = $_POST['age'];
        $userID = $_SESSION['user_id'];
        
        // Update the height, weight, and age in the database
        $sql = "UPDATE User SET Height = '$height', Weight = '$weight', Age = '$age' WHERE UserID = $userID";
        if ($conn->query($sql) === TRUE) {
            echo "Body information updated successfully";
        } else {
            echo "Error updating body information: " . $conn->error;
        }
    }
}

$conn->close();
?>
