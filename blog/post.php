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

// Fetch related blogs (excluding current blog)
$relatedStmt = $conn->prepare("SELECT id, title, image_url FROM blogs WHERE id != ? ORDER BY created_at DESC LIMIT 6");
$relatedStmt->bind_param("i", $blog_id);
$relatedStmt->execute();
$relatedBlogs = $relatedStmt->get_result();
$relatedStmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($blog['title']); ?></title>

    <!-- ✅ Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ✅ Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <!-- ✅ AOS for Scroll Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* background: linear-gradient(to right, #ccc, #ccc); */
            color: #333;
        }
        .blog-title {
            font-family: 'Playfair Display', serif;
        }
        .blog-content p {
            margin-bottom: 1.5rem;
            line-height: 1.8;
            font-size: 1.2rem;
        }
        .blog-content a {
            color: blue;
            font-weight: bold;
            text-decoration: none;
        }
        .blog-content a:hover {
            color: #a50221;
        }
    </style>
</head>
<body>

<!-- ✅ Responsive Navbar -->
<nav class="bg-white-600 p-2 shadow-lg px-6 md:px-12">
    <div class="container mx-auto flex justify-between items-center">
        <!-- ✅ Logo -->
        <a href="../index.php" class="text-black text-2xl font-bold flex items-center">
            <img src="../public/logo.png" alt="Logo" class="h-10 mr-2">
        </a>

        <!-- ✅ Mobile Menu Button -->
        <button id="menu-toggle" class="text-black text-2xl md:hidden">
            ☰
        </button>

        <!-- ✅ Navigation Links -->
        <ul id="nav-links" class="hidden md:flex space-x-6 text-black font-medium">
            <li><a href="dashboard.php" class="hover:text-gray-200">Home</a></li>
            <li><a href="../blog/index.php" class="hover:text-gray-200">Blog</a></li>
            <!-- <li><a href="add_blog.php" class="hover:text-gray-200">Add Blog</a></li> -->
            
            <!-- ✅ Logout Button -->
            <!-- <li>
                <a href="../auth/logout.php" class="bg-white text-red-600 px-4 py-2 rounded-md hover:bg-gray-200 transition">
                    Logout
                </a>
            </li> -->
        </ul>
    </div>

    <!-- ✅ Mobile Menu (Hidden by Default) -->
    <div id="mobile-menu" class="hidden md:hidden bg-red-700 text-white flex flex-col items-center py-4 space-y-4">
        <a href="dashboard.php" class="hover:text-gray-200">Home</a>
        <a href="/blog/index.php" class="hover:text-gray-200">Blog</a>
        <!-- <a href="../auth/logout.php" class="bg-white text-red-600 px-4 py-2 rounded-md hover:bg-gray-200 transition">
            🚪 Logout
        </a> -->
    </div>
</nav>

<!-- ✅ Navbar JavaScript -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById("menu-toggle");
    const mobileMenu = document.getElementById("mobile-menu");

    menuToggle.addEventListener("click", function () {
        mobileMenu.classList.toggle("hidden");
    });
});
</script>


<!-- ✅ Hero Section -->
<div class="relative bg-cover bg-center h-[400px] flex items-center justify-center text-white text-center px-5"
    style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.8)), url('<?= $blog['image_url']; ?>');">
    <div>
        <h1 class="text-4xl md:text-6xl font-bold blog-title" data-aos="fade-down"><?= htmlspecialchars($blog['title']); ?></h1>
        <p class="text-lg mt-3 opacity-80" data-aos="fade-up">Published on <?= date('F j, Y', strtotime($blog['created_at'])); ?></p>
    </div>
</div>

<!-- ✅ Blog Content -->
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white text-gray-900 shadow-lg rounded-xl" data-aos="fade-up">
    <!-- <img src="<?= $blog['image_url']; ?>" class="w-full max-h-[400px] object-cover rounded-lg shadow-md mb-6" alt="Blog Image"> -->
    
    <div class="blog-content text-gray-800">
        <?php
        // ✅ Preserve formatting with safe HTML
        echo nl2br(html_entity_decode($blog['content'], ENT_QUOTES, 'UTF-8'));
        ?>
        <img src="<?= $blog['image_url']; ?>" class="w-full max-h-[400px] object-cover rounded-lg shadow-md mb-6" alt="Blog Image">
    </div>
</div>

<!-- ✅ Related Blogs Section -->
<h3 class="text-center text-black text-3xl font-bold mt-12" data-aos="fade-up">🔗 Related Blogs</h3>
<div class="container mx-auto px-5 mt-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <?php while ($related = $relatedBlogs->fetch_assoc()): ?>
            <a href="post.php?id=<?= $related['id']; ?>" class="block bg-white rounded-lg overflow-hidden shadow-md transform transition hover:scale-105" data-aos="fade-up">
                <img src="<?= $related['image_url']; ?>" class="w-full h-40 object-cover" alt="Blog Image">
                <div class="p-4">
                    <h5 class="text-lg font-semibold text-black-600"><?= htmlspecialchars($related['title']); ?></h5>
                </div>
            </a>
        <?php endwhile; ?>
    </div>
</div>

<!-- ✅ Back Button -->
<a href="index.php" class="fixed bottom-5 left-5 bg-red-600 text-white px-4 py-2 rounded-full shadow-lg hover:bg-red-700 transition">Back</a>

<!-- ✅ Footer -->
<footer class="bg-black text-white text-center py-4 mt-12">
    © 2025 Your Website | All Rights Reserved.
</footer>

<!-- ✅ Tailwind JS & AOS -->
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</body>
</html>
