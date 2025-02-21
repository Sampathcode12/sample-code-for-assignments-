<?php
header('Content-Type: application/json'); // Ensure response is JSON

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['aplicationID'])) {

    // Sanitize and validate the application ID
    $application_id = filter_var($_POST['aplicationID'], FILTER_VALIDATE_INT);

    // Check if the application ID is valid
    if ($application_id === false) {
        echo json_encode(["status" => 400, "message" => "Invalid application ID."]);
        exit;
    }

    // API endpoint for rejecting the tender application
    $url = "http://localhost:5268/api/TenderAply/RejectTenderApplication/$application_id";
    $data = ['applicationId' => $application_id];
    $payload = json_encode($data);

    // Initialize cURL session
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    // Execute cURL and capture the response
    $result = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_error = curl_error($ch); // Capture cURL error
    curl_close($ch);

    // Check if cURL resulted in an error
    if ($curl_error) {
        echo json_encode(["status" => 500, "message" => "CURL Error: " . $curl_error]);
        exit;
    }

    // Check the HTTP response code
    if ($http_code !== 200 || !$result) {
        echo json_encode(["status" => $http_code, "message" => "Failed to reject tender.", "response" => $result]);
    } else {
        // Successful rejection message
        echo json_encode(["status" => 200, "message" => "Tender successfully rejected."]);
    }
} else {
    echo json_encode(["status" => 400, "message" => "Invalid request."]);
}
?>
