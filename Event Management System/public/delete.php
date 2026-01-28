<?php
require_once dirname(__DIR__) . "/config/db.php";
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("DELETE FROM events WHERE id=?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
