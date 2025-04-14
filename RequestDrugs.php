<?php 
session_start();


// Redirect to login if email session is not set
if (!isset($_SESSION['Pharmacy_email'])) {
    header("Location: PhamacyLogin.php"); // Change the filename if your login page has a different name
    exit();
}

$responseMessage = "";

// Get data from query string
$itemName = $_GET['name'] ?? '';
$drugId = $_GET['drug_id'] ?? '';
$price = $_GET['price'] ?? '';
$brandName = $_GET['brand'] ?? '';

$drugImages = [];

// Fetch drug data and extract images for matching drug ID
if (!empty($drugId)) {
    include 'fetch_Data.php';
    $drugsData = fetchDrugsData();

    if (isset($drugsData['data']) && is_array($drugsData['data'])) {
        foreach ($drugsData['data'] as $drug) {
            if ($drug['druG_ID'] == $drugId) {
                if (!empty($drug['imagePaths']) && is_array($drug['imagePaths'])) {
                    $drugImages = $drug['imagePaths'];
                }
                break;
            }
        }
    }
}

// Handle form submission
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

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:5268/api/PhamacyRequst/AddPharmacyStockRequest');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pharmacy Stock Request</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 30px;
    }

    .container {
      background: white;
      padding: 30px;
      max-width: 700px;
      margin: auto;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    label {
      display: block;
      margin-top: 15px;
    }

    input[type="text"],
    input[type="email"],
    input[type="number"] {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      margin-top: 20px;
      background-color: #007BFF;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .response-msg {
      margin-top: 20px;
      color: green;
    }

    .images-wrapper {
      margin-top: 30px;
    }

    .images-wrapper h3 {
      margin-bottom: 10px;
    }

    .image-list {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .image-list img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 10px;
      border: 1px solid #ccc;
    }
  </style>
</head>
<body>
<div class="container">
  <h2>Pharmacy Stock Request Form</h2>

  <form method="POST" action="">
    <label for="pharmacy_name">Pharmacy Name:</label>
    <input type="text" id="pharmacy_name" name="pharmacy_name"
           value="<?php echo isset($_SESSION['pharmacyName']) ? htmlspecialchars($_SESSION['pharmacyName']) : ''; ?>"
           required readonly>

    <label for="pharmacy_email">Email:</label>
    <input type="email" id="pharmacy_email" name="pharmacy_email"
           value="<?php echo isset($_SESSION['Phamacy_email']) ? htmlspecialchars($_SESSION['Phamacy_email']) : ''; ?>"
           required readonly>

    <label for="item_name">Item Name:</label>
    <input type="text" id="item_name" name="item_name" value="<?php echo htmlspecialchars($itemName); ?>" required readonly>

    <label for="brand_name">Brand Name:</label>
    <input type="text" id="brand_name" name="brand_name" value="<?php echo htmlspecialchars($brandName); ?>">

    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" min="1" required>

    <button type="submit">Submit Request</button>
  </form>

  <?php if (!empty($responseMessage)): ?>
    <p class="response-msg"><?php echo htmlspecialchars($responseMessage); ?></p>
  <?php endif; ?>

  <?php if (!empty($drugImages)): ?>
    <div class="images-wrapper">
      <h3>All Images for This Drug</h3>
      <div class="image-list">
        <?php foreach ($drugImages as $img): ?>
          <img src="<?php echo htmlspecialchars($img); ?>" alt="Drug Image">
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
</div>
</body>
</html>
