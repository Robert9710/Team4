<?php
// Database configuration
$dbHost     = "localhost";
$dbUsername = "jevsikov_php2";
$dbPassword = "Qwerty1234";
$dbName     = "jevsikov_testphp";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


?>
