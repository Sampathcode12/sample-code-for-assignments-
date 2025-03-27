<?php
session_start();

// Check if the staff is logged in by verifying the job role session
$jobRole = isset($_SESSION['job_role']) ? $_SESSION['job_role'] : null;
$profilePicture = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'default-profile.jpg'; // Default to 'default-profile.jpg' if no profile picture

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
    <title>Staff Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        /* Global reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Font Family */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Profile Container */
        .profile-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 20px;
            flex-direction: column;
        }

        /* Profile Card */
        .profile-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 250px;
        }

        /* Profile Picture */
        .profile-picture {
            width: 100px;
            height: 100px;
            margin: 0 auto;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #ddd;
            margin-bottom: 20px;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Profile Information */
        .profile-info {
            font-size: 14px;
            color: #333;
        }

        .profile-info h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #4A90E2;
        }

        .profile-info p {
            color: #888;
        }

        /* Logout and Back Button Styles */
        .logout-container {
            margin-top: 20px;
        }

        .btn-logout {
            background-color: #e74c3c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 10px;
        }

        .btn-logout:hover {
            background-color: #c0392b;
        }

        .back-btn {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .back-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <div class="profile-container">
        <div class="profile-card">
            <!-- Profile Picture -->
            <div class="profile-picture">
                <img src="profile-placeholder.jpg" alt="Profile Picture" class="profile-img">
            </div>
            
            <!-- User Information -->
            <div class="profile-info">
                <h2>John Doe</h2>
                <p>Position: Staff</p>
            </div>
            
            <!-- Logout and Back Buttons -->
            <div class="logout-container">
                <form method="POST" action="logout.php">
                    <button type="submit" name="logout" class="btn-logout">Logout</button>
                </form>
                <button type="button" class="back-btn" onclick="history.back()">← Back</button>
            </div>
        </div>
    </div>

</body>
</html>
