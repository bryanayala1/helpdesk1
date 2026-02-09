<?php
require '../includes/auth_check.php';
require '../config/database.php';

if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

// Get all tickets with user info
$stmt = $pdo->query("
    SELECT t.*, u.name AS user_name
    FROM tickets t
    JOIN users u ON t.user_id = u.id
    ORDER BY t.created_at DESC
");
$tickets = $stmt->fetchAll();

// Get staff list
$staffStmt = $pdo->query("SELECT id, name FROM users WHERE role = 'staff'");
$staffs = $staffStmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin - Tickets</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
  <h4>All Support Tickets</h4>

  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>User</th>
        <th>Title</th>
        <th>Category</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Assign</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($tickets as $t): ?>
      <tr>
        <td><?= htmlspecialchars($t['user_name']) ?></td>
        <td><?= htmlspecialchars($t['title']) ?></td>
        <td><?= $t['category'] ?></td>
        <td>
          <span class="badge bg-<?= $t['priority']=='High'?'danger':($t['priority']=='Medium'?'warning':'secondary') ?>">
            <?= $t['priority'] ?>
          </span>
        </td>
        <td><?= $t['status'] ?></td>
        <td>
          <?php if ($t['status'] === 'Pending'): ?>
          <form method="POST" action="assign_ticket.php" class="d-flex gap-1">
            <input type="hidden" name="ticket_id" value="<?= $t['id'] ?>">
            <select name="staff_id" class="form-select form-select-sm" required>
              <option value="">Select Staff</option>
              <?php foreach ($staffs as $s): ?>
                <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
              <?php endforeach; ?>
            </select>
            <button class="btn btn-sm btn-primary">Assign</button>
          </form>
          <?php else: ?>
            <span class="text-muted">Assigned</span>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

</body>
</html>
