<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suplier manage - Home</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <h1> (SPC)</h1>
        <nav>
            <a href="admin.php">Home</a>
          
            <a href="Staff_manage.php">Staff Manage</a>
            <a href="#">Search Drugs</a>
            <a href="#">Orders</a>
            <a href="#">Manage Stock</a>
            <!-- <a href="DrugsAdd.php">DrugsAdd</a> -->
       
            <a href="#">Manage Tenders</a>

        
        </nav>
        <div class="user-profile">
            <a href="admin.php">
                <img src="profile-icon.png" alt="User Profile">
            </a>
        </div>
    </header>

    <section class="welcome">
        <h2>Welcome to SPC</h2>
        <p>Your trusted partner in pharmaceutical supplies.</p>
    </section>

    <section class="features">
        

      

        <div class="feature">
            <h3>Delete Suplier member</h3>
            <p>Manage stock levels for manufactured and purchased drugs.</p>
            <a href="supler_delete.php" class="btn">Delete</a>
        </div>

        <div class="feature">
            <h3>Ckack supler Member Information</h3>
            <p>Submit and track tenders for pharmaceutical supplies.</p>
            <a href="search_suppliers.php" class="btn">Chack</a>
        </div> 

        <div class="feature">
            <h3>All Suplier member Data</h3>
            <p>Staff can register and participate in tenders.</p>
            <a href="Suplier_Data_view.php" class="btn">click</a>
        </div>


        
      
    </section>

    <footer>
        <p>&copy; 2024 SPC - State Pharmaceutical Cooperation</p>
    </footer>
</body>
</html>
