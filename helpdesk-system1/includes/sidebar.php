<?php $role = $_SESSION['role']; ?>

<div class="sidebar p-3">

<h5 class="text-center mb-4">⚙ Helpdesk</h5>

<?php if($role === 'admin'): ?>
  <a href="/helpdesk-system/admin/dashboard.php">🏠 Dashboard</a>
  <a href="/helpdesk-system/admin/tickets.php">🎫 Tickets</a>
  <a href="/helpdesk-system/admin/announcements.php">📢 Announcements</a>
  <a href="/helpdesk-system/admin/notifications.php">🔔 Notifications</a>

<?php elseif($role === 'staff'): ?>
  <a href="/helpdesk-system/staff/dashboard.php">🏠 Dashboard</a>
  <a href="/helpdesk-system/staff/tickets.php">🎫 My Tickets</a>

<?php else: ?>
  <a href="/helpdesk-system/user/dashboard.php">🏠 Dashboard</a>
  <a href="/helpdesk-system/user/create_ticket.php">➕ Create Ticket</a>
  <a href="/helpdesk-system/user/my_tickets.php">📄 My Tickets</a>
<?php endif; ?>

</div>

<div class="p-4 w-100">
