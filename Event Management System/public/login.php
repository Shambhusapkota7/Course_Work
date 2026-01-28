<?php
require_once dirname(__DIR__) . "/config/db.php";
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["full_name"];
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid login credentials";
    }
}
?>

<h2>Login</h2>
<p style="color:red"><?= htmlspecialchars($error) ?></p>

<form method="post">
    Email<br>
    <input type="email" name="email" required><br><br>

    Password<br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p>New user? <a href="signup.php">Sign up</a></p>
