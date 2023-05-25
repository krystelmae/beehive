<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="homepage.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Automated Scheduling System</title>
    </head>
    <body>
        <head>  
            <nav>
                <ul>
                    <li><a href="homepage.php">Home</a></li>
                    <li><a href="view_preference.php">Faculty Preference</a></li>
                    <li><a href="view_Schedule.php">My Schedule</a></li>
                </ul>
            </nav>    
        </head>
    
        <?php
        // Simulated database
        $preferences = [];

        // Function to sanitize input data
        function sanitizeInput($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Function to save preferences
        function savePreference($subject1, $time1, $unit1, $subject2, $time2, $unit2, $subject3, $time3, $unit3)
        {
            global $preferences;
            $preference = [
                'subject1' => $subject1,
                'time1' => $time1,
                'unit1' => $unit1,
                'subject2' => $subject2,
                'time2' => $time2,
                'unit2' => $unit2,
                'subject3' => $subject3,
                'time3' => $time3,
                'unit3' => $unit3
            ];
            $preferences[] = $preference;
            // You can perform database operations here instead of using a simulated database
        }

        // Function to display preferences
        function displayPreferences()
        {
            global $preferences;
            if (count($preferences) > 0) {
                echo "<h2>Faculty Preferences:</h2>";
                echo "<table>";
                echo "<tr><th>Choice</th><th>Subject</th><th>Time</th><th>Unit</th></tr>";
                foreach ($preferences as $index => $preference) {
                    echo "<tr>";
                    echo "<td>First Choice</td>";
                    echo "<td>" . $preference['subject1'] . "</td>";
                    echo "<td>" . $preference['time1'] . "</td>";
                    echo "<td>" . $preference['unit1'] . "</td>";
                    echo "</tr>";
                    if (!empty($preference['subject2'])) {
                        echo "<tr>";
                        echo "<td>Second Choice</td>";
                        echo "<td>" . $preference['subject2'] . "</td>";
                        echo "<td>" . $preference['time2'] . "</td>";
                        echo "<td>" . $preference['unit2'] . "</td>";
                        echo "</tr>";
                    }
                    if (!empty($preference['subject3'])) {
                        echo "<tr>";
                        echo "<td>Third Choice</td>";
                        echo "<td>" . $preference['subject3'] . "</td>";
                        echo "<td>" . $preference['time3'] . "</td>";
                        echo "<td>" . $preference['unit3'] . "</td>";
                        echo "</tr>";
                    }
                }
                echo "</table>";
            } else {
                echo "<p>No preferences found.</p>";
            }
        }

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Validate and sanitize the input
            $subject1 = sanitizeInput($_POST['subject1']);
            $time1 = isset($_POST['time1']) ? sanitizeInput($_POST['time1']) : "";
            $unit1 = isset($_POST['unit1']) ? sanitizeInput($_POST['unit1']) : "";
            $subject2 = isset($_POST['subject2']) ? sanitizeInput($_POST['subject2']) : "";
            $time2 = isset($_POST['time2']) ? sanitizeInput($_POST['time2']) : "";
            $unit2 = isset($_POST['unit2']) ? sanitizeInput($_POST['unit2']) : "";
            $subject3 = isset($_POST['subject3']) ? sanitizeInput($_POST['subject3']) : "";
            $time3 = isset($_POST['time3']) ? sanitizeInput($_POST['time3']) : "";
            $unit3 = isset($_POST['unit3']) ? sanitizeInput($_POST['unit3']) : "";

            // Perform validation
            $errors = [];
            if (empty($subject1)) {
                $errors[] = "First Choice is required.";
            }

            // If no errors, save the preferences and display success message
            if (empty($errors)) {
                savePreference($subject1, $time1, $unit1, $subject2, $time2, $unit2, $subject3, $time3, $unit3);
                echo "<p>Preferences saved successfully.</p>";
                // Clear form fields
                $subject1 = $time1 = $unit1 = $subject2 = $time2 = $unit2 = $subject3 = $time3 = $unit3 = "";
            } else {
                // Display errors
                foreach ($errors as $error) {
                    echo "<p>Error: $error</p>";
                }
            }
        }
        ?>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Faculty Preferences</h1>
            <label for="subject1">First Choice:</label>
            <input type="text" name="subject1" id="subject1" value="<?php echo $subject1; ?>" required><br>
            <label for="time1">Time:</label>
            <input type="text" name="time1" id="time1" value="<?php echo $time1; ?>"><br>
            <label for="unit1">Unit:</label>
            <input type="text" name="unit1" id="unit1" value="<?php echo $unit1; ?>"><br>

            <label for="subject2">Second Choice:</label>
            <input type="text" name="subject2" id="subject2" value="<?php echo $subject2; ?>"><br>
            <label for="time2">Time:</label>
            <input type="text" name="time2" id="time2" value="<?php echo $time2; ?>"><br>
            <label for="unit2">Unit:</label>
            <input type="text" name="unit2" id="unit2" value="<?php echo $unit2; ?>"><br>

            <label for="subject3">Third Choice:</label>
            <input type="text" name="subject3" id="subject3" value="<?php echo $subject3; ?>"><br>
            <label for="time3">Time:</label>
            <input type="text" name="time3" id="time3" value="<?php echo $time3; ?>"><br>
            <label for="unit3">Unit:</label>
            <input type="text" name="unit3" id="unit3" value="<?php echo $unit3; ?>"><br>

            <input type="submit" value="Save Preferences">
        </form>

        <?php
        // Display preferences
        displayPreferences();
        ?>

    </body>
</html>
