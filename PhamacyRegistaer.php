<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pharmacyName = trim($_POST['pharmacyName'] ?? '');
    $regNo = trim($_POST['regNo'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $license = trim($_POST['license'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $data = array(
        "pharmacyName" => $pharmacyName,
        "regNo" => $regNo,
        "address" => $address,
        "phone" => $phone,
        "email" => $email,
        "license" => $license,
        "password" => $password
    );

    $apiUrl = "http://localhost:5268/api/PamacyController1/AddPharmacy";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
    curl_close($ch);

    if ($httpCode == 200) {
        echo "<script>alert('Phamacy Successfully Registered');</script>";
        echo "<script>window.location.href='PhamacyLogin.php';</script>";
    } elseif ($httpCode == 500) {
        echo "<script>alert('Error: Email already exists!');</script>";
    } else {
        echo "<script>alert('Error: Unable to register supplier. Please try again later.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Supplier Registration</title>
</head>
<body>
    <div class="form-container">
        <h2>Supplier Registration</h2>
        <section class="welcome">
            <form method="post">
                <div class="form-group">
                    <label for="pharmacyName">Pharmacy Name</label>
                    <input type="text" id="pharmacyName" name="pharmacyName" placeholder="Enter Pharmacy Name" required>
                </div>
                <div class="form-group">
                    <label for="regNo">Registration Number</label>
                    <input type="text" id="regNo" name="regNo" placeholder="Enter Registration Number" required>
                </div>
                <div class="form-group">
                    <label for="address">Business Address</label>
                    <input type="text" id="address" name="address" placeholder="Enter Address" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="Enter Phone Number" required>
                </div>
                <div class="form-group">
                    <label for="email">Business Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter Email" required>
                </div>
                <div class="form-group">
                    <label for="license">License Number</label>
                    <input type="text" id="license" name="license" placeholder="Enter License Number" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password" required>
                </div>
                <button type="submit" class="submit-btn">Register</button>
            </form>
        </section>
    </div>
</body>
</html>
