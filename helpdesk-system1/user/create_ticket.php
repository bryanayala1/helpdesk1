<?php
require '../includes/auth_check.php';
require '../config/database.php';

if ($_SESSION['role'] !== 'user') {
    die("Access denied");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = $_POST['title'];
    $description = $_POST['description'];
    $category    = $_POST['category'];
    $priority    = $_POST['priority'];
    $user_id     = $_SESSION['user_id'];

    // Insert ticket
    $stmt = $pdo->prepare("
        INSERT INTO tickets (user_id, title, description, category, priority)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([$user_id, $title, $description, $category, $priority]);

    // Notify admin
    $msg = "New ticket submitted by " . $_SESSION['name'];
    $pdo->prepare("INSERT INTO notifications (message) VALUES (?)")
        ->execute([$msg]);

    $success = "Ticket submitted successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Create Ticket</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
  <h4>Create Support Ticket</h4>

  <?php if (!empty($success)): ?>
    <div class="alert alert-success"><?= $success ?></div>
  <?php endif; ?>

  <form method="POST">
    <input type="text" name="title" class="form-control mb-2" placeholder="Issue Title" required>

    <textarea name="description" class="form-control mb-2" placeholder="Describe the issue" required></textarea>

    <select name="category" class="form-control mb-2" required>
      <option value="">Select Category</option>
      <option>Hardware</option>
      <option>Software</option>
      <option>Network</option>
      <option>Others</option>
    </select>

    <select name="priority" class="form-control mb-3" required>
      <option value="">Priority</option>
      <option value="Low">Low</option>
      <option value="Medium">Medium</option>
      <option value="High">High</option>
    </select>

    <button class="btn btn-primary">Submit Ticket</button>
  </form>
</div>

</body>
</html>
