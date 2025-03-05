<?php
session_start();
require_once '../includes/db_connect.php'; // Database connection

// Check if the user is logged in and is an admin or superadmin
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'super_admin')) {
    header("Location: ../auth/login.php");
    exit();
}

if (isset($_GET['id'])) {
    $client_id = intval($_GET['id']);

    // Delete client query
    $deleteQuery = "DELETE FROM clients WHERE id = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $client_id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "Client profile deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete profile.";
    }
}

header("Location: model_agency_dashboard.php");
exit();
