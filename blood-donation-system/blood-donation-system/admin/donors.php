<?php
require_once '../config.php';
require_once 'auth_check.php';

$donors = $pdo->query("SELECT * FROM donors ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manage Donors</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1>Manage Donors</h1>

    <table class="cart-table">
        <thead>
            <tr>
                <th>Name</th><th>Blood Group</th><th>City</th><th>Phone</th><th>Available</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($donors as $donor): ?>
                <tr>
                    <td><?php echo htmlspecialchars($donor['name']); ?></td>
                    <td><?php echo htmlspecialchars($donor['blood_group']); ?></td>
                    <td><?php echo htmlspecialchars($donor['city']); ?></td>
                    <td><?php echo htmlspecialchars($donor['phone']); ?></td>
                    <td><?php echo htmlspecialchars($donor['available']); ?></td>
                    <td>
                        <a href="edit_donor.php?id=<?php echo $donor['id']; ?>">Edit</a> |
                        <a href="delete_donor.php?id=<?php echo $donor['id']; ?>"
                           onclick="return confirm('Delete this donor?');"
                           class="remove-link">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p><a href="dashboard.php">&larr; Back to dashboard</a></p>
</div>
</body>
</html>
