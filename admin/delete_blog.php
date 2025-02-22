<?php
require '../auth/auth.php'; // Ensure only admin access
require '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    die("Invalid blog ID.");
}

$blog_id = $_GET['id'];

// Delete the blog post
$stmt = $conn->prepare("DELETE FROM blogs WHERE id = ?");
$stmt->bind_param("i", $blog_id);

if ($stmt->execute()) {
    header("Location: dashboard.php");
    exit();
} else {
    echo "Error deleting blog: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>