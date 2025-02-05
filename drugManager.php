<?php

class DrugManager {

    // Function to update a drug by search term (ID or Name)
    public function updateDrug($searchTerm, $updatedDrug) {
        $url = 'http://localhost:5268/api/Drugs/UpdateDrugs?search=' . urlencode($searchTerm);

        // Prepare data to send (drug details)
        $data = json_encode($updatedDrug); // The updated drug data should be an array or object

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Using PUT for update
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // Send updated drug data

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            return ['error' => 'Error: ' . curl_error($ch)];
        }

        curl_close($ch);

        // Handle the API response
        $response = json_decode($result, true);
        return $response;
    }

    // Function to delete a drug by search term (ID or Name)
    public function deleteDrug($searchTerm) {
        $url = 'http://localhost:5268/api/Drugs/DeleteDrugs?search=' . urlencode($searchTerm);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); // Using DELETE for deleting the drug

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            return ['error' => 'Error: ' . curl_error($ch)];
        }

        curl_close($ch);

        // Handle the API response
        $response = json_decode($result, true);
        return $response;
    }

    // Function to search and display drug details
    public function searchDrug($searchTerm) {
        $url = 'http://localhost:5268/api/Drugs/GetDrugBySearch?search=' . urlencode($searchTerm);

        // Initialize cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        // Execute the request
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            return ['error' => 'Error: ' . curl_error($ch)];
        }

        curl_close($ch);

        // Decode JSON response
        $response = json_decode($result, true);

        // Check if we got the drug data
        if (isset($response['error'])) {
            return $response; // Error message from API
        }

        return $response; // Return drug data from API
    }

    // Display the form for searching, updating, and deleting drugs
    public function displayForm() {
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Drug Update/Delete</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>

        <!-- Form for Searching Drug -->
        <form method="GET" action="">
            <label for="search">Search Drug by ID or Name:</label>
            <input type="text" id="search" name="search" required>
            <button type="submit">Search</button>
        </form>';

        // Check if search term is provided
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $searchTerm = $_GET['search'];
            echo "<p>Searching for: " . htmlspecialchars($searchTerm) . "</p>";

            // Fetch the drug data from the API
            $drugData = $this->searchDrug($searchTerm);

            if (isset($drugData['error'])) {
                // Display error message if no drug found or an issue occurs
                echo "<p>Error: " . htmlspecialchars($drugData['error']) . "</p>";
            } else {
                // Display drug details in form fields for updating
                echo "
                <h3>Update Drug</h3>
                <form method='POST'>
                    <input type='hidden' name='action' value='Update'>
                    <input type='hidden' name='searchTerm' value='" . htmlspecialchars($searchTerm) . "'>

                    <label for='drug_name'>Drug Name:</label><br>
                    <input type='text' name='drug_name' value='" . htmlspecialchars($drugData['drug_name'] ?? '') . "' required><br>
                    <label for='drug_type'>Drug Type:</label><br>
                    <input type='text' name='drug_type' value='" . htmlspecialchars($drugData['drug_type'] ?? '') . "' required><br>
                    <label for='drug_company'>Drug Company:</label><br>
                    <input type='text' name='drug_company' value='" . htmlspecialchars($drugData['drug_company'] ?? '') . "' required><br>
                    <label for='drug_expiry'>Drug Expiry:</label><br>
                    <input type='date' name='drug_expiry' value='" . htmlspecialchars($drugData['drug_expiry'] ?? '') . "' required><br>
                    <label for='drug_quantity'>Drug Quantity:</label><br>
                    <input type='number' name='drug_quantity' value='" . htmlspecialchars($drugData['drug_quantity'] ?? '') . "' required><br>
                    <label for='drug_price'>Drug Price:</label><br>
                    <input type='number' step='0.01' name='drug_price' value='" . htmlspecialchars($drugData['drug_price'] ?? '') . "' required><br>
                    <button type='submit'>Update Drug</button>
                </form>

                <h3>Delete Drug</h3>
                <form method='POST'>
                    <input type='hidden' name='action' value='Delete'>
                    <input type='hidden' name='searchTerm' value='" . htmlspecialchars($searchTerm) . "'>
                    <button type='submit'>Delete Drug</button>
                </form>";
            }

            // Handle the form submission for actions (Update or Delete)
            if (isset($_POST['action'])) {
                $action = $_POST['action'];
                $searchTerm = $_POST['searchTerm'];

                if ($action == 'Update') {
                    $updatedDrug = [
                        'DRUG_NAME' => $_POST['drug_name'],
                        'DRUG_TYPE' => $_POST['drug_type'],
                        'DRUG_COMPANY' => $_POST['drug_company'],
                        'DRUG_EXPIRY' => $_POST['drug_expiry'],
                        'DRUG_QUANTITY' => $_POST['drug_quantity'],
                        'DRUG_PRICE' => $_POST['drug_price']
                    ];

                    $response = $this->updateDrug($searchTerm, $updatedDrug);
                    echo "<p>{$response['StatusMessage']}</p>";
                } elseif ($action == 'Delete') {
                    $response = $this->deleteDrug($searchTerm);
                    echo "<p>{$response['StatusMessage']}</p>";
                }
            }
        }

        echo '</body></html>';
    }
}

// Instantiate the DrugManager class and display the form
$drugManager = new DrugManager();
$drugManager->displayForm();

?>


