<?php

include"Staff_header.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles1.css">
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
<section class="hero">
    <div class="hero-content">
        <h2>Welcome to SPC</h2>
        <!-- <p>Your trusted partner in pharmaceutical supplies.</p> -->
    </div>
</section>



<section class="features">

    <div class="feature">
        <h3> Staff</h3>
        <p>View system Staff.</p>
        <a href="Staff_data_view.php" class="btn">Go to Staff</a>
    </div>
    <div class="feature">
        <h3> Suplier</h3>
        <p>View system Supliers.</p>
        <a href="Suplier_Data_view.php" class="btn">Go to Suplier</a>
    </div>
    <div class="feature">
        <h3> Phamacy</h3>
        <p>View system users.</p>
        <a href="PhamacyView.php" class="btn">Go to Phamacys</a>
    </div>

    <div class="feature">
        <h3> Manage Tenders</h3>
        <p>Review and approve tenders from suppliers.</p>
        <a href="tender_manage.php" class="btn">Go to Orders</a>
    </div>

    <div class="feature">
        <h3>Drug order</h3>
       
        <p>Approve and track customer orders.</p>
        <a href="phamacyRequestView.php" class="btn">Go to Tenders</a>
    </div>

    <!-- <div class="feature">
        <h3>Manage Warehouse Stock</h3>
        <p>Monitor drug inventory and restock as needed.</p>
        <a href="warehouse.php" class="btn">Go to Warehouse</a>
    </div> -->

</section>



</body>
</html>
