<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tender List</title>
    <link rel="stylesheet" href="styles.css">  <!-- External CSS File -->
</head>
<body>

<header>
        <h2>Tender List</h2>
    </header>
  
  

    <table class="sTable">
        <thead>
            <tr>
                <th>Tender Title</th>
                <th> Tender Reference Number</th>
                <th>Description</th>
                <th>Deadline</th>
        
            </tr>
        </thead>
        <tbody>
            <?php
            include 'fetch_Data.php'; // Include PHP file with API call function
            $TenderData = fetchTenderData();

            if (isset($TenderData['data'])) {
                foreach ($TenderData['data'] as $Tender) {
                    echo "<tr>
                        <td>{$Tender['tender_title']}</td>
                        <td>{$Tender['rFnumber']}</td>
                        <td>{$Tender['description']}</td>
                        <td>{$Tender['deadline']}</td>                         
                         

                      </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No suppliers found or invalid response.</td></tr>";
            }
            ?>
        </tbody>
    </table>
<div width: 100%;>
    <button onclick="window.location.href='Apliy_Tender.php';">Apply</button>
    <button onclick="window.history.back();">Back</button>
    </div>

</body>
</html>
