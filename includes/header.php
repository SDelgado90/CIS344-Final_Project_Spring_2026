<?php require_once __DIR__ . '/../config/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lionsgate Real Estate</title>

    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

<header class="site-header">

    <div class="logo-container">
        <img src="assets/logo.png" alt="Lionsgate Real Estate Logo" class="logo">

        <div>
            <h1>Lionsgate Real Estate</h1>
            <p class="tagline">Luxury Property Management & Real Estate</p>
        </div>
    </div>

    <nav>
        <a href="index.php">Home</a>
        <a href="properties.php">Properties</a>

        <?php if (isset($_SESSION['user'])): ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </nav>

</header>

<main>
