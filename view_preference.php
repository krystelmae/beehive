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
    <h1>Your Preferred Subjects and Times</h1>

    <?php
    // Retrieve the faculty preferences from the database
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $database = "your_database";

    // Create a new connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT subject1, time1, unit1, subject2, time2, unit2, subject3, time3, unit3 FROM faculty_preferences");

    // Execute the statement
    $stmt->execute();

    // Bind the result variables
    $stmt->bind_result($subject1, $time1, $unit1, $subject2, $time2, $unit2, $subject3, $time3, $unit3);

    // Display the table
    echo "<h2>Faculty Preferences</h2>";
    echo "<table>";
    echo "<tr><th>Subject 1</th><th>Time 1</th><th>Unit 1</th><th>Subject 2</th><th>Time 2</th><th>Unit 2</th><th>Subject 3</th><th>Time 3</th><th>Unit 3</th></tr>";
    
    // Fetch and display the data
    while ($stmt->fetch()) {
        echo "<tr>";
        echo "<td>$subject1</td>";
        echo "<td>$time1</td>";
        echo "<td>$unit1</td>";
        echo "<td>$subject2</td>";
        echo "<td>$time2</td>";
        echo "<td>$unit2</td>";
        echo "<td>$subject3</td>";
        echo "<td>$time3</td>";
        echo "<td>$unit3</td>";
        echo "</tr>";
    }

    echo "</table>";

    // Close the statement and connection
    $stmt->close();
    $conn->close();
?>

   
</body>
</html>
