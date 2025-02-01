<?php
// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $fullName = isset($_POST['fullName']) ? trim($_POST['fullName']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $role = isset($_POST['role']) ? trim($_POST['role']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $phoneNumber = isset($_POST['PhoneNumber']) ? trim($_POST['PhoneNumber']) : '';
    $address = isset($_POST['Address']) ? trim($_POST['Address']) : '';

    // Validate: Ensure all fields are filled
    if (empty($fullName) || empty($email) || empty($role) || empty($password) || empty($phoneNumber) || empty($address)) {
        echo json_encode(["status" => "error", "message" => "All fields are required!"]);
        exit;
    }

    // Validate: Check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email format!"]);
        exit;
    }

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare data for the database or API
    $staffData = array(
        "full_name" => $fullName,
        "email" => $email,
        "role" => $role,
        "password" => $hashedPassword,
        "phone_number" => $phoneNumber,
        "address" => $address
    );

    // Here you would typically insert data into a database. For now, let's mock success.
    // Replace the following lines with database insertion or API integration.
    $success = true; // Simulating a successful operation

    if ($success) {
        // Return success message
        echo json_encode(["status" => "success", "message" => "Staff member added successfully!"]);
    } else {
        // Return error message if something goes wrong
        echo json_encode(["status" => "error", "message" => "Failed to add staff member."]);
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
        <nav>
            <a href="admin.html">Home</a>
            <a href="login.html">Login</a>
        </nav>
    </header>

    <section class="welcome">

    <form id="addStaffForm">
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="role">Role:</label>
        <input type="text" id="role" name="role" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="PhoneNumber">Phone Number:</label>
        <input type="text" id="PhoneNumber" name="PhoneNumber" required>

        <label for="Address">Address:</label>
        <input type="text" id="Address" name="Address" required>

        <button type="submit">Add Staff Member</button>
    </form>

    <div class="message" id="responseMessage"></div>
    </section>
    <script>
        document.getElementById('addStaffForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent form from refreshing the page

            const staffData = {
                fullName: document.getElementById('fullName').value,
                email: document.getElementById('email').value,
                role: document.getElementById('role').value,
                password: document.getElementById('password').value,
            };

            fetch('https://yourdomain.com/api/staff', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(staffData),
            })
            .then(response => response.json())
            .then(data => {
                // Handle success
                document.getElementById('responseMessage').innerHTML = `<p>Staff member added successfully!</p>`;
            })
            .catch(error => {
                // Handle error
                document.getElementById('responseMessage').innerHTML = `<p>Error: ${error.message}</p>`;
            });
        });
    </script>

</body>
</html>
