<?php
require '../includes/auth_check.php';
require '../config/database.php';

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM tickets WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$tickets = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
  <title>My Tickets</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
  <h4>My Tickets</h4>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Title</th>
        <th>Category</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($tickets as $t): ?>
      <tr>
        <td><?= htmlspecialchars($t['title']) ?></td>
        <td><?= $t['category'] ?></td>
        <td>
          <span class="badge bg-<?= $t['priority']=='High'?'danger':($t['priority']=='Medium'?'warning':'secondary') ?>">
            <?= $t['priority'] ?>
          </span>
        </td>
        <td><?= $t['status'] ?></td>
        <td><?= $t['created_at'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

</body>
</html>
