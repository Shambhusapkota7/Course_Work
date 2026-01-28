<?php
require_once dirname(__DIR__) . "/config/db.php";
require_once dirname(__DIR__) . "/includes/functions.php";
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
// ✅ Get event_id safely
$event_id = (int)($_GET['event_id'] ?? 0);

if ($event_id <= 0) {
    die("Invalid event ID");
}

// ✅ Fetch event correctly
$stmt = $pdo->prepare("SELECT id, event_name FROM events WHERE id = ?");
$stmt->execute([$event_id]);
$event = $stmt->fetch();

if (!$event) {
    die("Event not found");
}

// ✅ Handle registration
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        "INSERT INTO attendees (event_id, full_name, email)
         VALUES (?, ?, ?)"
    );
    $stmt->execute([
        $event_id,
        $_POST['full_name'],
        $_POST['email']
    ]);
    $success = true;
}

include dirname(__DIR__) . "/includes/header.php";
?>

<h2>Register for Event: <?= escape($event['event_name']) ?></h2>

<?php if ($success): ?>
    <p style="color:green;">Registration successful!</p>
<?php endif; ?>

<form method="post">
    Full Name:<br>
    <input type="text" name="full_name" required><br><br>

    Email:<br>
    <input type="email" name="email" required><br><br>

    <button type="submit">Register</button>
</form>

<br>
<a href="index.php" class="btn-back">← Back to Events</a>


<?php include dirname(__DIR__) . "/includes/footer.php"; ?>
