<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff List</title>
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
    <h2>Staff List</h2>

    <table class="sTable">
        <thead>
            <tr>
                <th>STAFF_ID</th>
                <th>FIRSTNAME</th>
                <th>LASTNAME</th>
                <th>EMAIL</th>
                <th>PASSWORD</th>
                <th>ADDRESS</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'fetch_drugs.php'; // PHP file to fetch supplier data
            $suppliersData = fetchStaffData();  
            
            if (!empty($suppliersData)) {
                foreach ($suppliersData as $supplier) {
                    echo "<tr>
                            <td>" . htmlspecialchars($supplier['STAFF_ID']) . "</td>
                            <td>" . htmlspecialchars($supplier['FIRSTNAME']) . "</td>
                            <td>" . htmlspecialchars($supplier['LASTNAME']) . "</td>
                            <td>" . htmlspecialchars($supplier['EMAIL']) . "</td>
                            <td>" . htmlspecialchars($supplier['PASSWORD']) . "</td>
                            <td>" . htmlspecialchars($supplier['ADDRESS']) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No suppliers found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>