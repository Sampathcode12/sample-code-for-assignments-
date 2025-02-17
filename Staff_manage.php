<?php include "Staff_header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff - Home</title>
    <link rel="stylesheet" href="styles1.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

<!-- Sidebar -->
<!-- <div class="sidebar">
    <div class="logo">
        <h2>Staff Portal</h2>
    </div>
    <ul class="menu">
        <li><a href="staff_home.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="Staff.php"><i class="fas fa-users"></i> Add New Member</a></li>
        <li><a href="staff_delete.php"><i class="fas fa-user-times"></i> Delete Member</a></li>
        <li><a href="staff_update.php"><i class="fas fa-user-edit"></i> Update Member</a></li>
        <li><a href="Staff_data_view.php"><i class="fas fa-database"></i> View All Members</a></li>
    </ul>
</div> -->

<!-- Main Content -->
<div class="main-content">
    <!-- Hero Section -->
    <section class="welcome">
        <h2>Welcome to SPC</h2>
        <p>Your trusted partner in pharmaceutical supplies.</p>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="feature">
            <h3>New Member</h3>
            <p>Add a new staff member to the portal.</p>
            <a href="Staff.php" class="btn">Add New Member</a>
        </div>

        <div class="feature">
            <h3>Delete Member</h3>
            <p>Remove a staff member from the system.</p>
            <a href="staff_delete.php" class="btn">Remove Member</a>
        </div>

        <div class="feature">
            <h3>Update Member Information</h3>
            <p>Edit details of an existing staff member.</p>
            <a href="staff_update.php" class="btn">Update Info</a>
        </div>

        <div class="feature">
            <h3>All Member Data</h3>
            <p>View and manage all staff member data.</p>
            <a href="Staff_data_view.php" class="btn">View Data</a>
        </div>
    </section>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2024 SPC - State Pharmaceutical Cooperation</p>
</footer>

</body>
</html>
