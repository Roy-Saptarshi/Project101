<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "2ndcycle"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login form submission
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if fields are not empty
    if (!empty($email) && !empty($password)) {
        // Prepare statement to avoid SQL injection
        $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if email exists
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $row['password'])) {
                // Store session variables
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];

                // Redirect to products page
                header("Location: products.php");
                exit();
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "No account found with that email.";
        }

        $stmt->close();
    } else {
        $error = "Please fill out both fields.";
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2ndCycle - Login</title>
    <link rel="stylesheet" href="css/form.css"> <!-- Link to form.css -->
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <h1>2ndCycle</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="payment.php">Payment</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Login Form -->
    <div class="form-container">
        <form action="login.php" method="POST">
            <h2>Login</h2>

            <!-- Display Error -->
            <?php if (!empty($error)) { ?>
                <p style="color:red;"><?php echo $error; ?></p>
            <?php } ?>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Log In</button>
        </form>
        <p>If you don't have an account, <a href="register.php">Register</a>.</p>
    </div>

    <!-- Footer -->
    <footer>
        <p>© 2024 2ndCycle. All rights reserved.</p>
    </footer>
</body>
</html>
