<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Restrict access to admin users only
if ($_SESSION['role'] !== 'admin') {
    echo "Access Denied! Only admins can access this page.";
    exit();
}
?>