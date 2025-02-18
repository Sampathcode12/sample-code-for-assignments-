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
    <div class="container">
        <h2>Pharmacy Stock Request Form</h2>
        <form method="POST" action="">
            <label for="pharmacy_name">Pharmacy Name:</label>
            <input type="text" id="pharmacy_name" name="pharmacy_name" value="<?php echo isset($_SESSION['pharmacyName']) ? htmlspecialchars($_SESSION['pharmacyName']) : ''; ?>" required readonly>

            <label for="pharmacy_email">Email:</label>
            <input type="email" id="pharmacy_email" name="pharmacy_email" value="<?php echo isset($_SESSION['Phamacy_email']) ? htmlspecialchars($_SESSION['Phamacy_email']) : ''; ?>" required readonly>

            <label for="item_name">Item Name:</label>
            <input type="text" id="item_name" name="item_name" required>

            <label for="brand_name">Brand Name:</label>
            <input type="text" id="brand_name" name="brand_name" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" required>

            <button type="submit">Submit Request</button>
        </form>

        <?php if (!empty($responseMessage)): ?>
            <p class="response-msg"><?php echo htmlspecialchars($responseMessage); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
