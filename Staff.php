<?php
// staff_register.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate required fields
    $requiredFields = ['FirstName', 'LastName', 'Email', 'Password', 'Address', 'PhoneNumber', 'JobRole'];
    $missingFields = [];
    
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $missingFields[] = $field;
        }
    }
    
    if (!empty($missingFields)) {
        echo "<script>alert('Missing required fields: " . implode(', ', $missingFields) . "');</script>";
        exit();
    }

    // Validate email format
    if (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
        exit();
    }

    // Initialize profile picture as null
    $profilePictureBase64 = null;
    
    // Handle file upload if present
    if (isset($_FILES['ProfilePicture']) && $_FILES['ProfilePicture']['error'] == UPLOAD_ERR_OK) {
        $fileType = pathinfo($_FILES['ProfilePicture']['name'], PATHINFO_EXTENSION);
        $allowedTypes = ['jpg', 'jpeg', 'png'];
        
        if (!in_array(strtolower($fileType), $allowedTypes)) {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, and PNG allowed.');</script>";
            exit();
        }
        
        $imageData = file_get_contents($_FILES['ProfilePicture']['tmp_name']);
        $profilePictureBase64 = base64_encode($imageData);
    }

    // Prepare API data
    $data = [
        'FIRSTNAME' => $_POST['FirstName'],
        'LASTNAME' => $_POST['LastName'],
        'EMAIL' => $_POST['Email'],
        'PASSWORD' => password_hash($_POST['Password'], PASSWORD_BCRYPT),
        'ADDRESS' => $_POST['Address'],
        'PHONE_NUMBER' => $_POST['PhoneNumber'],
        'JOB_ROLE' => $_POST['JobRole'],
        'ProfilePictureBase64' => $profilePictureBase64
    ];

    // API endpoint
    $apiUrl = "http://localhost:5268/api/Staff/AddStaff";
    
    // Initialize cURL
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $apiUrl,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Accept: application/json'
        ]
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Handle response
    if ($httpCode == 200) {
        echo "<script>alert('Staff added successfully!'); window.location.href='staff_list.php';</script>";
    } else {
        $responseData = json_decode($response, true);
        $errorMsg = $responseData['StatusMessage'] ?? 'Unknown error occurred';
        echo "<script>alert('Error: $errorMsg');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Staff Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 40px;
        }
        .card {
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .form-label {
            font-weight: 500;
        }
        .profile-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: 10px auto;
            display: block;
            border: 3px solid #dee2e6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Add New Staff Member</h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" id="staffForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="FirstName" class="form-label">First Name*</label>
                            <input type="text" class="form-control" id="FirstName" name="FirstName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="LastName" class="form-label">Last Name*</label>
                            <input type="text" class="form-control" id="LastName" name="LastName" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="Email" class="form-label">Email*</label>
                        <input type="email" class="form-control" id="Email" name="Email" required>
                    </div>

                    <div class="mb-3">
                        <label for="Password" class="form-label">Password*</label>
                        <input type="password" class="form-control" id="Password" name="Password" minlength="8" required>
                        <small class="text-muted">Minimum 8 characters</small>
                    </div>

                    <div class="mb-3">
                        <label for="Address" class="form-label">Address*</label>
                        <input type="text" class="form-control" id="Address" name="Address" required>
                    </div>

                    <div class="mb-3">
                        <label for="PhoneNumber" class="form-label">Phone Number*</label>
                        <input type="tel" class="form-control" id="PhoneNumber" name="PhoneNumber" required>
                    </div>

                    <div class="mb-3">
                        <label for="JobRole" class="form-label">Job Role*</label>
                        <select class="form-select" id="JobRole" name="JobRole" required>
                            <option value="">Select Job Role</option>
                            <option value="Manager">Manager</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Staff">Staff</option>
                            <option value="Administrator">Administrator</option>
                        </select>
                    </div>

                    <div class="mb-3 text-center">
                        <label for="ProfilePicture" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" id="ProfilePicture" name="ProfilePicture" accept="image/*" onchange="previewImage(this)">
                        <img id="profilePreview" src="https://via.placeholder.com/120" class="profile-preview mt-2" alt="Profile Preview">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Add Staff Member</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewImage(input) {
            const preview = document.getElementById('profilePreview');
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "https://via.placeholder.com/120";
            }
        }

        document.getElementById('staffForm').addEventListener('submit', function(e) {
            const password = document.getElementById('Password').value;
            if (password.length < 8) {
                alert('Password must be at least 8 characters long');
                e.preventDefault();
            }
        });
    </script>
</body>
</html>