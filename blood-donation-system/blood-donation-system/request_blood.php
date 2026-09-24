<?php
require_once 'config.php';

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patientName = trim($_POST['patient_name']);
    $bloodGroup = $_POST['blood_group'];
    $city = trim($_POST['city']);
    $phone = trim($_POST['contact_phone']);
    $hospital = trim($_POST['hospital_name']);
    $units = (int)$_POST['units_needed'];

    $stmt = $pdo->prepare(
        "INSERT INTO requests (patient_name, blood_group, city, contact_phone, hospital_name, units_needed)
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->execute([$patientName, $bloodGroup, $city, $phone, $hospital, $units]);

    $success = true;
}

$bloodGroups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];

require_once 'includes/header.php';
?>

<h1>Request Blood</h1>
<p class="subtitle">Submit a request and our team (admin) will help match you with available donors.</p>

<?php if ($success): ?>
    <div class="success-box">
        <p>Your blood request has been submitted successfully. The admin will review it and reach out to matching donors.</p>
        <a href="index.php" class="btn">Back to Home</a>
    </div>
<?php else: ?>
    <form method="POST" class="checkout-form">
        <label for="patient_name">Patient Name</label>
        <input type="text" id="patient_name" name="patient_name" required>

        <label for="blood_group">Blood Group Needed</label>
        <select id="blood_group" name="blood_group" required>
            <option value="">Select</option>
            <?php foreach ($bloodGroups as $bg): ?>
                <option value="<?php echo $bg; ?>"><?php echo $bg; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="city">City</label>
        <input type="text" id="city" name="city" required>

        <label for="contact_phone">Contact Phone</label>
        <input type="text" id="contact_phone" name="contact_phone" required>

        <label for="hospital_name">Hospital Name</label>
        <input type="text" id="hospital_name" name="hospital_name" required>

        <label for="units_needed">Units Needed</label>
        <input type="number" id="units_needed" name="units_needed" min="1" value="1" required>

        <button type="submit" class="btn">Submit Request</button>
    </form>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>
