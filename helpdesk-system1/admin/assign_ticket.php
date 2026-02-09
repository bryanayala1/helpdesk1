<?php
require '../includes/auth_check.php';
require '../config/database.php';

if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticket_id = $_POST['ticket_id'];
    $staff_id  = $_POST['staff_id'];

    // Assign ticket
    $stmt = $pdo->prepare("
        INSERT INTO ticket_assignments (ticket_id, staff_id)
        VALUES (?, ?)
    ");
    $stmt->execute([$ticket_id, $staff_id]);

    // Update ticket status
    $pdo->prepare("
        UPDATE tickets SET status = 'In Progress' WHERE id = ?
    ")->execute([$ticket_id]);

    // Notify admin (optional log)
    $pdo->prepare("
        INSERT INTO notifications (message)
        VALUES (?)
    ")->execute(["Ticket #$ticket_id assigned to IT Staff"]);

    header("Location: tickets.php");
    exit;
}
