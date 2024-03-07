<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account</title>
    <link rel="stylesheet" type="text/css" href="SignupPages/styleSignIn.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
</head>
<!--form thats adds an exercise-->
<body>
    <header>
    <h1 style="font-size: 2em;">Add Exercise</h1>
    </header>

    <main>
        <form action="processAddExercise.php" method="post">
            <label for="exercise">Name of Exercise:</label>
            <input type="text" id="exercise" name="exercise" required>
            <!-- Switched to a select option -->
            <label for="muscle">Muscle Group:</label>
            <select name="muscle" id="muscle">
                <option value="">Select</option>
                <option value="Full-body">Full Body</option>
                <option value="Legs">Legs</option>
                <option value="Arms">Arms</option>
                <option value="Chest">Chest</option>
                <option value="Back">Back</option>

            </select>

            <label for="days">How many days of week?:</label>
            <input type="number" id="days" name="days" required>

            <label for="sets">How many sets should be done?:</label>
            <input type="number" id="sets" name="sets" required>

            <label for="description">Description of the exercise:</label>
            <textarea id="description" name="description" rows="4" cols="30" required></textarea>

            <label for="video">Add a video link example (Optional):</label>
            <input type="text" id="video" name="video">

            <button type="submit">Add Exercise</button>
        </form>
    </main>
</body>