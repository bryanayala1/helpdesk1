<?php
require '../includes/auth_check.php';
require '../config/database.php';

if ($_SESSION['role'] !== 'staff') {
    die("Access denied");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticket_id = $_POST['ticket_id'];
    $status    = $_POST['status'];
    $remarks   = $_POST['remarks'];
    $staff_id  = $_SESSION['user_id'];

    // Update ticket status
    $pdo->prepare("
        UPDATE tickets SET status = ? WHERE id = ?
    ")->execute([$status, $ticket_id]);

    // Insert log
    $pdo->prepare("
        INSERT INTO ticket_logs (ticket_id, remarks, status, updated_by)
        VALUES (?, ?, ?, ?)
    ")->execute([$ticket_id, $remarks, $status, $staff_id]);

    // Notify admin
    $pdo->prepare("
        INSERT INTO notifications (message)
        VALUES (?)
    ")->execute(["Ticket #$ticket_id updated to $status"]);

    header("Location: tickets.php");
    exit;
}
