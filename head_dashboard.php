<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="homepage.css">
    <title>Automated Scheduling System</title>

</head>
<body>
    <header>

        <nav>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="manage_faculty.php">Manage Faculty</a></li>
                <li><a href="manage_courses.php">Manage Courses</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <h1>Department Dashboard</h1>
    </header>
    
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
        <p>&copy; <?php echo date("2023"); ?>All rights reserved.</p>
    </footer>
</body>
</html>
