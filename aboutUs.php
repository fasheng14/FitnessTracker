<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" type="text/css" href="aboutUsStyle.css">
    <!-- Link to the CSS file for messaging component -->
    <link rel="stylesheet" type="text/css" href="messenger.css">
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
            <h1 style="font-size: 3em;">About Us</h1>
        </div>


        <!-- Navigation between site pages  -->
        <div class="dropDown">
            <button class="dropButton">Menu</button>
            <nav class="dropContent">
                <a href="HomePages/loggedHome.php">Home</a>
                <a href="userDashboard.php">Dashboard</a>
                <a href="myPlan.php">My Plan</a>
                <a href="communityPage.php">Community</a>
                <a href="exerciseLibrary.php">Exercise Library</a>
                <a href="logout.php">Sign out </a>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="item">
                <p class="aboutText">
                    We are a group of students who enjoy working out.
                    We created this website for our capstone to help people strive for a healthy body and have a
                    physically
                    healthy life.
                    We believe individuals can reach their physical potential through a community and help within that
                    community.
                    This place is here to help individuals who are interested in physical fitness.
                    MagnCreo is a place meant for individuals who just started their fitness journey.
                    This website is for them to learn about different workouts and steps they can take to become better.
                    They can keep track of their daily and weekly workouts, which is part of the workout plan that they
                    create.
                    We allow them to set personal goals and keep track of those goals. We know people can reach their
                    potential
                    if given the right tools.
                </p>
            </div>
            <div class="item2">
                <div class="team">
                    <img class="teamPic" src="HomePages/graphic/blankPFP.png" alt="blank picture" width="150px">
                    <h1 class="teamName">Joseph Rohrer</h1>
                </div>
                <div class="team">
                    <img class="teamPic" src="HomePages/graphic/blankPFP.png" alt="blank picture" width="150px">
                    <h1 class="teamName">Brandon Pranke</h1>
                </div>
                <div class="team">
                    <img class="teamPic" src="HomePages/graphic/blankPFP.png" alt="blank picture" width="150px">
                    <h1 class="teamName">Fasheng Yang</h1>
                </div>
            </div>

        </div>

    </main>
</body>

</html>