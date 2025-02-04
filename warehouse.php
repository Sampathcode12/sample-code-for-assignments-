<?php
// API Base URL (Replace with your actual .NET API URL)
$api_url = "http://localhost:5268/api/Drugs/GetAllDrugs"; 

// Function to send API requests
function callAPI($method, $url, $data = null) {
    $curl = curl_init();
    
    switch ($method) {
        case "POST":
        case "PUT":
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
            ));
            break;
        case "DELETE":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            break;
        default:
            break;
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    curl_close($curl);

    return json_decode($response, true);
}

// Handle form actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_drug'])) {
        $data = [
            // "DRUG_ID" => $_POST['ID'],
            "DRUG_NAME" => $_POST['name'],
            "DRUG_TYPE" => $_POST['type'],
            "DRUG_COMPANY" => $_POST['company'],
            "DRUG_PRICE" => $_POST['price'],
            "DRUG_QUANTITY" => $_POST['quantity'],
            "DRUG_EXPIRY" => $_POST['expiry']
        ];
        callAPI("POST", "$api_url/add", $data);
    }

    if (isset($_POST['update_drug'])) {
        $data = [
            // "DRUG_ID" => $_POST['ID'],
            "DRUG_NAME" => $_POST['name'],
            "DRUG_TYPE" => $_POST['type'],
            "DRUG_COMPANY" => $_POST['company'],
            "DRUG_PRICE" => $_POST['price'],
            "DRUG_QUANTITY" => $_POST['quantity'],
            "DRUG_EXPIRY" => $_POST['expiry']
        ];
        callAPI("PUT", "$api_url/update", $data);
    }

    if (isset($_POST['delete_drug'])) {
        $id = $_POST['ID'];
        callAPI("DELETE", "$api_url/delete/$id");
    }
}

// Fetch all drugs
$drugs = callAPI("GET", "$api_url/all");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drug Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <section>
        <h2>Add / Update Drug</h2>
        <form method="post">
            <!-- <label for="ID">Drug ID</label>
            <input type="text" name="ID" id="ID" required> -->

            <label for="name">Drug Name</label>
            <input type="text" name="name" id="name" required>

            <label for="type">Drug Type</label>
            <input type="text" name="type" id="type" required>

            <label for="company">Drug Company</label>
            <input type="text" name="company" id="company" required>

            <label for="price">Price</label>
            <input type="text" name="price" id="price" required>

            <label for="quantity">Quantity</label>
            <input type="text" name="quantity" id="quantity" required>

            <label for="expiry">Expiry Date</label>
            <input type="date" name="expiry" id="expiry" required>

            <button type="submit" name="add_drug">Add Drug</button>
            <button type="submit" name="update_drug">Update Drug</button>
        </form>
    </section>

    <section>
        <h2>Delete Drug</h2>
        <form method="post">
            <label for="ID">Drug ID</label>
            <input type="text" name="ID" id="ID" required>
            <button type="submit" name="delete_drug">Delete Drug</button>
        </form>
    </section>

    <section>
        <h2>All Drugs</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Company</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Expiry</th>
            </tr>
            <?php foreach ($drugs as $drug) { ?>
                <tr>
                    <td><?php echo $drug['DRUG_ID']; ?></td>
                    <td><?php echo $drug['DRUG_NAME']; ?></td>
                    <td><?php echo $drug['DRUG_TYPE']; ?></td>
                    <td><?php echo $drug['DRUG_COMPANY']; ?></td>
                    <td><?php echo $drug['DRUG_PRICE']; ?></td>
                    <td><?php echo $drug['DRUG_QUANTITY']; ?></td>
                    <td><?php echo $drug['DRUG_EXPIRY']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </section>

</body>
</html>
