<?php
session_start();

// Check if UserID is set in session
if (!isset($_SESSION["user_id"])) {
    header("Location: signIn.php");
    exit;
}

$userID = $_SESSION["user_id"];
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" type="text/css" href="accountInfoStyle.css">
    <!-- Link to the CSS file for messaging component -->
    <link rel="stylesheet" type="text/css" href="messsenger.css">
    <!-- Mate SC front from Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <a class="logo" href="HomePages/loggedHome.php">
            <!-- Image -->
            <img src="HomePages/graphic/fitnessLogo.png" alt="MagnCreo Logo" width="150px">
        </a>
        <div class="name">
            <h1 style="font-size: 3em;">Account</h1>
        </div>


        <!-- Navigation between site pages  -->
        <div class="dropDown">
            <button class="dropButton">Menu</button>
            <nav class="dropContent">
                <a href="userDashboard.php">Dashboard</a>
                <a href="myPlan.php">My Plan</a>
                <a href="communityPage.php">Community</a>
                <a href="exerciseLibrary.php">Exercise Library</a>
                <a href="aboutUs.php">About Us</a>
                <a href="logout.php">Sign out </a>
            </nav>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="item">
                <form action="updateAccount.php" method="post">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <button class="updateButton" type="submit" name="update_password">Update</button>
                </form>
                <form action="updateAccount.php" method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                    <button class="updateButton" type="submit" name="update_username">Update</button>
                </form>
            </div>

            <div class="item">
                <form action="updateAccount.php" method="post">
                    <label for="fname">First Name:</label>
                    <input type="text" id="fname" name="fname" required>

                    <label for="lname">Last Name:</label>
                    <input type="text" id="lname" name="lname" required>
                    <button class="updateButton" type="submit" name="update_name">Update</button>
                </form>
            </div>

            <div class="item">
                <form action="updateAccount.php" method="post">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    <button class="updateButton" type="submit" name="update_email">Update</button>
                </form>
            </div>

            <div class="item">
                <form action="updateAccount.php" method="post">
                    <label for="height">Height (feet):</label>
                    <input type="number" id="height" name="height" step="0.01" required>

                    <label for="weight">Weight (pounds):</label>
                    <input type="number" id="weight" name="weight" step="0.01" required>

                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" required>
                    <button class="updateButton" type="submit" name="update_body">Update</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>