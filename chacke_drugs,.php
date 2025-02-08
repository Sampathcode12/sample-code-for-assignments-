<?php
$errorMessage = "";
$drugs = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = trim($_POST['searchTerm'] ?? '');

    if (!empty($searchTerm)) {
        $url = "http://localhost:5268/api/Drugs/SearchDrugs?searchTerm=" . urlencode($searchTerm);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Set timeout to prevent hanging

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get HTTP status code
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            $errorMessage = "Failed to connect to API: " . htmlspecialchars($curlError);
        } else {
            $result = json_decode($response, true);

            if ($httpCode == 200 && !empty($result)) {
                $drugs = $result;
            } elseif ($httpCode == 400) {
                $errorMessage = "Invalid search parameter. Please enter a valid Drug ID or Type.";
            } elseif ($httpCode == 404 || empty($result)) {
                $errorMessage = "No matching drugs found.";
            } else {
                $errorMessage = "An error occurred: " . ($result['statusMessage'] ?? "Unknown error.");
            }
        }
    } else {
        $errorMessage = "Please enter a search term.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Search Drugs</title>
</head>
<body>

    <header>
        <h2>Search Drugs</h2>
    </header>

    <section class="search-section">
        <form method="post">
            <input type="text" name="searchTerm" placeholder="Enter Drug ID or Type" required>
            <button type="submit">Search</button>
            <button type="button" onclick="window.location.href='index.php';">Back</button> <!-- Back Button -->
        </form>
        
        <?php if (!empty($errorMessage)) : ?>
            <p style="color: red;"><?php echo htmlspecialchars($errorMessage); ?></p>
        <?php endif; ?>
    </section>

    <section class="result-section">
        <?php if (!empty($drugs)) : ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>Drug ID</th>
                        <th>Drug Name</th>
                        <th>Drug Type</th>
                        <th>Company</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Expiry Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($drugs as $drug) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($drug['druG_ID']); ?></td>
                            <td><?php echo htmlspecialchars($drug['druG_NAME']); ?></td>
                            <td><?php echo htmlspecialchars($drug['druG_TYPE']); ?></td>
                            <td><?php echo htmlspecialchars($drug['druG_COMPANY']); ?></td>
                            <td><?php echo htmlspecialchars($drug['druG_PRICE']); ?></td>
                            <td><?php echo htmlspecialchars($drug['druG_QUANTITY']); ?></td>
                            <td><?php echo htmlspecialchars($drug['druG_EXPIRY']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST" && empty($drugs)) : ?>
            <p>No matching drugs found.</p>
        <?php endif; ?>
    </section>

</body>
</html>
