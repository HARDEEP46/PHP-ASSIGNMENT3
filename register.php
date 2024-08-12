<?php
include 'config/dbconfig.php';
include 'templates/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password)) {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);

        if ($stmt->rowCount() == 0) {
            $stmt = $pdo->prepare('INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)');
            $stmt->execute([$firstName, $lastName, $email, $password]);
            $message = 'Registration successful. You can now log in.';
        } else {
            $message = 'Email already exists';
        }
    } else {
        $message = 'Please fill all fields';
    }
}
?>

<h2>Register</h2>
<form method="post" action="">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" required>
    <br>
    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Register</button>
</form>

<?php if (isset($message)): ?>
<p><?= $message ?></p>
<?php endif; ?>

<?php include 'templates/footer.php';?>