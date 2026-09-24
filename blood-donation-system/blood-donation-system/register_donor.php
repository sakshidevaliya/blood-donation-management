<?php
require_once 'config.php';

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $bloodGroup = $_POST['blood_group'];
    $city = trim($_POST['city']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $lastDonation = !empty($_POST['last_donation_date']) ? $_POST['last_donation_date'] : null;

    $stmt = $pdo->prepare(
        "INSERT INTO donors (name, blood_group, city, phone, email, last_donation_date, available)
         VALUES (?, ?, ?, ?, ?, ?, 'Yes')"
    );
    $stmt->execute([$name, $bloodGroup, $city, $phone, $email, $lastDonation]);

    $success = true;
}

$bloodGroups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];

require_once 'includes/header.php';
?>

<h1>Become a Donor</h1>

<?php if ($success): ?>
    <div class="success-box">
        <p>Thank you for registering as a donor! Your details have been saved and will now appear in donor searches.</p>
        <a href="index.php" class="btn">Back to Home</a>
    </div>
<?php else: ?>
    <form method="POST" class="checkout-form">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" required>

        <label for="blood_group">Blood Group</label>
        <select id="blood_group" name="blood_group" required>
            <option value="">Select</option>
            <?php foreach ($bloodGroups as $bg): ?>
                <option value="<?php echo $bg; ?>"><?php echo $bg; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="city">City</label>
        <input type="text" id="city" name="city" required>

        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" required>

        <label for="email">Email (optional)</label>
        <input type="email" id="email" name="email">

        <label for="last_donation_date">Last Donation Date (if any)</label>
        <input type="date" id="last_donation_date" name="last_donation_date">

        <button type="submit" class="btn">Register as Donor</button>
    </form>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>
