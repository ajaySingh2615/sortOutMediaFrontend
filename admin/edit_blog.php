<?php
require '../auth/auth.php'; // Ensure only admin access
require '../includes/db_connect.php';
require '../includes/config.php'; // Cloudinary config
require '../vendor/autoload.php';

use Cloudinary\Api\Upload\UploadApi;

if (!isset($_GET['id'])) {
    die("Invalid blog ID.");
}

$blog_id = $_GET['id'];

// Fetch existing blog details
$stmt = $conn->prepare("SELECT title, content, image_url FROM blogs WHERE id = ?");
$stmt->bind_param("i", $blog_id);
$stmt->execute();
$result = $stmt->get_result();
$blog = $result->fetch_assoc();
$stmt->close();

if (!$blog) {
    die("Blog not found.");
}

// Update blog post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $image_url = $blog['image_url']; // Keep existing image if not updated

    // If a new image is uploaded, replace the old one
    if (!empty($_FILES['image']['tmp_name'])) {
        $uploadApi = new UploadApi();
        $upload = $uploadApi->upload($_FILES['image']['tmp_name']);
        $image_url = $upload['secure_url'];
    }

    $stmt = $conn->prepare("UPDATE blogs SET title = ?, content = ?, image_url = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $content, $image_url, $blog_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating blog: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Blog</title>
</head>
<body>
    <h2>Edit Blog</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($blog['title']) ?>" required>
        <label>Content:</label>
        <textarea name="content" required><?= htmlspecialchars($blog['content']) ?></textarea>
        <label>Current Image:</label><br>
        <img src="<?= $blog['image_url'] ?>" width="200"><br>
        <label>New Image (optional):</label>
        <input type="file" name="image">
        <button type="submit">Update Blog</button>
    </form>
</body>
</html>
