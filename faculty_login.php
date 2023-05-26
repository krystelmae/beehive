<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Automated Scheduling System</title>
</head>

<body>
    <section>
        <h1>Faculty Login</h1>
        <?php
        // Check if form is submitted
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Connect to the database
            $host = 'localhost';
            $dbUsername = 'root';
            $dbPassword = '';
            $dbName = 'scheduling';

            $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
            if ($conn->connect_error) {
                die('Connection failed: ' . $conn->connect_error);
            }

            // Prepare and execute the select statement
            $stmt = $conn->prepare('SELECT * FROM faculty WHERE username = ?');
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if a matching record is found
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if ($row['password'] == $password) {
                    // Authentication successful
                    // Redirect to faculty dashboard or perform necessary actions
                    header('Location: faculty_dashboard.php');
                    exit();
                }
            }

            // Authentication failed
            echo '<p class="error">Invalid username or password.</p>';

            $stmt->close();
            $conn->close();
        }
        ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="submit">Login</button>
        </form>
    </section>
    <footer>
        <p>&copy;
            <?php echo date("Y"); ?> Your Department. All rights reserved.
        </p>
    </footer>
</body>

</html>