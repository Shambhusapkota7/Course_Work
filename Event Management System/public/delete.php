<?php
require_once dirname(__DIR__) . "/config/db.php"; // DB connection

session_start(); // Start session

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = (int)($_GET['id'] ?? 0); // Get event ID

// Delete event
$stmt = $pdo->prepare("DELETE FROM events WHERE id=?");
$stmt->execute([$id]);

header("Location: index.php"); // Redirect
exit;
