<?php
session_start(); // Start session for login handling

$errorMessage = ""; // Initialize error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
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
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout to prevent long waiting times

        // Execute cURL request
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            $errorMessage = "Failed to connect to API: " . htmlspecialchars($curlError);
        } else {
            $response = json_decode($result, true);

            // Validate API response
            if ($httpCode == 200 && isset($response['statusCode']) && $response['statusCode'] == 200) {
                $_SESSION['supplier_email'] = $email; // Set session for logged-in supplier
                 // Optional: store supplier ID if returned
                $_SESSION['supplier_name'] = $response['supplierName'] ?? null;  // Optional: store supplier name
                
                echo "<script>alert('Login successful');</script>";
                echo "<script>window.location.href='Suplier_dashboardt.php';</script>"; // Redirect to dashboard
                exit();
            } else {
                $errorMessage = $response['statusMessage'] ?? "Login failed. Please check your credentials.";
            }
        }
    } else {
        $errorMessage = "Please enter both email and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section>
        <h2>Supplier Login</h2>
        <?php if (!empty($errorMessage)) : ?>
            <p class="message" style="color: red;"><?php echo htmlspecialchars($errorMessage); ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="Supplier_register.php">Register here</a></p>
    </section>
</body>
</html>
