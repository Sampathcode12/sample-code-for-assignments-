<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff List</title>
    <link rel="stylesheet" href="styles.css">  <!-- External CSS File -->
</head>
<body>

<header>
        <h2>Staff List</h2>
    </header>
  
  

    <table class="sTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'fetch_drugs.php'; // Include PHP file with API call function
            $StaffData = fetchStaffData();

            if (isset($StaffData['data'])) {
                foreach ($StaffData['data'] as $Staff) {
                    echo "<tr>
                        <td>{$Staff['stafF_ID']}</td>
                        <td>{$Staff['firstname']}</td>
                        <td>{$Staff['lastname']}</td>
                        <td>{$Staff['email']}</td>                         
                        <td>{$Staff['address']}</td>
                        <td>{$Staff['password']}</td>
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
