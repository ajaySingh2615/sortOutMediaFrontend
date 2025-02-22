<?php
require '../auth/auth.php'; // Ensure only admin access
require '../includes/db_connect.php';

// Fetch all blog posts
$result = $conn->query("SELECT id, title, created_at FROM blogs");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Admin Dashboard</h2>
    <a href="../auth/logout.php">Logout</a>
    <a href="add_blog.php">Add New Blog</a>

    <h3>All Blogs</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['title']; ?></td>
                <td><?= $row['created_at']; ?></td>
                <td>
                    <a href="edit_blog.php?id=<?= $row['id']; ?>">Edit</a>
                    <a href="delete_blog.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
