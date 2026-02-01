<?php
require_once dirname(__DIR__) . "/vendor/autoload.php"; // Composer / Twig
require_once dirname(__DIR__) . "/config/db.php";        // DB
require_once dirname(__DIR__) . "/includes/csrf.php";    // CSRF

session_start(); // Start session

$id = (int)($_GET["id"] ?? 0); // Event ID
if ($id <= 0) {
    die("Invalid event ID");
}

// Fetch event
$stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
$stmt->execute([$id]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    die("Event not found");
}

// Handle update
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!verify_csrf($_POST["csrf"])) {
        die("Invalid CSRF token");
    }

    $stmt = $pdo->prepare(
        "UPDATE events
         SET event_name=?, location=?, event_date=?, organizer=?, description=?
         WHERE id=?"
    );

    $stmt->execute([
        $_POST["event_name"],
        $_POST["location"],
        $_POST["event_date"],
        $_POST["organizer"],
        $_POST["description"],
        $id
    ]);

    header("Location: index.php"); // Redirect
    exit;
}

// Twig setup
$loader = new Twig\Loader\FilesystemLoader(dirname(__DIR__) . "/templates");
$twig   = new Twig\Environment($loader);

$twig->addGlobal('session', $_SESSION); // Share session

// Render form
echo $twig->render("event_form.twig", [
    "title"       => "Edit Event",
    "button_text" => "Update Event",
    "event"       => $event,
    "csrf"        => csrf_token(),
    "exclude_id"  => $id
]);
