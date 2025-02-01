<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $companyName = $_POST['company_name'];
    $password = $_POST['password'];
    $contactPerson = $_POST['contact_person'];
    $licenseNo = $_POST['license_no'];
    $email = $_POST['email'];
    $companyAddress = $_POST['company_Address'];

    // Create an array with form data
    $data = array(
        "company_name" => $companyName,
        "password" => $password,
        "contact_person" => $contactPerson,
        "license_no" => $licenseNo,
        "email" => $email,
        "company_address" => $companyAddress
    );

    // Convert the array to JSON
    $jsonData = json_encode($data);

    // Initialize cURL
    $ch = curl_init('https://your-api-url.com/api/supplier/register'); // Replace with your .NET API URL

    // Set the cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
    ));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check if the request was successful
    if ($response === false) {
        echo "Error: " . curl_error($ch);
    } else {
        // Decode the JSON response from the API
        $responseData = json_decode($response, true);

        // Handle the response (e.g., success or error message)
        if (isset($responseData['status']) && $responseData['status'] == 'success') {
            echo "Registration successful!";
        } else {
            echo "Error: " . (isset($responseData['message']) ? $responseData['message'] : 'Unknown error');
        }
    }

    // Close the cURL session
    curl_close($ch);
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Supplier Registration</h1>
        <nav>
            <a href="index.html">Home</a>
        </nav>
    </header>
    <section>
        <form action="register_process.php" method="POST">
            <label>Company Name:</label>
            <input type="text" name="company_name" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>Contact Person:</label>
            <input type="text" name="contact_person" required>

            <label>License Number:</label>
            <input type="text" name="license_no" required>

            <label>Email:</label>
            <input type="email" name="email" required>

           
            <label>Company Address:</label>
            <input type="text" name="company_Address" required>

            <button type="submit">Register</button>
        </form>
    </section>
</body>
</html>
