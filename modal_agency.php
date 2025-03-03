<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Models Agency</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Tailwind CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
<style>
    /* ✅ Ensure Modal Appears on Top */
    #addClientModal {
        z-index: 99999;
    }

    /* ✅ Modal Content Styling */
    #addClientModal > div {
        max-height: 85vh;
        overflow-y: auto;
        border-radius: 12px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    }

    /* ✅ Prevent Background Scroll When Modal is Open */
    body.modal-open {
        overflow: hidden;
    }
     /* ✅ Hero Section Styling */
    #heroCarousel {
        display: flex;
        transition: transform 0.6s ease-in-out;
    }

    .hero-img {
        width: calc(100% / 4); /* ✅ Default: 4 images per row */
        height: 80vh;
        object-fit: cover;
        flex-shrink: 0;
    }

    /* ✅ Navigation Button Styling */
    .hero-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 12px 16px;
        border-radius: 50%;
        font-size: 24px;
        transition: 0.3s;
    }

    .hero-btn:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }
  /* ✅ Responsive Design */
  @media (max-width: 1024px) {
        .hero-img {
            width: calc(100% / 2); /* ✅ Tablet: 2 images per row */
        }
    }

    @media (max-width: 768px) {
        .hero-img {
            width: 100%; /* ✅ Mobile: 1 image per row */
        }
    }

    .font-poppins { font-family: 'Poppins', sans-serif; }
    .font-montserrat { font-family: 'Montserrat', sans-serif; }

    /* ✅ Premium Styling */
    .client-name {
        font-size: 22px;
        font-weight: 700;
        color: #333;
    }
    .client-category {
        font-size: 16px;
        font-weight: 500;
        color: #777;
    }
    .client-followers {
        font-size: 14px;
        font-weight: 400;
        color: #555;
    }

    /* ✅ Hover Effect Styling */
    .hover-content h3 {
        font-size: 28px;
        font-weight: 700;
    }
    .hover-content p {
        font-size: 18px;
        font-weight: 500;
    }
    .hover-content strong {
        font-size: 20px;
        font-weight: 600;
    }

    /* ✅ Button Styling */
    .btn-primary {
        font-size: 16px;
        font-weight: 600;
        padding: 10px 16px;
        transition: 0.3s;
    }
    .btn-primary:hover {
        transform: scale(1.05);
    }

    /* ✅ Stylish Dropdowns */
    .filter-dropdown {
        appearance: none;
        background-color: white;
        border: 2px solid #e5e7eb;
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        color: #333;
        transition: 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .filter-dropdown:hover, .filter-dropdown:focus {
        border-color: #ff4757;
        box-shadow: 0 4px 8px rgba(255, 71, 87, 0.2);
        outline: none;
    }

    /* ✅ Center the Filters & Add Spacing */
    .filters-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        background: white;
        padding: 16px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* ✅ Apply Filters Button */
    .apply-filter-btn {
        background-color: #ff4757;
        color: white;
        font-weight: 600;
        font-size: 16px;
        padding: 10px 16px;
        border-radius: 8px;
        transition: 0.3s;
        box-shadow: 0 4px 6px rgba(255, 71, 87, 0.2);
    }

    .apply-filter-btn:hover {
        background-color: #e63946;
        box-shadow: 0 6px 12px rgba(255, 71, 87, 0.3);
    }

     /* ✅ Modern Fonts */
     .font-montserrat {
        font-family: 'Montserrat', sans-serif;
    }
    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }

    /* ✅ Call-to-Action Button */
    .cta-btn {
        background-color: white;
        color: #e63946;
        font-size: 18px;
        font-weight: 600;
        padding: 12px 24px;
        border-radius: 30px;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 6px 15px rgba(255, 71, 87, 0.3);
    }

    .cta-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(255, 71, 87, 0.5);
    }
</style>


</head>
<body class="bg-gray-100">

    <!-- ✅ Navbar -->
    <nav class="bg-white shadow-md fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <!-- 🔹 Left: Logo -->
                <div class="flex-shrink-0">
                    <a href="index.php">
                        <img src="logo.png" alt="Logo" class="h-10"> <!-- Change logo.png -->
                    </a>
                </div>

                <!-- 🔹 Center: Navigation Links (Hidden on Mobile) -->
                <div class="hidden md:flex space-x-6">
                    <a href="index.php" class="text-gray-700 hover:text-red-500">Home</a>
                    <a href="#" class="text-gray-700 hover:text-red-500">About</a>
                    <a href="#" class="text-gray-700 hover:text-red-500">Services</a>
                    <a href="#" class="text-gray-700 hover:text-red-500">Contact</a>
                </div>

                <!-- 🔹 Right: Add Client Button -->
                <div class="flex items-center">
                    <button onclick="toggleModal()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                        + Add Client
                    </button>

                    <!-- ✅ Hamburger Menu for Mobile -->
                    <button onclick="toggleMobileMenu()" class="md:hidden ml-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- ✅ Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white p-4">
            <a href="index.php" class="block text-gray-700 py-2">Home</a>
            <a href="#" class="block text-gray-700 py-2">About</a>
            <a href="#" class="block text-gray-700 py-2">Services</a>
            <a href="#" class="block text-gray-700 py-2">Contact</a>
        </div>
    </nav>

   <!-- ✅ Fully Responsive Add Client Modal - Now Above All Content -->
<div id="addClientModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-[9999] hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto relative">
        <button onclick="toggleModal()" class="absolute top-2 right-2 text-red-600 text-2xl font-bold">&times;</button>
        <h2 class="text-xl font-semibold mb-4 text-center text-red-600">Add New Client</h2>

        <!-- ✅ Form -->
        <form id="addClientForm" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Name:</label>
                    <input type="text" name="name" class="w-full p-2 border rounded focus:ring focus:ring-red-300" required>
                </div>
                <div>
                    <label class="block font-medium">Age:</label>
                    <input type="number" name="age" class="w-full p-2 border rounded focus:ring focus:ring-red-300" required>
                </div>

                <div>
                    <label class="block font-medium">Gender:</label>
                    <select name="gender" class="w-full p-2 border rounded focus:ring focus:ring-red-300">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div>
                    <label class="block font-medium">Followers:</label>
                    <input type="number" name="followers" class="w-full p-2 border rounded focus:ring focus:ring-red-300" required>
                </div>
            </div>

            <div class="mt-2">
                <label class="block font-medium">Category:</label>
                <select name="category" class="w-full p-2 border rounded focus:ring focus:ring-red-300">
                    <option value="Live Streaming Host">Live Streaming Host</option>
                    <option value="YouTubers">YouTubers</option>
                    <option value="Social Media Influencers">Social Media Influencers</option>
                    <option value="Bollywood Artist">Bollywood Artist</option>
                    <option value="Mobile/PC Gamers">Mobile/PC Gamers</option>
                    <option value="Short Video Creators">Short Video Creators</option>
                    <option value="Podcast Hosts">Podcast Hosts</option>
                    <option value="Lifestyle Bloggers/Vloggers">Lifestyle Bloggers/Vloggers</option>
                    <option value="Fitness Influencers">Fitness Influencers</option>
                </select>
            </div>

            <div class="mt-2">
                <label class="block font-medium">Languages:</label>
                <select name="language[]" class="w-full p-2 border rounded focus:ring focus:ring-red-300" multiple>
                    <option value="Hindi">Hindi</option>
                    <option value="English">English</option>
                    <option value="Bengali">Bengali</option>
                    <option value="Telugu">Telugu</option>
                    <option value="Marathi">Marathi</option>
                    <option value="Tamil">Tamil</option>
                    <option value="Urdu">Urdu</option>
                    <option value="Gujarati">Gujarati</option>
                    <option value="Malayalam">Malayalam</option>
                    <option value="Kannada">Kannada</option>
                    <option value="Odia">Odia</option>
                    <option value="Punjabi">Punjabi</option>
                </select>
            </div>

            <div class="mt-2">
                <label class="block font-medium">Professional:</label>
                <select name="professional" class="w-full p-2 border rounded focus:ring focus:ring-red-300">
                    <option value="Artist">Artist</option>
                    <option value="Employee">Employee</option>
                </select>
            </div>

            <div class="mt-2">
                <label class="block font-medium">Upload Image:</label>
                <input type="file" name="image" class="w-full p-2 border rounded focus:ring focus:ring-red-300" accept="image/*" required>
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded w-full hover:bg-green-600">
                    Submit
                </button>
            </div>
        </form>

        <button onclick="toggleModal()" class="mt-4 text-red-500 w-full text-center">Cancel</button>
    </div>
</div>

<!-- ✅ Hero Section -->
<div class="relative w-full overflow-hidden">
    <div id="heroCarousel" class="flex transition-transform duration-700 ease-in-out">
        <img src="/images/Artist-images/slot-1/refactor-v1/Ambika_Arora.webp" class="hero-img">
        <img src="/images/Artist-images/slot-1/refactor-v1/Anchal_Thakur.webp" class="hero-img">
        <img src="/images/Artist-images/slot-1/refactor-v1/Annupriya_singh.webp" class="hero-img">
        <img src="/images/Artist-images/slot-1/refactor-v1/Madhu.webp" class="hero-img">
        <img src="/images/Artist-images/slot-1/refactor-v1/Priyanka_Taras.webp" class="hero-img">
        <img src="/images/Artist-images/slot-1/refactor-v1/Shereen_A_Bannsal.webp" class="hero-img">
        <img src="/images/Artist-images/slot-1/refactor-v1/Shivangi_Ghosh.webp" class="hero-img">
        <img src="/images/Artist-images/slot-1/refactor-v1/Twinkle_Sharma.webp" class="hero-img">
    </div>

    <!-- ✅ Navigation Buttons -->
    <button id="prevHero" class="hero-btn left-4">❮</button>
    <button id="nextHero" class="hero-btn right-4">❯</button>
</div>

<!-- ✅ CTA Section -->
<div class="relative bg-gradient-to-r from-red-500 to-pink-600 text-white py-16 px-8 text-center">
    <h2 class="text-4xl font-bold tracking-wide leading-tight font-montserrat">
        Show Your Talent? <br> Call Us Now to Know How!
    </h2>
    <p class="mt-4 text-lg font-light max-w-2xl mx-auto font-poppins">
        Join our exclusive agency and take your career to the next level. 
        We help models, influencers, and artists get discovered and work with top brands.
    </p>
    
    <!-- ✅ Call Us Button -->
    <button class="mt-6 px-6 py-3 bg-white text-red-600 font-semibold text-lg rounded-full shadow-lg transition duration-300 hover:scale-105 hover:shadow-xl">
        Call Us Now
    </button>
</div>




<div class="max-w-7xl mx-auto p-4">
    <h2 class="text-3xl font-bold text-center text-red-600 mb-6">All Clients</h2>

    <!-- ✅ Filters Section -->
<div class="flex flex-wrap justify-center gap-4 mb-6 bg-white shadow-md rounded-lg p-4">
    <select id="filterCategory" class="filter-dropdown">
        <option value="">All Categories</option>
        <option value="Live Streaming Host">Live Streaming Host</option>
        <option value="YouTubers">YouTubers</option>
        <option value="Social Media Influencers">Social Media Influencers</option>
        <option value="Bollywood Artist">Bollywood Artist</option>
        <option value="Mobile/PC Gamers">Mobile/PC Gamers</option>
        <option value="Short Video Creators">Short Video Creators</option>
        <option value="Podcast Hosts">Podcast Hosts</option>
        <option value="Lifestyle Bloggers/Vloggers">Lifestyle Bloggers/Vloggers</option>
        <option value="Fitness Influencers">Fitness Influencers</option>
    </select>

    <select id="filterGender" class="filter-dropdown">
        <option value="">All Genders</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>

    <select id="filterAge" class="filter-dropdown">
        <option value="">All Ages</option>
        <option value="18-25">18-25</option>
        <option value="26-35">26-35</option>
        <option value="36-45">36-45</option>
        <option value="46+">46+</option>
    </select>

    <select id="filterLanguage" class="filter-dropdown">
        <option value="">All Languages</option>
        <option value="Hindi">Hindi</option>
        <option value="English">English</option>
        <option value="Bengali">Bengali</option>
        <option value="Telugu">Telugu</option>
    </select>

    <select id="filterProfessional" class="filter-dropdown">
        <option value="">All Professionals</option>
        <option value="Artist">Artist</option>
        <option value="Employee">Employee</option>
    </select>

    <button onclick="fetchClients(1)" class="apply-filter-btn">Apply Filters</button>
</div>


     <!-- ✅ Clients Grid -->
     <div id="clientsList" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Clients will be loaded here dynamically -->
    </div>



    <!-- ✅ Pagination -->
    <div class="mt-6 flex justify-center" id="paginationControls"></div>
</div>





    <script>
       function toggleModal() {
        const modal = document.getElementById("addClientModal");
        const body = document.body;

        if (modal.classList.contains("hidden")) {
            modal.classList.remove("hidden");
            body.classList.add("modal-open"); // ✅ Prevent background scrolling
        } else {
            modal.classList.add("hidden");
            body.classList.remove("modal-open");
        }
    }

    // ✅ Close modal when clicking outside the form
    window.addEventListener("click", function (event) {
        const modal = document.getElementById("addClientModal");
        if (event.target === modal) {
            toggleModal();
        }
    });

    // ✅ Close modal with Escape Key
    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            toggleModal();
        }
    });

        // ✅ Toggle Mobile Menu
        function toggleMobileMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }
    </script>

<script>
    document.getElementById("addClientForm").addEventListener("submit", async function (event) {
    event.preventDefault(); // Prevent default form submission

    let formData = new FormData(this);

    try {
        const response = await fetch("/admin/add_client.php", {
            method: "POST",
            body: formData
        });

        const textResponse = await response.text(); // Debug raw response
        console.log("Raw response:", textResponse);

        const result = JSON.parse(textResponse); // Convert to JSON
        if (result.status === "success") {
            alert("✅ Client added successfully!");
            location.reload();
        } else {
            alert("❌ Error: " + result.message);
        }
    } catch (error) {
        console.error("❌ Fetch Error:", error);
        alert("❌ Unexpected error. Check the console for details.");
    }
});

</script>

<script>
    let currentPage = 1;
    
    async function fetchClients(page = 1) {
        currentPage = page;

        const category = document.getElementById("filterCategory").value;
        const gender = document.getElementById("filterGender").value;
        const age = document.getElementById("filterAge").value;
        const language = document.getElementById("filterLanguage").value;
        const professional = document.getElementById("filterProfessional").value;

        let url = `admin/fetch_clients.php?page=${page}&category=${category}&gender=${gender}&age_group=${age}&language=${language}&professional=${professional}`;
        
        try {
            const response = await fetch(url);
            const data = await response.json();

            let clientsContainer = document.getElementById("clientsList");
            let paginationControls = document.getElementById("paginationControls");
            clientsContainer.innerHTML = "";

            data.clients.forEach(client => {
                let clientCard = `
                    <div class="relative group overflow-hidden rounded-lg shadow-lg transition hover:shadow-xl bg-white">
                        <div class="relative">
                            <!-- ✅ Image -->
                            <img src="${client.image_url}" alt="${client.name}" class="w-full h-[450px] object-cover rounded-md">
                            
                            <!-- ✅ Hover Overlay -->
                            <div class="absolute inset-0 bg-pink-600 bg-opacity-90 text-white flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 p-6 text-center hover-content">
                                <h3 class="font-montserrat">${client.name}</h3>
                                <p class="font-poppins mt-1">${client.category}</p>
                                <p class="font-poppins">Followers: <strong>${client.followers}</strong></p>
                                <p class="font-poppins">Age: ${client.age} | ${client.gender}</p>
                                <p class="font-poppins">Languages: ${client.language}</p>
                                <p class="font-poppins">Profession: ${client.professional}</p>

                                <!-- ✅ Icons for View Profile & Booking -->
                                <div class="flex gap-4 mt-4">
                                    <button class="px-5 py-2 bg-white text-pink-600 font-semibold rounded-lg hover:bg-gray-200 shadow-md btn-primary">
                                        <i class="fas fa-eye mr-2"></i> View Profile
                                    </button>
                                    <button class="px-5 py-2 bg-white text-pink-600 font-semibold rounded-lg hover:bg-gray-200 shadow-md btn-primary">
                                        <i class="fas fa-user-check mr-2"></i> Book Now
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- ✅ Name, Category, and Followers (Always Visible) -->
                        <div class="p-4 text-center">
                            <h3 class="client-name font-montserrat">${client.name}</h3>
                            <p class="client-category font-poppins">${client.category}</p>
                            <p class="client-followers font-poppins">Followers: <strong>${client.followers}</strong></p>
                        </div>
                    </div>
                `;
                clientsContainer.innerHTML += clientCard;
            });

            // ✅ Pagination controls
            let totalPages = Math.ceil(data.total_clients / 10);
            paginationControls.innerHTML = `
                <button onclick="fetchClients(${Math.max(1, currentPage - 1)})" class="px-3 py-2 bg-red-600 text-white rounded-lg mx-1 ${currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-red-700'}">Prev</button>
                <span class="px-4 py-2 text-lg font-semibold">${currentPage} / ${totalPages}</span>
                <button onclick="fetchClients(${Math.min(totalPages, currentPage + 1)})" class="px-3 py-2 bg-red-600 text-white rounded-lg mx-1 ${currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : 'hover:bg-red-700'}">Next</button>
            `;
        } catch (error) {
            console.error("Error fetching clients:", error);
        }
    }

    window.onload = () => fetchClients(1);
</script>

<script>
    const heroCarousel = document.getElementById("heroCarousel");
    const heroImages = document.querySelectorAll(".hero-img");
    const totalSlides = heroImages.length;
    let currentHeroIndex = 0;
    let visibleSlides = getVisibleSlides(); // ✅ Detect screen size

    function getVisibleSlides() {
        if (window.innerWidth < 768) return 1; // ✅ Mobile: 1 image per scroll
        if (window.innerWidth < 1024) return 2; // ✅ Tablet: 2 images per scroll
        return 4; // ✅ PC: 4 images per scroll
    }

    function updateHeroSlide() {
        heroCarousel.style.transform = `translateX(-${currentHeroIndex * (100 / visibleSlides)}%)`;
    }

    function autoScrollHero() {
        if (currentHeroIndex < totalSlides - visibleSlides) {
            currentHeroIndex++;
        } else {
            currentHeroIndex = 0;
        }
        updateHeroSlide();
    }

    let heroInterval = setInterval(autoScrollHero, 5000); // ✅ Change slide every 5 seconds

    document.getElementById("prevHero").addEventListener("click", () => {
        if (currentHeroIndex > 0) {
            currentHeroIndex--;
        } else {
            currentHeroIndex = totalSlides - visibleSlides;
        }
        updateHeroSlide();
        resetInterval();
    });

    document.getElementById("nextHero").addEventListener("click", () => {
        if (currentHeroIndex < totalSlides - visibleSlides) {
            currentHeroIndex++;
        } else {
            currentHeroIndex = 0;
        }
        updateHeroSlide();
        resetInterval();
    });

    function resetInterval() {
        clearInterval(heroInterval);
        heroInterval = setInterval(autoScrollHero, 5000);
    }

    // ✅ Detect screen resize and adjust visible slides dynamically
    window.addEventListener("resize", () => {
        visibleSlides = getVisibleSlides();
        updateHeroSlide();
    });
</script>











</body>
</html>
