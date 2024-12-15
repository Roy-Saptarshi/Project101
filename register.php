<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - 2ndCycle</title>
    <!-- Link to form.css first -->
    <link rel="stylesheet" href="css/form.css">
    <!-- Then link to style.css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>2ndCycle</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="payment.php">Payment</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="form-container">
            <h2>Register</h2>
            <form action="process_register.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="3" required></textarea>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>
                
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                
                <button type="submit">Register</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 2ndCycle. All rights reserved.</p>
    </footer>
</body>
</html>
