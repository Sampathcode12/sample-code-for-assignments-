<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

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
    curl_close($ch);

    if ($result) {
        $response = json_decode($result, true);

        if (isset($response['statusCode']) && $response['statusCode'] == 200) {
            // Extract job role and profile picture from response
            $jobRole = $response['jobRole'] ?? 'Unknown';
            $profilePicture = $response['profilePicture'] ?? 'default-profile.jpg'; // Default to 'default-profile.jpg' if no picture

            // Store in session
            $_SESSION['email'] = $email;
            $_SESSION['job_role'] = $jobRole;
            $_SESSION['profile_picture'] = $profilePicture; // Store profile picture

            // Redirect based on job role
            if ($jobRole === 'Admin') {
                header("Location: admin.php");
                exit();
            } elseif ($jobRole === 'Manager') {
                header("Location: manager_home.php");
                exit();
            } elseif ($jobRole === 'StockKeeper') {
                header("Location: stock_keeper.php");
                exit();
            } else {
                header("Location: staff_home.php"); // Default to staff home if job role doesn't match
                exit();
            }
        } else {
            echo "<script>alert('Login failed: " . ($response['statusMessage'] ?? 'Unknown error') . "');</script>";
            echo "<script>window.location.href='staffLogin.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Server error. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css"> <!-- Link to external CSS -->
</head>
<body>
    <section class="welcome">
        <h2>Login</h2>
        <form method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
        <!-- <p>Don't have an account? <a href="Staff.php">Register here</a></p> -->
    </section>
</body>
</html>
