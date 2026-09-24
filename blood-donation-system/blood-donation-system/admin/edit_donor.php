<?php
require_once '../config.php';
require_once 'auth_check.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $bloodGroup = $_POST['blood_group'];
    $city = trim($_POST['city']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $available = $_POST['available'];
    $donorId = (int)$_POST['donor_id'];

    $stmt = $pdo->prepare(
        "UPDATE donors SET name=?, blood_group=?, city=?, phone=?, email=?, available=? WHERE id=?"
    );
    $stmt->execute([$name, $bloodGroup, $city, $phone, $email, $available, $donorId]);

    header('Location: donors.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM donors WHERE id = ?");
$stmt->execute([$id]);
$donor = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$donor) {
    die("Donor not found. <a href='donors.php'>Back to donors</a>");
}

$bloodGroups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Donor</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1>Edit Donor</h1>

    <form method="POST" class="checkout-form">
        <input type="hidden" name="donor_id" value="<?php echo $donor['id']; ?>">

        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($donor['name']); ?>" required>

        <label for="blood_group">Blood Group</label>
        <select id="blood_group" name="blood_group" required>
            <?php foreach ($bloodGroups as $bg): ?>
                <option value="<?php echo $bg; ?>" <?php echo $donor['blood_group'] === $bg ? 'selected' : ''; ?>><?php echo $bg; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="city">City</label>
        <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($donor['city']); ?>" required>

        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($donor['phone']); ?>" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($donor['email']); ?>">

        <label for="available">Available to Donate</label>
        <select id="available" name="available">
            <option value="Yes" <?php echo $donor['available'] === 'Yes' ? 'selected' : ''; ?>>Yes</option>
            <option value="No" <?php echo $donor['available'] === 'No' ? 'selected' : ''; ?>>No</option>
        </select>

        <button type="submit" class="btn">Save Changes</button>
    </form>

    <p><a href="donors.php">&larr; Back to donors</a></p>
</div>
</body>
</html>
