<?php
require_once 'config.php';

// Search/filter params
$bloodGroup = isset($_GET['blood_group']) ? $_GET['blood_group'] : '';
$city = isset($_GET['city']) ? trim($_GET['city']) : '';

$sql = "SELECT * FROM donors WHERE available = 'Yes'";
$params = [];

if ($bloodGroup !== '') {
    $sql .= " AND blood_group = ?";
    $params[] = $bloodGroup;
}
if ($city !== '') {
    $sql .= " AND city LIKE ?";
    $params[] = "%$city%";
}
$sql .= " ORDER BY name ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$donors = $stmt->fetchAll(PDO::FETCH_ASSOC);

$bloodGroups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];

require_once 'includes/header.php';
?>

<h1>Find a Blood Donor</h1>
<p class="subtitle">Search available donors by blood group and city.</p>

<form method="GET" class="search-form">
    <select name="blood_group">
        <option value="">All Blood Groups</option>
        <?php foreach ($bloodGroups as $bg): ?>
            <option value="<?php echo $bg; ?>" <?php echo $bloodGroup === $bg ? 'selected' : ''; ?>><?php echo $bg; ?></option>
        <?php endforeach; ?>
    </select>

    <input type="text" name="city" placeholder="City (e.g. Mumbai)" value="<?php echo htmlspecialchars($city); ?>">

    <button type="submit" class="btn">Search</button>
    <a href="index.php" class="btn small secondary">Reset</a>
</form>

<div class="donor-grid">
    <?php if (count($donors) === 0): ?>
        <p>No available donors found matching your search.</p>
    <?php endif; ?>

    <?php foreach ($donors as $donor): ?>
        <div class="donor-card">
            <div class="blood-badge"><?php echo htmlspecialchars($donor['blood_group']); ?></div>
            <h3><?php echo htmlspecialchars($donor['name']); ?></h3>
            <p class="city">📍 <?php echo htmlspecialchars($donor['city']); ?></p>
            <p class="phone">📞 <?php echo htmlspecialchars($donor['phone']); ?></p>
            <?php if ($donor['last_donation_date']): ?>
                <p class="last-donation">Last donated: <?php echo date('d M Y', strtotime($donor['last_donation_date'])); ?></p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once 'includes/footer.php'; ?>
