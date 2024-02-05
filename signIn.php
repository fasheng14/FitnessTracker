
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Page</title>
    <link rel="stylesheet" type="text/css" href="SignupPages/styleSignIn.css">

    <!-- Mate SC front from Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">

</head>
<body>
    <header>
        <h1 style="font-size: 2em;">Sign In</h1>
        <a href="unloggedHome.html">Link to unloggedhome</a>
    </header>

    <!-- Main Content  -->
    <main>
        <h2>Sign In</h2>
        <form action="loginProcess.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="login">Login</button>
        </form>
    </main>
</body>
</html>
