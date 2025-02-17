<?php
$message = "";
$statusColor = "red"; // Default error color

// Handle POST request for updating supplier
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $supplierId = $_POST['supplier_id'] ?? '';
    $supplierName = $_POST['supplier_name'] ?? '';
    $supplierEmail = $_POST['supplier_email'] ?? '';
    $supplierAddress = $_POST['supplier_address'] ?? '';
    $supplierPassword = $_POST['supplier_password'] ?? '';
    $supplierLicenNumber = $_POST['supplier_licen_number'] ?? '';
    $supplierPhoneNumber = $_POST['supplier_Phone_number'] ?? '';

    // Validate required fields
    if (!empty($supplierId) && !empty($supplierName) && !empty($supplierEmail) && !empty($supplierAddress) && !empty($supplierPassword) && !empty($supplierLicenNumber)) {
        
        // Prepare data to send to API
        $data = [
            'SUP_ID' => $supplierId,
            'NAME' => $supplierName,
            'EMAIL' => $supplierEmail,
            'ADDRESS' => $supplierAddress,
            'PASSWORD' => $supplierPassword,
            'Licen_Number' => $supplierLicenNumber,
            'phone_Number' => $supplierPhoneNumber
        ];

        // Convert data to JSON format
        $jsonData = json_encode($data);

        // API URL (Replace with actual API endpoint)
        $url = "http://localhost:5268/api/Supplier/UpdateSupplier/$supplierId";

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
                $message = "Supplier updated successfully.";
                $statusColor = "green";
            } else {
                $message = "An error occurred: " . json_encode($result);
            }
        }
    } else {
        $message = "Please enter all required supplier details.
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Supplier</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
    <h2>Update Supplier</h2>
    <form method="POST" action="">
        <input type="number" name="supplier_id" placeholder="Enter Supplier ID" required><br>
        <input type="text" name="supplier_name" placeholder="Enter Supplier Name" required><br>
        <input type="email" name="supplier_email" placeholder="Enter Supplier Email" required><br>
        <input type="text" name="supplier_address" placeholder="Enter Supplier Address" required><br>
        <input type="password" name="supplier_password" placeholder="Enter Password" required><br>
        <input type="text" name="supplier_licen_number" placeholder="Enter License Number" required><br>
        <input type="number" name="supplier_Phone_number" placeholder="Enter Phone Number" required><br>
        <button type="submit">Update Supplier</button>
    </form>

    <?php if (!empty($message)) : ?>
        <p style="color: <?php echo htmlspecialchars($statusColor); ?>;">
            <?php echo htmlspecialchars($message); ?>
        </p>
    <?php endif; ?>

</body>
</html>
