<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "fitnessTrackDB";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
    die("Sorry, there was a problem connecting to our database.");
}

// Use the UserID to fetch messages for all users
$result = $db->query("SELECT User.Username, Messages.Message FROM Messages INNER JOIN User ON Messages.UserID = User.UserID");

$output = "";
while ($row = $result->fetch_assoc()) {
    $output .= $row['Username'] . "\\" . $row['Message'] . "\n";
}

echo $output;

$db->close();
?>


<!--REFERENCES

https://github.com/howCodeORG/Messenger/blob/master/get-messages.php
-->