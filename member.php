<?php
include 'config/dbconfig.php';
include 'templates/header.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
?>

<h2>Welcome, <?= $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'] ?></h2>
<p>Email: <?= $_SESSION['user']['email'] ?></p>

<?php include 'templates/footer.php';?>