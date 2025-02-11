<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff List</title>
    <link rel="stylesheet" href="styles.css">  <!-- External CSS File -->
</head>
<body>

<header>
        <h2>Staff List</h2>
    </header>
  
  

    <table class="sTable">
        <thead>
            <tr>
            <th>Table ID</th>
                <th>ID</th>
                <th>Phamacy Name</th>
                <th>Phamacy Email</th>
                <th>Item Name</th>
                <th>Brand Name</th>
                <th>Quantity</th>
                <th>Request Date</th>
             
            </tr>
        </thead>
        <tbody>
            <?php
            include 'fetch_Data.php'; // Include PHP file with API call function
            $StaffData = fetchPhamacyRequestRejectView();

            if (isset($StaffData['data'])) {
                foreach ($StaffData['data'] as $Reject) {
                    echo "<tr>
                    <td>{$Reject['tabaleID']}</td>
                        <td>{$Reject['applicationId']}</td>
                        <td>{$Reject['pharmacyName']}</td>
                        <td>{$Reject['pharmacyEmail']}</td>
                        <td>{$Reject['itemName']}</td>                         
                        <td>{$Reject['brandName']}</td>
                        <td>{$Reject['quantity']}</td>
                         <td>{$Reject['requestDate']}</td>
                       
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
