<?php
require_once 'includes/auth.php';
requireRole(['agent']);

require_once 'classes/RealEstateDatabase.php';

include 'includes/header.php';

$db = new RealEstateDatabase();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $propertyType = $_POST['propertyType'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    $agentId = $_SESSION['user']['userId'];

    $success = $db->addProperty(
        $title,
        $propertyType,
        $address,
        $city,
        $price,
        $status,
        $agentId
    );

    $message = $success ? "Property added." : "Failed.";
}
?>

<h2>Add Property</h2>

<p><?php echo $message; ?></p>

<form method="POST">

    <input type="text" name="title" placeholder="Title" required><br><br>

    <input type="text" name="propertyType" placeholder="Property Type" required><br><br>

    <input type="text" name="address" placeholder="Address" required><br><br>

    <input type="text" name="city" placeholder="City" required><br><br>

    <input type="number" step="0.01" name="price" placeholder="Price" required><br><br>

    <select name="status">
        <option value="available">Available</option>
        <option value="sold">Sold</option>
        <option value="rented">Rented</option>
    </select><br><br>

    <button type="submit">Add Property</button>

</form>

<?php include 'includes/footer.php'; ?>
