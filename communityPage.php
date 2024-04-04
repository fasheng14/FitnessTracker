<?php
session_start();

// Check if UserID is set in session
if (!isset($_SESSION["user_id"])) {
    header("Location: signIn.php");
    exit; 
}

$userID = $_SESSION["user_id"];
?>

<DOCTYPE html>
    <html lang=en>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Community Page</title>
        <link rel="stylesheet" type="text/css" href="communityStyle.css">
        <link rel="stylesheet" type="text/css" href="messenger.css">


        <!-- Mate SC front from Google Fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    </head>

    <body>
        <header>
            <div class="homeLogo">
                <!-- Image -->
                <img src="HomePages/graphic/fitnessLogo.png" alt="MagnCreo Logo" class="logo">
            </div>
            <div class="name">
                <h1 style="font-size: 2em;">MagnCreo Community</h1>
            </div>
            <div class="dropDown">
                <button class="dropButton">Menu</button>
                <nav class="dropContent">
                    <a href="HomePages/loggedHome.php">Home</a>
                    <a href="userDashboard.php">Dashboard</a>
                    <a href="myPlan.php">My Plan</a>
                    <a href="exerciseLibrary.php">Exercise Library</a>
                    <a href="logout.php">Sign out </a>
                </nav>
            </div>

        </header>

        <!-- Main Content  -->
        <main>
            <div class="container">
            

                <!--switched recomendations column to be used as a friend list for now -->
                <div class="itemContainer" id="friends">
                    <h2>Friends List</h2>
                    <div hidden class="item" id="friends">
                        <!--Needed to add friends to list -->
                        <div class="item" id="friendsItem">
                            
                        </div>
                    </div>
                </div>

                <!-- Workout column (take and show name of user and description of workout) -->
                <div class="itemContainer" id="workout">
                    <h2>Workouts</h2>
                    <!--This button is used so users can share their plan and stats with the community -->
                    <a href="sharePlan.php" class="addPlan">Share plan with the Community</a>
                    <!--this is where the plans are added -->
                    <div class="plans" id="plans">
                </div>
            </div>

            

            <button class="messenger-button" onclick="toggleMessenger()">Messenger</button>

            <!-- Messenger container -->
            <div class="msg-container" id="msg-container">
                <div class="header" onclick="toggleMessenger()">Messenger <span class="close-btn"></span></div>
                <div class="msg-area" id="msg-area"></div>
                <div class="bottom">
                    <input type="text" name="msginput" class="msginput" id="msginput" placeholder="Enter your message here ... (Press enter to send message)">
                </div>
            </div>
        </main>
            <!-- Link to the JavaScript file for messaging component -->
            <script src="messenger.js"></script>
    </body>

    <footer>

    </footer>
    <script>
    $(document).ready(function() {
        //Function for loading friends into the friends list
        function loadFriends() {
            $.ajax({
                url: 'loadFriendsFromDatabase.php',
                type: 'GET',
                dataType: 'json',
                success: function(friends) {
                    console.log(friends);
                    //Users can also view the full plan and stats of their added friends
                    friends.forEach(function(friend) {
                        $('#friends').append('<div class="item" id="recommendationItem"><h3>' + friend.FriendUsername + '</h3><button class="viewPlan" onClick="submitUserID('+ friend.UserID2 + ')">View  Friend\'s plan</button></div></div>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error loading friends: ', status, error);
                }
            });
        }

        //Function for loadin plans into the plan section
        function loadPlans() {
            $.ajax({
                url: 'loadPlansFromDatabase.php',
                type: 'GET',
                dataType: 'json',
                success: function(plans) {
                    console.log(plans)
                    plans.forEach(function(plan) {
                        var planHtml = '<div class="item" id="workoutItem">';
                    planHtml += '<h3>' + plan.PlanName + ' by </h3>'
                    planHtml += '<h3><span class="username-clickable">' + plan.Username + '</span>';
                    planHtml += '<div class="addFriend" style="display: none;"><button class="friendButton" data-userID="' + plan.UserID + '">Add Friend</button>';
                    planHtml += '<div class="friendDropdown" style="display: none;"><b><a class="add-friend" href="#" data-username="' + plan.Username + '">Confirm</a></div></div></h3>';
                    planHtml += '<p>' + plan.Description + '</p>';
                    planHtml += '<button class="viewPlan" onClick="submitUserID('+ plan.UserID + ')">View their full plan</button></div>'
                    $('#plans').append(planHtml);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error getting plans: ', status, error);
                }
            });
        }

        //This function is for clicking on an username on and then the add friend button pops up
        $(document).on('click', '.username-clickable', function(event) {
        event.preventDefault(); 
        var addFriendBtn = $(this).siblings('.addFriend');
        // Hide other "Add Friend" buttons
        $('.addFriend').not(addFriendBtn).hide();
        // Toggle visibility of the clicked "Add Friend" button
        addFriendBtn.toggle();
    });
    //This function adds the user clicked on to the friends list once add friend is clicked
    $(document).on('click', '.friendButton', function(event) {
    event.preventDefault(); 

    // Get the username from the data attribute
    var userID = $(this).attr('data-userID');

    

    

    
    var addFriendButton = $(this);
    //Ajax request for adding the friend into the database
    $.ajax({
    url: 'addFriend.php',
    type: 'POST',
    data: { userID: userID }, 
    success: function(response) {
        // Handle success response
        if (response.success) {
            loadFriends();
            
        } 
    },
    

    
    
});
    //Hides the add friend button
    addFriendButton.hide();
    });

    

        // Call the functions to load friends and plans
        loadFriends();
        loadPlans();


    });
    //This functions is used when any of the view plans buttons are clicked
    function submitUserID(UserID) {
    // Create a new form element
    //This is used to submit the userID of the dashboard to be looked at
    var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "planDashboard.php");

    // Create a hidden input field for UserID
    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "UserID");
    input.setAttribute("value", UserID);

    // Append the input field to the form
    form.appendChild(input);

    // Append the form to the document body
    document.body.appendChild(form);

    // Submit the form
    form.submit();
    
}
</script>

    </html>