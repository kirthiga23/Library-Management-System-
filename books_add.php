<?php
include 'config.php';
if(!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $stmt = $conn->prepare("INSERT INTO books (title, author, year) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $author, $year);
    $stmt->execute();
    header("Location: books_index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Book</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="navbar">
    <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="books_index.php"><i class="fas fa-book"></i> Books</a>
    <a href="members_index.php"><i class="fas fa-users"></i> Members</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>
<div class="container">
    <h2><i class="fas fa-plus-circle"></i> Add New Book</h2>
    <form method="post">
        <div class="input-group"><i class="fas fa-book"></i><input type="text" name="title" placeholder="Book Title" required></div>
        <div class="input-group"><i class="fas fa-pen-nib"></i><input type="text" name="author" placeholder="Author Name" required></div>
        <div class="input-group"><i class="fas fa-calendar-alt"></i><input type="number" name="year" placeholder="Publication Year" required></div>
        <button type="submit" class="btn btn-add"><i class="fas fa-plus-circle"></i> Add Book</button>
    </form>
</div>
</body>
</html>
