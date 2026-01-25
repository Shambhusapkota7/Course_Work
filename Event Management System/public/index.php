<?php
// ✅ SAFE PATH INCLUDES (works even with spaces in folder name)
require_once dirname(__DIR__) . "/config/db.php";
require_once dirname(__DIR__) . "/includes/functions.php";
include dirname(__DIR__) . "/includes/header.php";

// Fetch all events
$stmt = $pdo->query("SELECT * FROM events ORDER BY event_date ASC");
$events = $stmt->fetchAll();
?>

<div class="nav-bar">
    <a href="add.php">➕ Add Event</a>
    <a href="search.php" class="secondary">🔍 Advanced Search</a>
    
</div>


<br><br>

<!-- Ajax Live Search -->
<input type="text" id="search" placeholder="Live search event..." autocomplete="off">
<div id="result"></div>

<br><br>

<table border="1" width="100%">
    <tr>
        <th>Event Name</th>
        <th>Location</th>
        <th>Date</th>
        <th>Organizer</th>
        <th>Actions</th>
    </tr>

    <?php if (count($events) === 0): ?>
        <tr>
            <td colspan="5">No events found.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($events as $event): ?>
            <tr>
                <td><?= escape($event['event_name']) ?></td>
                <td><?= escape($event['location']) ?></td>
                <td><?= escape($event['event_date']) ?></td>
                <td><?= escape($event['organizer']) ?></td>
                <td>
                    <a href="edit.php?id=<?= (int)$event['id'] ?>" class="btn btn-edit">Edit</a>
<a href="delete.php?id=<?= (int)$event['id'] ?>" 
   class="btn btn-delete"
   onclick="return confirm('Delete this event?')">Delete</a>
<a href="register.php?event_id=<?= (int)$event['id'] ?>" class="btn btn-register">Register</a>

                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<?php include dirname(__DIR__) . "/includes/footer.php"; ?>
