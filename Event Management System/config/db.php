<?php
$host = "localhost";
$db   = "np02cs4a240060";
$user = "np02cs4a240060";
$pass = "LwK14Mh4Aw";

try {
    // PDO connection
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed");
}
