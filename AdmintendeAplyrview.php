<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tender List</title>
    <link rel="stylesheet" href="styles.css">  <!-- External CSS File -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery for AJAX -->
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
        include 'fetch_Data.php';
        $TenderAplyData = fetchTenderApplyData();

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
                            <button onclick='confirmTender({$appId})'>Confirm</button>
                            <button onclick='rejectTender({$appId})'>Reject</button>
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

<!-- JavaScript for AJAX Requests -->
<script>
function confirmTender(applicationId) {
    $.ajax({
        type: "POST",
        url: "confirm_tender.php",
        data: { aplicationID: applicationId },
        dataType: "json",
        success: function(response) {
            if (response.status === 200) {
                alert(response.message); // Show success notification
                location.reload(); // Refresh page
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function() {
            alert("An error occurred while confirming the tender.");
        }
    });
}

function rejectTender(applicationId) {
    $.ajax({
        type: "POST",
        url: "reject_tender.php",
        data: { aplicationID: applicationId },
        dataType: "json",
        success: function(response) {
            if (response.status === 200) {
                alert(response.message); // Show success notification
                location.reload(); // Refresh page
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function() {
            alert("An error occurred while rejecting the tender.");
        }
    });
}
</script>

</body>
</html>
