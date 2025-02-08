<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // API endpoint
    $apiUrl = "http://localhost:5268/api/Staff/StaffLogin";

    // Prepare the data
    $postData = json_encode([
        "EMAIL" => $email,
        "PASSWORD" => $password
    ]);

    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($postData)
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    // Execute cURL request
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get HTTP response code
    curl_close($ch);

    // Check if API returned a valid JSON response
    $response = json_decode($result, true);

    if ($httpCode == 200 && isset($response['statusCode'])) {
        if ($response['statusCode'] == 200) {
            // Extract job role from response
            $jobRole = isset($response['jobRole']) ? $response['jobRole'] : 'Unknown';

            // Store in session
            $_SESSION['email'] = $email;
            $_SESSION['job_role'] = $jobRole;

            echo "<script>alert('Login successful. Your role: $jobRole');</script>";
            echo "<script>window.location.href='Staff_Home.php';</script>";
            exit();
        } else {
            echo "<script>alert('Login failed: " . htmlspecialchars($response['statusMessage'] ?? 'Unknown error') . "');</script>";
            echo "<script>window.location.href='staffLogin.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Server error. Please try again later.');</script>";
    }

    // Debugging - Uncomment to see API response during development
    /*
    echo "<pre>";
    print_r($response);
    echo "</pre>";
    exit();
    */
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
        <form method="POST">
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
