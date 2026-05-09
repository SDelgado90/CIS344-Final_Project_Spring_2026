<?php
require_once 'includes/auth.php';
requireRole(['buyer', 'renter']);

require_once 'classes/RealEstateDatabase.php';

include 'includes/header.php';

$db = new RealEstateDatabase();

$messageText = '';

$propertyId = $_GET['propertyId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $message = $_POST['message'];

    $userId = $_SESSION['user']['userId'];

    $success = $db->addInquiry($userId, $propertyId, $message);

    $messageText = $success ? "Inquiry submitted." : "Failed.";
}
?>

<h2>Submit Inquiry</h2>

<p><?php echo $messageText; ?></p>

<form method="POST">

    <textarea name="message" required></textarea><br><br>

    <button type="submit">Send Inquiry</button>

</form>

<?php include 'includes/footer.php'; ?>
