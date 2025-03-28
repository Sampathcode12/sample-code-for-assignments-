<?php
session_start();
include 'fetch_Data.php'; // Include PHP file with API call function

// Get logged-in user's role
$jobRole = $_SESSION['joB_ROLE'] ?? '';

// Fetch staff data from API
$StaffData = fetchStaffData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff List</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        // Function to confirm deletion and trigger API call
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this staff member?")) {
                // Redirect to delete_staff.php with ID for deletion
                window.location.href = "delete_staff.php?id=" + id;
            }
            else if (confirm("Are you sure you want to Update this staff member?")) {
                // Redirect to delete_staff.php with ID for deletion
                window.location.href = "staff_update.php=" + id;
            }
        }

        // Function to print the staff list
        function printStaffList() {
            var printContents = document.getElementById('staffTable').outerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = "<h2>Staff List</h2>" + printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }

        // Function to preview profile image on file selection
        function previewImage(input) {
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('profilePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    </script>
</head>
<body>

<header>
    <h2>Staff List</h2>
</header>

<table class="sTable" id="staffTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Job Type</th>
            <th>Actions</th> <!-- Actions Column -->
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if staff data is available
        if (isset($StaffData['data']) && is_array($StaffData['data'])) {
            // Loop through the staff data and generate rows
            foreach ($StaffData['data'] as $Staff) {
                echo "<tr>
                    <td>" . htmlspecialchars($Staff['stafF_ID']) . "</td>
                    <td>" . htmlspecialchars($Staff['firstname']) . "</td>
                    <td>" . htmlspecialchars($Staff['lastname']) . "</td>
                    <td>" . htmlspecialchars($Staff['email']) . "</td>
                    <td>" . htmlspecialchars($Staff['address']) . "</td>
                    <td>" . htmlspecialchars($Staff['phonE_NUMBER']) . "</td>
                    <td>" . htmlspecialchars($Staff['joB_ROLE']) . "</td>
                    <td>
                        <a href='staff_update.php?id=" . htmlspecialchars($Staff['stafF_ID']) . "' class='update-btn'>Update</a>
                        <button onclick='confirmDelete(" . htmlspecialchars($Staff['stafF_ID']) . ")' class='delete-btn'>Delete</button>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No staff found.</td></tr>";
        }
        ?>
    </tbody>
</table>

<button onclick="printStaffList()">Print</button>

</body>
</html>
