<?php
session_start();
require __DIR__ . '/../config/database.php';

$name = $_SESSION['name'] ?? 'User';
$role = $_SESSION['role'] ?? '';

$count = 0;
if ($role === 'admin') {
    $count = $pdo->query("SELECT COUNT(*) FROM notifications WHERE is_read = 0")->fetchColumn();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Helpdesk System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/helpdesk-system/assets/css/style.css">
</head>

<body>
<nav class="navbar navbar-dark bg-dark px-3">
  <span class="navbar-brand">Helpdesk</span>

  <div class="d-flex align-items-center gap-3 text-white">
    <?php if($role === 'admin'): ?>
      <a href="/helpdesk-system/admin/notifications.php" class="text-white position-relative">
        🔔
        <?php if($count > 0): ?>
          <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
            <?= $count ?>
          </span>
        <?php endif; ?>
      </a>
    <?php endif; ?>

    <span><?= $name ?></span>
    <a href="/helpdesk-system/auth/logout.php" class="btn btn-sm btn-danger">Logout</a>
  </div>
</nav>

<div class="d-flex">
