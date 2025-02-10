<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pharmacyName = $_POST["pharmacy_name"];
    $pharmacyEmail = $_POST["pharmacy_email"];
    $itemName = $_POST["item_name"];
    $brandName = $_POST["brand_name"];
    $quantity = $_POST["quantity"];

    // API endpoint for submitting stock requests
    $url = 'http://localhost:5268/api/PhamacyRequst/AddPharmacyStockRequest';

    // Data to be sent in JSON format
    $data = json_encode([
        "pharmacyName" => $pharmacyName,
        "pharmacyEmail" => $pharmacyEmail,
        "itemName" => $itemName,
        "brandName" => $brandName,
        "itemQuantity" => (int)$quantity

 
    ]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)
    ]);

    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        $responseMessage = "Error: " . curl_error($ch);
    } else {
        $response = json_decode($result, true);
        if (isset($response["StatusMessage"])) {
            $responseMessage = $response["StatusMessage"];
        } else {
            $responseMessage = "Stock request submitted successfully!";
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
    <form method="POST">
        <label>Pharmacy Name:</label>
        <input type="text" name="pharmacy_name" required>

        <label>Email:</label>
        <input type="email" name="pharmacy_email" required>

        <label>Item Name:</label>
        <input type="text" name="item_name" required>

        <label>Brand Name:</label> <!-- company Name -->
        <input type="text" name="brand_name" required>

        <label>Quantity:</label>
        <input type="number" name="quantity" min="1" required>

        <button type="submit">Submit Request</button>
    </form>

    <?php
    if (isset($responseMessage)) {
        echo "<p class='response-msg'>$responseMessage</p>";
    }
    ?>
</body>
</html>