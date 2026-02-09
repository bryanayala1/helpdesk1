<?php
require '../includes/auth_check.php';
require '../config/database.php';

if ($_SESSION['role'] !== 'admin') die("Access denied");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $msg   = $_POST['message'];

    $pdo->prepare("INSERT INTO announcements (title, message) VALUES (?, ?)")
        ->execute([$title, $msg]);
}

$ann = $pdo->query("SELECT * FROM announcements ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Announcements</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
<h4>Create Announcement</h4>

<form method="POST" class="mb-4">
  <input class="form-control mb-2" name="title" placeholder="Title" required>
  <textarea class="form-control mb-2" name="message" placeholder="Message" required></textarea>
  <button class="btn btn-primary">Post</button>
</form>

<h5>Posted Announcements</h5>
<ul class="list-group">
<?php foreach ($ann as $a): ?>
<li class="list-group-item">
  <strong><?= htmlspecialchars($a['title']) ?></strong><br>
  <?= htmlspecialchars($a['message']) ?>
</li>
<?php endforeach; ?>
</ul>
</div>
</body>
</html>
