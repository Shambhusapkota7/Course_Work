<?php
require_once dirname(__DIR__) . "/vendor/autoload.php"; // Load Composer (Twig)
require_once dirname(__DIR__) . "/config/db.php";        // Database connection
require_once dirname(__DIR__) . "/includes/csrf.php";    // CSRF helpers

session_start(); // Start session

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!verify_csrf($_POST["csrf"])) {
        die("Invalid CSRF token");
    }

    $stmt = $pdo->prepare(
        "INSERT INTO events (event_name, location, event_date, organizer, description)
         VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->execute([
        $_POST["event_name"],
        $_POST["location"],
        $_POST["event_date"],
        $_POST["organizer"],
        $_POST["description"]
    ]);

    header("Location: index.php"); // Redirect after insert
    exit;
}

// Twig setup
$loader = new Twig\Loader\FilesystemLoader(dirname(__DIR__) . "/templates");
$twig   = new Twig\Environment($loader);

$twig->addGlobal('session', $_SESSION); // Share session with Twig

// Render form
echo $twig->render("event_form.twig", [
    "title"       => "Add Event",
    "button_text" => "Add Event",
    "csrf"        => csrf_token()
]);
