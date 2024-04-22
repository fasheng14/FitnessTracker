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

// Grabs the username of the logged-in user
$username = $_SESSION['username'];

//Checks if user is admin
$isAdmin = $_SESSION['isAdmin'];

// Fetch user data from the database except the current user
$sql = "SELECT Username FROM User WHERE Username != '$username'";
$result = $conn->query($sql);
$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row['Username'];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Tracker App</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="../messenger.css">

    <!-- Mate SC front from Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
</head>

<body>
    <header>

        <div class="logo">
            <!-- Image -->
            <img src="graphic/fitnessLogo.png" alt="MagnCreo Logo" width="150px">
        </div>

        <div class="name">
            <h1 style="font-size: 3em;">MagnCreo</h1>
        </div>

        <!-- Navigation between site pages  -->
        <div class="dropDown">
            <button class="dropButton">Menu</button>
            <nav class="dropContent">
                <a href="../userDashboard.php">Dashboard</a>
                <a href="../accountInfo.php">Account</a>
                <a href="../myPlan.php">My Plan</a>
                <a href="../communityPage.php">Community</a>
                <a href="../exerciseLibrary.php">Exercise Library</a>
                <?php  if ($isAdmin == 1) {
                    echo "<a href='../SignUpPages/adminAccountCreate.php'>Create an Admin Account</a>";
                }?>
                <a href="../createDatabase.php">Create the database</a>
                <a href="../aboutUs.php">About Us</a>
                <a href="../logout.php">Sign out </a>
            </nav>
        </div>
    </header>

    <main>
        <div>
            <h2 style="margin-bottom: 20px;">welcome back
                <?php echo $username ?>
            </h2>
        </div>


        <div class="signUpContainer">

            <div class="signUpImageBox">
                <!-- Image -->
                <img src="graphic/signUpImage.webp" alt="Sign Up Image" class="signup-image">
            </div>

            <div class="signUpInfo">

                <div class="motivational-piece">
                    <h3></h3>
                    <p>Start planning your customized workout plan</p>
                </div>

                <!-- Sign Up Button -->
                <a href="../myPlan.php" class="signup-button">GO TO YOUR PLAN</a>


            </div>
        </div>

        <div class="signUpContainer">

            <div class="signUpInfo">

                <div class="motivational-piece">
                    <h3></h3>
                    <p>Explore and Contribute to MagnCreo's Exercise Library</p>
                </div>

                <!-- EL Button -->
                <a href="../exerciseLibrary.php" class="signup-button">Exercise Library</a>


            </div>

            <div class="signUpImageBox">
                <!-- Image -->
                <img src="graphic/signUpImage.webp" alt="Sign Up Image" class="signup-image">
            </div>
        </div>

        <div class="signUpContainer">

            <div class="signUpImageBox">
                <!-- Image -->
                <img src="graphic/signUpImage.webp" alt="Sign Up Image" class="signup-image">
            </div>

            <div class="signUpInfo">

                <div class="motivational-piece">
                    <h3></h3>
                    <p>Connect with the MagnCreo community for support, tips, and to explore the health journeys of
                        others.</p>
                </div>

                <!-- Sign Up Button -->
                <a href="../communityPage.php" class="signup-button">Join the MagnCreo Community</a>


            </div>
        </div>

        <!-- Messaging button -->
        <button class="messenger-button" onclick="toggleMessenger()">Messenger</button>

        <!-- Messenger container -->
        <div class="msg-container" id="msg-container">
            <div class="header" onclick="toggleMessenger()">Messenger <span class="close-btn"></span></div>
            <div class="msg-area" id="msg-area"></div>
            <div class="bottom">
                <input type="text" name="msginput" class="msginput" id="msginput"
                    placeholder="Enter your message here ... (Press enter to send message)">
            </div>
        </div>

    </main>
    <!-- Link to the JavaScript file for messaging component -->
    <script src="../messenger.js"></script>

</body>

</html>