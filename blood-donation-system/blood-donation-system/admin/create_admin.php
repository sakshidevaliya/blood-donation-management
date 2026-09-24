<?php
// ============================================================
// RUN THIS FILE ONCE in your browser to create your admin login,
// then DELETE this file for security.
// Visit: http://localhost/blood-donation-system/admin/create_admin.php
// ============================================================
require_once '../config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $pdo->exec("DELETE FROM admin");

    $stmt = $pdo->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hashed]);

    $message = "Admin account created! You can now log in at admin/login.php. Please delete this file (create_admin.php) now for security.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create Admin Account</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1>Create Admin Account</h1>

    <?php if ($message): ?>
        <p class="success-message"><?php echo $message; ?></p>
    <?php else: ?>
        <form method="POST" class="checkout-form">
            <label for="username">Admin Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Admin Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="btn">Create Admin Account</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
