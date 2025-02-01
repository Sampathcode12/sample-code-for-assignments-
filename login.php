<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // API endpoint (replace with your actual .NET API URL)
    $apiUrl = "http://localhost:5268/api/Staff/Addstaff";

    // Prepare the data to send
    $postData = json_encode([
        "email" => $email,
        "password" => $password
    ]);

    // Initialize cURL session
    $ch = curl_init($apiUrl);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    // Execute cURL request
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Decode API response
    $result = json_decode($response, true);

    if ($httpCode == 200 && isset($result['token'])) {
        // Store token and redirect
        $_SESSION['user_token'] = $result['token'];
        header("Location: dashboard.php");
        exit();
    } else {
        // Display error message
        $errorMessage = isset($result['message']) ? $result['message'] : "Login failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section>
        <h2>Login</h2>
        <?php if (isset($errorMessage)) { echo "<p class='message'>$errorMessage</p>"; } ?>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.html">Register here</a></p>
    </section>
</body>
</html>
