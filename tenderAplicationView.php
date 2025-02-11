
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
            <th>Aplication Id</th>
                <th>Suplier Name</th>
                <th>RF Number</th>
                <th>Offer Price</th>
                <th>Suplier Email</th>
                <th>Proposal</th>
                <th>Requcet Date</th>
                
        
            </tr>
        </thead>
        <tbody>
            <?php
            include 'fetch_Data.php'; // Include PHP file with API call function
            $TenderAplyData = fetchTenderApplyData();

            if (isset($TenderAplyData['data'])) {
                foreach ($TenderAplyData['data'] as $TenderAplication) {
                    echo "<tr>
                        <td>{$TenderAplication['aplicationID']}</td>
                        <td>{$TenderAplication['supplierName']}</td>
                        <td>{$TenderAplication['tenderRef']}</td>
                        <td>{$TenderAplication['offeredPrice']}</td>
                        <td>{$TenderAplication['supplierEmail']}</td>
                        <td>{$TenderAplication['proposalText']}</td>   
                         <td>{$TenderAplication['date']}</td>   
              
                     
                      </tr>";

                  
                }
            } else {
                echo "<tr><td colspan='7'>No Proposal found or invalid response.</td></tr>";
            }
            ?>
        </tbody>
    </table>
<!-- 
    <button onclick="window.location.href='Apliy_Tender.php';">Apply</button> -->
    <button onclick="window.history.back();">Back</button>


</body>
</html>
