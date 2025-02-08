<?php
$message = "";
$statusColor = "red"; // Default error color

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = trim($_POST['searchTerm'] ?? '');

    if (!empty($searchTerm)) {
        $url = "http://localhost:5268/api/Tender/DeleteTender/" . urlencode($searchTerm);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Prevents hanging requests

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get HTTP status code
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            $message = "Failed to connect to API: $curlError";
        } else {
            $result = json_decode($response, true);

            if ($httpCode == 200 && isset($result['statusCode']) && $result['statusCode'] == 200) {
                $message = "Tender successfully deleted.";
                $statusColor = "green";
            } elseif ($httpCode == 404 || (isset($result['statusCode']) && $result['StatusCode'] == 404)) {
                $message = "No matching Tender found or already deleted.";
            } else {
                $message = "An error occurred: " . ($result['statusMessage'] ?? "Unknown error.");
            }
        }
    } else {
        $message = "Please enter a Tender RF ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Delete Drug</title>
</head>
<body>

    <header>
        <h2>Delete Drug</h2>
    </header>

    <section class="delete-section">
        <form method="post">
            <input type="text" name="searchTerm" placeholder="Enter Suplier ID " required>
            <button type="submit">Delete</button>
        </form>
        

        <?php if (!empty($message)) : ?>
            <p style="color: <?php echo htmlspecialchars($statusColor); ?>;">
                <?php echo htmlspecialchars($message); ?>
            </p>
        <?php endif; ?>

        <!-- Back Button -->
        <div class="btn-container">
            <button class="btn btn-back" onclick="history.back()">Back</button>
        </div>
    </section>

</body>
</html>
