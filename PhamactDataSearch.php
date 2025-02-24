<?php
function searchPharmacy($searchTerm) {
    $url = 'http://localhost:5268/api/PamacyController1/SearchPharmacy?query=' . urlencode($searchTerm);
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $result = curl_exec($ch);
 
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);
    
    if (curl_errno($ch)) {
        return ['error' => 'Error: ' . curl_error($ch)];
    }
    
    $response = json_decode($result, true);
    
    curl_close($ch);

    if ($response && is_array($response) && !empty($response)) {
        return ['data' => $response];
    } elseif ($httpCode == 404) {
        return ['error' => 'No pharmacies found for the given search term.'];
    } else {
        return ['error' => 'Unexpected API response. Please check the API or try again later.'];
    }
}
?>
<form method="GET">
<div style=" justify-content: center; align-items: center; width: 30%; margin: 0 auto;">
    <input type="text" name="search" placeholder="Search Phamacy ID / Name Or Email" required>
    <button type="submit" style="padding: 10px 20px;">Search</button>
</div>
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
                        <td>" . htmlspecialchars($pharmacy['id'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($pharmacy['pharmacyName'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($pharmacy['email'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($pharmacy['regNo'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($pharmacy['license'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($pharmacy['address'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($pharmacy['phone'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($pharmacy['password'] ?? 'N/A') . "</td>
                    </tr>";


                }
            }
        }
        ?>
    </tbody>
</table>
