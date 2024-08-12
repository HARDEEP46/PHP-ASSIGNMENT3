<?php
include 'templates/header.php'; // includes the header file
?>

<h2>Contact Us</h2>
<form method="post" action=""> <!-- form with the post method-->
    <label for="full_name">Full Name:</label>
    <input type="text" id="full_name" name="full_name" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="message">Message:</label>
    <textarea id="message" name="message" required></textarea>
    <br>
    <button type="submit">Send</button>
</form>

<?php include 'templates/footer.php';?> <!--include the footer -->