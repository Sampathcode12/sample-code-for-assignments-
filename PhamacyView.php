<?php
session_start();
include 'fetch_Data.php'; // Include PHP file with API call function

// Assuming you store the logged-in user's role in the session
$jobRole = $_SESSION['job_role'] ?? '';

// Fetch tender pharmacy data
$TenderData = fetchTenderPhamacyData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h2>Pharmacy List</h2>
</header>

<table class="sTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Pharmacy Name</th>
            <th>Register Number</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>License</th>
            <?php if ($jobRole === 'Admin') { echo "<th>Password</th>"; } ?>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($TenderData['data'])) {
            foreach ($TenderData['data'] as $Tender) {
                echo "<tr>
                    <td>{$Tender['id']}</td>
                    <td>{$Tender['pharmacyName']}</td>
                    <td>{$Tender['regNo']}</td>
                    <td>{$Tender['address']}</td>
                    <td>{$Tender['phone']}</td>
                    <td>{$Tender['email']}</td>
                    <td>{$Tender['license']}</td>";
                    
                // Show password only for admin
                if ($jobRole === 'Admin') {
                    echo "<td>{$Tender['password']}</td>";
                }
                
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No pharmacies found or invalid response.</td></tr>";
        }
        ?>
    </tbody>
</table>
<!-- 
<button onclick="window.history.back();">Back</button> -->

</body>
</html>
