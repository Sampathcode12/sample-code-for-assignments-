<?php
session_start();

// Check if the staff is logged in by verifying the job role session
$jobRole = isset($_SESSION['job_role']) ? $_SESSION['job_role'] : null;

if (!$jobRole) {
    // Redirect to login page if not logged in
    header("Location: StaffLogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Header</title>
    <link rel="stylesheet" href="styles1.css"> <!-- External CSS File -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"> <!-- Google Font -->
</head>
<body>

<header class="header-container">
    <div class="logo-container">
        <!-- <a href="staff_home.php" class="logo"> -->
            <!-- <img src="logo.png" alt="SPC Logo" class="logo-icon"> -->
            <H1>SPC</H1> <!-- Logo Text -->
        </a>
    </div>
    

    <div class="user-info">
        <!-- Profile Icon -->
        <!-- <div class="profile">
            <a href="profile.php">
                <img url="" alt="Profile Icon" class="profile-icon">
            </a>
        </div> -->

        <!-- Staff Role and Name -->
        <div class="staff-info">
            <p>Welcome, <strong><?php echo htmlspecialchars($jobRole); ?> </strong></p>
        </div>

        <!-- Logout Button -->
        <div class="logout">
            <form method="POST" action="logout.php">
                <button type="submit" name="logout" class="btn-logout">Logout</button>
                <button type="button" class="back-btn" onclick="history.back()">← Back</button>

            </form>
        </div>
    </div>
</header>

</body>
</html>
