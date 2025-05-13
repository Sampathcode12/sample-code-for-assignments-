<?php
$message = "";
$statusColor = "red"; // Default error color

// Handle POST request for updating supplier
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $StaffId = $_POST['Staff_id'] ?? '';
    $FirstName = $_POST['firstName'] ?? '';
    $LastName = $_POST['LastName'] ?? '';
    $Email = $_POST['Email'] ?? '';
    $Password = $_POST['Password'] ?? '';
    $Address = $_POST['Address'] ?? '';
    $PhoneNumber = $_POST['PhoneNumber'] ?? '';
    $JoRole = $_POST['JobRole'] ?? '';

    // Validate required fields
    if (!empty($StaffId) )  {
        
        // Prepare data to send to API
        $data = [
            'Staff_id' => $StaffId,
            'firstname' => $FirstName,
            'lastname' => $LastName,
            'Email' => $Email,
            'password' => $Password,
            'address' => $Address,
            'phone_number' => $PhoneNumber,
            'job_role' => $JoRole

        ];



        // Convert data to JSON format
        $jsonData = json_encode($data);

        // API URL (Replace with actual API endpoint)
        $url = "http://localhost:5268/api/Staff/UpdateStaff/$StaffId";

        // Initialize cURL session
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Timeout duration in seconds
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Use PUT request
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Content-Length: " . strlen($jsonData)
        ]);

        // Execute cURL request
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        // Handle response from API
        if ($curlError) {
            $message = "Failed to connect to API: $curlError";
        } else {
            $result = json_decode($response, true);

            if ($httpCode == 200 && isset($result['statusCode']) && $result['statusCode'] == 200) {
                $message = "Staff Member updated successfully.";
                $statusColor = "green";
            } else {
                $message = "An error occurred: " . json_encode($result);
            }
        }
    } else {
        $message = "Please enter all required Staff details.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Staff Mamber</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
        <h2>Update Staff Mamber</h2>
        <form method="POST" action="">
            <input type="number" name="Staff_id" placeholder="Enter Staff ID" required>
            <input type="text" name="firstName" placeholder="Enter First Name" required>
            <input type="text" name="LastName" placeholder="Enter Last Name" required>
            <input type="email" name="Email" placeholder="Enter Email" required>
            <input type="password" name="Password" placeholder="Enter Password" required>
            <input type="text" name="Address" placeholder="Enter Address" required>
            <input type="number" name="PhoneNumber" placeholder="Enter Phone Number" required>
            
            <select name="JobRole" id="JobRole" required>
                <option value="">-- Select Job Role --</option>
                <option value="Admin">Admin</option>
                <option value="Manager">Manager</option>
                <option value="StockKeeper">Stock Keeper</option>
                <option value="Receptionist">Receptionist</option>
            </select>

            <button type="submit">Update Member</button>
        </form>

        <?php if (!empty($message)) : ?>
            <p class="message <?php echo $statusColor == 'green' ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </p>
        <?php endif; ?>
    </div>

</body>
</html>
