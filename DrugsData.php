<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drugs List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Drugs List</h2>

    <table class="sTable">
        <tr>
            <th>Drug ID</th>
            <th>Drug Name</th>
            <th>Type</th>
            <th>Company</th>
            <th>Expiry Date</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        <tbody>
            <?php
            include 'fetch_drugs.php';  
       // Ensure you include the PHP file with the fetchDrugsData function
            $drugsData = fetchDrugsData();  // Fetch drugs data from the API
            
            // Check if the data is available
            if (isset($drugsData['data'])) {
                // Loop through each drug and display them in the table
                foreach ($drugsData['data'] as $drug) {
                    echo "<tr>
                           <td>{$drug['DRUG_ID']}</td>
                            <td>{$drug['DRUG_NAME']}</td>
                            <td>{$drug['DRUG_TYPE']}</td>
                            <td>{$drug['DRUG_COMPANY']}</td>
                            <td>" . date('Y-m-d', strtotime($drug['DRUG_EXPIRY'])) . "</td>
                            <td>{$drug['DRUG_QUANTITY']}</td>
                            <td>{$drug['DRUG_PRICE']}</td>

                          </tr>";
                }
            } else {
                // If no data is found or the response is invalid, show an error message
                echo "<tr><td colspan='7'>No drugs found or invalid response.</td></tr>";
            }
            ?>
        </tbody>
    </table>



</body>
</html>


                  

                        