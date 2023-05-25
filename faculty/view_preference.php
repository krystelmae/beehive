<!DOCTYPE html>
<html>
<head>
    <title>View Preferences</title>
</head>
<body>
    <h1>Your Preferred Subjects and Times</h1>

    <?php
    // Retrieve faculty preferences from the database
    $facultyId = $_SESSION['faculty_id'];
    $sql = "SELECT * FROM faculty_preferences WHERE faculty_id = $facultyId";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p>Subject: " . $row['subject'] . "</p>";
            echo "<p>Preferred Time: " . $row['preferred_time'] . "</p>";
            echo "<hr>";
        }
    } else {
        echo "<p>No preferences found.</p>";
    }
    ?>

    <a href="dashboard.php">Go back to dashboard</a>
</body>
</html>
