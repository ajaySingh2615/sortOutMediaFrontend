<?php
session_start();
require './includes/db_connect.php';

// ✅ Store success message (if any)
$message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
unset($_SESSION['message']); // Clear the session message after displaying
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Models Agency</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Tailwind CSS -->
      <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/modal_agency/style.css">
</head>
<body class="bg-gray-100">

    <!-- ✅ Success Message Div (Initially Hidden) -->
<div id="successMessage" 
    class="hidden fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white text-lg font-semibold px-6 py-3 rounded-lg shadow-lg z-[9999]">
    <strong>Success!</strong> Your profile has been submitted successfully. It will be visible after admin approval.
</div>


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
                    <!-- ✅ Create Profile Button in Navbar -->
<!-- ✅ Create Profile Button in Navbar -->
<button id="createProfileBtn" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
    Create Profile
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

   <!-- ✅ Create Profile Selection Modal -->
<div id="profileSelectionModal" class="fixed inset-0 bg-gray-800 bg-opacity-60 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-sm md:max-w-md lg:max-w-lg transform scale-95 transition duration-300">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">Choose Profile Type</h2>

        <div class="flex flex-col md:flex-row gap-4 justify-center">
            <button onclick="openClientForm('Artist')" class="w-full md:w-1/2 px-6 py-3 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-600 transition-all duration-200">
                🎭 Artist
            </button>
            <button onclick="openClientForm('Employee')" class="w-full md:w-1/2 px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition-all duration-200">
                💼 Employee
            </button>
        </div>

        <button onclick="closeSelectionModal()" class="mt-6 w-full text-red-500 font-semibold hover:underline text-center">Cancel</button>
    </div>
</div>

 <!-- ✅ Profile Submission Form Modal -->
 <div id="addClientModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-lg max-h-[85vh] overflow-y-auto relative">
            <button onclick="closeAddClientForm()" class="absolute top-4 right-4 text-gray-600 hover:text-red-500 text-2xl font-bold">&times;</button>
            
            <h2 class="text-2xl font-bold mb-6 text-center text-red-600">Add Profile</h2>

            <form id="addClientForm" enctype="multipart/form-data" class="space-y-4">
            
            <!-- ✅ Professional Field (Locked) -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Professional</label>
                <div class="relative">
                    <input type="text" id="professionalField" name="professional" 
                           class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 focus:ring-red-300 focus:border-red-500" readonly>
                    <span class="absolute right-4 top-3 text-gray-500"><i class="fas fa-user-tie"></i></span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-300 focus:border-red-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Age</label>
                    <input type="number" name="age" 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-300 focus:border-red-500" required>
                </div>
            </div>

            <div>
    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
    <input type="tel" name="phone" 
           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-300 focus:border-red-500"
           placeholder="Enter phone number"
           pattern="[0-9]{10}" 
           required>
</div>


            <div>
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-300 focus:border-red-500">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <!-- ✅ Dynamic Field: Followers for Artist, Experience for Employee -->
            <div>
                <label class="block text-sm font-medium text-gray-700" id="dynamicFieldLabel">Followers</label>
                <input type="text" id="dynamicField" name="followers" 
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-300 focus:border-red-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-300 focus:border-red-500">
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

            <div>
                <label class="block text-sm font-medium text-gray-700">Languages</label>
                <select name="language[]" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-300 focus:border-red-500" multiple>
                    <option value="Hindi">Hindi</option>
                    <option value="English">English</option>
                    <option value="Bengali">Bengali</option>
                    <option value="Telugu">Telugu</option>
                </select>
            </div>

            <div>
    <label class="block text-sm font-medium text-gray-700">
        Upload Image <span class="text-red-500">*</span>
    </label>
    <input type="file" name="image"
           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-300 focus:border-red-500"
           accept="image/*" required>
    <p class="mt-2 text-sm text-gray-500">
        Please upload an image with a resolution of <strong>720 × 1280 px</strong> (9:16 aspect ratio) to ensure proper display.
    </p>
</div>


            <!-- ✅ Submit Button with Loading -->
<div class="mt-6">
    <button type="submit" id="submitBtn" 
            class="w-full py-3 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 flex items-center justify-center">
        <span id="submitText">Submit</span>
        <span id="loadingSpinner" class="hidden ml-2 w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
    </button>
</div>

        </form>

        <button onclick="closeAddClientForm()" 
                class="mt-4 w-full text-red-500 font-semibold hover:underline text-center">
            Cancel
        </button>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        // ✅ Hide modals on page load
        document.getElementById("profileSelectionModal").classList.add("hidden");
        document.getElementById("addClientModal").classList.add("hidden");

        // ✅ Remove any "flex" class that might cause auto-opening
        document.getElementById("profileSelectionModal").classList.remove("flex");
        document.getElementById("addClientModal").classList.remove("flex");

        // ✅ Attach event listener to "Create Profile" button
        document.getElementById("createProfileBtn").addEventListener("click", function () {
            showSelectionModal();
        });
    });

    // ✅ Show Selection Modal
    function showSelectionModal() {
        const modal = document.getElementById("profileSelectionModal");
        if (modal) {
            modal.classList.remove("hidden");
            modal.classList.add("flex");
            modal.style.opacity = "1";
            modal.style.visibility = "visible";
            document.body.classList.add("modal-open");
        }
    }

    // ✅ Close Selection Modal
    function closeSelectionModal() {
        const modal = document.getElementById("profileSelectionModal");
        if (modal) {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
            modal.style.opacity = "0";
            modal.style.visibility = "hidden";
            document.body.classList.remove("modal-open");
        }
    }

    // ✅ Open Add Profile Form Based on Selection
    function openClientForm(type) {
        closeSelectionModal();
        const clientModal = document.getElementById("addClientModal");

        if (clientModal) {
            clientModal.classList.remove("hidden");
            clientModal.classList.add("flex");
            clientModal.style.opacity = "1";
            clientModal.style.visibility = "visible";
        }

        // ✅ Set Professional Type (Readonly)
        const professionalField = document.getElementById("professionalField");
        if (professionalField) {
            professionalField.value = type;
            professionalField.setAttribute("readonly", true);
        }

        // ✅ Adjust Dynamic Field (Followers or Experience)
        let dynamicField = document.getElementById("dynamicField");
        let dynamicFieldLabel = document.getElementById("dynamicFieldLabel");

        if (type === "Employee") {
            dynamicFieldLabel.innerText = "Experience (Years):";
            dynamicField.name = "experience";
            dynamicField.placeholder = "Enter Experience in Years";
        } else {
            dynamicFieldLabel.innerText = "Followers:";
            dynamicField.name = "followers";
            dynamicField.placeholder = "Enter Followers Count";
        }
    }

    // ✅ Close Add Profile Form
    function closeAddClientForm() {
        const clientModal = document.getElementById("addClientModal");
        if (clientModal) {
            clientModal.classList.add("hidden");
            clientModal.classList.remove("flex");
            clientModal.style.opacity = "0";
            clientModal.style.visibility = "hidden";
        }
    }

    // ✅ Close modals when clicking outside
    window.addEventListener("click", function (event) {
        const profileModal = document.getElementById("profileSelectionModal");
        const clientModal = document.getElementById("addClientModal");

        if (event.target === profileModal) {
            closeSelectionModal();
        }
        if (event.target === clientModal) {
            closeAddClientForm();
        }
    });

    // ✅ Close modals when pressing Escape key
    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            closeSelectionModal();
            closeAddClientForm();
        }
    });
</script>









<!-- ✅ Hero Section -->
<div class="hero-container">
    <div id="heroCarousel" class="carousel">
        <!-- ✅ Wrapping each image inside a container to prevent distortion -->
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized-update/Ambika_Arora.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized-update/Anchal_Thakur.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized-update/Madhu.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized-update/Nancy_Khatri.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized-update/Priyanka_Taras.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized-update/Shereen_A_Bannsal.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized-update/Shivangi_Ghosh.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized-update/Twinkle_Sharma.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized-update/Vinuja.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized_new/Aishwarya_Sanglikar.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized_new/Arnav_Mathur.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized_new/Dia_Bajaj.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized_new/Iris_Vatrana.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized_new/Manav_Mongia.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized_new/Manisha_sharma.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized_new/Moumita_Mukherjee.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized_new/Naveena_Kapoor.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized_new/Niharika_shara.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized_new/Pooja_Singh.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized_new/Shambhavi_Sharma-2.png" class="hero-img"></div>
        <div class="hero-slide"><img src="/images/Artist-images/iloveimg-resized_new/Shambhavi_Sharma.png" class="hero-img"></div>
        
    </div>

     <!-- ✅ Navigation Buttons -->
     <button id="prevHero" class="hero-btn left-btn">❮</button>
    <button id="nextHero" class="hero-btn right-btn">❯</button>
</div>


<!-- ✅ Clients Logo Section -->
<div class="w-full bg-gray-100 py-12">
    <h2 class="text-3xl lg:text-4xl font-bold text-center text-gray-800 mb-6">Our Trusted Clients</h2>

    <!-- ✅ Clients Logo Grid (Desktop) -->
    <div class="hidden lg:grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 justify-center items-center max-w-6xl mx-auto">
        <img src="/images/company-images/improved-logos/chingari1.jpeg" alt="Client 1" class="client-logo">
        <img src="/images/company-images/improved-logos/disco2.jpeg" alt="Client 2" class="client-logo">
        <img src="/images/company-images/improved-logos/josh13.jpeg" alt="Client 3" class="client-logo">
        <img src="/images/company-images/improved-logos/me4.jpeg" alt="Client 4" class="client-logo">
        <img src="/images/company-images/improved-logos/meesho14.png" alt="Client 5" class="client-logo">
    </div>

    <!-- ✅ Clients Logo Carousel (Mobile) -->
    <div class="lg:hidden overflow-hidden relative w-full max-w-4xl mx-auto">
        <div class="flex whitespace-nowrap animate-slide">
            <img src="/images/company-images/improved-logos/chingari1.jpeg" alt="Client 1" class="client-logo">
            <img src="/images/company-images/improved-logos/disco2.jpeg" alt="Client 2" class="client-logo">
            <img src="/images/company-images/improved-logos/josh13.jpeg" alt="Client 3" class="client-logo">
            <img src="/images/company-images/improved-logos/me4.jpeg" alt="Client 4" class="client-logo">
            <img src="/images/company-images/improved-logos/meesho14.png" alt="Client 5" class="client-logo">
        </div>
    </div>
</div>

<!-- ✅ Categories Showcase Section -->
<div class="relative w-full h-auto py-20 bg-cover bg-center" style="background-image: url('/images/background-image-2.jpg');">
    
    <!-- ✅ Overlay for better readability -->
    <div class="absolute inset-0 bg-black bg-opacity-70"></div>

    <!-- ✅ Content Container -->
    <div class="relative z-10 text-center text-white max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 font-[Montserrat]">Explore Our Categories</h2>
        
        <!-- ✅ Categories Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="category-box bg-red-500 hover:bg-red-600">Live Streaming Host</div>
            <div class="category-box bg-blue-500 hover:bg-blue-600">YouTubers</div>
            <div class="category-box bg-yellow-500 hover:bg-yellow-600">Social Media Influencers</div>
            <div class="category-box bg-green-500 hover:bg-green-600">Hollywood Artist</div>
            <div class="category-box bg-purple-500 hover:bg-purple-600">Mobile/PC Gamers</div>
            <div class="category-box bg-orange-500 hover:bg-orange-600">Short Video Creators</div>
            <div class="category-box bg-pink-500 hover:bg-pink-600">Podcast Hosts</div>
            <div class="category-box bg-indigo-500 hover:bg-indigo-600">Lifestyle Bloggers/Vloggers</div>
            <div class="category-box bg-teal-500 hover:bg-teal-600">Fitness Influencers</div>
        </div>
    </div>
</div>


<div class="max-w-7xl mx-auto p-4">
    <h2 class="text-3xl font-bold text-center text-red-600 mb-6">All Clients</h2>

    <!-- ✅ Filters Section -->
<div class="flex flex-wrap justify-center gap-4 mb-6 rounded-lg p-4">
    <select id="filterCategory" class="filter-dropdown">
        <option value="">Categories</option>
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
        <option value="">Genders</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>

    <select id="filterAge" class="filter-dropdown">
        <option value="">Ages</option>
        <option value="18-25">18-25</option>
        <option value="26-35">26-35</option>
        <option value="36-45">36-45</option>
        <option value="46+">46+</option>
    </select>

    <select id="filterLanguage" class="filter-dropdown">
        <option value="">Languages</option>
        <option value="Hindi">Hindi</option>
        <option value="English">English</option>
        <option value="Bengali">Bengali</option>
        <option value="Telugu">Telugu</option>
    </select>

    <select id="filterProfessional" class="filter-dropdown">
        <option value="">Professionals</option>
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
        // ✅ Toggle Mobile Menu
        function toggleMobileMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const addClientForm = document.getElementById("addClientForm");
        const submitBtn = document.getElementById("submitBtn");
        const submitText = document.getElementById("submitText");
        const loadingSpinner = document.getElementById("loadingSpinner");
        const successMessage = document.getElementById("successMessage"); // ✅ Ensure this exists

        if (!addClientForm) {
            console.error("❌ addClientForm not found!");
            return;
        }

        addClientForm.addEventListener("submit", async function (event) {
            event.preventDefault(); // Prevent default form submission

            // ✅ Show Loading Spinner & Disable Button
            submitText.textContent = "Submitting...";
            loadingSpinner.classList.remove("hidden");
            submitBtn.disabled = true;
            submitBtn.classList.add("opacity-50", "cursor-not-allowed");

            let formData = new FormData(addClientForm);

            try {
                const response = await fetch("/admin/add_client.php", {
                    method: "POST",
                    body: formData
                });

                const textResponse = await response.text();
                console.log("Raw response:", textResponse);

                const result = JSON.parse(textResponse);
                if (result.status === "success") {
                    // ✅ Show Success Message
                    successMessage.classList.remove("hidden");
                    successMessage.innerHTML = `<strong>Success!</strong> Your profile has been submitted successfully. It will be visible after admin approval.`;

                    // ✅ Hide Success Message After 5 Seconds
                    setTimeout(() => {
                        successMessage.classList.add("hidden");
                    }, 5000);

                    // ✅ Reset Form Fields
                    addClientForm.reset();

                    // ✅ Close Add Profile Form
                    closeAddClientForm();

                    // ✅ Fetch Only Approved Clients
                    fetchClients();
                } else {
                    alert("❌ Error: " + result.message);
                }
            } catch (error) {
                console.error("❌ Fetch Error:", error);
                alert("❌ Unexpected error. Check the console for details.");
            } finally {
                // ✅ Reset Button After Submission
                submitText.textContent = "Submit";
                loadingSpinner.classList.add("hidden");
                submitBtn.disabled = false;
                submitBtn.classList.remove("opacity-50", "cursor-not-allowed");
            }
        });

        // ✅ Fetch Approved Clients Function
        async function fetchClients(page = 1) {
            const clientsContainer = document.getElementById("clientsList");
            const paginationControls = document.getElementById("paginationControls");

            if (!clientsContainer) {
                console.error("❌ clientsList element not found!");
                return;
            }

            let url = `/admin/fetch_clients.php?page=${page}`;

            try {
                const response = await fetch(url);
                const data = await response.json();

                clientsContainer.innerHTML = "";

                if (data.clients.length === 0) {
                    clientsContainer.innerHTML = `<p class="text-center text-gray-600">No approved profiles available yet.</p>`;
                } else {
                    data.clients.forEach(client => {
                        let additionalInfo = client.professional === "Employee"
                            ? `<p class="font-poppins">Experience: <strong>${client.experience}-Years</strong></p>` 
                            : `<p class="font-poppins">Followers: <strong>${client.followers}</strong></p>`; 

                            let clientCard = `
    <div class="relative group overflow-hidden rounded-lg shadow-lg transition hover:shadow-xl bg-white">
        <div class="relative w-full aspect-[9/16]">
            <img src="${client.image_url}" alt="${client.name}" class="w-full h-full object-contain rounded-md">
            <div class="absolute inset-0 bg-pink-600 bg-opacity-90 text-white flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 p-6 text-center">
                <h3 class="font-montserrat">${client.name}</h3>
                <p class="font-poppins mt-1">${client.category}</p>
                <p class="font-poppins">Age: ${client.age} | ${client.gender}</p>
                <p class="font-poppins">Languages: ${client.language}</p>
                <p class="font-poppins">Profession: ${client.professional}</p>
                ${additionalInfo}
                <button class="px-5 py-2 mt-3 bg-white text-pink-600 font-semibold rounded-lg hover:bg-gray-200 shadow-md btn-primary">
                    <i class="fas fa-user-check mr-2"></i> Book Now
                </button>
            </div>
        </div>
        <div class="p-4 text-center">
            <h3 class="client-name font-montserrat">${client.name}</h3>
            <p class="client-category font-poppins">${client.category}</p>
            ${additionalInfo}
        </div>
    </div>
`;


                        clientsContainer.innerHTML += clientCard;
                    });
                }
            } catch (error) {
                console.error("Error fetching clients:", error);
            }
        }

        // ✅ Close Add Profile Form
        function closeAddClientForm() {
            const clientModal = document.getElementById("addClientModal");
            if (clientModal) {
                clientModal.classList.add("hidden");
                clientModal.classList.remove("flex");
                clientModal.style.opacity = "0";
                clientModal.style.visibility = "hidden";
            }
        }

        // ✅ Fetch Clients on Page Load
        fetchClients();
    });
</script>





<script>
    const heroCarousel = document.getElementById("heroCarousel");
const heroSlides = document.querySelectorAll(".hero-slide");
const totalSlides = heroSlides.length;
let currentHeroIndex = 0;
let visibleSlides = 4; // ✅ 4 images per row

function updateHeroSlide() {
    heroCarousel.style.transform = `translateX(-${currentHeroIndex * (100 / visibleSlides)}%)`;
}

/* ✅ Auto-Scroll One Image at a Time */
function autoScrollHero() {
    if (currentHeroIndex < totalSlides - visibleSlides) {
        currentHeroIndex++;
    } else {
        currentHeroIndex = 0; // ✅ Reset to first slide
    }
    updateHeroSlide();
}

let heroInterval = setInterval(autoScrollHero, 3000); // ✅ Auto-scroll every 3s

/* ✅ Manual Navigation (Previous & Next Buttons) */
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

/* ✅ Reset Auto-Scroll Interval After Manual Interaction */
function resetInterval() {
    clearInterval(heroInterval);
    heroInterval = setInterval(autoScrollHero, 3000);
}

/* ✅ Handle Screen Resize */
window.addEventListener("resize", () => {
    if (window.innerWidth < 768) {
        visibleSlides = 1; // ✅ 1 image per row (Mobile)
    } else if (window.innerWidth < 1024) {
        visibleSlides = 2; // ✅ 2 images per row (Tablet)
    } else {
        visibleSlides = 4; // ✅ 4 images per row (Desktop)
    }
    updateHeroSlide();
});

/* ✅ Add Keyboard Navigation */
document.addEventListener("keydown", (event) => {
    if (event.key === "ArrowRight") {
        document.getElementById("nextHero").click();
    }
    if (event.key === "ArrowLeft") {
        document.getElementById("prevHero").click();
    }
});

</script>

<!-- ✅ Fully Responsive About Section -->
<div class="relative w-full h-auto lg:h-[80vh] flex flex-col lg:flex-row items-center bg-cover bg-center" 
    style="background-image: url('/images/section-background-1.jpg');">
    
    <!-- ✅ Right Side Black Overlay (Covers Entire Background on Mobile) -->
    <div class="absolute inset-0 bg-black bg-opacity-70 lg:w-1/2 lg:right-0 lg:inset-auto"></div>

    <!-- ✅ Content Section (Now Centered on Mobile, Left on Large Screens) -->
    <div class="relative z-10 w-full lg:w-1/2 ml-auto px-6 lg:px-16 py-12 text-white text-center lg:text-left">
        <h2 class="text-4xl lg:text-5xl font-bold font-[Montserrat]">About Agency</h2>
        <p class="text-red-400 text-xl lg:text-2xl italic font-[Dancing Script] mt-2">Something You Need to Know</p>

        <p class="mt-4 text-md lg:text-lg font-light leading-relaxed font-[Poppins]">
            We are a leading talent agency helping **models, influencers, and artists** showcase their potential and collaborate with top brands.  
            With a vast network in the **entertainment & fashion industry**, we bring talent closer to their dreams.
        </p>

        <p class="mt-4 text-md lg:text-lg font-light font-[Poppins]">
            Our agency believes in **creativity, excellence, and building long-lasting relationships** with artists. Whether you're a rising star or an experienced professional, we provide the right platform to grow and shine.
        </p>

        <!-- ✅ About Us Button -->
        <button class="mt-6 px-6 lg:px-8 py-3 bg-red-500 text-white text-md lg:text-lg font-semibold rounded-full shadow-lg transition-all duration-300 hover:scale-105 hover:bg-red-600">
            ABOUT US
        </button>
    </div>
</div>


<!-- ✅ Engaging Call-to-Action (CTA) Section -->
<div class="relative bg-gradient-to-r from-red-600 to-pink-500 text-white py-20 px-8 text-center">
    <h2 class="text-5xl font-extrabold tracking-wide leading-tight font-montserrat animate-fade-in">
        🚀 Show Your Talent?  
        <br> Call Us Now to Know How! 🎭
    </h2>
    
    <p class="mt-4 text-lg font-light max-w-3xl mx-auto font-poppins animate-slide-up">
        Ready to take your career to the next level? Whether you're an **influencer, model, or artist**, we help you get discovered by top brands!  
        Don't miss out on amazing opportunities.
    </p>

    <!-- ✅ Call Now Button with Animation -->
    <button onclick="callNow()" class="mt-6 px-8 py-4 bg-white text-red-600 font-semibold text-xl rounded-full shadow-lg transition-all duration-300 hover:scale-110 hover:shadow-2xl animate-bounce">
        📞 Call Us Now
    </button>

    <!-- ✅ Floating Call Icon -->
    <div class="absolute bottom-6 right-6 hidden md:block animate-pulse">
        <a href="tel:+911234567890" class="bg-white text-red-600 p-4 rounded-full shadow-xl hover:scale-110 transition">
            📞
        </a>
    </div>
</div>

<script>
    function callNow() {
        window.location.href = "tel:+911234567890"; // Replace with your actual phone number
    }
</script>

<!-- ✅ Footer Section -->
<footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

        <!-- ✅ About Us -->
        <div>
            <h3 class="text-xl font-bold text-red-500 mb-4">About Us</h3>
            <p class="text-sm text-gray-300">
                We are a leading agency helping influencers, artists, and brands connect for the best collaborations.  
                Join us to showcase your talent and grow!
            </p>
        </div>

        <!-- ✅ Quick Links -->
        <div>
            <h3 class="text-xl font-bold text-red-500 mb-4">Quick Links</h3>
            <ul class="space-y-2">
                <li><a href="#" class="text-gray-400 hover:text-red-400 transition">Home</a></li>
                <li><a href="#" class="text-gray-400 hover:text-red-400 transition">About</a></li>
                <li><a href="#" class="text-gray-400 hover:text-red-400 transition">Services</a></li>
                <li><a href="#" class="text-gray-400 hover:text-red-400 transition">Contact</a></li>
            </ul>
        </div>

        <!-- ✅ Contact Info -->
        <div>
            <h3 class="text-xl font-bold text-red-500 mb-4">Contact</h3>
            <p class="text-sm text-gray-300">📍 Location: Mumbai, India</p>
            <p class="text-sm text-gray-300">📞 Phone: +91 98765 43210</p>
            <p class="text-sm text-gray-300">📧 Email: info@agency.com</p>
        </div>

        <!-- ✅ Social Media -->
        <div>
            <h3 class="text-xl font-bold text-red-500 mb-4">Follow Us</h3>
            <div class="flex space-x-4">
                <a href="#" class="social-icon bg-blue-500"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon bg-pink-500"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon bg-blue-400"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon bg-red-600"><i class="fab fa-youtube"></i></a>
            </div>
        </div>

    </div>

    <!-- ✅ Copyright -->
    <div class="text-center text-gray-500 text-sm mt-8 border-t border-gray-700 pt-4">
        &copy; 2025 Your Agency Name. All Rights Reserved.
    </div>
</footer>


</body>
</html>
