<?php
require_once dirname(__DIR__) . "/vendor/autoload.php"; // Composer / Twig
require_once dirname(__DIR__) . "/config/db.php";        // DB

session_start(); // Start session

$error = "";

// Handle login
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email    = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"]   = $user["id"];
        $_SESSION["user_name"] = $user["full_name"];
        header("Location: index.php"); // Redirect on success
        exit;
    } else {
        $error = "Invalid login credentials";
    }
}

// Twig
$loader = new Twig\Loader\FilesystemLoader(dirname(__DIR__) . "/templates");
$twig   = new Twig\Environment($loader);
$twig->addGlobal("session", $_SESSION);

echo $twig->render("login.twig", [
    "title" => "Login",
    "error" => $error
]);
