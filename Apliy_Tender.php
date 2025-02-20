
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
<link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
    <h2>Apply Tender</h2>
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


