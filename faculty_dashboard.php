<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scheduling";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to save preferences
function savePreference($subject1, $time1, $unit1, $subject2, $time2, $unit2, $subject3, $time3, $unit3, $conn)
{
    // Retrieve the first preference from the database
    $stmt = $conn->prepare("SELECT * FROM preferences WHERE id = 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Set the first preference as the second preference for the current user
    $subject2 = $row['subject1'];
    $time2 = $row['time1'];
    $unit2 = $row['unit1'];

    // Prepare and execute the SQL statement to save the preferences
    $stmt = $conn->prepare("INSERT INTO preferences (subject1, time1, unit1, subject2, time2, unit2, subject3, time3, unit3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $subject1, $time1, $unit1, $subject2, $time2, $unit2, $subject3, $time3, $unit3);
    $stmt->execute();
    $stmt->close();
}

// Function to display preferences
function displayPreferences($conn, $hideFirstPreference = false)
{
    // Retrieve preferences from the database
    $sql = "SELECT * FROM preferences";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Faculty Preferences:</h2>";
        echo "<table>";
        echo "<tr><th>Choice</th><th>Subject</th><th>Time</th><th>Unit</th></tr>";
        $count = 1;
        while ($row = $result->fetch_assoc()) {
            // Skip displaying the first preference if hideFirstPreference is true
            if ($hideFirstPreference && $count === 1) {
                $count++;
                continue;
            }

            echo "<tr>";
            echo "<td>Choice $count</td>";
            echo "<td>" . $row['subject1'] . "</td>";
            echo "<td>" . $row['time1'] . "</td>";
            echo "<td>" . $row['unit1'] . "</td>";
            echo "</tr>";
            $count++;
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
    $subject2 = sanitizeInput($_POST['subject2']);
    $time2 = isset($_POST['time2']) ? sanitizeInput($_POST['time2']) : "";
    $unit2 = isset($_POST['unit2']) ? sanitizeInput($_POST['unit2']) : "";
    $subject3 = sanitizeInput($_POST['subject3']);
    $time3 = isset($_POST['time3']) ? sanitizeInput($_POST['time3']) : "";
    $unit3 = isset($_POST['unit3']) ? sanitizeInput($_POST['unit3']) : "";

    // Save the preferences
    savePreference($subject1, $time1, $unit1, $subject2, $time2, $unit2, $subject3, $time3, $unit3, $conn);

    // Redirect to the same page to avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="homepage.css">
    <title>Faculty Preferences</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Faculty Preferences</h1>
        <nav>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="view_preference.php">My Preference</a></li>
                <li><a href="view_schedule.php">View Schedule</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <?php
    // Display the preferences with the first preference hidden for the second user
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        displayPreferences($conn, true);
    } else {
        displayPreferences($conn);
    }
    ?>
    <br>
    <h2>Enter Your Preferences:</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="subject1">Subject 1:</label>
        <input type="text" name="subject1" required><br><br>
        <label for="time1">Time 1:</label>
        <input type="text" name="time1"><br><br>
        <label for="unit1">Unit 1:</label>
        <input type="text" name="unit1"><br><br>

        <label for="subject2">Subject 2:</label>
        <input type="text" name="subject2" required><br><br>
        <label for="time2">Time 2:</label>
        <input type="text" name="time2"><br><br>
        <label for="unit2">Unit 2:</label>
        <input type="text" name="unit2"><br><br>

        <label for="subject3">Subject 3:</label>
        <input type="text" name="subject3" required><br><br>
        <label for="time3">Time 3:</label>
        <input type="text" name="time3"><br><br>
        <label for="unit3">Unit 3:</label>
        <input type="text" name="unit3"><br><br>

        <input type="submit" value="Save Preferences">
    </form>
</body>

</html>