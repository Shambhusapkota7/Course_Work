<?php
require_once dirname(__DIR__) . "/vendor/autoload.php"; // Twig
require_once dirname(__DIR__) . "/config/db.php";        // DB

session_start(); // Session

$error = "";

// Handle signup
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name     = trim($_POST["full_name"]);
    $email    = trim($_POST["email"]);
    $password = $_POST["password"];

    if ($name && $email && $password) {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare(
                "INSERT INTO users (full_name, email, password)
                 VALUES (?, ?, ?)"
            );
            $stmt->execute([$name, $email, $hash]);

            header("Location: login.php"); // Redirect
            exit;

        } catch (PDOException $e) {
            $error = "Email already exists";
        }

    } else {
        $error = "All fields are required";
    }
}

// Twig
$loader = new Twig\Loader\FilesystemLoader(dirname(__DIR__) . "/templates");
$twig   = new Twig\Environment($loader);
$twig->addGlobal("session", $_SESSION);

// Render
echo $twig->render("signup.twig", [
    "title" => "Sign Up",
    "error" => $error
]);
