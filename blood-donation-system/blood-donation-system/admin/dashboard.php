<?php
require_once '../config.php';
require_once 'auth_check.php';

$donorCount = $pdo->query("SELECT COUNT(*) FROM donors")->fetchColumn();
$availableCount = $pdo->query("SELECT COUNT(*) FROM donors WHERE available = 'Yes'")->fetchColumn();
$requestCount = $pdo->query("SELECT COUNT(*) FROM requests")->fetchColumn();
$pendingCount = $pdo->query("SELECT COUNT(*) FROM requests WHERE status = 'Pending'")->fetchColumn();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <div class="admin-header">
        <h1>Admin Dashboard</h1>
        <div>
            <span>Logged in as <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
            <a href="logout.php" class="btn small">Logout</a>
        </div>
    </div>

    <div class="admin-stats">
        <div class="stat-box"><h2><?php echo $donorCount; ?></h2><p>Total Donors</p></div>
        <div class="stat-box"><h2><?php echo $availableCount; ?></h2><p>Available Donors</p></div>
        <div class="stat-box"><h2><?php echo $requestCount; ?></h2><p>Total Requests</p></div>
        <div class="stat-box"><h2><?php echo $pendingCount; ?></h2><p>Pending Requests</p></div>
    </div>

    <div class="admin-actions">
        <a href="donors.php" class="btn">Manage Donors</a>
        <a href="requests.php" class="btn">Manage Requests</a>
    </div>
</div>
</body>
</html>
