<?php
$message = "";
$statusColor = "red"; // Default error color

// Handle POST request for updating drug
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $searchTerm = $_POST['searchTerm'] ?? '';
    $drugName = $_POST['drug_name'] ?? '';
    $drugType = $_POST['drug_type'] ?? '';
    $drugCompany = $_POST['drug_company'] ?? '';
    $drugPrice = $_POST['drug_price'] ?? '';
    $drugQuantity = $_POST['drug_quantity'] ?? '';
    $drugExpiry = $_POST['drug_expiry'] ?? '';

    // Validate required fields
    if (!empty($searchTerm) && !empty($drugName) && !empty($drugType) && !empty($drugCompany) && !empty($drugPrice) && !empty($drugQuantity) && !empty($drugExpiry)) {
        
        // Prepare data to send to API
        $data = [
            'search' => $searchTerm,
            'updatedDrug' => [
                'DRUG_NAME' => $drugName,
                'DRUG_TYPE' => $drugType,
                'DRUG_COMPANY' => $drugCompany,
                'DRUG_PRICE' => $drugPrice,
                'DRUG_QUANTITY' => $drugQuantity,
                'DRUG_EXPIRY' => $drugExpiry,
            ]
        ];

        // Convert data to JSON format
        $jsonData = json_encode($data);

        // API URL (Replace with the actual API endpoint)
        $url = "http://localhost:5268/api/Drugs/UpdateDrugs";

        // Initialize cURL session
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Timeout duration in seconds
        curl_setopt($ch, CURLOPT_POST, true);
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
                $message = "Drug updated successfully.";
                $statusColor = "green";
            } else {
                $message = "An error occurred: " . ($result['statusMessage'] ?? "Unknown error.");
            }
        }
    } else {
        $message = "Please enter all required drug details.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Drug</title>
</head>
<body>

    <h2>Update Drug</h2>
    <form method="POST" action="">
        <input type="text" name="searchTerm" placeholder="Enter Drug ID or Name" required><br>
        <input type="text" name="drug_name" placeholder="Enter Drug Name" required><br>
        <input type="text" name="drug_type" placeholder="Enter Drug Type" required><br>
        <input type="text" name="drug_company" placeholder="Enter Drug Company" required><br>
        <input type="number" name="drug_price" placeholder="Enter Drug Price" required><br>
        <input type="number" name="drug_quantity" placeholder="Enter Drug Quantity" required><br>
        <input type="date" name="drug_expiry" placeholder="Enter Drug Expiry Date" required><br>
        <button type="submit">Update Drug</button>
    </form>

    <?php if (!empty($message)) : ?>
        <p style="color: <?php echo htmlspecialchars($statusColor); ?>;">
            <?php echo htmlspecialchars($message); ?>
        </p>
    <?php endif; ?>

</body>
</html>
