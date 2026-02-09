<?php
require '../includes/auth_check.php';
require '../config/database.php';

if ($_SESSION['role'] !== 'staff') {
    die("Access denied");
}

$staff_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT t.*, u.name AS user_name
    FROM ticket_assignments ta
    JOIN tickets t ON ta.ticket_id = t.id
    JOIN users u ON t.user_id = u.id
    WHERE ta.staff_id = ?
    ORDER BY t.created_at DESC
");
$stmt->execute([$staff_id]);
$tickets = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Staff - Assigned Tickets</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
  <h4>My Assigned Tickets</h4>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>User</th>
        <th>Title</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($tickets as $t): ?>
      <tr>
        <td><?= htmlspecialchars($t['user_name']) ?></td>
        <td><?= htmlspecialchars($t['title']) ?></td>
        <td><?= $t['status'] ?></td>
        <td>
          <form method="POST" action="update_ticket.php" class="d-flex gap-1">
            <input type="hidden" name="ticket_id" value="<?= $t['id'] ?>">
            <select name="status" class="form-select form-select-sm" required>
              <option value="In Progress">In Progress</option>
              <option value="Resolved">Resolved</option>
            </select>
            <input type="text" name="remarks" class="form-control form-control-sm" placeholder="Remarks" required>
            <button class="btn btn-sm btn-success">Update</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

</body>
</html>
