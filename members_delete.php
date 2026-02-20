<?php
include 'config.php';
if(!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
$id = $_GET['id'];
// Delete user row as well (if matching email) - optional
$result = $conn->query("SELECT email FROM members WHERE id=$id");
$row = $result->fetch_assoc();
if($row){
    $email = $row['email'];
    $conn->query("DELETE FROM users WHERE email='".$conn->real_escape_string($email)."'"); 
}
$conn->query("DELETE FROM members WHERE id=$id");
header("Location: members_index.php");
exit();
?>