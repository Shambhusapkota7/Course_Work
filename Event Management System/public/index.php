<?php
require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . "/config/db.php";

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch all events
$stmt = $pdo->query("SELECT * FROM events ORDER BY event_date ASC");
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Twig setup
$loader = new Twig\Loader\FilesystemLoader(dirname(__DIR__) . "/templates");
$twig = new Twig\Environment($loader);

// ✅ Add global session BEFORE render
$twig->addGlobal('session', $_SESSION);

// Render
echo $twig->render("event_list.twig", [
    "title"  => "Event Management System",
    "events" => $events
]);
