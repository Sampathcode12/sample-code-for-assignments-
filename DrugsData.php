<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drugs List</title>
    <link rel="stylesheet" href="styles.css">  <!-- External CSS File -->
</head>
<body>

    <header>
        <h2>Drugs List</h2>
    </header>

    <table class="sTable">
        <tr>
            <th>Drug ID</th>
            <th>Drug Name</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Company</th>
            <th>Expiry Date</th>
        </tr>
        <tbody>
            <?php
            include 'fetch_Data.php';  
            $drugsData = fetchDrugsData();
            
            if (isset($drugsData['data'])) {
                foreach ($drugsData['data'] as $drug) {
                    echo "<tr>
                            <td>{$drug['druG_ID']}</td>
                            <td>{$drug['druG_NAME']}</td>
                            <td>{$drug['druG_TYPE']}</td>
                            <td>{$drug['druG_QUANTITY']}</td>
                            <td>\${$drug['druG_PRICE']}</td>
                            <td>{$drug['druG_COMPANY']}</td>
                            <td>" . date('Y-m-d', strtotime($drug['druG_EXPIRY'])) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No drugs found or invalid response.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
