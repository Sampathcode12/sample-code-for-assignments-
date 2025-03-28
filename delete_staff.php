<?php
// Delete staff member based on ID passed via GET request
if (isset($_GET['id'])) {
    $staffID = $_GET['id'];

    // Call your delete function here (assuming it's a REST API call)
    $url = "http://localhost:5268/api/Staff/DeleteStaff/" . urlencode($staffID);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200) {
        // Successful deletion
        header('Location: Staff_data_view.php?status=success');
        exit();
    } else {
        // Error in deletion
        header('Location: Staff_data_view.php?status=error');
        exit();
    }
} else {
    // If no staff ID is passed
    header('Location: Staff_data_view.php?status=error');
    exit();
}
?>
