<?php
// Enable error reporting (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$password = "";
$database = "user_db"; // Your correct database name

// Create a database connection
$conn = new mysqli($host, $user, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Set character encoding (optional but recommended)
$conn->set_charset("utf8");

// Uncomment the line below to check if the connection works
// echo "✅ Database connection successful!";
?>
