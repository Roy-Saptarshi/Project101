<?php
$servername = "localhost";
$username = "root"; // default XAMPP username
$password = ""; // default XAMPP password
$dbname = "2ndcycle"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from form
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if password matches confirm password
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
    } else {
        // Encrypt password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (name, address, email, phone, country, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $address, $email, $phone, $country, $hashed_password);

        // Execute the query
        if ($stmt->execute()) {
            echo "Registration successful!";
            header("Location: login.php"); // Redirect to login page after successful registration
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
    }
}

$conn->close();
?>
