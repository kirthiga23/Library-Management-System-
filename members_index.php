<?php
include 'config.php';
if(!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
$result = $conn->query("SELECT * FROM members ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Members Management</title>
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
    <h2><i class="fas fa-users"></i> Members Management</h2>
    <a href="members_add.php" class="btn btn-add"><i class="fas fa-plus-circle"></i> Add New Member</a>

    <table class="styled-table">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Joined Date</th><th>Actions</th></tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= $row['joined_date'] ?></td>
                <td>
                    <a href="members_edit.php?id=<?= $row['id'] ?>" class="btn btn-edit"><i class="fas fa-edit"></i> Edit</a>
                    <a href="members_delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-delete"><i class="fas fa-trash"></i> Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
