
<?php
session_start();
// Enable error reporting for debugging
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $supplierName = $_POST['SupplierName'] ?? ''; 
    $supplierEmail = $_POST['SupplierEmail'] ?? ''; 
    $tenderRef = $_POST['TenderRef'] ?? ''; 
    $offeredPrice = $_POST['OfferedPrice'] ?? ''; 
    $proposalText = $_POST['ProposalText'] ?? ''; 

    // Data array to be sent as JSON
    $data = array(
        "SupplierName" => $supplierName,
        "SupplierEmail" => $supplierEmail,
        "TenderRef" => $tenderRef,
        "ProposalText" => $proposalText,
        "OfferedPrice" => $offeredPrice
    );

    // Log the data to the browser console for debugging
    echo "<script>console.log('Payload Data: " . json_encode($data) . "')</script>";

    // Initialize cURL session
    $ch = curl_init();
    $url = "http://localhost:5268/api/TenderAply/AddTenderProposal"; // Your API endpoint

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check if there was an error
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch); // Show cURL error
    } else {
        echo "<script>alert('Tender Proposal Submitted Successfully');</script>";
       // echo "API Response: " . htmlspecialchars($response); // Show the API response
    }

    // Close the cURL session
    curl_close($ch);
}
?>

<!-- HTML Form with added container class -->





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>/* General Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7fa;
    margin: 0;
    padding: 0;
}

/* Center the form */
.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Form Styles */
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* Label Styles */
.form-label {
    font-size: 16px;
    font-weight: bold;
    color: #333;
}

/* Input and Textarea Styles */
.form-control {
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #28a745;
    outline: none;
}

/* Button Styles */
.btn {
    background-color: #28a745;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #218838;
}

/* Additional Styles */
.mb-3 {
    margin-bottom: 15px;
}

textarea.form-control {
    resize: vertical;
}

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
    .container {
        width: 90%;
        padding: 15px;
    }
}
</style>
</head>
<body>
<div class="container">
    <form action="" method="post">
    <div class="mb-3">
    <label class="form-label">Supplier Name</label>
    <input type="text" class="form-control" name="SupplierName" value="<?php echo isset($_SESSION['supplier_name']) ? htmlspecialchars($_SESSION['supplier_name']) : ''; ?>" required>
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" class="form-control" name="SupplierEmail" value="<?php echo isset($_SESSION['supplier_email']) ? htmlspecialchars($_SESSION['supplier_email']) : ''; ?>" required>
</div>
        <div class="mb-3">
            <label class="form-label">Tender Reference Number</label>
            <input type="text" class="form-control" name="TenderRef" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Proposal Document (Text)</label>
            <textarea class="form-control" name="ProposalText" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Offered Price</label>
            <input type="number" class="form-control" name="OfferedPrice" required>
        </div>
        <button type="submit" class="btn">Apply for Tender</button>
        <button type="button" class="back-btn" onclick="history.back()">← Back</button>

    </form>
</div>

</body>
</html>


