<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="homepage.css">
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <title>Automated Scheduling System</title>
</head>

<body>
    <header>
        <h1>Faculty Head Dashboard</h1>
        <nav>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="manage_faculty.php">Manage Faculty</a></li>
                <li><a href="section_assignment.php">Manage Courses</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <h1> Assigned Section </h1>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "scheduling";
        $table = "section";

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $courses = ['Bachelor of Science Computer Science', 'Bachelor of Science Information Science', 'Bachelor of Science Information Technology'];
            $yearLevels = ['First Year', 'Second Year', 'Third Year', 'Fourth Year'];

            foreach ($courses as $course) {
                foreach ($yearLevels as $yearLevel) {
                    $numSections = $_POST['sections'][$course][$yearLevel];
                    $numSections = intval($numSections);
                    $course = $conn->real_escape_string($course);
                    $yearLevel = $conn->real_escape_string($yearLevel);

                    for ($i = 1; $i <= $numSections; $i++) {
                        $section = $conn->real_escape_string($i); // Generate section label (e.g., First Year-1, Second Year-2)
                        $query = "INSERT INTO $table (course, year_level, section) VALUES ('$course', '$yearLevel', '$section')";

                        if ($conn->query($query) !== TRUE) {
                            echo "Error: " . $conn->error;
                        }
                    }
                }
            }

            echo "Rows inserted successfully.";
        }

        $conn->close();
        ?>

        <form method="post" action="">
            <?php
            $courses = ['Bachelor of Science Computer Science', 'Bachelor of Science Information Science', 'Bachelor of Science Information Technology'];
            $yearLevels = ['First Year', 'Second Year', 'Third Year', 'Fourth Year'];

            foreach ($courses as $course) {
                echo "<h2>$course</h2>";

                foreach ($yearLevels as $yearLevel) {
                    echo "<h3>$yearLevel</h3>";
                    echo "<label>Number of Sections:</label>";
                    echo "<input type='number' name='sections[$course][$yearLevel]' min='1'><br><br>";
                }
            }
            ?>

            <input type="submit" name="submit" value="Submit">
        </form>
    </section>
    <footer>
        <p>&copy;
            <?php echo date("Y"); ?> All rights reserved.
        </p>
    </footer>
</body>

</html>