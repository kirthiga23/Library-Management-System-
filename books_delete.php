<?php
include 'config.php';
if(!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
$id = $_GET['id'];
$conn->query("DELETE FROM books WHERE id=$id");
header("Location: books_index.php");
exit();
?>