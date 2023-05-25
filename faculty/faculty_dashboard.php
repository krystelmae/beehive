<!DOCTYPE html>
<html>
<head>
    <title>Faculty Preference</title>
</head>
<body>
    <h1>Faculty Preference Form</h1>

    <?php
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $subject1 = $_POST['subject1'];
        $subject2 = $_POST['subject2'];
        $subject3 = $_POST['subject3'];
        $time = $_POST['time'];
        $unit = $_POST['unit'];

        // Check if any two choices are the same
        if ($subject1 === $subject2 || $subject1 === $subject3 || $subject2 === $subject3) {
            echo "<p class='error'>Warning: Please choose different subjects for each choice.</p>";
        } else {
            // Display the submitted preferences
            echo "<h2>Your Preferences:</h2>";
            echo "<p>1st Choice: $subject1</p>";
            echo "<p>2nd Choice: $subject2</p>";
            echo "<p>3rd Choice: $subject3</p>";
            echo "<p>Time: $time</p>";
            echo "<p>Unit: $unit</p>";
        }
    }
    ?>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="subject1">1st Choice Subject:</label>
        <input type="text" name="subject1" id="subject1" required><br>

        <label for="time">Time:</label>
        <input type="text" name="time" id="time" required><br>

        <label for="unit">Unit:</label>
        <input type="text" name="unit" id="unit" required><br>


        <label for="subject2">2nd Choice Subject:</label>
        <input type="text" name="subject2" id="subject2" required><br>

        <label for="time">Time:</label>
        <input type="text" name="time" id="time" required><br>

        <label for="unit">Unit:</label>
        <input type="text" name="unit" id="unit" required><br>


        <label for="subject3">3rd Choice Subject:</label>
        <input type="text" name="subject3" id="subject3" required><br>

        <label for="time">Time:</label>
        <input type="text" name="time" id="time" required><br>

        <label for="unit">Unit:</label>
        <input type="text" name="unit" id="unit" required><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
