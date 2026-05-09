<?php
require_once 'classes/RealEstateDatabase.php';
require_once 'includes/auth.php';

requireLogin();
requireRole(['agent']);

if (!isset($_GET['id'])) {
    die( 'Property ID missing.');
}

$db = new RealEstateDatabase();

$db->deleteProperty((int)$_GET['id']);

header('Location: properties.php');
exit;
?>
