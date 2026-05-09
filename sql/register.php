<?php
require_once 'classes/RealEstateDatabase.php';
include 'includes/header.php';

$db = new RealEstateDatabase();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userName = trim($_POST['userName']);
    $contactInfo = trim($_POST['contactInfo']);
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $success = $db->addUser($userName, $contactInfo, $passwordHash, $userType);

    if ($success) {
        $message = "Registration successful.";
    } else {
        $message = "Registration failed.";
    }
}
?>

<h2>Register</h2>

<p><?php echo $message; ?></p>

<form method="POST">

    <label>Username:</label><br>
    <input type="text" name="userName" required><br><br>

    <label>Contact Info:</label><br>
    <input type="text" name="contactInfo" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <label>User Type:</label><br>
    <select name="userType">
        <option value="agent">Agent</option>
        <option value="buyer">Buyer</option>
        <option value="renter">Renter</option>
    </select><br><br>

    <button type="submit">Register</button>

</form>

<?php include 'includes/footer.php'; ?>
