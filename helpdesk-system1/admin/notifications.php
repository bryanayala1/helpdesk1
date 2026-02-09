<?php
require '../includes/auth_check.php';
require '../config/database.php';

if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

$stmt = $pdo->query("
    SELECT * FROM notifications
    ORDER BY created_at DESC
");
$notes = $stmt->fetchAll();

// Mark as read
$pdo->query("UPDATE notifications SET is_read = 1");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Notifications</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
  <h4>Notifications</h4>

  <ul class="list-group">
    <?php foreach ($notes as $n): ?>
      <li class="list-group-item <?= $n['is_read'] ? '' : 'list-group-item-warning' ?>">
        <?= htmlspecialchars($n['message']) ?>
        <br>
        <small class="text-muted"><?= $n['created_at'] ?></small>
      </li>
    <?php endforeach; ?>
  </ul>
</div>

</body>
</html>
