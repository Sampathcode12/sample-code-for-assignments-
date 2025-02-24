<?php
session_start();

// Destroy session to log out
session_unset();
session_destroy();

// Redirect to login page after logging out
header("Location: PhamacyLogin.php");
exit();
?>
