<?php
$message = "";
$statusColor = "red"; // Default error color

// Handle POST request for updating supplier
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $DrugsId = $_POST['Drugs_id'] ?? '';
    $DrugsName = $_POST['Drugs_name'] ?? '';
    $DrugsTyep = $_POST['Drugs_Type'] ?? '';
    $DrugsCompany = $_POST['Drugs_Company'] ?? '';
    $DrugsPrice = $_POST['Drugs_Price'] ?? '';
    $DrugsQuantity = $_POST['Drugs_Quantity'] ?? '';
    $DrugsExpryDate = $_POST['Drugs_expry_date'] ?? '';
    // Validate required fields
    if (!empty($DrugsId)) {
        
        // Prepare data to send to API
        $data = [
            'druG_ID' => $DrugsId,
            'druG_NAME' => $DrugsName,
            'druG_TYPE' => $DrugsTyep,
            'druG_COMPANY' => $DrugsCompany,
            'druG_PRICE' => $DrugsPrice,
            'druG_QUANTITY' => $DrugsQuantity,
            'druG_EXPIRY' => $DrugsExpryDate

        ];

        // Convert data to JSON format
        $jsonData = json_encode($data);

        // API URL (Replace with actual API endpoint)
        $url = "http://localhost:5268/api/Drugs/UpdateDrugs/$DrugsId";

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
                $message = "Drugs updated successfully.";
                $statusColor = "green";
            } else {
                $message = "An error occurred: " . json_encode($result);
            }
        }
    } else {
        $message = "Please enter all required Drugs details.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Stock</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Update Stock</h2>
    <form method="POST" action="">
        <input type="number" name="Drugs_id" placeholder="Enter Drugs ID" required><br>
        <input type="text" name="Drugs_name" placeholder="Enter Drugs Name" required><br>
        <input type="text" name="Drugs_Type" placeholder="Enter Drugs Type" required><br>
        <input type="text" name="Drugs_Company" placeholder="Enter Drugs Company" required><br>
        <input type="number" name="Drugs_Price" placeholder="Enter price" required><br>
        <input type="text" name="Drugs_Quantity" placeholder="Enter Quantity" required><br>
        <input type="date" name="Drugs_expry_date" placeholder="Enter expry date" required><br>
        <button type="submit">Update Drugs</button>
        <button type="button" class="back-btn" onclick="history.back()">← Back</button>
    </form>
</div>
    <?php if (!empty($message)) : ?>
        <p style="color: <?php echo htmlspecialchars($statusColor); ?>;">
            <?php echo htmlspecialchars($message); ?>
        </p>
    <?php endif; ?>

</body>
</html>
