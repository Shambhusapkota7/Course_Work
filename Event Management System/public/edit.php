<?php
require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . "/config/db.php";
require_once dirname(__DIR__) . "/includes/csrf.php";

$id = (int)($_GET["id"] ?? 0);
if ($id <= 0) {
    die("Invalid event ID");
}

$stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
$stmt->execute([$id]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    die("Event not found");
}

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

    header("Location: index.php");
    exit;
}

// Twig render (UI moved to Twig)
$loader = new Twig\Loader\FilesystemLoader(dirname(__DIR__) . "/templates");
$twig = new Twig\Environment($loader);

echo $twig->render("event_form.twig", [
    "title" => "Edit Event",
    "button_text" => "Update Event",
    "event" => $event,
    "csrf" => csrf_token(),
    "exclude_id" => $id   // ✅ for Ajax validation
]);
