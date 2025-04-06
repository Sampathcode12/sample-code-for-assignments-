<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drugs List</title>
    <link rel="stylesheet" href="styles.css">  <!-- External CSS File -->
    <style>
        .drug-images {
            display: flex;
            gap: 5px;
        }
        .drug-images img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<header>
    <h2>Drugs List</h2>
</header>

<table class="sTable">
    <thead>
        <tr>
            <th>Drug ID</th>
            <th>Drug Name</th>
            <th>Type</th>
            <th>Price</th>
            <th>Company</th>
            <th>Availability</th>
            <th>Images</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'fetch_Data.php';  
        $drugsData = fetchDrugsData();
        
        if (isset($drugsData['data'])) {
            foreach ($drugsData['data'] as $drug) {
                $originalPrice = $drug['druG_PRICE'];
                $newPrice = round($originalPrice * 1.10, 2); 
                $availability = ($drug['druG_QUANTITY'] > 0) ? "Available" : "Not Available";

                echo "<tr>
                        <td>{$drug['druG_ID']}</td>
                        <td>{$drug['druG_NAME']}</td>
                        <td>{$drug['druG_TYPE']}</td>
                        <td>RS:{$newPrice}</td>
                        <td>{$drug['druG_COMPANY']}</td>
                        <td>{$availability}</td>
                        <td>";

                // Show images (if any)
                if (isset($drug['imagePaths']) && is_array($drug['imagePaths']) && count($drug['imagePaths']) > 0) {
                    echo "<div class='drug-images'>";
                    foreach ($drug['imagePaths'] as $imagePath) {
                        echo "<img src='{$imagePath}' alt='Drug Image'>";
                    }
                    echo "</div>";
                } else {
                    echo "No images";
                }

                echo "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No drugs found or invalid response.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
