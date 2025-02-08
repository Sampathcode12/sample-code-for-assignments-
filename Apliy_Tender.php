<?php
// Start session to retrieve supplier session data
session_start();

// Retrieve session values if set
$supplierName = $_SESSION['supplier_name'] ?? '';
$supplierEmail = $_SESSION['supplier_email'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form inputs
    $supplier_name = $_POST['supplier_name'] ?? '';
    $RFnumber = $_POST['tender_ref'] ?? '';
    $offered_price = $_POST['offered_price'] ?? '';
    $proposal = $_POST['proposal'] ?? '';  // Updated to match form field
    $supplier_email = $_POST['supplier_email'] ?? '';

    // Prepare data for API request
    $data = array(
        "supplierName" => $supplier_name,
        "tenderRef" => $RFnumber,
        "offeredPrice" => $offered_price,
        "proposalDocument" => $proposal,  // Now sending text instead of a file
        "supplierEmail" => $supplier_email,
    );

    echo "<script>console.log('Payload Data: " . json_encode($data) . "');</script>";

    // Initialize cURL session
    $ch = curl_init();
    $url = "http://localhost:5268/api/TenderAply/AddTenderProposal";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Set headers
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));

    // Execute request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo "<script>alert('Error: " . curl_error($ch) . "');</script>";
    } else {
        echo "<script>alert('Tender Applied Successfully');</script>";
    }

    curl_close($ch);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier - Apply for Tender</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center">Supplier - Apply for Tender</h2>
        <form action="" method="post">
            <!-- Supplier Name (Pre-filled with session data if available) -->
            <div class="mb-3">
                <label class="form-label">Supplier Name</label>
                <input type="text" class="form-control" name="supplier_name" value="<?php echo htmlspecialchars($supplierName); ?>" required>
            </div>
            
            <!-- Tender Reference Number -->
            <div class="mb-3">
                <label class="form-label">Tender Reference Number</label>
                <input type="text" class="form-control" name="tender_ref" required>
            </div>
            
            <!-- Proposal (Text input instead of file upload) -->
            <div class="mb-3">
                <label class="form-label">Proposal</label>
                <textarea class="form-control" name="proposal" rows="5" required></textarea>
            </div>
            
            <!-- Offered Price -->
            <div class="mb-3">
                <label class="form-label">Offered Price</label>
                <input type="number" step="0.01" class="form-control" name="offered_price" required>
            </div>
            
            <!-- Supplier Email (Pre-filled with session data if available) -->
            <div class="mb-3">
                <label class="form-label">Supplier Email</label>
                <input type="email" class="form-control" name="supplier_email" value="<?php echo htmlspecialchars($supplierEmail); ?>" required>
            </div>
            
            <button type="submit" class="btn btn-success">Apply for Tender</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
