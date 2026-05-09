<?php
require_once 'includes/auth.php';
requireLogin();

include 'includes/header.php';
?>

<h2>Dashboard</h2>

<p>Welcome, <?php echo $_SESSION['user']['userName']; ?>!</p>

<p>User Type: <?php echo $_SESSION['user']['userType']; ?></p>

<?php if ($_SESSION['user']['userType'] === 'agent'): ?>

    <a href="add_property.php">Add Property</a><br><br>

<?php endif; ?>

<a href="properties.php">Browse Properties</a><br><br>

<a href="logout.php">Logout</a>

<?php include 'includes/footer.php'; ?>
