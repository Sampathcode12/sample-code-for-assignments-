<?php
session_start();
include 'fetch_Data.php'; // Include PHP file with API call function

// Assuming the logged-in user's role is stored in session
$jobRole = $_SESSION['job_role'] ?? '';

// Fetch supplier data
$SupplierData = fetchSuppliersData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Search</title>
    <link rel="stylesheet" href="styles.css">  <!-- Link to external CSS -->
</head>
<body>

    <h2>Supplier Data View</h2>

    <table class="sTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <?php if ($jobRole === 'Admin') { echo "<th>Password</th>"; } ?>
                <th>License Number</th>
                <th>Phone Number</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (isset($SupplierData['data'])) {
            foreach ($SupplierData['data'] as $Supplier) {
                echo "<tr>
                    <td>{$Supplier['suP_ID']}</td>
                    <td>{$Supplier['name']}</td>
                    <td>{$Supplier['email']}</td>";

                // Display password only for admin users
                if ($jobRole === 'Admin') {
                    echo "<td>{$Supplier['password']}</td>";
                }

                echo "<td>{$Supplier['licen_Number']}</td>
                      <td>{$Supplier['phone_Number']}</td>
                      <td>{$Supplier['address']}</td>
                  </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No suppliers found or invalid response.</td></tr>";
        }
        ?>
        </tbody>
    </table>

</body>
</html>
