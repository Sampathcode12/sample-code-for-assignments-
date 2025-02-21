<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? ''; 
    $email = $_POST['Email'] ?? ''; 
    $password = $_POST['Password'] ?? ''; 
    $address = $_POST['Address'] ?? ''; 
    $phone_number = $_POST['Phone_Number'] ?? ''; 
    $licen_number = $_POST['Licen_Number'] ?? ''; 

    $data = array(
        "name" => $name,
        "email" => $email,
        "password" => $password,
        "address" => $address,
        "phone_number" => $phone_number,
        "licen_number" => $licen_number
    );

    $apiUrl = "http://localhost:5268/api/Supplier/AddSupplier";

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
        echo "<script>alert('Supplier Successfully Registered');</script>";
        echo "<script>window.location.href='SuplierLogin.php';</script>";
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
                    <label for="name">Business Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter Name" required>
                </div>
                <div class="form-group">
                    <label for="email">Business Email</label>
                    <input type="email" id="Email" name="Email" placeholder="Enter Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="Password" name="Password" placeholder="Enter Password" required>
                </div>
                <div class="form-group">
                    <label for="address">Business Address</label>
                    <input type="text" id="Address" name="Address" placeholder="Enter Address" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" id="Phone_Number" name="Phone_Number" placeholder="Enter Number" required>
                </div>
                <div class="form-group">
                    <label for="licen_number">License Number</label>
                    <input type="text" id="Licen_Number" name="Licen_Number" placeholder="Enter License Number" required>
                </div>
                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </section>
    </div>
</body>
</html>
