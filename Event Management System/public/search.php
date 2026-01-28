<?php
require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . "/config/db.php";

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$q        = trim($_GET['q'] ?? '');
$location = trim($_GET['location'] ?? '');
$date     = trim($_GET['date'] ?? '');

$searched = isset($_GET['search']);
$events = [];

if ($searched) {
    $sql = "SELECT * FROM events WHERE 1=1";
    $params = [];

    if ($q !== '') {
        $sql .= " AND event_name LIKE ?";
        $params[] = "%$q%";
    }

    if ($location !== '') {
        $sql .= " AND location LIKE ?";
        $params[] = "%$location%";
    }

    if ($date !== '') {
        $sql .= " AND event_date = ?";
        $params[] = $date;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Twig setup
$loader = new Twig\Loader\FilesystemLoader(dirname(__DIR__) . "/templates");
$twig = new Twig\Environment($loader);

// ✅ Add globals BEFORE render
$twig->addGlobal('session', $_SESSION);

// Render
echo $twig->render("search_results.twig", [
    "title"    => "Search Events",
    "events"   => $events,
    "q"        => $q,
    "location" => $location,
    "date"     => $date,
    "searched" => $searched
]);
