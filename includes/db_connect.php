<?php
$servername = "localhost";  // Change this for Hostinger
$username = "root";  // Change this for Hostinger
$password = "";  // Change this for Hostinger
$dbname = "myblog_database";  // Use your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
