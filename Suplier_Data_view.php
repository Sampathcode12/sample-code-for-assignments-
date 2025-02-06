

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Search</title>
    <link rel="stylesheet" href="styles.css">  <!-- Link to external CSS -->
</head>
<body>

    <h2> Supplier data vew</h2>

  
  
    <table class="sTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Licen Number</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include 'fetch_Data.php'; // Include PHP file with API call function
            $SuplierData = fetchSuppliersData();

            if (isset($SuplierData['data'])) {
                foreach ($SuplierData['data'] as $Suplier) {
                    echo "<tr>
                        <td>{$Suplier['suP_ID']}</td>
                        <td>{$Suplier['name']}</td>
                        <td>{$Suplier['email']}</td>
                        <td>{$Suplier['password']}</td>                         
                        <td>{$Suplier['licen_Number']}</td>
                         <td>{$Suplier['phone_Number']}</td>
                        <td>{$Suplier['address']}</td>
                      </tr>";


                  
                  
                
                }


            } else {
                echo "<tr><td colspan='6'>No suppliers found or invalid response.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
