<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Automated Scheduling System</title>
</head>
<body>
    <section>
        <h1>Department Head Login</h1>
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "scheduling";

        // Create a new connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if form is submitted
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Prepare the SQL statement
            $stmt = $conn->prepare("SELECT * FROM head WHERE username = ? AND password = ?");
            $stmt->bind_param("ss", $username, $password);

            // Execute the query
            $stmt->execute();

            // Fetch the result
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Redirect to head_dashboard.php
                header('Location: head_dashboard.php');
                exit();
            } else {
                echo '<p class="error">Invalid username or password.</p>';
            }

            // Close the statement
            $stmt->close();
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
        <p>&copy; <?php echo date("Y"); ?> Your Department. All rights reserved.</p>
    </footer>
    
    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>