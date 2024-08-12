<?php

// Establish a connection with the database
include 'config/dbconfig.php';

// Include the header template
include 'templates/header.php';

// Initialize a variable to store any error or success messages
$message = ' ';

// Check if the form was submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the email and password from the form submission
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if both the email and password fields are not empty
    if (!empty($email) && !empty($password)) {
        // Prepare a SQL statement to select the user with the provided email and password
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
        
        // Execute the prepared statement with the email and password provided by the user
        $stmt->execute([$email, $password]);

        // Check if exactly one row is returned, indicating a successful login
        if ($stmt->rowCount() == 1) {
            // Fetch the user's data from the result set
            $user = $stmt->fetch();

            // Store user data in the session to mark them as logged in
            $_SESSION['user'] = $user;

            // Redirect the user to the member's area page
            header('Location: member.php');
            exit; // Terminate the script to prevent further execution
        } else {
            // If no matching user is found, set an error message
            $message = 'Invalid login credentials';
        }
    } else {
        // If either the email or password field is empty, set an error message
        $message = 'Please fill all fields';
    }
}
?>

<!-- HTML Content Starts Here -->
<div id="main-content">
    <!-- Left side: Content Sections -->
    <div id="content">
        <h2>Welcome to Our Website</h2>
        <p>Welcome to our website, a demonstration of what’s possible with modern web technologies. We are a fictional company passionate about showcasing the integration of PHP and MySQL in building dynamic and secure web applications. Our mission is to educate and inspire developers by providing practical examples and comprehensive tutorials on web development.

Our team consists of dedicated professionals with a shared goal of advancing the field of web development. We believe in the power of knowledge sharing and aim to create a platform where aspiring developers can learn, experiment, and grow their skills.</p>

        <!-- About Us Section -->
        

        <!-- Features Section -->
        <section id="features">
            <h3>Our Features</h3>
            <ul>
                <li>Responsive Design</li>
                <li>User Authentication</li>
                <li>Database Integration</li>
                <li>Secure Login System</li>
            </ul>
            <img src="images/img2.jpeg" alt="Features Image" class="responsive-image">
        </section>

        <!-- Image Gallery -->
        <section id="gallery">
            <h3>Image Gallery</h3>
            <div class="gallery">
                <img src="images/thumbnail1.png" alt="Gallery Image 1" class="thumbnail">
                <img src="images/thumbnail2.jpeg" alt="Gallery Image 2" class="thumbnail">
            </div>
        </section>
        <section id="about">
            <h3>About Us</h3>
            <p>We are a fictional company dedicated to providing the best web solutions. Our website is a demonstration of PHP and MySQL integration to build a fully functional web application.</p>
        </section>
    </div>

    <!-- Right side: Login Form -->
    <div id="sidebar">
        <!-- If the user is not logged in, display the login form -->
        <?php if (!isset($_SESSION['user'])): ?>
        <h3>Member Login</h3>
        <form method="post" action="">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="submit">Login</button>
        </form>
        <?php endif; ?>

        <!-- Display any message (e.g., errors or success) -->
        <?php if (isset($message)): ?>
        <p class="message"><?= $message ?></p>
        <?php endif; ?>
    </div>
</div>

<!-- Include the footer template file that contains the bottom part of the HTML structure -->
<?php include 'templates/footer.php'; ?>
