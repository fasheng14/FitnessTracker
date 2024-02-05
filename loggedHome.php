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


 
 </head>
 <body>
 
     <header>
         <h1 style="font-size: 2em;">Fitness Tracker App</h1>
     </header>
 
     <!-- Navigation between site pages  -->
     <nav>
         <a href="userDashboard.php">My Profile</a>
         <a href="createDatabase.php">Create the database</a>
         <?php
        // Check if the user is logged in
        if (!empty($username)) {
            echo '<a href="logout.php">Log out</a>';
        } else {
            // If not logged in
            echo '<a href="signin.php">Sign In</a>';
        }
        ?>

 
     </nav>
 
     <!-- Main Content  -->
 
     <main>
         
         <h2 style="margin-bottom: 20px;">Welcome <?php echo $username?> to our Fitness Tracker</h2>
 
 
     </main>
 
     <footer>
     </footer>
 
 </body>
 </html>