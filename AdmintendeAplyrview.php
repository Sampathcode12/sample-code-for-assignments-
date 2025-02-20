<?php
include 'fetch_Data.php';
$TenderAplyData = fetchTenderApplyData();
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
    <h2>Tender Request List</h2>
</header>

<table class="sTable">
    <thead>
        <tr>
            <th>Application ID</th>
            <th>Supplier Name</th>
            <th>RF Number</th>
            <th>Offer Price</th>
            <th>Supplier Email</th>
            <th>Proposal</th>
            <th>Request Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($TenderAplyData['data']) && is_array($TenderAplyData['data'])) {
            foreach ($TenderAplyData['data'] as $TenderApplication) {
                if (is_array($TenderApplication)) {
                    $appId = htmlspecialchars($TenderApplication['aplicationID'] ?? 'N/A');
                    echo "<tr>
                        <td>{$appId}</td>
                        <td>" . htmlspecialchars($TenderApplication['supplierName'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($TenderApplication['tenderRef'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($TenderApplication['offeredPrice'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($TenderApplication['supplierEmail'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($TenderApplication['proposalText'] ?? 'N/A') . "</td>   
                        <td>" . htmlspecialchars($TenderApplication['date'] ?? 'N/A') . "</td>   
                        <td>
                            <form action='confirm_tender.php' method='POST' style='display:inline-block;'>
                                <input type='hidden' name='aplicationID' value='{$appId}'>
                                <input type='hidden' name='action' value='confirm'>
                                <button type='submit'>Confirm</button>
                            </form>
                            <form action='reject_tender.php' method='POST' style='display:inline-block;'>
                                <input type='hidden' name='aplicationID' value='{$appId}'>
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
