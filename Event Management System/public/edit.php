<?php
require_once "../config/db.php";
require_once "../includes/csrf.php";
require_once "../includes/functions.php";

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    die("Invalid event ID");
}

$stmt = $pdo->prepare("SELECT * FROM events WHERE id=?");
$stmt->execute([$id]);
$event = $stmt->fetch();

if (!$event) {
    die("Event not found");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!verify_csrf($_POST['csrf'])) {
        die("Invalid CSRF token");
    }

    $sql = "UPDATE events 
            SET event_name=?, location=?, event_date=?, organizer=?, description=? 
            WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['event_name'],
        $_POST['location'],
        $_POST['event_date'],
        $_POST['organizer'],
        $_POST['description'],
        $id
    ]);

    header("Location: index.php");
    exit;
}

include "../includes/header.php";
?>

<form method="post">
    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

    <!-- ✅ REQUIRED for Ajax validation -->
    <input type="hidden" id="exclude_id" value="<?= (int)$id ?>">

    Event Name:
    <input name="event_name" value="<?= escape($event['event_name']) ?>" required><br>

    Location:
    <input name="location" value="<?= escape($event['location']) ?>" required><br>

    Date:
    <input type="date" name="event_date" value="<?= escape($event['event_date']) ?>" required><br>

    Organizer:
    <input name="organizer" value="<?= escape($event['organizer']) ?>" required><br>

    Description:<br>
    <textarea name="description"><?= escape($event['description']) ?></textarea><br>

    <button type="submit">Update Event</button>
</form>

<?php include "../includes/footer.php"; ?>
