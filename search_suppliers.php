<?php
function searchSupplier($searchTerm) {
    $url = 'http://localhost:5268/api/Supplier/SearchSupplier?query=' . urlencode($searchTerm);
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $result = curl_exec($ch);
    
    if (curl_errno($ch)) {
        return ['error' => 'Error: ' . curl_error($ch)];
    }
    
    $response = json_decode($result, true);
    
    if ($response && is_array($response)) {
        return ['data' => $response];
    } else {
        return ['error' => 'No suppliers found or invalid response.'];
    }
    
    curl_close($ch);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff List</title>
    <link rel="stylesheet" href="styles.css">  <!-- External CSS File -->
</head>
<form method="GET">
    <input type="text" name="search" placeholder="Search Suppliers" required>
    <button type="submit">Search</button>
</form>

<table class="sTable">
    <tr>
        <th>Supplier ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>password</th>
        <th>supplied item</th>
        <th>Address</th>
    </tr>
    <tbody>
        <?php
        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $supplierData = searchSupplier($searchTerm);

            if (isset($supplierData['data'])) {
                foreach ($supplierData['data'] as $supplier) {
                    echo "<tr>
                            <td>{$supplier['suP_ID']}</td>
                            <td>{$supplier['name']}</td>
                            <td>{$supplier['email']}</td>
                            <td>{$supplier['password']}</td>
                            <td>{$supplier['supplieditem']}</td>
                             <td>{$supplier['address']}</td>
                          </tr>";
                }



                
            } else {
                echo "<tr><td colspan='5'>No suppliers found or invalid response.</td></tr>";
            }
        }
        ?>
    </tbody>
</table>
</html>
