<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the form data
    $firstname = $_POST['FIRSTNAME'] ?? ''; 
    $lastname = $_POST['LASTNAME'] ?? ''; 
    $email = $_POST['EMAIL'] ?? ''; 
    $password = $_POST['PASSWORD'] ?? ''; 
    $address = $_POST['ADDRESS'] ?? ''; 
    $phone_number = $_POST['Phone_number'] ?? ''; 
    $job_role = $_POST['JobRole'] ?? ''; 

    // Handle file upload
    if (isset($_FILES['profile_picture'])) {
        $profilePicture = $_FILES['profile_picture'];
        $profilePicturePath = "uploads/" . $profilePicture['name'];  // Define the file upload path
        move_uploaded_file($profilePicture['tmp_name'], $profilePicturePath);  // Move the uploaded file to the server
    }

    // Create an array with the form data and file information
    $data = array(
        "firstname" => $firstname,
        "lastname" => $lastname,
        "email" => $email,
        "password" => $password,
        "address" => $address,
        "phone_number" => $phone_number,
        "job_role" => $job_role,
        "profile_picture" => $profilePicturePath  // Path to the uploaded profile picture
    );

    // API URL where the data needs to be sent
    $apiUrl = "http://localhost:5268/api/Staff/Addstaff";

    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));

    // Execute cURL request
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
    curl_close($ch);

    // Handle the response based on the HTTP status code
    if ($httpCode == 200) {
        echo "<script>alert('Staff Member Successfully Added');</script>";
        echo "<script>window.location.href='staffLogin.php';</script>";
    } elseif ($httpCode == 409) {
        echo "<script>alert('Error: Email or Staff ID already exists!');</script>";
    } else {
        echo "<script>alert('Error: Unable to add staff. Please try again later.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Add Staff</title>
</head>
<body>
    <div class="form-container">
        <h2>Add Staff</h2>
        <section class="welcome">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="FIRSTNAME">First Name</label>
                    <input type="text" id="FIRSTNAME" name="FIRSTNAME" placeholder="Enter First Name" required>
                </div>
                <div class="form-group">
                    <label for="LASTNAME">Last Name</label>
                    <input type="text" id="LASTNAME" name="LASTNAME" placeholder="Enter Last Name" required>
                </div>
                <div class="form-group">
                    <label for="EMAIL">Email</label>
                    <input type="email" id="EMAIL" name="EMAIL" placeholder="Enter Email" required>
                </div>
                <div class="form-group">
                    <label for="PASSWORD">Password</label>
                    <input type="password" id="PASSWORD" name="PASSWORD" placeholder="Enter Password" required>
                </div>
                <div class="form-group">
                    <label for="ADDRESS">Address</label>
                    <input type="text" id="ADDRESS" name="ADDRESS" placeholder="Enter Address" required>
                </div>
                <div class="form-group">
                    <label for="Phone_number">Phone Number</label>
                    <input type="text" id="Phone_number" name="Phone_number" placeholder="Enter Phone Number" required>
                </div>
                <div class="form-group">
                    <label for="JobRole">Job Role</label>
                    <input type="text" id="JobRole" name="JobRole" placeholder="Enter Job Role" required>
                </div>
                <div class="form-group">
                    <label for="profile_picture">Profile Picture</label>
                    <input type="file" id="profile_picture" name="profile_picture" required>
                </div>
                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </section>
    </div>
</body>
</html>
