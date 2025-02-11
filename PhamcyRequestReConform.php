<?php
header('Content-Type: application/json'); // Ensure response is JSON

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['applicationId'])) {

    echo
    $application_id = filter_var($_POST['applicationId'], FILTER_VALIDATE_INT); // Validate integer input

    if ($application_id === false) {
        echo json_encode(["status" => 400, "message" => "Invalid application ID."]);
        exit;
    }

    $url = "http://localhost:5268/api/PhamacyRequst/ConfirmPharmacyStockRequest/$application_id";
    $data = ['applicationId' => $application_id];
    $payload = json_encode($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    $result = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_error = curl_error($ch); // Capture CURL error
    curl_close($ch);

    if ($curl_error) {
        echo json_encode(["status" => 500, "message" => "CURL Error: " . $curl_error]);
        exit;
    }

    if ($http_code !== 200 || !$result) {
        echo json_encode(["status" => $http_code, "message" => "Failed to confirm tender.", "response" => $result]);
    } else {
        echo $result;
    }
} else {
    echo json_encode(["status" => 400, "message" => "Invalid request."]);
}
?>
