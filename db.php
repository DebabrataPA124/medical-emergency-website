<?php
// Set the details needed to connect to the database
$host = 'localhost';      // The server where the database is (localhost means your own computer)
$username = 'root';       // Username to log in to MySQL (default is 'root')
$password = '';           // Password for MySQL (empty by default in XAMPP)
$database = 'curacare_db';// The name of the database you want to use

// Create a new connection to the database using the above details
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection worked or not
if ($conn->connect_error) {
    // If it did not connect, stop the script and show an error message
    die("Connection failed: " . $conn->connect_error);
}

// If connection is successful, the $conn variable can now be used in other files to talk to the database
?>
