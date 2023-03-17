<?php

// Database configuration
$host = 'localhost'; // Database host (usually 'localhost')
$user = 'root'; // Database username
$password = ''; // Database password
$database = 'it_days'; // Database name

// Create a connection to the database
$conn = mysqli_connect($host, $user, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
