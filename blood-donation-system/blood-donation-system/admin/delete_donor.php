<?php
require_once '../config.php';
require_once 'auth_check.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("DELETE FROM donors WHERE id = ?");
$stmt->execute([$id]);

header('Location: donors.php');
exit;
