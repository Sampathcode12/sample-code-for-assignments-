<?php
$message = "";
$statusColor = "red"; // Default error color

// Handle POST request for updating pharmacy
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $pharmacyId = $_POST['pharmacy_id'] ?? '';
    $pharmacyName = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $password = $_POST['password'] ?? '';
    $rfNumber = $_POST['RfNumber'] ?? '';
    $license = $_POST['LicenNumber'] ?? '';
    $phone = $_POST['Phone_number'] ?? '';

    // Validate required fields
    if (!empty($pharmacyId) && !empty($pharmacyName) && !empty($email)) {
        
        // Prepare data to send to API
        $data = [
            'pharmacyName' => $pharmacyName,
            'regNo' => $rfNumber,
            'address' => $address,
            'phone' => $phone,
            'email' => $email,
            'password' => $password,
            'license' => $license
        ];

        // Convert data to JSON format
        $jsonData = json_encode($data);

        // API URL (Replace with actual API endpoint)
        $url = "http://localhost:5268/api/PamacyController1/UpdatePharmacy/$pharmacyId";

        // Initialize cURL session
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Timeout duration in seconds
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Use PUT request
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Content-Length: " . strlen($jsonData)
        ]);

        // Execute cURL request
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        // Handle response from API
        if ($curlError) {
            $message = "Failed to connect to API: $curlError";
        } else {
            $result = json_decode($response, true);

            if ($httpCode == 200 && isset($result['statusCode']) && $result['statusCode'] == 200) {
                $message = "Pharmacy updated successfully.";
                $statusColor = "green";
            } elseif ($httpCode == 400) {
                $message = "Error: Bad request. Please check the input data.";
            }
            
            else {
                $message = "An error occurred: " . json_encode($result);
            }
        }
    } else {
        $message = "Please enter all required pharmacy details.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pharmacy</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">

    <h2>Update Pharmacy</h2>
    <form method="POST" action="">
        <input type="number" name="pharmacy_id" placeholder="Enter Pharmacy ID" required><br>
        <input type="text" name="name" placeholder="Enter Pharmacy Name" required><br>
        <input type="email" name="email" placeholder="Enter Pharmacy Email" required><br>
        <input type="text" name="address" placeholder="Enter Pharmacy Address" required><br>
        <input type="password" name="password" placeholder="Enter Password" required><br>
        <input type="text" name="RfNumber" placeholder="Enter RF Number" required><br>
        <input type="text" name="LicenNumber" placeholder="Enter License Number" required><br>
        <input type="number" name="Phone_number" placeholder="Enter Phone Number" required><br>
        <button type="submit">Update Pharmacy</button>
    </form>

    <?php if (!empty($message)) : ?>
        <p style="color: <?php echo htmlspecialchars($statusColor); ?>;">
            <?php echo htmlspecialchars($message); ?>
        </p>
    <?php endif; ?>

</body>
</html>
