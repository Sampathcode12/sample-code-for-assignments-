<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // API endpoint (replace with your actual .NET API URL)
    $apiUrl = "http://localhost:5268/api/Supplier/SupplierLogin";

    // Prepare the data to send
    $postData = json_encode([
        "EMAIL" => $email,
        "PASSWORD" => $password
    ]);

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
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

    // Check for errors
    if (curl_errno($ch)) {
        echo 'cURL Error: ' . curl_error($ch);
    } else {
        echo "Raw API Response: " . $result;
        $response = json_decode($result, true);
    }

    curl_close($ch);

    // Validate API response
    if ($response && isset($response['statusCode']) && isset($response['statusMessage'])) {
        if ($response['statusCode'] == 200) {
            $_SESSION['email'] = $email;
            echo "<script>alert('Login successful');</script>";
            echo "<script>window.location.href='Suplier_dashboard.php';</script>";
            exit();
        } else {
            echo "<script>alert('Login failed: " . $response['statusMessage'] . "');</script>";
            echo "<script>window.location.href='Suplier_Login.php';</script>";
            exit();
        }
    } else {
        echo "Invalid response from server. Please try again.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Supler</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section>
        <h2>Suplier Login</h2>
        <?php if (isset($errorMessage)) { echo "<p class='message'>$errorMessage</p>"; } ?>
        <form action=" " method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="SUplier_register.php">Register here</a></p>
    </section>
</body>
</html>
