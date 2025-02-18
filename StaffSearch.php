<?php
function searchStaff($searchTerm) {
    $url = 'http://localhost:5268/api/Staff/SearchStaff?query=' . urlencode($searchTerm);
    
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
<div style=" justify-content: center; align-items: center; width: 30%; margin: 0 auto;">
    <input type="text" name="search" placeholder="Search Suppliers ID / Name Or Email" required>
    <button type="submit" style="padding: 10px 20px;">Search</button>
</div>
    <link rel="stylesheet" href="styles.css"> 
</form>

<table class="sTable">
    <tr>
    <th>Staff ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Job Role</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Password</th>
    
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
                foreach ($pharmacyData['data'] as $staff) {
                    echo "<tr>
                            <td>{$staff['stafF_ID']}</td>
                            <td>{$staff['firstname']}</td>
                            <td>{$staff['lastname']}</td>
                            <td>{$staff['email']}</td>
                            <td>{$staff['joB_ROLE']}</td>
                            <td>{$staff['address']}</td>
                            <td>{$staff['phonE_NUMBER']}</td>
                            <td>{$staff['password']}</td>
                            
                        </tr>";


                }
            }
        }
        ?>
    </tbody>
</table>
