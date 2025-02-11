
<?php

include"Staff_header.php";

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
<!--  -->

    <section class="welcome">
        <h2>Welcome to SPC</h2>
        <p>Your trusted partner in pharmaceutical supplies.</p>
    </section>

    <section class="features">
        

        <div class="feature">
            <h3>View all Phamacy request</h3>
            <p>Search for available drugs and place orders easily.</p>
            <a href="AdmintendeAplyrview.php" class="btn">Staff Manage</a>
        </div>

        <div class="feature">
            <h3>View all conform Phamacy request</h3>
            <p>Manage stock levels for manufactured and purchased drugs.</p>
            <a href="PhamcyRequestReConformView.php" class="btn">Manage Suplier</a>
        </div>

        <div class="feature">
            <h3>View all Reject Phamacy request</h3>
            <p>Submit and track tenders for pharmaceutical supplies.</p>
            <a href="PhamacyRequestRegectView.php" class="btn">Manage Tenders</a>
        </div>

        <!-- <div class="feature">
            <h3>Phamacy Manage</h3>
            <p>Staff can register and participate in tenders.</p>
            <a href="PhamacyManage.php" class="btn">Manage Phamacy</a>
        </div>


        <div class="feature">
            <h3>Phamacy Request Manage</h3>
            <p>Staff can register and participate in tenders.</p>
            <a href="PhamacyRequestManage.php" class="btn">Manage Phamacy</a>
        </div> -->
      
    </section>

    <footer>
        <p>&copy; 2024 SPC - State Pharmaceutical Cooperation</p>
    </footer>
</body>
</html>
