<?php
// ✅ Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Ensure Correct Path for `db_connect.php`
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/model_agency_dashboard.php';

// ✅ Ensure Only Admins & Super Admins Can Access
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'super_admin')) {
    header("Location: ../auth/login.php");
    exit();
}

// ✅ Check if Client ID is Passed
if (isset($_GET['id'])) {
    $client_id = intval($_GET['id']);
    $admin_id = $_SESSION['user_id']; // Get the logged-in admin ID

    // ✅ Update Client Approval Status
    $query = "UPDATE clients SET approval_status = 'approved', approved_by = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $admin_id, $client_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "✅ Client profile approved successfully.";
    } else {
        $_SESSION['error'] = "❌ Error approving client profile.";
    }

    mysqli_stmt_close($stmt);

    // ✅ Redirect Back to `modal_agency_dashboard.php`
    header("Location: /model_agency_dashboard.php");
exit();
} else {
    // ✅ Redirect if no ID is provided
    $_SESSION['error'] = "❌ Invalid request. No client ID provided.";
    header("Location: /modal_agency_dashboard.php");
    exit();
}
?>
