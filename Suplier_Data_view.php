<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier List</title>
    <link rel="stylesheet" href="styles.css">  <!-- External CSS File -->
</head>
<body>

<header>
        <h2>Supplier List</h2>
    </header>

    <table class="sTable">
        <thead>
            <tr>
            <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Supplied Item</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'fetch_Data.php'; // Include PHP file with API call function
            $suppliersData = fetchSuppliersData();

            if (isset($suppliersData['data'])) {
                foreach ($suppliersData['data'] as $supplier) {
                    echo "<tr>
                        <td>{$supplier['suP_ID']}</td>
                            <td>{$supplier['name']}</td>
                            <td>{$supplier['email']}</td>
                            <td>{$supplier['supplieditem']}</td>
                         
                            <td>{$supplier['address']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No suppliers found or invalid response.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
