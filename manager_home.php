<?php

include"Staff_header.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- <header>
    <h1>Admin Dashboard - SPC</h1>
    <nav>
        <a href="admin_home.php">Home</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="manage_orders.php">Manage Orders</a>
        <a href="manage_tenders.php">Manage Tenders</a>
        <a href="warehouse.php">Manage Stock</a>
        <a href="logout.php">Logout</a>
    </nav>
</header> -->



<section class="features">

    <div class="feature">
        <h3>Manage Users</h3>
        <p>View, add, and remove system users.</p>
        <a href="manage_users.php" class="btn">Go to Users</a>
    </div>

    <div class="feature">
        <h3>Manage Orders</h3>
        <p>Approve and track customer orders.</p>
        <a href="manage_orders.php" class="btn">Go to Orders</a>
    </div>

    <div class="feature">
        <h3>Manage Tenders</h3>
        <p>Review and approve tenders from suppliers.</p>
        <a href="manage_tenders.php" class="btn">Go to Tenders</a>
    </div>

    <div class="feature">
        <h3>Manage Warehouse Stock</h3>
        <p>Monitor drug inventory and restock as needed.</p>
        <a href="warehouse.php" class="btn">Go to Warehouse</a>
    </div>

</section>

<footer>
    <p>&copy; 2024 SPC - State Pharmaceutical Cooperation</p>
</footer>

</body>
</html>
