<?php
function searchSupplier($searchTerm) {
    $url = 'http://localhost:5268/api/Supplier/SearchSupplier?query=' . urlencode($searchTerm);
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Set timeout to avoid long waiting times

    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
        $error = 'Error: ' . curl_error($ch);
        curl_close($ch);
        return ['error' => $error]; // Return cURL error
    }

    curl_close($ch);
    $response = json_decode($result, true);

    // Handle different response cases
    if ($httpCode !== 200) {
        return ['error' => "API request failed with status code: $httpCode"];
    }

    if (!$response || !is_array($response) || empty($response)) {
        return ['error' => 'No suppliers found for the given search term.'];
    }

    return ['data' => $response];
}
?>



<table class="sTable">
    <tr>
        <th>Supplier ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Supplied Item</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>
    <tbody>
        <?php
        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $supplierData = searchSupplier($searchTerm);

            // Check if 'error' exists in the response and show the error message
            if (isset($supplierData['error'])) {
                echo "<tr><td colspan='7' class='error-msg'>{$supplierData['error']}</td></tr>";
            } elseif (isset($supplierData['data'])) {
                foreach ($supplierData['data'] as $Suplier) {
                    echo "<tr>
                           <td>{$Suplier['suP_ID']}</td>
                        <td>{$Suplier['name']}</td>
                        <td>{$Suplier['email']}</td>
                        <td>{$Suplier['password']}</td>                         
                        <td>{$Suplier['licen_Number']}</td>
                         <td>{$Suplier['phone_Number']}</td>
                        <td>{$Suplier['address']}</td>
                     
                          </tr>";
                }
            }
        }
        ?>
    </tbody>
</table>
<form method="GET">
<div style=" justify-content: center; align-items: center; width: 30%; margin: 0 auto;">
    <input type="text" name="search" placeholder="Search Suppliers ID / Name Or Email" required>
    <button type="submit" style="padding: 10px 20px;">Search</button>
</div>

    <link rel="stylesheet" href="styles.css"> 
</form>


<!-- <td>
                                <form method='POST' action='search_suppliers.php' style='display:inline;' onsubmit='return confirm(\"Are you sure?\");'>
                                    <input type='hidden' name='supplierId' value='{$Suplier['suP_ID']}'>
                                    <button type='submit'>Delete</button>
                                </form>
                            </td> -->