<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = $_POST['FIRSTNAME'] ?? ''; 
    $lastname = $_POST['LASTNAME'] ?? ''; 
    $email = $_POST['EMAIL'] ?? ''; 
    $password = $_POST['PASSWORD'] ?? ''; 
    $address = $_POST['ADDRESS'] ?? ''; 
  

    $data = array(
        
        "firstname" => $firstname,
        "lastname" => $lastname,
        "address" => $address,
        "password" => $password,
        "email" => $email
       
    );


    echo"<script> console.log('playload Data:".json_encode($data)."')</script>";

    $ch = curl_init();

    $url = "http://localhost:5268/api/Staff/Addstaff";

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
    <title>Add Staff Member</title>

</head>
<body>

    <header>
        <h2>Add a New Staff Member</h2>
        <nav>
            <!-- <a href="admin.html">Home</a>
            <a href="login.php">Login</a> -->
        </nav>
    </header>

    <section class="welcome">
    <form action="" method="post">
        <h1>Staff Registration</h1>
      
                
        <div class="form-group">
        <label for="">FIRSTNAME</label>
        <input type="text" name="FIRSTNAME">
        </div>

        <label for="">LASTNAME</label>
        <input type="text" name="LASTNAME">
        
        <label for="">EMAIL</label>
        <input type="text" name="EMAIL">
        
        <label for="">PASSWORD</label>
        <input type="password" name="PASSWORD">
        
        <label for="">ADDRESS</label>
        <input type="text" name="ADDRESS">
        
     
        
         <button type="submit" class="submit-btn">Submit</button>
    </form>

    <div class="submit-btn" id="responseMessage"></div>
    </section>


</body>
</html>
