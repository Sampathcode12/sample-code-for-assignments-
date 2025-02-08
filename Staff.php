<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Staff_Id = $_POST['StaffId'] ?? ''; 
    $firstname = $_POST['FIRSTNAME'] ?? ''; 
    $lastname = $_POST['LASTNAME'] ?? ''; 
    $email = $_POST['EMAIL'] ?? ''; 
    $password = $_POST['PASSWORD'] ?? ''; 
    $address = $_POST['ADDRESS'] ?? ''; 
    $phone = $_POST['Phone_number'] ?? ''; 
    $jobRole = $_POST['Job_Role'] ?? ''; 

    $data = array(
        "Staff_id" => $Staff_Id,
        "firstname" => $firstname,
        "lastname" => $lastname,
        "address" => $address,
        "password" => $password,
        "email" => $email,
        "phone_number" => $phone,
        "job_role" => $jobRole
    );

    $apiUrl = "http://localhost:5268/api/Staff/Addstaff";

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
        echo "<script>alert('Staff Member Successfully Added');</script>";
        echo "<script>window.location.href='staffLogin.php';</script>";
    } elseif ($httpCode == 409) {
        echo "<script>alert('Error: Staff ID or Email already exists!');</script>";
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
    <title>Add Staff Member</title>
</head>
<body>

    <header>
        <h2>Add a New Staff Member</h2>
    </header>

    <section class="welcome">
        <form action="" method="post">
            <h1>Staff Registration</h1>

            <label for="">Staff ID</label>
            <input type="text" name="StaffId" required>

            <div class="form-group">
                <label for="">FIRSTNAME</label>
                <input type="text" name="FIRSTNAME" required>
           

            <label for="">LASTNAME</label>
            <input type="text" name="LASTNAME" required>
            
            <label for="">EMAIL</label>
            <input type="email" name="EMAIL" required>
            
            <label for="">PASSWORD</label>
            <input type="password" name="PASSWORD" required>
            
            <label for="">ADDRESS</label>
            <input type="text" name="ADDRESS" required>

            <label for="">Phone Number</label>
            <input type="text" name="Phone_number" required>

            <label for="">Job Role</label>
            <select name="Job_Roll" required>
                <option value="">-- Select Job Role --</option>
                <option value="Admin">Admin</option>
                <option value="Manager">Manager</option>
                <option value="Stock_keeper">Stock ?keeper</option>
                <option value="Receptionist">Receptionist</option>
            </select>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>

        <div class="submit-btn" id="responseMessage"></div>
    </section>

</body>
</html>
