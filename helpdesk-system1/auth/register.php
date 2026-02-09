<?php
require '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role  = 'user';

    $stmt = $pdo->prepare("
        INSERT INTO users (name, email, password, role)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([$name, $email, $pass, $role]);

    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5 col-md-4">
<h4>Create Account</h4>
<form method="POST">
  <input class="form-control mb-2" name="name" placeholder="Full Name" required>
  <input class="form-control mb-2" name="email" type="email" placeholder="Email" required>
  <input class="form-control mb-3" name="password" type="password" placeholder="Password" required>
  <button class="btn btn-success w-100">Register</button>
</form>
</div>
</body>
</html>
