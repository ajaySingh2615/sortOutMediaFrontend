<?php
require '../includes/db_connect.php';

// Fetch all blog posts
$result = $conn->query("SELECT id, title, content, image_url, created_at FROM blogs ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog Posts</title>
</head>
<body>
    <h2>All Blog Posts</h2>
    <div>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div>
                <h3><a href="post.php?id=<?= $row['id']; ?>"><?= htmlspecialchars($row['title']); ?></a></h3>
                <p><?= substr(htmlspecialchars($row['content']), 0, 150) . '...'; ?></p>
                <img src="<?= $row['image_url']; ?>" width="300" alt="Blog Image">
                <p><small>Published on: <?= $row['created_at']; ?></small></p>
            </div>
            <hr>
        <?php endwhile; ?>
    </div>
</body>
</html>