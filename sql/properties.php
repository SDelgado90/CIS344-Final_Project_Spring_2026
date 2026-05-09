<?php
require_once 'classes/RealEstateDatabase.php';
include 'includes/header.php';

$db = new RealEstateDatabase();

$properties = $db->getAllProperties();
?>

<h2>Properties</h2>

<?php foreach ($properties as $property): ?>

<div class="card">

    <h3><?php echo $property['title']; ?></h3>

    <p>Type: <?php echo $property['propertyType']; ?></p>

    <p>City: <?php echo $property['city']; ?></p>

    <p>Price: $<?php echo $property['price']; ?></p>

    <p>Status: <?php echo $property['status']; ?></p>

    <a href="property_details.php?id=<?php echo $property['propertyId']; ?>">
        View Details
    </a>

    <a href="property_details.php?id=<?php echo $property['propertyId']; ?>">
        //View Details 
</a>

<?php if (isset($_SESSION['user']) && $_SESSION['user']['userType'] === 'agent'): ?>

    <br><br>

    <a href="delete_property.php?id=<?php echo $property['propertyId']; ?>"
       onclick="return confirm('Delete this property?');">
       // Delete Property
</a>

<?php endif; ?>

</div>

<?php endforeach; ?>

<?php include 'includes/footer.php'; ?>
