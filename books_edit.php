<?php
include 'config.php';
if(!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM books WHERE id=$id");
$book = $result->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $stmt = $conn->prepare("UPDATE books SET title=?, author=?, year=? WHERE id=?");
    $stmt->bind_param("ssii", $title, $author, $year, $id);
    $stmt->execute();
    header("Location: books_index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Book</title>
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
    <h2><i class="fas fa-edit"></i> Edit Book</h2>
    <form method="post">
        <div class="input-group"><i class="fas fa-book"></i><input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" placeholder="Book Title" required></div>
        <div class="input-group"><i class="fas fa-pen-nib"></i><input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" placeholder="Author Name" required></div>
        <div class="input-group"><i class="fas fa-calendar-alt"></i><input type="number" name="year" value="<?= $book['year'] ?>" placeholder="Publication Year" required></div>
        <button type="submit" class="btn btn-edit"><i class="fas fa-edit"></i> Update Book</button>
    </form>
</div>
</body>
</html>
