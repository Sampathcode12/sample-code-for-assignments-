<?php
session_start();
include 'fetch_Data.php'; // Include PHP file with API call function

// Assuming you store the logged-in user's role in the session
$jobRole = $_SESSION['job_role'] ?? '';

// Fetch staff data
$StaffData = fetchStaffData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h2>Staff List</h2>
</header>

<table class="sTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Address</th>
            <?php if ($jobRole === 'Admin') { echo "<th>Password</th>"; } ?>
            <th>Phone Number</th>
            <th>Job Type</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($StaffData['data'])) {
            foreach ($StaffData['data'] as $Staff) {
                echo "<tr>
                    <td>{$Staff['stafF_ID']}</td>
                    <td>{$Staff['firstname']}</td>
                    <td>{$Staff['lastname']}</td>
                    <td>{$Staff['email']}</td>
                    <td>{$Staff['address']}</td>";
                    
                // Show password only for admin
                if ($jobRole === 'Admin') {
                    echo "<td>{$Staff['password']}</td>";
                }

                echo "<td>{$Staff['phonE_NUMBER']}</td>
                      <td>{$Staff['joB_ROLE']}</td>
                  </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No staff found or invalid response.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
