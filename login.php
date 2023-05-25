<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection settings
    $host = 'localhost';
    $dbUsername = 'your_database_username';
    $dbPassword = 'your_database_password';
    $dbName = 'department_db';

    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $dbUsername, $dbPassword);

    // Prepare the SQL statement
    $statement = $pdo->prepare("SELECT * FROM department_head WHERE username = :username");

    // Bind the parameter
    $statement->bindParam(':username', $username);

    // Execute the query
    $statement->execute();

    // Fetch the row
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    // Check if a row is found and verify the password
    if ($row && password_verify($password, $row['password'])) {
        // Successful login for department head
        echo "Welcome, Department Head!";
    } else {
        // Invalid login credentials
        echo "Invalid username or password!";
    }
}
?>
