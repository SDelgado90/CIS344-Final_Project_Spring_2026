<?php
require_once 'classes/RealEstateDatabase.php';
include 'includes/header.php';

$db = new RealEstateDatabase();

$id = $_GET['id'];

$property = $db->getPropertyById($id);
?>

<h2>Property Details</h2>

<div class="card">

    <h3><?php echo $property['title']; ?></h3>

    <p>Type: <?php echo $property['propertyType']; ?></p>

    <p>Address: <?php echo $property['address']; ?></p>

    <p>City: <?php echo $property['city']; ?></p>

    <p>Price: $<?php echo $property['price']; ?></p>

    <p>Status: <?php echo $property['status']; ?></p>

    <p>Agent: <?php echo $property['agentName']; ?></p>

</div>

<a href="submit_inquiry.php?propertyId=<?php echo $property['propertyId']; ?>">
    Submit Inquiry
</a>

<?php include 'includes/footer.php'; ?>
