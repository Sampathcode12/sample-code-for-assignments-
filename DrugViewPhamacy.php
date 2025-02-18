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
         
            <th>Price </th>
            <th>Company</th>
            <th>Availability</th>
        </tr>
        <tbody>
            <?php
            include 'fetch_Data.php';  
            $drugsData = fetchDrugsData();
            
            if (isset($drugsData['data'])) {
                foreach ($drugsData['data'] as $drug) {
                    $originalPrice = $drug['druG_PRICE'];  // Original Price
                    $newPrice = round($originalPrice * 1.10, 2); 
                    $availability = ($drug['druG_QUANTITY'] > 0) ? "Available" : "Not Available";// Adding 10%

                    echo "<tr>
                         <td>{$drug['druG_ID']}</td>
                            <td>{$drug['druG_NAME']}</td>
                            <td>{$drug['druG_TYPE']}</td>
                           
                            <td>RS:{$newPrice}</td>
                            <td>{$drug['druG_COMPANY']}</td>
                             <td>{$availability}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No drugs found or invalid response.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
