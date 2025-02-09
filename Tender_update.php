<?php
$message = "";
$statusColor = "red"; // Default error color

// Handle POST request for updating supplier
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $Title = $_POST['Tender_title'] ?? '';
    $Description = $_POST['description'] ?? '';
    $Deadline = $_POST['Dead_line'] ?? '';
    $RFNumber = $_POST['RF_number'] ?? '';
    // $supplierPassword = $_POST['supplier_password'] ?? '';
    // $supplierLicenNumber = $_POST['supplier_licen_number'] ?? '';
    // $supplierPhoneNumber = $_POST['supplier_Phone_number'] ?? '';

    // Validate required fields
    if (!empty($RFNumber) ) {
        
        // Prepare data to send to API
        $data = [
            'tender_title' => $Title,
            'description' => $Description,
            'deadline' => $Deadline,
         
            ///'ADDRESS' => $supplierAddress,
            // 'PASSWORD' => $supplierPassword,
            // 'Licen_Number' => $supplierLicenNumber,
            // 'phone_Number' => $supplierPhoneNumber
        ];

        // Convert data to JSON format
        $jsonData = json_encode($data);

        // API URL (Replace with actual API endpoint)
        $url = "http://localhost:5268/api/Tender/UpdateTender/$RFNumber";

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
                $message = "Tender updated successfully.";
                $statusColor = "green";
            } else {
                $message = "An error occurred: " . json_encode($result);
            }
        }
    } else {
        $message = "Please enter all required Tender details.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Supplier</title>
</head>
<body>

    <h2>Update Supplier</h2>
    <form method="POST" action="">

         <input type="number" name="RF_number" placeholder="Enter References Number7" required><br>


        <input type="text" name="Tender_title" placeholder="Enter Title for Tender" required><br>
        <!-- <input type="text" name="description" placeholder="Enter Description" required><br> -->
        <textarea name="description" placeholder="Enter Description" rows="4" cols="50" required></textarea><br>
    
        <input type="Date" name="Dead_line" placeholder="Enter Deadline" required><br>
        <button type="submit">Update </button>
    </form>

    <?php if (!empty($message)) : ?>
        <p style="color: <?php echo htmlspecialchars($statusColor); ?>;">
            <?php echo htmlspecialchars($message); ?>
        </p>
    <?php endif; ?>

</body>
</html>
