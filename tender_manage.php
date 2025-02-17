<?php

include"Staff_header.php";

?>


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
 

    <section class="welcome">
        <h2>Welcome to SPC</h2>
        <p>Your trusted partner in pharmaceutical supplies.</p>
    </section>

    <section class="features">
        

        <div class="feature">
            <h3>Tender Add</h3>
            <p>Search for available drugs and place orders easily.</p>
            <a href="Add_tender.php" class="btn">Staff Manage</a>
        </div>

        <div class="feature">
            <h3>Tender delete</h3>
            <p>Manage stock levels for manufactured and purchased drugs.</p>
            <a href="tender_delete.php" class="btn">Manage Suplier</a>
        </div>

        <div class="feature">
            <h3>Update tender Information</h3>
            <p>Submit and track tenders for pharmaceutical supplies.</p>
            <a href="Tender_update.php" class="btn">Manage Tenders</a>
        </div>

        <div class="feature">
            <h3>view all denders</h3>
            <p>Staff can register and participate in tenders.</p>
            <a href="tender_view.php" class="btn">Register Now</a>
        </div>


        
        <div class="feature">
            <h3>view all denders request</h3>
            <p>Staff can register and participate in tenders.</p>
            <a href="AdmintendeAplyrview.php" class="btn">Register Now</a>
        </div>
      
    </section>

    <footer>
        <p>&copy; 2024 SPC - State Pharmaceutical Cooperation</p>
    </footer>
</body>
</html>
