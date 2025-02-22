<?php
require '../auth/auth.php';
require '../includes/db_connect.php';
require '../includes/config.php'; // Cloudinary config
require '../vendor/autoload.php';

use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    
    // Upload image to Cloudinary
    if (!empty($_FILES['image']['tmp_name'])) {
        try {
            $uploadApi = new UploadApi();
            $upload = $uploadApi->upload($_FILES['image']['tmp_name'], [
                'folder' => 'blog_images' // Store images in Cloudinary folder
            ]);
            $image_url = $upload['secure_url'];
        } catch (Exception $e) {
            die("Cloudinary Upload Error: " . $e->getMessage());
        }
    } else {
        $image_url = '';
    }
    
    $stmt = $conn->prepare("INSERT INTO blogs (title, content, image_url, created_by) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $title, $content, $image_url, $_SESSION['user_id']);
    
    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Blog</title>
    <link rel="stylesheet" href="../public/styles.css"> <!-- Link to external CSS -->
</head>
<body>
    <h2>Add New Blog</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" required>
        <label>Content:</label>
        <textarea name="content" required></textarea>
        <label>Image:</label>
        <input type="file" name="image">
        <button type="submit">Add Blog</button>
    </form>
</body>