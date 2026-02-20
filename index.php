<?php
include 'config.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from DB
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Plain text password check (for demo). Replace with password_verify() for hashed passwords.
        if ($password === $user['password']) {
            $_SESSION['user'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['email'] = $user['email'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid Password";
        }
    } else {
        $error = "User not found";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Library Management</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <h2><i class="fas fa-lock"></i> Login</h2>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post">
            <div class="input-group"><i class="fas fa-envelope"></i><input type="email" name="email" placeholder="Email" required></div>
            <div class="input-group"><i class="fas fa-key"></i><input type="password" name="password" placeholder="Password" required></div>
            <button type="submit" name="login" class="btn btn-add"><i class="fas fa-sign-in-alt"></i> Login</button>
        </form>
        <p style="margin-top:10px;color:#555">Admin: admin@example.com / admin123<br>Member: john@example.com / member123</p>
    </div>
</body>
</html>
