<?php
// Update these values if your MySQL config is different
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session on every page that includes config.php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>
