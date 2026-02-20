<?php
include 'config.php';
if(!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $stmt = $conn->prepare("INSERT INTO members (name, email, phone) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $phone);
    $stmt->execute();
    // Optionally create a user row for this member
    $stmt2 = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, 'member123', 'member')");
    $stmt2->bind_param("ss", $name, $email);
    @$stmt2->execute();
    header("Location: members_index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Member</title>
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
    <h2><i class="fas fa-plus-circle"></i> Add New Member</h2>
    <form method="post">
        <div class="input-group"><i class="fas fa-user"></i><input type="text" name="name" placeholder="Member Name" required></div>
        <div class="input-group"><i class="fas fa-envelope"></i><input type="email" name="email" placeholder="Email" required></div>
        <div class="input-group"><i class="fas fa-phone"></i><input type="text" name="phone" placeholder="Phone"></div>
        <button type="submit" class="btn btn-add"><i class="fas fa-plus-circle"></i> Add Member</button>
    </form>
</div>
</body>
</html>
