<?php
require_once 'classes/RealEstateDatabase.php';
include 'includes/header.php';

$db = new RealEstateDatabase();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userName = trim($_POST['userName']);
    $password = $_POST['password'];

    $user = $db->getUserByUsername($userName);

    if ($user && password_verify($password, $user['passwordHash'])) {

        $_SESSION['user'] = [
            'userId' => $user['userId'],
            'userName' => $user['userName'],
            'userType' => $user['userType']
        ];

        header("Location: dashboard.php");
        exit();

    } else {
        $error = "Invalid username or password.";
    }
}
?>

<h2>Login</h2>

<?php if ($error): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<form method="POST">

    <label>Username:</label><br>
    <input type="text" name="userName" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>

</form>

<?php include 'includes/footer.php'; ?>
