<?php
require_once dirname(__DIR__) . "/config/db.php";
require_once dirname(__DIR__) . "/includes/functions.php";

$q = trim($_GET['q'] ?? '');
if ($q === '') {
    exit;
}

$stmt = $pdo->prepare(
    "SELECT event_name 
     FROM events 
     WHERE event_name LIKE ?
     ORDER BY event_name ASC
     LIMIT 5"
);
$stmt->execute(["%$q%"]);
$results = $stmt->fetchAll();

if (!$results) {
    echo "<div class='search-item'>No results</div>";
    exit;
}

foreach ($results as $row) {
    echo "<div class='search-item' data-name='" . escape($row['event_name']) . "'>"
        . escape($row['event_name']) .
        "</div>";
}
