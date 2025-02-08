<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Get the job role from session
$jobRole = $_SESSION['job_role'];

// Example: Redirect based on job role
if ($jobRole == "Admin") {
    echo "Welcome, Admin!";
} elseif ($jobRole == "Manager") {
    echo "Welcome, Manager!";
} else {
    echo "Welcome, Staff!";
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=Dashbord, initial-scale=1.0">
    <title>Dashbord</title>
</head>
<body>
    
</body>
</html>