<?php
require_once dirname(__DIR__) . "/config/db.php";
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if ($name && $email && $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare(
                "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)"
            );
            $stmt->execute([$name, $email, $hash]);

            header("Location: login.php");
            exit;
        } catch (PDOException $e) {
            $error = "Email already exists";
        }
    }
}
?>

<h2>Sign Up</h2>
<p style="color:red"><?= htmlspecialchars($error) ?></p>

<form method="post">
    Full Name<br>
    <input name="full_name" required><br><br>

    Email<br>
    <input type="email" name="email" required><br><br>

    Password<br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Sign Up</button>
</form>

<p>Already have an account? <a href="login.php">Login</a></p>
