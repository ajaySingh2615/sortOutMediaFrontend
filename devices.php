<?php
require 'includes/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devices | Used Laptop/Mobile Devices</title>

    <!-- ✅ Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ✅ Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<!-- Font Awesome Icons -->
<link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
      rel="stylesheet"
    />


    <style>
        /* ✅ General Styling */
body {
    font-family: 'Poppins', sans-serif;
    background: #c2c4c6;
    color: #333;
}

/* ✅ Navbar Custom Styling */
.navbar {
            background-color: #343a40; /* Dark Navbar */
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }
        .nav-link {
            color: white;
            font-size: 1.1rem;
            transition: 0.3s;
        }
        .nav-link:hover {
            color: #ffcc00;
        }
        .navbar-toggler {
            border: none;
        }
        .navbar-toggler:focus {
            box-shadow: none;
        }
        .dropdown-menu {
            background-color: #343a40;
        }
        .dropdown-item {
            color: white;
        }
        .dropdown-item:hover {
            background-color: #495057;
        }
        .search-box {
            width: 250px;
        }
        @media (max-width: 768px) {
            .search-box {
                width: 100%;
            }
        }

        /* ✅ Make Hero Section Full-Screen */
#heroCarousel {
    height: 100vh;
    position: relative;
}

/* ✅ Ensure Images Cover Entire Screen */
.hero-img {
    height: 100vh;
    object-fit: cover;
    width: 100%;
}

/* ✅ Dark Gradient Overlay for Text Visibility */
.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5));
    z-index: 1;
}

/* ✅ Centered & Styled Text */
.carousel-caption {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    z-index: 2;
    width: 80%;
}

/* ✅ Stylish Title */
.hero-title {
    font-size: 4.5rem;
    font-weight: 800;
    font-family: 'Playfair Display', serif;
    color: white;
    text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.8);
    line-height: 1.2;
    margin-bottom: 15px;
}

/* ✅ Subtitle */
.hero-subtitle {
    font-size: 1.6rem;
    color: #f8f9fa;
    font-family: 'Poppins', sans-serif;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6);
    margin-bottom: 20px;
}

/* ✅ Call-to-Action Button */
.hero-btn {
    font-size: 1.3rem;
    padding: 15px 40px;
    border-radius: 50px;
    background: #ff3d00;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
    transition: 0.3s ease-in-out;
}

.hero-btn:hover {
    background: #cc2900;
    transform: scale(1.05);
}


        /* ✅ Filters Section */
.filters-container {
    background: #fff;
    padding: 15px 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

.filters-container .form-select,
.filters-container .form-control {
    max-width: 180px;
    flex-grow: 1;
    font-size: 1rem;
    padding: 10px;
}

/* ✅ Reset Button */
#resetFilters {
    font-size: 1rem;
    font-weight: bold;
    padding: 10px;
    background: #ff3d00;
    border: none;
    border-radius: 8px;
    color: white;
    transition: 0.3s;
}

#resetFilters:hover {
    background: #cc2900;
}

/* ✅ Device Card */
.device-card {
    background: #fff;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
    text-align: center;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.device-card:hover {
    transform: scale(1.05);
}

/* ✅ Device Image */
.device-img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
}

/* ✅ Fix title overflow */
.device-title {
    font-size: 1rem; /* Adjust font size */
    font-weight: bold;
    color: #000;
    margin-top: 10px;
    text-align: center;
    word-wrap: break-word; /* Ensures long words break */
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 4; /* Limits to 2 lines */
    -webkit-box-orient: vertical;
}

/* ✅ Description Button */
.description-btn {
    font-size: 0.9rem;
    font-weight: bold;
    padding: 8px 12px;
    background: #17a2b8;
    color: white;
    border-radius: 5px;
    width: 100%;
    text-align: center;
}

.description-btn:hover {
    background: #117a8b;
}

/* ✅ Price */
.device-price {
    font-size: 1.3rem;
    font-weight: bold;
    color:#000;
}

/* ✅ Contact Button */
.device-footer .btn {
    font-size: 1rem;
    padding: 10px;
    border-radius: 8px;
    font-weight: bold;
}

/* ✅ Pagination Styling */
.pagination .page-item.active .page-link {
    background: #ff3d00;
    border-color: #ff3d00;
    color: #fff;
}

.pagination .page-link {
    color: #333;
    font-weight: bold;
    padding: 10px 15px;
    transition: 0.3s;
}

.pagination .page-link:hover {
    background: #ff3d00;
    color: white;
}

/* ✅ Description Modal */
#descriptionModal .modal-content {
    border-radius: 12px;
}

#descriptionModal .modal-header {
    background: #17a2b8;
    color: white;
    border-radius: 12px 12px 0 0;
}

/* ✅ Footer Styling */
.footer {
            background-color: #343a40;
            color: white;
            padding: 50px 0;
        }
        .footer a {
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }
        .footer a:hover {
            color: #ffcc00;
        }
        .footer .social-icons a {
            font-size: 1.5rem;
            margin-right: 15px;
            display: inline-block;
            transition: 0.3s;
        }
        .footer .social-icons a:hover {
            transform: scale(1.2);
        }
        .footer hr {
            border-color: rgba(255, 255, 255, 0.2);
        }
        @media (max-width: 768px) {
            .footer .col-md-4 {
                text-align: center;
                margin-bottom: 20px;
            }
        }

    </style>
</head>
<body>

<!-- ✅ Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <!-- 🌟 Logo -->
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-laptop-code"></i> MyStore
        </a>

        <!-- 📱 Mobile Menu Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- 🌎 Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
                </li>

                <!-- 📂 Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-th-large"></i> Categories
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-laptop"></i> Laptops</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-desktop"></i> Desktops</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-video"></i> CCTV Cameras</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-fingerprint"></i> Biometric Devices</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-print"></i> Printers</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="about.php"><i class="fas fa-info-circle"></i> About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php"><i class="fas fa-envelope"></i> Contact</a>
                </li>
            </ul>

            <!-- 🔎 Search Box -->
            <form class="d-flex">
                <input class="form-control search-box me-2" type="search" placeholder="Search...">
                <button class="btn btn-warning" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
</nav>


<!-- ✅ Full-Screen Hero Section -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <!-- 🌟 Slide 1: Laptops & Devices -->
        <div class="carousel-item active">
            <div class="hero-overlay"></div> 
            <img src="/public/bannerForDevices/laptop.webp" class="d-block w-100 hero-img" alt="Banner 1">
            <div class="carousel-caption">
                <h1 class="hero-title">Upgrade Your Work Setup with <br> Premium</h1>
                <p class="hero-subtitle">Top-notch refurbished laptops, desktops, and accessories at unbeatable prices.</p>
                <a href="#devices" class="btn hero-btn">🛒 Explore Devices</a>
            </div>
        </div>

        <!-- 🌟 Slide 2: Security Solutions -->
        <div class="carousel-item">
            <div class="hero-overlay"></div>
            <img src="/public/bannerForDevices/cctv.webp" class="d-block w-100 hero-img" alt="Banner 2">
            <div class="carousel-caption">
                <h1 class="hero-title">Secure Your Space with <br> CCTV & Biometric Solutions</h1>
                <p class="hero-subtitle">Protect your home and office with high-quality security devices.</p>
                <a href="#devices" class="btn hero-btn">🔍 Browse Security Devices</a>
            </div>
        </div>

        <!-- 🌟 Slide 3: Printers & Accessories -->
        <div class="carousel-item">
            <div class="hero-overlay"></div>
            <img src="/public/bannerForDevices/printer.webp" class="d-block w-100 hero-img" alt="Banner 3">
            <div class="carousel-caption">
                <h1 class="hero-title">High-Quality Printers & Accessories</h1>
                <p class="hero-subtitle">Perfect printing solutions for businesses and professionals.</p>
                <a href="#devices" class="btn hero-btn">🖨️ View Printers</a>
            </div>
        </div>
    </div>

    <!-- 🔄 Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
</div>




<!-- ✅ Filters Section -->
<div class="container my-4">
    <div class="filters-container">
        <input type="text" id="search" class="form-control" placeholder="🔎 Search by Name">
        <select id="categoryFilter" class="form-select">
            <option value="">📂 All Categories</option>
            <option value="Laptop">💻 Laptop</option>
            <option value="Desktop">🖥️ Desktop</option>
            <option value="CCTV Camera">📷 CCTV Camera</option>
            <option value="Biometric">🔐 Biometric</option>
            <option value="Printer">🖨️ Printer</option>
        </select>
        <select id="priceFilter" class="form-select">
            <option value="">💰 Price Range</option>
            <option value="below_10000">Below ₹10,000</option>
            <option value="10000_30000">₹10,000 - ₹30,000</option>
            <option value="30000_50000">₹30,000 - ₹50,000</option>
            <option value="above_50000">Above ₹50,000</option>
        </select>
        <button id="resetFilters" class="btn btn-danger">🔄 Reset</button>
    </div>
</div>

<!-- ✅ Device Cards -->
<div class="container">
    <div class="row" id="deviceContainer"></div>
</div>

<!-- ✅ Pagination -->
<div class="container text-center my-4">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center" id="paginationContainer"></ul>
    </nav>
</div>


<!-- ✅ Description Modal -->
<div class="modal fade" id="descriptionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Device Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="deviceDescription"></div>
        </div>
    </div>
</div>

<!-- ✅ Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- 🌟 Company Info -->
            <div class="col-md-4">
                <h4><i class="fas fa-laptop-code"></i> MyStore</h4>
                <p>Providing top-quality refurbished devices with warranty and support.</p>
                <div class="social-icons">
                    <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>

            <!-- 🔗 Quick Links -->
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="about.php"><i class="fas fa-info-circle"></i> About Us</a></li>
                    <li><a href="products.php"><i class="fas fa-th-large"></i> Products</a></li>
                    <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                </ul>
            </div>

            <!-- 📞 Contact Details -->
            <div class="col-md-4">
                <h5>Contact Us</h5>
                <p><i class="fas fa-map-marker-alt"></i> 123 Street, City, India</p>
                <p><i class="fas fa-phone"></i> +91 98765 43210</p>
                <p><i class="fas fa-envelope"></i> support@mystore.com</p>
            </div>
        </div>

        <hr>

        <!-- ⚖️ Copyright -->
        <div class="text-center">
            <p>&copy; <?php echo date("Y"); ?> MyStore. All rights reserved.</p>
        </div>
    </div>
</footer>


<!-- ✅ Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    function fetchDevices(filters = {}) {
        let url = new URL("fetch_devices.php", window.location.origin);
        
        // ✅ Append filters to URL
        Object.keys(filters).forEach(key => url.searchParams.append(key, filters[key]));

        fetch(url)
            .then(response => response.json())
            .then(data => {
                renderDevices(data.devices);
                renderPagination(data.totalPages, data.currentPage);
            })
            .catch(error => console.error("Error fetching devices:", error));
    }

    function renderDevices(devices) {
        let container = document.querySelector(".container .row");
        container.innerHTML = "";
        
        devices.forEach(device => {
            let deviceHTML = `
                <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
                    <div class="device-card">
                        <img src="${device.image_url}" class="device-img" alt="Device Image">
                        <h5 class="device-title">${device.device_name}</h5>
                        <button class="btn description-btn" data-description="${device.description}">ℹ️ See Description</button>
                        <p class="device-price text-danger fw-bold mt-2">₹${device.price}</p>
                        <div class="device-footer">
                            <a href="https://wa.me/${device.contact_number}" target="_blank" class="btn btn-success w-100">📞 Contact on WhatsApp</a>
                        </div>
                    </div>
                </div>
            `;
            container.innerHTML += deviceHTML;
        });

        attachDescriptionEvent();
    }

    function renderPagination(totalPages, currentPage) {
        let paginationContainer = document.querySelector(".pagination");
        paginationContainer.innerHTML = "";

        if (totalPages <= 1) return;

        paginationContainer.innerHTML += `
            <li class="page-item ${currentPage <= 1 ? 'disabled' : ''}">
                <a class="page-link pagination-btn" data-page="${currentPage - 1}">Previous</a>
            </li>
        `;

        for (let i = 1; i <= totalPages; i++) {
            paginationContainer.innerHTML += `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link pagination-btn" data-page="${i}">${i}</a>
                </li>
            `;
        }

        paginationContainer.innerHTML += `
            <li class="page-item ${currentPage >= totalPages ? 'disabled' : ''}">
                <a class="page-link pagination-btn" data-page="${currentPage + 1}">Next</a>
            </li>
        `;

        attachPaginationEvents();
    }

    function attachDescriptionEvent() {
        document.querySelectorAll('.description-btn').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('deviceDescription').innerText = this.getAttribute('data-description');
                new bootstrap.Modal(document.getElementById('descriptionModal')).show();
            });
        });
    }

    function attachPaginationEvents() {
        document.querySelectorAll(".pagination-btn").forEach(button => {
            button.addEventListener("click", function (event) {
                event.preventDefault();
                let page = this.getAttribute("data-page");
                fetchDevices({ page });
            });
        });
    }

    // ✅ Add Event Listeners for Filters
    document.getElementById('search').addEventListener('input', function () {
        fetchDevices({ search: this.value });
    });

    document.getElementById('categoryFilter').addEventListener('change', function () {
        fetchDevices({ category: this.value });
    });

    document.getElementById('priceFilter').addEventListener('change', function () {
        fetchDevices({ price_range: this.value });
    });

    document.getElementById('resetFilters').addEventListener('click', function () {
        fetchDevices({});
    });

    // ✅ Fetch Initial Devices
    fetchDevices();
});
</script>

</body>
</html>
