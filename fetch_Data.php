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
    $url = 'http://localhost:5268/api/Supplier/GetAllSuppliers'; // Update with your actual API URL

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

function fetchTenderData() {
    $url = 'http://localhost:5268/api/Tender/GetAllTenders';  

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

function fetchTenderApplyData() {
    $url = 'http://localhost:5268/api/TenderAply/GetAllTenderProposal'; 

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


