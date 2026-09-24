<?php
require_once '../config.php';
require_once 'auth_check.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];
    $stmt = $pdo->prepare("UPDATE requests SET status = ? WHERE id = ?");
    $stmt->execute([$status, $id]);
    header("Location: view_request.php?id=$id");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM requests WHERE id = ?");
$stmt->execute([$id]);
$request = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$request) {
    die("Request not found. <a href='requests.php'>Back to requests</a>");
}

// Find matching available donors for this request
$stmt = $pdo->prepare("SELECT * FROM donors WHERE blood_group = ? AND city = ? AND available = 'Yes'");
$stmt->execute([$request['blood_group'], $request['city']]);
$matchingDonors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Request #<?php echo $request['id']; ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1>Request #<?php echo $request['id']; ?></h1>

    <p><strong>Patient:</strong> <?php echo htmlspecialchars($request['patient_name']); ?></p>
    <p><strong>Blood Group Needed:</strong> <?php echo htmlspecialchars($request['blood_group']); ?></p>
    <p><strong>City:</strong> <?php echo htmlspecialchars($request['city']); ?></p>
    <p><strong>Hospital:</strong> <?php echo htmlspecialchars($request['hospital_name']); ?></p>
    <p><strong>Contact:</strong> <?php echo htmlspecialchars($request['contact_phone']); ?></p>
    <p><strong>Units Needed:</strong> <?php echo $request['units_needed']; ?></p>

    <form method="POST">
        <label for="status">Status</label>
        <select name="status" id="status">
            <?php foreach (['Pending', 'Approved', 'Fulfilled', 'Cancelled'] as $s): ?>
                <option value="<?php echo $s; ?>" <?php echo $request['status'] === $s ? 'selected' : ''; ?>><?php echo $s; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn small">Update Status</button>
    </form>

    <h2>Matching Available Donors</h2>
    <?php if (count($matchingDonors) === 0): ?>
        <p>No matching available donors found in this city right now.</p>
    <?php else: ?>
        <table class="cart-table">
            <thead><tr><th>Name</th><th>Phone</th><th>Email</th></tr></thead>
            <tbody>
                <?php foreach ($matchingDonors as $donor): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($donor['name']); ?></td>
                        <td><?php echo htmlspecialchars($donor['phone']); ?></td>
                        <td><?php echo htmlspecialchars($donor['email']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <p><a href="requests.php">&larr; Back to requests</a></p>
</div>
</body>
</html>
