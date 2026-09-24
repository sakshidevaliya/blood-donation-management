<?php
// Start session on every page that includes this file
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ---- Database settings ----
// Default XAMPP settings: username 'root', empty password
$host = 'localhost';
$dbname = 'blood_donation_db';
$db_username = 'root';
$db_password = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $db_username,
        $db_password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

define('SITE_NAME', 'LifeDrop - Blood Donation Network');
