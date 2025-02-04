<?php
function fetchDrugsData() {
    $url = 'http://localhost:5268/api/Drugs/GetAllDrugs';  

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $result = curl_exec($ch);
    curl_close($ch);

    if (!$result) {
        return ['error' => 'Failed to fetch data from API.'];
    }

    $response = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return ['error' => 'Invalid JSON response from API.'];
    }

    return ['data' => $response];
}



function fetchStaffData() {
    $url = 'http://localhost:5268/api/Staff/GettAllStaff';  

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $result = curl_exec($ch);
    curl_close($ch);

    if (!$result) {
        return ['error' => 'Failed to fetch data from API.'];
    }

    $response = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return ['error' => 'Invalid JSON response from API.'];
    }

    return ['data' => $response];
}



function fetchSuppliersData() {
    $url = 'http://localhost:5268/api/Supplier/GetAllSuplier';  

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $result = curl_exec($ch);
    curl_close($ch);

    if (!$result) {
        return ['error' => 'Failed to fetch data from API.'];
    }

    $response = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return ['error' => 'Invalid JSON response from API.'];
    }

    return ['data' => $response];
}

?>


