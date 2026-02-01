<?php
// Database connection
require_once dirname(__DIR__) . "/config/db.php";

// Return JSON for AJAX
header("Content-Type: application/json; charset=UTF-8");

// Get inputs
$event_name = trim($_GET['event_name'] ?? '');
$exclude_id = (int)($_GET['exclude_id'] ?? 0);

// Validate input
if ($event_name === '') {
    echo json_encode([
        "ok" => false,
        "message" => "Event name is required"
    ]);
    exit;
}

// Check for duplicate event name
$sql = "SELECT COUNT(*) FROM events WHERE event_name = ?";
$params = [$event_name];

// Exclude current record during edit
if ($exclude_id > 0) {
    $sql .= " AND id <> ?";
    $params[] = $exclude_id;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$count = (int)$stmt->fetchColumn();

// Send result
if ($count > 0) {
    echo json_encode([
        "ok" => false,
        "message" => "Event name already exists"
    ]);
} else {
    echo json_encode([
        "ok" => true,
        "message" => "Event name is available"
    ]);
}
