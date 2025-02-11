<?php
include 'fetch_Data.php';
$TenderAplyData = fetchPhamacyRequest();
?>
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
    <h2>Tender List</h2>
</header>

<table class="sTable">
    <thead>
        <tr>
        <th>Request ID</th>
            <th>Phamacy Name</th>
            <th>Phamacy Email</th>
            <th>Item Name</th>
            <th>Brand Name</th>
            <th>Quantity</th>
            <th>Request Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($TenderAplyData['data']) && is_array($TenderAplyData['data'])) {
            foreach ($TenderAplyData['data'] as $TenderApplication) {
                if (is_array($TenderApplication)) {
                    $appId = htmlspecialchars($TenderApplication['applicationId'] ?? 'N/A');
                    echo "<tr>
                        <td>{$appId}</td>
                        <td>" . htmlspecialchars($TenderApplication['applicationId'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($TenderApplication['pharmacyName'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($TenderApplication['pharmacyEmail'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($TenderApplication['itemName'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($TenderApplication['brandName'] ?? 'N/A') . "</td>   
                        <td>" . htmlspecialchars($TenderApplication['quantity'] ?? 'N/A') . "</td> 
                        <td>" . htmlspecialchars($TenderApplication['requestDate'] ?? 'N/A') . "</td> 
                        



                        
                        <td>
                            <form action='PhamcyRequestReConform.php' method='POST' style='display:inline-block;'>
                                <input type='hidden' name='applicationId' value='{$appId}'>
                                <input type='hidden' name='action' value='confirm'>
                                <button type='submit'>Confirm</button>
                            </form>
                            <form action='PhamcyRequestReject.php' method='POST' style='display:inline-block;'>
                                <input type='hidden' name='applicationId' value='{$appId}'>
                                <input type='hidden' name='action' value='reject'>
                                <button type='submit'>Reject</button>
                            </form>
                        </td>
                    </tr>";
                }
            }
        } else {
            echo "<tr><td colspan='8'>No Proposals found or invalid response.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
