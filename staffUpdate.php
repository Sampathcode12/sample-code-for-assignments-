<?php
$message = "";
$statusColor = "red"; // Default error color
$StaffId = ""; // Default value for StaffId
$FirstName = "";
$LastName = "";
$Email = "";
$Password = "";
$Address = "";
$PhoneNumber = "";
$JoRole = "";

// Fetch staff data based on ID if available
if (isset($_GET['staff_id']) && !empty($_GET['staff_id'])) {
    $StaffId = $_GET['staff_id'];
    echo"$StaffId";

    // Fetch staff data from the API
    $url = "http://localhost:5268/api/Staff/GetAllStaff/$StaffId"; // Replace with your actual API endpoint
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200) {
        $staffData = json_decode($response, true);
        if (isset($staffData['data'])) {
            $staff = $staffData['data'];
            $FirstName = $staff['firstname'];
            $LastName = $staff['lastname'];
            $Email = $staff['email'];
            $Password = $staff['password']; // Be cautious with password
            $Address = $staff['address'];
            $PhoneNumber = $staff['phonE_NUMBER'];
            $JoRole = $staff['joB_ROLE'];
        } else {
            $message = "Staff member not found.";
        }
    } else {
        $message = "Failed to fetch staff data.";
    }
}

// Handle POST request for updating staff
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
    if (!empty($StaffId)) {
        
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
        $url = "http://localhost:5268/api/Staff/UpdateStaff/" . urlencode($StaffId);

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
    <title>Update Staff Member</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
        <h2>Update Staff Member</h2>
        
        <!-- Display Message -->
        <?php if (!empty($message)) : ?>
            <p class="message <?php echo $statusColor == 'green' ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </p>
        <?php endif; ?>

        <!-- Update Form -->
        <form method="POST" action="">
            <input type="hidden" name="Staff_id" value="<?php echo htmlspecialchars($StaffId); ?>" required>
            <input type="text" name="firstName" value="<?php echo htmlspecialchars($FirstName); ?>" placeholder="Enter First Name" required>
            <input type="text" name="LastName" value="<?php echo htmlspecialchars($LastName); ?>" placeholder="Enter Last Name" required>
            <input type="email" name="Email" value="<?php echo htmlspecialchars($Email); ?>" placeholder="Enter Email" required>
            <input type="password" name="Password" value="<?php echo htmlspecialchars($Password); ?>" placeholder="Enter Password" required>
            <input type="text" name="Address" value="<?php echo htmlspecialchars($Address); ?>" placeholder="Enter Address" required>
            <input type="text" name="PhoneNumber" value="<?php echo htmlspecialchars($PhoneNumber); ?>" placeholder="Enter Phone Number" required>

            <div class="mb-3">
                        <label for="JobRole" class="form-label">Job Role*</label>
                        <select class="form-select" id="JobRole" name="JobRole" required>
                            <!-- <option value="">Select Job Role</option> -->
                            <option value="Manager">Manager</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>


            <button type="submit">Update</button>
        </form>
    </div>

</body>
</html>
