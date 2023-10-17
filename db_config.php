<?php
// Database configuration
$hostname = 'localhost'; // Replace with your database host name or IP address
$database = 'signup_db'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

// Create a PDO database connection
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Set character set to UTF-8 (optional, depending on your database setup)
    $pdo->exec("SET NAMES utf8");
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
