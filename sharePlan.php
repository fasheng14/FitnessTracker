<?php
session_start();

// Check if UserID is set in session
if (!isset($_SESSION["user_id"])) {
    // Redirect to the sign-in page or handle the situation accordingly
    header("Location: signIn.php");
    exit; // Stop further execution
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share your Plan</title>
    <link rel="stylesheet" type="text/css" href="SignupPages/styleSignIn.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
</head>
<!--form thats allows user to show other users their plans. Lets them describe their plan, so they can find other
users with similar goals-->
<body>
    <header>
    <h1 style="font-size: 2em;">Share your plan</h1>
    </header>

    <main>
        <form action="processSharePlan.php" method="post">
            <label for="planName">Name of your Plan</label>
            <input type="text" id="planName" name="planName" required>

            <label for="planDescription">Describe Your Plan and what you want to achieve:</label>
            <textarea id="planDescription" name="planDescription" rows="5"  required></textarea>

            <button type="submit">Share Plan</button>
        </form>
    </main>
</body>