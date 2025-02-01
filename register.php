<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
    $name = $_POST['name'] ?? ''; 
    $email = $_POST['email'] ?? ''; 
    $password = $_POST['password'] ?? ''; 
    $supplied_item = $_POST['supplied_item'] ?? ''; 
    $address = $_POST['address'] ?? ''; 
  

    $data = array(
        
      
        "NAME" => $name,
        "EMAIL" => $email,
        "PASSWORD" => $password,
        "SUPPLIEDITEM" => $supplied_item,
        "ADDRESS" => $address

       
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
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input, 
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group textarea {
            resize: vertical;
            height: 100px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .submit-btn {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style> -->
</head>
<body>
    <div class="form-container">
        <h2>Supplier Registration</h2>
        <section class="welcome">
        <form method="post">
         
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <label for="supplied_item">Supplied Item</label>
                <input type="text" id="supplied_item" name="supplied_item" placeholder="Enter Supplied Item" required>
            </div>
           
            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" placeholder="Enter Address" required></textarea>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
    </section>
</body>
</html>
