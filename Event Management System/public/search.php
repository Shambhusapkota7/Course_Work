<?php
require_once dirname(__DIR__) . "/config/db.php";
require_once dirname(__DIR__) . "/includes/functions.php";
include dirname(__DIR__) . "/includes/header.php";

$q        = trim($_GET['q'] ?? '');
$location = trim($_GET['location'] ?? '');
$date     = trim($_GET['date'] ?? '');

$searched = isset($_GET['search']);
$events = [];

if ($searched) {
    $sql = "SELECT * FROM events WHERE 1=1";
    $params = [];

    if ($q !== '') {
        $sql .= " AND event_name LIKE ?";
        $params[] = "%$q%";
    }

    if ($location !== '') {
        $sql .= " AND location LIKE ?";
        $params[] = "%$location%";
    }

    if ($date !== '') {
        $sql .= " AND event_date = ?";
        $params[] = $date;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $events = $stmt->fetchAll();
}
?>

<h2>Search Events</h2>

<div class="search-form">
<form method="get" action="search.php">
    <label>Keyword:</label>
    <input type="text" name="q" value="<?= escape($q) ?>">

    <label>Location:</label>
    <input type="text" name="location" value="<?= escape($location) ?>">

    <label>Date:</label>
    <input type="date" name="date" value="<?= escape($date) ?>">

    <button type="submit" name="search">Search</button>
    <a href="index.php" class="btn-back">← Back to Events</a>

</form>
</div>

<?php if ($searched): ?>
    <?php if (!$events): ?>
        <p class="no-results">No events found.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Event Name</th>
                <th>Location</th>
                <th>Date</th>
                <th>Organizer</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($events as $event): ?>
                <tr>
                    <td><?= escape($event['event_name']) ?></td>
                    <td><?= escape($event['location']) ?></td>
                    <td><?= escape($event['event_date']) ?></td>
                    <td><?= escape($event['organizer']) ?></td>
                    <td class="actions">
    <a href="edit.php?id=<?= (int)$event['id'] ?>" class="btn btn-edit">Edit</a>
    <a href="register.php?event_id=<?= (int)$event['id'] ?>" class="btn btn-register">Register</a>
    <a href="delete.php?id=<?= (int)$event['id'] ?>"
       class="btn btn-delete"
       onclick="return confirm('Delete this event?')">Delete</a>
</td>

                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
<?php endif; ?>

<?php include dirname(__DIR__) . "/includes/footer.php"; ?>
