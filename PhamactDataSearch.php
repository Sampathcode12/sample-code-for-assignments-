<?php
function searchPharmacy($searchTerm) {
    $url = 'http://localhost:5268/api/PamacyController1/SearchPharmacy?query=' . urlencode($searchTerm);
    
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
    <input type="text" name="search" placeholder="Search Pharmacy ID / Name Or Email" required>
    <button type="submit">Search</button>
    <link rel="stylesheet" href="styles.css"> 
</form>

<table class="sTable">
    <tr>
        <th>Pharmacy ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Registration Number</th>
        <th>License</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Password</th>
    
    </tr>
    <tbody>
        <?php
        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $pharmacyData = searchPharmacy($searchTerm);

            // Check if 'error' exists in the response and show the error message
            if (isset($pharmacyData['error'])) {
                echo "<tr><td colspan='8' class='error-msg'>{$pharmacyData['error']}</td></tr>";
            } elseif (isset($pharmacyData['data'])) {
                foreach ($pharmacyData['data'] as $pharmacy) {
                    echo "<tr>
                            <td>{$pharmacy['id']}</td>
                            <td>{$pharmacy['pharmacyName']}</td>
                            <td>{$pharmacy['email']}</td>
                            <td>{$pharmacy['regNo']}</td>
                            <td>{$pharmacy['license']}</td>
                            <td>{$pharmacy['address']}</td>
                            <td>{$pharmacy['phone']}</td>
                            <td>{$pharmacy['password']}</td>
                            
                        </tr>";


                }
            }
        }
        ?>
    </tbody>
</table>
