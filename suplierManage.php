<?php
function searchSupplier($searchTerm) {
    $url = 'http://localhost:5268/api/Supplier/SearchSupplier?query=' . urlencode($searchTerm);
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $result = curl_exec($ch);
    
    if (curl_errno($ch)) {
        $error = 'Error: ' . curl_error($ch);
        curl_close($ch);
        return ['error' => $error];
    }

    curl_close($ch);
    $response = json_decode($result, true);

    return $response && is_array($response) ? ['data' => $response] : ['error' => 'No suppliers found or invalid response.'];
}

function deleteSupplier($supplierId) {
    $url = 'http://localhost:5268/api/Supplier/DeleteSupplier/' . $supplierId;
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $result = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($result, true);
}

function updateSupplier($supplierId, $data) {
    $url = 'http://localhost:5268/api/Supplier/UpdateSupplier/' . $supplierId;
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $result = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($result, true);
}
?>

<form method="GET">
    <input type="text" name="search" placeholder="Search Suppliers" required>
    <button type="submit">Search</button>
</form>

<table class="sTable">
    <tr>
        <th>Supplier ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Supplied Item</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>
    <tbody>
        <?php
        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $supplierData = searchSupplier($searchTerm);

            if (isset($supplierData['data'])) {
                foreach ($supplierData['data'] as $supplier) {
                    $supplierId = htmlspecialchars($supplier['suP_ID']); // Ensure correct key
                    echo "<tr>
                            <td>{$supplierId}</td>
                            <td>" . htmlspecialchars($supplier['name']) . "</td>
                            <td>" . htmlspecialchars($supplier['email']) . "</td>
                            <td>" . htmlspecialchars($supplier['password']) . "</td>
                            <td>" . htmlspecialchars($supplier['supplieditem']) . "</td>
                            <td>" . htmlspecialchars($supplier['address']) . "</td>
                            <td>
                                <form method='POST' action='' onsubmit='return confirm(\"Are you sure?\");'>
                                    <input type='hidden' name='deleteSupplier' value='{$supplierId}'>
                                    <button type='submit'>Delete</button>
                                </form>
                             <td>
    <form method='POST' action='update_supplier.php'>
        <input type='hidden' name='supplierId' value='<?= $supplierId ?>'>
        <button type='submit'>Update</button>
    </form>
</td>
                   
                 
                 
                 
                            </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No suppliers found or invalid response.</td></tr>";
            }
        }

        // Handle deletion request
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteSupplier'])) {
            $deleteResponse = deleteSupplier($_POST['deleteSupplier']);
            echo "<script>alert('".($deleteResponse ? "Supplier deleted successfully" : "Error deleting supplier")."'); window.location.href='search_suppliers.php';</script>";
        }
        ?>
    </tbody>
</table>
