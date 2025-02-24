<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['Pharmacy_email'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Get pharmacy name from session
$pharmacyName = $_SESSION['pharmacyName'] ?? "Guest"; 
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
        <H1>SPC</H1> <!-- Logo Text -->
    </div>

    <div class="user-info">
        <!-- Staff Role and Name -->
        <div class="staff-info">
            <p>Welcome, <?php echo htmlspecialchars($pharmacyName); ?>!</p>
        </div>

        <!-- Logout Button -->
        <div class="logout">
            <form method="POST" action="PhamacyLogout.php">
                <button type="submit" name="logout" class="btn-logout">Logout</button>
                <button type="button" class="back-btn" onclick="history.back()">← Back</button>
            </form>
        </div>
    </div>
</header>

</body>
</html>
