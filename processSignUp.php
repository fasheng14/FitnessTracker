<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
    $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $height = floatval($_POST["height"]);
    $weight = floatval($_POST["weight"]);
    $age = intval($_POST["age"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);

    // Hash the password before storing it in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into User table
    $sql_insert_user = "
        INSERT INTO User (fname, lname, Username, Email, Password, Height, Weight, Age, Gender)
        VALUES ('$fname', '$lname', '$username', '$email', '$hashed_password', $height, $weight, $age, '$gender')

    ";

    if ($conn->query($sql_insert_user) === TRUE) {
        // Redirect to index.php after successful account creation
        header("Location: index.html");
        exit();
    } else {
        echo "Error creating user account: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
