<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../includes/auth_check.php';
require '../config/database.php';

if ($_SESSION['role'] !== 'admin') die("Access denied");

$total = $pdo->query("SELECT COUNT(*) FROM tickets")->fetchColumn();
$pending = $pdo->query("SELECT COUNT(*) FROM tickets WHERE status='Pending'")->fetchColumn();
$progress = $pdo->query("SELECT COUNT(*) FROM tickets WHERE status='In Progress'")->fetchColumn();
$resolved = $pdo->query("SELECT COUNT(*) FROM tickets WHERE status='Resolved'")->fetchColumn();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>

  <!-- BOOTSTRAP CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- CUSTOM CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="bg-light">

<div class="container mt-4">
<h4 class="mb-4">Admin Dashboard</h4>

<div class="row g-3">
  <div class="col-md-3">
    <div class="card text-bg-primary shadow">
      <div class="card-body text-center">
        <h3><?= $total ?></h3>
        <small>Total Tickets</small>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card text-bg-warning shadow">
      <div class="card-body text-center">
        <h3><?= $pending ?></h3>
        <small>Pending</small>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card text-bg-info shadow">
      <div class="card-body text-center">
        <h3><?= $progress ?></h3>
        <small>In Progress</small>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card text-bg-success shadow">
      <div class="card-body text-center">
        <h3><?= $resolved ?></h3>
        <small>Resolved</small>
      </div>
    </div>
  </div>
</div>

</div>
</body>
</html>
