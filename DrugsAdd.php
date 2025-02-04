<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST['name'] ?? ''; 
    $type = $_POST['type'] ?? ''; 
    $company = $_POST['company'] ?? ''; 
    $price = $_POST['price'] ?? ''; 
    $quantity = $_POST['quantity'] ?? ''; 
    $expiry = $_POST['expiry'] ?? ''; 
    
    $data = array(
        "DRUG_NAME" => $name,
        "DRUG_TYPE" => $type,
        "DRUG_COMPANY" => $company,
        "DRUG_PRICE" => $price,
        "DRUG_QUANTITY" => $quantity,
        "DRUG_EXPIRY" => $expiry
    );
    
    echo "<script> console.log('Payload Data: " . json_encode($data) . "')</script>";
    
    $ch = curl_init();
    
    $url = "http://localhost:5268/api/Drugs/AddDrugs"; // Adjust endpoint accordingly
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $payload = json_encode($data);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));
    
    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        echo "<script>alert('Drug Successfully Added or Updated');</script>";
    }
    curl_close($ch);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drugs Add</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section>
        <h2>Add / Update Drug</h2>
        <form method="post">
            <label for="name">Drug Name</label>
            <input type="text" name="name" id="name" required>

            <label for="type">Drug Type</label>
            <input type="text" name="type" id="type" required>

            <label for="company">Drug Company</label>
            <input type="text" name="company" id="company" required>

            <label for="price">Price</label>
            <input type="text" name="price" id="price" required>

            <label for="quantity">Quantity</label>
            <input type="text" name="quantity" id="quantity" required>

            <label for="expiry">Expiry Date</label>
            <input type="date" name="expiry" id="expiry" required>

            <button type="submit" name="add_drug">Add Drug</button>
            <button type="submit" name="update_drug">Update Drug</button>
        </form>
    </section>
</body>
</html>
