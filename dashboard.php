<?php
include 'config.php';
if(!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Library Management</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="navbar">
        <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
        <?php if($_SESSION['role'] === 'admin'): ?>
            <a href="books_index.php"><i class="fas fa-book"></i> Books</a>
            <a href="members_index.php"><i class="fas fa-users"></i> Members</a>
        <?php endif; ?>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    <div class="container">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['user']) ?>!</h2>
        <p>Your role: <strong><?= htmlspecialchars($_SESSION['role']) ?></strong></p>
        <?php if($_SESSION['role'] === 'admin'): ?>
            <p>Use the navigation to manage books and members.</p>
        <?php else: ?>
            <p>As a member you can view available books (feature can be added).</p>
        <?php endif; ?>
    </div>
</body>
</html>
