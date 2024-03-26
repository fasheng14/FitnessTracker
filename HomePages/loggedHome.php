<?php
session_start();

// Grabs the username of the logged in user
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Tracker App</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- Mate SC front from Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">

</head>

<body>

    <header>
        <a class="logo" href="loggedHome.php">
            <img src="../images/fitnessLogo.png" width="100px">
        </a>
        <h1 style="font-size: 2em;">Magncreo</h1>

        <!-- Navigation between site pages  -->
        <div class="dropDown">
            <button class="dropButton">Menu</button>
            <nav class="dropContent">
                <a href="../userDashboard.php">My Profile</a>
                <a href="../myPlan.php">My Plan</a>
                <a href="../communityPage.php">Community</a>
                <a href="../exerciseLibrary.php">Exercise Library</a>
                <a href="../SignUpPages/adminAccountCreate.php">Create an Admin Account</a>
                <a href="../createDatabase.php">Create the database</a>
                <a href="logout.php">Sign out </a>
            </nav>
        </div>
    </header>

    <!-- Main Content  -->

    <main>

        <h2 style="margin-bottom: 20px;">Welcome
            <?php echo $username ?> to our Fitness Tracker
        </h2>


        <div class="info-container">


        </div>
    </main>

    <footer>
    </footer>

</body>

</html>