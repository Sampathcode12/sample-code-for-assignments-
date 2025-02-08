<?php
session_start();
$jobRole = isset($_SESSION['job_role']) ? $_SESSION['job_role'] : 'Unknown';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff - Home</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <h1>(SPC)</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="register.html">Supplier Registration</a>
            <a href="drugs.html">Search Drugs</a>
            <a href="orders.html">Orders</a>
            <a href="warehouse.php">Manage Stock</a>
            <a href="DrugsData.php">Drugs Data</a>
            <a href="tender.html">Manage Tenders</a>
            <a href="customer_register.html">Customer</a>
            <a href="staffLogin.php">Staff Login</a>
        </nav>
        <div class="user-profile">
            <a href="admin.html">
                <img src="profile-icon.png" alt="User Profile">
            </a>
        </div>
    </header>

    <section class="welcome">
        <h2>Welcome to SPC</h2>
        <p>Your trusted partner in pharmaceutical supplies.</p>
        <p>
            <strong>Your Job Role:</strong> 
            <?php echo htmlspecialchars($jobRole); ?>
        </p>
    </section>

    <?php if ($jobRole === 'Unknown'): ?>
        <script>
            alert("Job role not found in session. Please log in again.");
            window.location.href = "staffLogin.php";
        </script>
    <?php endif; ?>

    <section class="features">
    <?php if ($jobRole === 'Admin'): ?>
    <div class="feature">
        <h3>Drug Search & Orders</h3>
        <p>Search for available drugs and place orders easily.</p>
        <a href="drugs.html" class="btn">Search Drugs</a>
    </div>
<?php endif; ?>
<?php if ($jobRole === 'Manager'): ?>
    <div class="feature">
        <h3>Drug Search & Orders</h3>
        <p>Search for available drugs and place orders easily.</p>
        <a href="drugs.html" class="btn">Search Drugs</a>
    </div>
<?php endif; ?>
<?php if ($jobRole === 'Stock_keeper'): ?>
    <div class="feature">
        <h3>Drug Search & Orders</h3>
        <p>Search for available drugs and place orders easily.</p>
        <a href="drugs.html" class="btn">Search Drugs</a>
    </div>
<?php endif; ?>

        <div class="feature">
            <h3>Warehouse Stock Management</h3>
            <p>Manage stock levels for manufactured and purchased drugs.</p>
            <a href="warehouse.php" class="btn">Manage Stock</a>
        </div>

        <div class="feature">
            <h3>Tender Management</h3>
            <p>Submit and track tenders for pharmaceutical supplies.</p>
            <a href="tender.html" class="btn">Manage Tenders</a>
        </div>

        <div class="feature">
            <h3>Staff Registration</h3>
            <p>Staff can register and participate in tenders.</p>
            <a href="Staff.php" class="btn">Register Now</a>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 SPC - State Pharmaceutical Corporation</p>
    </footer>
</body>
</html>
