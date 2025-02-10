<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tender List</title>
    <link rel="stylesheet" href="styles.css">  <!-- External CSS File -->
</head>
<body>

<header>
        <h2>Phamacy List</h2>
    </header>
  
  

    <table class="sTable">
        <thead>
            <tr>
                <th>ID</th>
                <th> Phamacy Name</th>
                <th>Register Number</th>
                <th>Address</th>
                <th>Phone Number Title</th>
                <th> Email</th>
                <th>License</th>
                <th>Password</th>
        
            </tr>
        </thead>
        <tbody>
            <?php
            include 'fetch_Data.php'; // Include PHP file with API call function
            $TenderData = fetchTenderPhamacyData();

            if (isset($TenderData['data'])) {
                foreach ($TenderData['data'] as $Tender) {
                    echo "<tr>
                        <td>{$Tender['id']}</td>
                        <td>{$Tender['pharmacyName']}</td>
                        <td>{$Tender['regNo']}</td>
                        <td>{$Tender['address']}</td>        
                        <td>{$Tender['phone']}</td>
                        <td>{$Tender['email']}</td>
                        <td>{$Tender['license']}</td>
                        <td>{$Tender['password']}</td>                   
                         





                      </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No suppliers found or invalid response.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- <button onclick="window.location.href='Apliy_Tender.php';">Apply</button> -->
    <button onclick="window.history.back();">Back</button>


</body>
</html>
