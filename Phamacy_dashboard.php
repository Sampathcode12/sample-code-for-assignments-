<?php include "Phamacyheader.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff - Home</title>
    <link rel="stylesheet" href="styles1.css"> <!-- Link to new stylesheet -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

<!-- Sidebar -->
<!-- <div class="sidebar">
    <div class="hero-content">
        <h2>Staff Portal</h2>
    </div>
    <ul class="menu">
        <li><a href="staff_home.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="Staff_manage.php"><i class="fas fa-users"></i> Staff Management</a></li>
        <li><a href="Suplier_Manage.php"><i class="fas fa-truck"></i> Supplier Management</a></li>
        <li><a href="tender_manage.php"><i class="fas fa-file-contract"></i> Tender Management</a></li>
        <li><a href="PhamacyManage.php"><i class="fas fa-store"></i> Pharmacy Management</a></li>
    </ul>
</div> -->

<!-- Main Content -->
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h2>Welcome to SPC</h2>
        <!-- <p>Your trusted partner in pharmaceutical supplies.</p> -->
    </div>
</section>

<!-- Features Section -->
<section class="features">
    <div class="feature">
        <i class="fas fa-users"></i>
        <h3>Drugs avalability</h3>
      
        <a href="DrugViewPhamacy.php" class="btn">Drugs</a>
    </div>

    <div class="feature">
        <i class="fas fa-truck"></i>
        <h3>Drugs order</h3>
    
        <a href="RequestDrugs.php" class="btn">Request</a>
    </div>


    <!-- <!-- <div class="feature">
        <i class="fas fa-file-contract"></i>
        <h3>Tender Management</h3>
        <p>Submit and track pharmaceutical tenders.</p>
        <a href="tender_manage.php" class="btn">Manage Tenders</a>
    </div> -->

    <div class="feature">
        <i class="fas fa-store"></i>
        <h3>Check Drugs</h3>
     
        <a href="chackDrugsPhamacy.php" class="btn">Search</a>
    </div> 
</section>

<!-- Footer Section -->

<?php include "footer.php"; ?>

</body>
</html>
