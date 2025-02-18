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
    </section>

    <section class="features">
        

        <div class="feature">
            <h3>View Phamacys</h3>
            
            <a href="phamacyRequestView.php" class="btn">Staff Manage</a>
        </div>

        <div class="feature">
            <h3> Delete Phamacys </h3>
            <a href="PhamacyDelet.php" class="btn">Delete</a>
        </div>

        <div class="feature">
            <h3>Update Phamacys</h3>
            <a href="PhamcyUpdate.php" class="btn">Update</a>
        </div>

        <div class="feature">
            <h3>Search Phamacys</h3>
            <a href="PhamactDataSearch.php" class="btn">Search</a>
        </div>


        
        <div class="feature">
            <h3>view Phamacy Drug request</h3>
            <a href="phamacyRequestView.php" class="btn">View</a>
        </div> 

        <div class="feature">
            <h3>view Phamacy Drug Conform data</h3>
            <a href="PhamcyRequestConformView.php" class="btn">View</a>
        </div> 
      
        <div class="feature">
            <h3>view Phamacy Drug Reject data</h3>
            <p>Staff can register and participate in tenders.</p>
            <a href="PhamacyRequestRegectView.php" class="btn">View</a>
        </div> 
    </section>

    <footer>
        <p>&copy; 2024 SPC - State Pharmaceutical Cooperation</p>
    </footer>
</body>
</html>
