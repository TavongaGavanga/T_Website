<?php
$host = "localhost";  // Server
$username = "root";   // Default is "root"
$password = "";       // Default is empty (use "root" for MAMP)
$database = "login";  // Ensure this matches the database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "✅ Database connection successful!";
}
?>
