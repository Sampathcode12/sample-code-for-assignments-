



<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
    $pharmacy_name = $_POST['pharmacy_name'] ?? ''; 
    $reg_no = $_POST['reg_no'] ?? ''; 
    $address = $_POST['address'] ?? ''; 
    $phone = $_POST['phone'] ?? ''; 
    $email = $_POST['email'] ?? ''; 
    $license = $_POST['license'] ?? ''; 
    $password = $_POST['password'] ?? ''; 
   
  

    $hashed_password = password_hash($password, PASSWORD_BCRYPT); 

    $data = array(
        
      
        "pharmacyName" => $pharmacy_name,
        "regNo" => $reg_no,
        "address" => $address,
        "phone" => $phone,
        "email" => $email,
        "license" => $license,
        "password" => $password
       

       
    );


    echo"<script> console.log('playload Data:".json_encode($data)."')</script>";

    $ch = curl_init();

    $url = "http://localhost:5268/api/PamacyController1/AddPharmacy";

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
        echo "<script>alert('Tender Added Successfully ');</script>";
    }
    curl_close($ch);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pharmacy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        .form-container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add Pharmacy</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="pharmacy_name">Pharmacy Name</label>
            <input type="text" id="pharmacy_name" name="pharmacy_name" required>
        </div>
        <div class="form-group">
            <label for="reg_no">Registration Number</label>
            <input type="text" id="reg_no" name="reg_no" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="license">License Number</label>
            <input type="text" id="license" name="license" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Add Pharmacy">
        </div>
    </form>
</div>

</body>
</html>
