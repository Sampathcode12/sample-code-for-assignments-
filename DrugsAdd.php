<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST['name'] ?? ''; 
    $type = $_POST['type'] ?? ''; 
    $company = $_POST['company'] ?? ''; 
    $price = $_POST['price'] ?? ''; 
    $quantity = $_POST['quantity'] ?? ''; 
    $expiry = $_POST['expiry'] ?? ''; 

    // Handle image uploads
    $uploadDir = "uploads/";
    $imagePaths = [];

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (!empty($_FILES['images']['name'][0])) {
        for ($i = 0; $i < count($_FILES['images']['name']) && $i < 5; $i++) {
            $tmpName = $_FILES['images']['tmp_name'][$i];
            $originalName = basename($_FILES['images']['name'][$i]);
            $targetPath = $uploadDir . time() . "_" . $originalName;

            if (move_uploaded_file($tmpName, $targetPath)) {
                $imagePaths[] = $targetPath;
            }
        }
    }

    // Prepare data payload
    $data = array(
        "DRUG_NAME" => $name,
        "DRUG_TYPE" => $type,
        "DRUG_COMPANY" => $company,
        "DRUG_PRICE" => $price,
        "DRUG_QUANTITY" => $quantity,
        "DRUG_EXPIRY" => $expiry,
        "ImagePaths" => $imagePaths
    );
    
    echo "<script> console.log('Payload Data: " . json_encode($data) . "')</script>";
    
    // Send to API
    $ch = curl_init();
    $url = "http://localhost:5268/api/Drugs/AddDrugs"; // Adjust if needed

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
        echo "<script>alert('Drug Successfully Added');</script>";
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
    <style>
        .preview-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <section>
        <h2>Add / Update Drug</h2>
        <form method="post" enctype="multipart/form-data">
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

            <!-- Image Upload Field Styled + Previews -->
            <div class="mb-3 text-center">
                <label for="images" class="form-label">Upload Images (Max 5)</label>
                <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple onchange="previewMultipleImages(this)">
                <div id="imagePreviews" class="mt-2 d-flex flex-wrap justify-content-center"></div>
            </div>

            <button type="submit" name="add_drug">Add Drug</button>
        </form>
    </section>

    <!-- JS for previewing images -->
    <script>
        function previewMultipleImages(input) {
            const previewContainer = document.getElementById("imagePreviews");
            previewContainer.innerHTML = "";

            if (input.files) {
                const maxFiles = 5;
                const files = Array.from(input.files).slice(0, maxFiles);

                files.forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.className = "preview-img";
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
</body>
</html>
