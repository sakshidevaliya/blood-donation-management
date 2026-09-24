<?php
require_once '../config.php';
require_once 'auth_check.php';

$requests = $pdo->query("SELECT * FROM requests ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manage Requests</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1>Blood Requests</h1>

    <table class="cart-table">
        <thead>
            <tr>
                <th>Patient</th><th>Blood Group</th><th>City</th><th>Hospital</th><th>Units</th><th>Status</th><th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $req): ?>
                <tr>
                    <td><?php echo htmlspecialchars($req['patient_name']); ?></td>
                    <td><?php echo htmlspecialchars($req['blood_group']); ?></td>
                    <td><?php echo htmlspecialchars($req['city']); ?></td>
                    <td><?php echo htmlspecialchars($req['hospital_name']); ?></td>
                    <td><?php echo $req['units_needed']; ?></td>
                    <td><?php echo htmlspecialchars($req['status']); ?></td>
                    <td><a href="view_request.php?id=<?php echo $req['id']; ?>">Manage</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p><a href="dashboard.php">&larr; Back to dashboard</a></p>
</div>
</body>
</html>
