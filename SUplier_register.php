<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
    $name = $_POST['name'] ?? ''; 
    $email = $_POST['Email'] ?? ''; 
    $password = $_POST['Password'] ?? ''; 
    $Address = $_POST['Address'] ?? ''; 
    $Phone_Number = $_POST['Phone_Number'] ?? ''; 
    $Licen_Number = $_POST['Licen_Number'] ?? ''; 
   
  

    $data = array(
        
      
        "name" => $name,
        "email" => $email,
        "password" => $password,
        "Address" => $Address,
        "Phone_Number" => $Phone_Number,
        "Licen_Number" => $Licen_Number
        

       
    );


    echo"<script> console.log('playload Data:".json_encode($data)."')</script>";

    $ch = curl_init();

    $url = "http://localhost:5268/api/Supplier/AddSupplier";

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
        echo "<script>alert('Staff Member Successfully Added');</script>";
    }
    curl_close($ch);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Supplier Form</title>
 
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
                <label for="name">Business Email</label>
                <input type="email" id="Email" name="Email" placeholder="Enter Email" required>
            </div>
           
            <div class="form-group">
                <label for="name">Password</label>
                <input type="password" id="Password" name="Password" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <label for="name"> Business Address </label>
                <input type="text" id="Address" name="Address" placeholder="Enter Address" required>
            </div>
           
            <div class="form-group">
                <label for="name">Phone Number</label>
                <input type="text" id="Phone_Number" name="Phone_Number" placeholder="Enter Number" required>
            </div>
            <div class="form-group">
                <label for="name">Licen Number</label>
                <input type="text" id="Licen_Number" name="Licen_Number" placeholder="Enter Licen Number" required>
            </div>

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
    </section>
</body>
</html>
