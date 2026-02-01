<?php
require_once dirname(__DIR__) . "/config/db.php";

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
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$results) {
    echo "<div class='search-item'>No results</div>";
    exit;
}

foreach ($results as $row) {
    $name = htmlspecialchars($row['event_name'], ENT_QUOTES, 'UTF-8');
    echo "<div class='search-item' data-name=\"{$name}\">{$name}</div>";
}
