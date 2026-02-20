<?php
include 'config.php';
if(!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM members WHERE id=$id");
$member = $result->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $stmt = $conn->prepare("UPDATE members SET name=?, email=?, phone=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $email, $phone, $id);
    $stmt->execute();
    // update users table email/name as well (if exists)
    $stmt2 = $conn->prepare("UPDATE users SET name=?, email=? WHERE email=?");
    $stmt2->bind_param("sss", $name, $email, $member['email']);
    @$stmt2->execute();
    header("Location: members_index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Member</title>
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
    <h2><i class="fas fa-edit"></i> Edit Member</h2>
    <form method="post">
        <div class="input-group"><i class="fas fa-user"></i><input type="text" name="name" value="<?= htmlspecialchars($member['name']) ?>" placeholder="Member Name" required></div>
        <div class="input-group"><i class="fas fa-envelope"></i><input type="email" name="email" value="<?= htmlspecialchars($member['email']) ?>" placeholder="Email" required></div>
        <div class="input-group"><i class="fas fa-phone"></i><input type="text" name="phone" value="<?= htmlspecialchars($member['phone']) ?>" placeholder="Phone"></div>
        <button type="submit" class="btn btn-edit"><i class="fas fa-edit"></i> Update Member</button>
    </form>
</div>
</body>
</html>
