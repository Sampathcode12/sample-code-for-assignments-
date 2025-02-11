<?php 
$responseMessage = ""; // Initialize response message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pharmacyName = $_POST["pharmacy_name"];
    $pharmacyEmail = $_POST["pharmacy_email"];
    $itemName = $_POST["item_name"];
    $brandName = $_POST["brand_name"];
    $quantity = (int)$_POST["quantity"];

    $data = array(
        "pharmacyName" => $pharmacyName,
        "pharmacyEmail" => $pharmacyEmail,
        "itemName" => $itemName,
        "brandName" => $brandName,
        "quantity" => $quantity
    );

    echo "<script>console.log('Payload Data: " . addslashes(json_encode($data)) . "');</script>";

echo "";


    $ch = curl_init();
    $url = 'http://localhost:5268/api/PhamacyRequst/AddPharmacyStockRequest'; // Fixed URL

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $payload = json_encode($data);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
        $responseMessage = "Error: " . curl_error($ch);
    } else {
        $decodedResponse = json_decode($response, true);
        if ($httpCode === 200) {
            $responseMessage = "Request added successfully.";
            echo "<script>alert('Request added successfully');</script>";
        } else {
            $responseMessage = "Failed to add request: " . ($decodedResponse['statusMessage'] ?? 'Unknown error');
        }
    }
    
    curl_close($ch);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Stock Request</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Pharmacy Stock Request Form</h2>
    <form method="POST" action="">
        <label>Pharmacy Name:</label>
        <input type="text" name="pharmacy_name" required>

        <label>Email:</label>
        <input type="email" name="pharmacy_email" required>

        <label>Item Name:</label>
        <input type="text" name="item_name" required>

        <label>Brand Name:</label> <!-- Company Name -->
        <input type="text" name="brand_name" required>

        <label>Quantity:</label>
        <input type="number" name="quantity" min="1" required>

        <button type="submit">Submit Request</button>
    </form>

    <?php if (!empty($responseMessage)): ?>
        <p class='response-msg'><?= htmlspecialchars($responseMessage) ?></p>
    <?php endif; ?>
</body>
</html>
