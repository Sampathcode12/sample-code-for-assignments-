<?php
function searchStaff($searchTerm) {
    $url = 'http://localhost:5268/api/TenderAply/SearchTenderProposal?query=' . urlencode($searchTerm);
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $result = curl_exec($ch);
    
    if (curl_errno($ch)) {
        return ['error' => 'Error: ' . curl_error($ch)];
    }
    
    $response = json_decode($result, true);
    
    curl_close($ch);

    if ($response && is_array($response) && !empty($response)) {
        return ['data' => $response];
    } else {
        return ['error' => 'No pharmacies found for the given search term.'];
    }
}
?>
<form method="GET">
    <input type="text" name="search" placeholder="Search Staff ID / Name Or Email" required>
    <button type="submit">Search</button>
    <link rel="stylesheet" href="styles.css"> 
</form>

<table class="sTable">
    <tr>
    <th>Application ID </th>
    <th>Supplier Name</th>
        <th>Email</th>
        <th>Tender Ref</th>
        <th>Proposal Text</th>
        <th>Offered Price</th>
        <!-- <th>Applied At</th> -->
    
    </tr>
    <tbody>
        <?php
        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $pharmacyData = searchStaff($searchTerm);

            // Check if 'error' exists in the response and show the error message
            if (isset($pharmacyData['error'])) {
                echo "<tr><td colspan='8' class='error-msg'>{$pharmacyData['error']}</td></tr>";
            } elseif (isset($pharmacyData['data'])) {
                foreach ($pharmacyData['data'] as $proposal) {
                    echo "<tr>
                            <td>{$proposal['aplicationID']}</td>
                          <td>{$proposal['supplierName']}</td>
                              <td>{$proposal['supplierEmail']}</td>
                            <td>{$proposal['tenderRef']}</td>
                               <td>{$proposal['proposalText']}</td>
                            <td>{$proposal['offeredPrice']}</td>
                        
                         
                         
                            
                        </tr>";

                       
                }
            }
        }
        ?>
    </tbody>
</table>
