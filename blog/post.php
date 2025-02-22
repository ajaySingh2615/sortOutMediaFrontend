<?php
require '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    die("Invalid blog ID.");
}

$blog_id = $_GET['id'];

// Fetch the blog post details
$stmt = $conn->prepare("SELECT title, content, image_url, created_at FROM blogs WHERE id = ?");
$stmt->bind_param("i", $blog_id);
$stmt->execute();
$result = $stmt->get_result();
$blog = $result->fetch_assoc();
$stmt->close();

if (!$blog) {
    die("Blog post not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($blog['title']); ?></title>
</head>
<body>
    <h2><?= htmlspecialchars($blog['title']); ?></h2>
    <p><small>Published on: <?= $blog['created_at']; ?></small></p>
    <img src="<?= $blog['image_url']; ?>" width="500" alt="Blog Image">
    <p><?= nl2br(htmlspecialchars($blog['content'])); ?></p>
    <a href="index.php">Back to Blogs</a>
</body>
</html>