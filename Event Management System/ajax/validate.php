<?php
require_once "../config/db.php";

// Return JSON
header("Content-Type: application/json; charset=UTF-8");

$event_name = trim($_GET['event_name'] ?? '');
$exclude_id = (int)($_GET['exclude_id'] ?? 0);

if ($event_name === '') {
    echo json_encode(["ok" => false, "message" => "Event name is required"]);
    exit;
}

$sql = "SELECT COUNT(*) FROM events WHERE event_name = ?";
$params = [$event_name];

// When editing, exclude current record from duplicate check
if ($exclude_id > 0) {
    $sql .= " AND id <> ?";
    $params[] = $exclude_id;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$count = (int)$stmt->fetchColumn();

if ($count > 0) {
    echo json_encode(["ok" => false, "message" => "Event name already exists"]);
} else {
    echo json_encode(["ok" => true, "message" => "Event name is available"]);
}
