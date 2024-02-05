<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account</title>
    <link rel="stylesheet" type="text/css" href="styleSignIn.css">
</head>
<body>
    <header>
        <h1 style="font-size: 2em;">Create Account</h1>
    </header>

    <!-- Main Content  -->
    <main>
        <form action="../processSignUp.php" method="post">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" required>

            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="height">Height (feet):</label>
            <input type="number" id="height" name="height" step="0.01" required>

            <label for="weight">Weight (pounds):</label>
            <input type="number" id="weight" name="weight" step="0.01" required>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <input type="hidden" id="account_type" name="account_type"  value='0'>

            <button type="submit">Create Account</button>
        </form>
    </main>
</body>
</html>
