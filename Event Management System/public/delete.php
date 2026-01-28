<?php
require_once dirname(__DIR__) . "/config/db.php";

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("DELETE FROM events WHERE id=?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
