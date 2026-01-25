<?php
require_once "../config/db.php";
require_once "../includes/csrf.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!verify_csrf($_POST['csrf'])) die("Invalid CSRF");

    $sql = "INSERT INTO events (event_name, location, event_date, organizer, description)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['event_name'],
        $_POST['location'],
        $_POST['event_date'],
        $_POST['organizer'],
        $_POST['description']
    ]);

    header("Location: index.php");
    exit;
}

include "../includes/header.php";
?>

<form method="post">
<input type="hidden" name="csrf" value="<?= csrf_token() ?>">
Event Name: <input name="event_name" required><br>
Location: <input name="location" required><br>
Date: <input type="date" name="event_date" required><br>
Organizer: <input name="organizer" required><br>
Description:<br>
<textarea name="description"></textarea><br>
<button type="submit">Add Event</button>
</form>

<?php include "../includes/footer.php"; ?>
