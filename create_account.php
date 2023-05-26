<!DOCTYPE html>
<html>
    <head>
        <title>Automated Scheduling System</title>
        <link rel="stylesheet" type="text/css" href="homepage.css">  
        <link rel="stylesheet" type="text/css" href="style.css"> 
    </head>
    <body>
        <header>  
            <nav>
                <ul>
                    <li><a href="homepage.php">Home</a></li>
                    <li><a href="head_login.php">Department Head</a></li>
                    <li><a href="faculty_login.php">Login</a></li>
                </ul>
            </nav>    
        </header>
        <section>
            <h1>Signup</h1>
            <?php
            // Check if form is submitted
            if (isset($_POST['submit'])) {
                $firstName = $_POST['first_name'];
                $lastName = $_POST['last_name'];
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Perform validation and registration process
                if ($firstName && $lastName && $username && $password) {
                    // Connect to the database
                    $host = 'localhost';
                    $dbUsername = 'root';
                    $dbPassword = '';
                    $dbName = 'scheduling';

                    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
                    if ($conn->connect_error) {
                        die('Connection failed: ' . $conn->connect_error);
                    }

                    // Prepare and execute the insert statement
                    $stmt = $conn->prepare('INSERT INTO faculty (first_name, last_name, username, password) VALUES (?, ?, ?, ?)');
                    $stmt->bind_param('ssss', $firstName, $lastName, $username, $password);
                    $stmt->execute();

                    // Check if the insert was successful
                    if ($stmt->affected_rows > 0) {
                        echo '<p class="success">Signup successful! You can now login.</p>';
                    } else {
                        echo '<p class="error">An error occurred. Please try again.</p>';
                    }

                    $stmt->close();
                    $conn->close();
                } else {
                    echo '<p class="error">Please fill in all the fields.</p>';
                }
            }
            ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="username">User Name:</label>
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
            <p>&copy; <?php echo date("Y"); ?>All rights reserved.</p>
        </footer>
    </body>
</html>