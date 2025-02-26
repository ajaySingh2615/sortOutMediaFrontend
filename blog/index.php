<?php
require '../includes/db_connect.php';

// Set the number of blogs per page
$blogsPerPage = 10;

// Get the current page number from the URL, default is page 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// Calculate the OFFSET for SQL
$offset = ($page - 1) * $blogsPerPage;

// Fetch blog posts with LIMIT for pagination
$result = $conn->query("SELECT id, title, content, image_url, created_at FROM blogs ORDER BY created_at DESC LIMIT $blogsPerPage OFFSET $offset");

// Get the total number of blogs
$totalBlogs = $conn->query("SELECT COUNT(*) as count FROM blogs")->fetch_assoc()['count'];
$totalPages = ceil($totalBlogs / $blogsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest Blog Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="../public/index.css"> <!-- Custom CSS -->
</head>
<body class="bg-gray-50">

<!-- ✅ Navbar -->
<nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mobile-navbar md:flex md:items-center md:justify-between h-16"> <!-- ✅ FIXED -->

            <!-- ✅ Logo (Left Side) -->
            <a href="#" class="logo flex items-center">
                <img src="../public/logo.png" alt="Logo" class="h-10 w-auto">
            </a>

            <!-- ✅ Mobile Menu Button (Right Side) -->
            <button id="menu-toggle" class="menu-toggle md:hidden text-gray-600 text-3xl focus:outline-none">
                ☰
            </button>

            <!-- ✅ Desktop Menu (Hidden on Mobile) -->
            <div class="hidden md:flex space-x-6">
                <a href="#" class="text-gray-700 hover:text-red-500 transition font-semibold">Home</a>
                <a href="#blog-section" class="text-gray-700 hover:text-red-500 transition font-semibold">Blogs</a>
                <a href="#footer" class="text-gray-700 hover:text-red-500 transition font-semibold">Contact</a>
            </div>
        </div>
    </div>

    <!-- ✅ Mobile Menu (Dropdown) -->
    <div id="mobile-menu" class="hidden md:hidden bg-white shadow-md w-full py-4 px-6">
        <a href="#" class="block py-2 text-gray-700 hover:text-red-500 transition font-semibold">Home</a>
        <a href="#blog-section" class="block py-2 text-gray-700 hover:text-red-500 transition font-semibold">Blogs</a>
        <a href="#footer" class="block py-2 text-gray-700 hover:text-red-500 transition font-semibold">Contact</a>
    </div>
</nav>

<!-- ✅ JavaScript for Mobile Menu -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    });
</script>


<!-- ✅ Hero Section with Full-Width Blog Image -->
<header class="relative w-full h-[400px] md:h-[500px] lg:h-[600px]">
    
    <!-- ✅ Hero Image with Shadow -->
    <div class="absolute inset-0">
        <img src="../images/blogging-page/blogging.webp" 
             alt="Blogging Image" 
             class="w-full h-full object-cover shadow-lg">
    </div>

    <!-- ✅ Overlay for Readability -->
    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center text-white px-6">
        <h1 class="text-4xl md:text-6xl font-bold font-playfair">
            Welcome to Our Blog
        </h1>
        <p class="text-lg md:text-xl font-poppins mt-4 max-w-2xl">
            Stay updated with the latest trends, insights, and expert articles in the world of technology, marketing, and innovation.
        </p>
        <a href="#blog-section" class="mt-6 inline-block px-6 py-3 bg-red-600 text-white font-semibold rounded-md shadow-md hover:bg-red-700 transition">
            Explore Blogs
        </a>
    </div>

</header>

<!-- ✅ Blog Timeline Container -->
<div class="flex justify-center py-12 px-4 md:px-8" id="blog-section">
    <div class="w-full max-w-7xl">
        <h2 class="text-center text-3xl md:text-4xl font-bold text-red-600 mb-12 uppercase tracking-wide font-playfair">
            Latest Blog Posts
        </h2>

        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="flex flex-col md:flex-row items-center md:items-center mb-16 relative w-full">
                
                <!-- ✅ Left Section: Profile Image & Date -->
                <div class="relative flex flex-col items-center justify-center text-center md:w-1/5">
                    <div class="relative w-32 h-32 md:w-36 md:h-36 rounded-full border-[3px] border-gray-500 shadow-md overflow-hidden transition-transform duration-300 hover:scale-105">
                        <img src="<?= $row['image_url']; ?>" alt="Blog Image" class="w-full h-full object-cover">
                    </div>
                    <div class="mt-3">
                        <p class="text-gray-500 text-sm md:text-lg font-roboto tracking-wide"><?= date('d F', strtotime($row['created_at'])); ?></p>
                        <p class="text-gray-800 font-bold text-2xl md:text-3xl font-playfair tracking-wide"><?= date('H:i', strtotime($row['created_at'])); ?></p>
                    </div>
                </div>

                <!-- ✅ Right Section: Speech Bubble Blog Content -->
                <div class="relative bg-white p-6 md:p-10 border border-gray-300 shadow-lg rounded-[50px] mt-6 md:mt-0 md:ml-10 w-full transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 speech-bubble">
                <h3 class="text-xl md:text-3xl font-bold text-gray-800 leading-tight hover:text-red-600 transition duration-200 font-playfair">
    <a href="post.php?id=<?= $row['id']; ?>"><?= htmlspecialchars($row['title']); ?></a>
</h3>
<p class="text-gray-600 mt-3 md:mt-4 font-poppins text-base md:text-lg">
    <?= substr(nl2br(preg_replace('/<a (.*?)>(.*?)<\/a>/i', '<a $1 class="text-red-600 font-semibold hover:text-red-800 transition" target="_blank">$2</a>', htmlspecialchars_decode($row['content']))), 0, 200) . '...'; ?>
</p>

<p class="text-sm md:text-md text-gray-500 mt-3 md:mt-4 font-roboto tracking-wide">
    By Our Growth Experts
</p>


                    <!-- Buttons (Share & Read More) -->
                    <div class="flex flex-col md:flex-row md:items-center justify-end mt-4 md:mt-6 space-y-2 md:space-y-0 md:space-x-4">
                        <button class="p-3 md:p-4 bg-red-200 rounded-full hover:bg-red-300 transition shadow-md">
                            🔗
                        </button>
                        <a href="post.php?id=<?= $row['id']; ?>" class="px-5 md:px-6 py-2 md:py-3 border-2 border-red-400 text-red-500 font-semibold rounded-md hover:bg-red-700 hover:text-white transition shadow-md">
                            READ MORE
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>

        <!-- ✅ Pagination -->
        <div class="bg-gray-900 text-white p-6 rounded-lg shadow-md text-center mt-10">
            <p class="text-sm md:text-lg">
                Showing <span class="font-bold"><?= ($offset + 1); ?></span> to 
                <span class="font-bold"><?= min(($offset + $blogsPerPage), $totalBlogs); ?></span> of 
                <span class="font-bold"><?= $totalBlogs; ?></span> Entries
            </p>

            <div class="flex justify-center mt-4 space-x-2">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1; ?>" class="px-4 md:px-5 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-600 transition">Prev</a>
                <?php else: ?>
                    <span class="px-4 md:px-5 py-2 bg-gray-800 text-gray-500 rounded-md cursor-not-allowed">Prev</span>
                <?php endif; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1; ?>" class="px-4 md:px-5 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-600 transition">Next</a>
                <?php else: ?>
                    <span class="px-4 md:px-5 py-2 bg-gray-800 text-gray-500 rounded-md cursor-not-allowed">Next</span>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<!-- ✅ Footer Section -->
<footer class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-6 md:px-12 lg:px-20 grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- About -->
        <div>
            <h3 class="text-xl font-bold mb-4">About Us</h3>
            <p class="text-gray-400">We share the latest trends and insights in technology, marketing, and innovation. Stay informed with our expert articles.</p>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="text-xl font-bold mb-4">Quick Links</h3>
            <ul>
                <li><a href="#" class="text-gray-400 hover:text-white transition">Home</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white transition">Blog</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white transition">Contact</a></li>
            </ul>
        </div>

        <!-- Contact Info -->
        <div>
            <h3 class="text-xl font-bold mb-4">Contact Us</h3>
            <p class="text-gray-400">Email: info@example.com</p>
            <p class="text-gray-400">Phone: +123 456 7890</p>
        </div>

    </div>

    <div class="text-center text-gray-500 text-sm mt-8">
        © 2025 Your Blog. All Rights Reserved.
    </div>
</footer>

</body>
</html>
