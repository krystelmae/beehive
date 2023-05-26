<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="homepage.css">
    <style>
        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
    <title>Automated Scheduling System</title>
</head>

<body>

    <head>
        <h2>Section Assignments</h2>
        <nav>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="view_Schedule.php">View Schedule</a></li>
                <li><a href="logout.php">Logout</a></li>

            </ul>
        </nav>
    </head>
    <table>
        <thead>
            <tr>
                <!-- <th>Subject</th> -->
                <th>Course</th>
                <th>Year Level</th>
                <th>Section</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection parameters
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "scheduling";

            // Create a database connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Function to display the section assignments
            function displaySectionAssignments($conn)
            {
                // Query to retrieve the section assignments
                $sql = "SELECT course, year_level, section FROM section";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['course'] . "</td>";
                        echo "<td>" . $row['year_level'] . "</td>";
                        echo "<td>" . $row['section'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No section assignments found.</td></tr>";
                }
            }

            // Function to generate the schedule using the Beehive algorithm
            function generateSchedule($conn)
            {
                // Define the courses and their details
                $courses = [
                    // [
                    //     'name' => 'English',
                    //     'year_level' => 'Year 7',
                    //     'num_sections' => 2,
                    // ],
                    // [
                    //     'name' => 'Mathematics',
                    //     'year_level' => 'Year 7',
                    //     'num_sections' => 3,
                    // ],
                    // Add more courses...
                ];

                // Define the subjects and their details
                $subjects = [
                    // [
                    //     'name' => 'English Literature',
                    //     'duration' => 1,
                    // ],
                    // [
                    //     'name' => 'Algebra',
                    //     'duration' => 1,
                    // ],
                    // Add more subjects...
                ];

                // Define the schedule grid
                $schedule = [];

                // Generate an initial schedule
                foreach ($courses as $course) {
                    $courseName = $course['name'];
                    $yearLevel = $course['year_level'];
                    $numSections = $course['num_sections'];

                    for ($section = 1; $section <= $numSections; $section++) {
                        $schedule[$yearLevel][$section] = [];
                        $randomSubject = $subjects[array_rand($subjects)];
                        $schedule[$yearLevel][$section][] = $randomSubject['name'];

                        // Save the section assignment to the database
                        $sql = "INSERT INTO section (course, year_level, section) VALUES ('$courseName', '$yearLevel', '$section')";
                        $conn->query($sql);
                    }
                }

                return $schedule;
            }

            // Display the section assignments
            displaySectionAssignments($conn);

            // Generate the schedule using the Beehive algorithm
            $schedule = generateSchedule($conn);

            // Close the database connection
            $conn->close();
            ?>
        </tbody>
    </table>
</body>

</html>