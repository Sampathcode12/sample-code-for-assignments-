<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstName = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $lastName = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';

    // Validation: Ensure all fields are filled out
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword) || empty($phone) || empty($address)) {
        echo "All fields are required!";
        exit;
    }

    // Validation: Check if passwords match
    if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
        exit;
    }

    // Validation: Check if email format is correct
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Create an array with form data (to send to an API or database)
    $data = array(
        "first_name" => $firstName,
        "last_name" => $lastName,
        "email" => $email,
        "password" => $hashedPassword,
        "phone" => $phone,
        "address" => $address
    );

    // Optionally, send this data to your .NET API or save it in a database
    // For example, you can use cURL to send this data to an API or save it in a MySQL database.
    // Here's an example of sending the data to a .NET API using cURL:

    // Convert data to JSON
    $jsonData = json_encode($data);

    // Initialize cURL to send data to API
    $ch = curl_init('https://your-api-url.com/api/customer/register'); // Replace with your API URL

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
    ));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        echo "Error: " . curl_error($ch);
    } else {
        // Decode JSON response from the API
        $responseData = json_decode($response, true);

        // Handle API response
        if (isset($responseData['status']) && $responseData['status'] == 'success') {
            echo "Registration successful!";
        } else {
            echo "Error: " . (isset($responseData['message']) ? $responseData['message'] : 'Unknown error');
        }
    }

    // Close cURL session
    curl_close($ch);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>

<header>
    <h1>Customer Registration</h1>
    <nav>
        <a href="home.html">Home</a>
        <a href="login.html">Login</a>
    </nav>
</header>

<section class="welcome">
    <h2>Create Your Account</h2>
    <form action="" method="POST">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" required placeholder="Enter your first name">

        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" required placeholder="Enter your last name">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required placeholder="Enter your email">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required placeholder="Create a password">

        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirm your password">

        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" required placeholder="Enter your phone number">

        <label for="address">Address</label>
        <input type="text" id="address" name="address" required placeholder="Enter your address">

        <button type="submit">Register</button>
    </form>
</section>

<footer>
    <p>&copy; 2025 Your Company. All rights reserved.</p>
</footer>

</body>
</html>
