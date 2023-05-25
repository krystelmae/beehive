<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
    <title>Automated Scheduling System</title>

</head>
<body>
    <h2>Section Assignments</h2>
    <table>
        <thead>
            <tr>
                <th>Course</th>
                <th>Year Level</th>
                <th>Section</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Replace this section with your own code to fetch the section assignments from your data source (database, API, etc.)
            // Here, I'm assuming you have a database connection and execute a query to retrieve the section assignments

            // Example using MySQLi
            $servername = "your_servername";
            $username = "your_username";
            $password = "your_password";
            $dbname = "your_database";

            // Create a database connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to retrieve the section assignments
            $sql = "SELECT course, year_level, section FROM section_assignments";
            $result = $conn->query($sql);

            // Loop through the result and display the section assignments
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['course']}</td>";
                    echo "<td>{$row['year_level']}</td>";
                    echo "<td>{$row['section']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No section assignments found.</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
