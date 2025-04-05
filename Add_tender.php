<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tender_title = $_POST['tender_title'] ?? ''; 
    $RFnumber = $_POST['tender_ref'] ?? ''; 
    $Deadline = $_POST['deadline'] ?? ''; 
    $description_file = '';
    
    // Handle file upload
    if (isset($_FILES['description']) && $_FILES['description']['error'] == 0) {
        $upload_dir = "uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $file_name = basename($_FILES['description']['name']);
        $target_file = $upload_dir . time() . "_" . $file_name;
        if (move_uploaded_file($_FILES['description']['tmp_name'], $target_file)) {
            $description_file = $target_file;
        }
    }

    $data = array(
        "tender_title" => $tender_title,
        "RFnumber" => $RFnumber,
        "Description" => $description_file,
        "Deadline" => $Deadline,
    );
 
    echo "<script>console.log('Payload Data: " . json_encode($data) . "')</script>";

    $ch = curl_init();
    $url = "http://localhost:5268/api/Tender/AddTender";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $payload = json_encode($data);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        echo "<script>alert('Tender Added Successfully');</script>";
    }
    curl_close($ch);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create & Apply for Tender</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center"> Create Tender</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Tender Title</label>
                <input type="text" class="form-control" name="tender_title" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tender Reference Number</label>
                <input type="text" class="form-control" name="tender_ref" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description (Upload Document)</label>
                <input type="file" class="form-control" name="description" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deadline</label>
                <input type="date" class="form-control" name="deadline" required>
            </div>
            <button type="submit" class="btn btn-primary">Create & Publish</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
