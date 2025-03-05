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
<style>

  /* ✅ Ensure modals are hidden on page load */
#profileSelectionModal,
#addClientModal {
    display: none; /* Hide initially */
}

/* ✅ Fix modal positioning and ensure it's above all content */
#profileSelectionModal,
#addClientModal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 99999; /* Keep modal always on top */
    background-color: rgba(0, 0, 0, 0.7); /* Dark overlay */
    display: none; /* Hide until triggered */
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
}

/* ✅ Show modal when it's active */
#profileSelectionModal.flex,
#addClientModal.flex {
    display: flex;
    opacity: 1;
    visibility: visible;
}

/* ✅ Ensure modal content is centered */
#profileSelectionModal > div,
#addClientModal > div {
    background: white;
    padding: 24px;
    border-radius: 12px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.3);
    max-width: 400px;
    text-align: center;
    transform: scale(0.9);
    transition: transform 0.3s ease-in-out;
}

/* ✅ Ensure smooth scale-in effect */
#profileSelectionModal.flex > div,
#addClientModal.flex > div {
    transform: scale(1);
}

/* ✅ Button Styling */
.modal-button {
    font-size: 18px;
    font-weight: 600;
    padding: 12px;
    transition: all 0.3s ease-in-out;
    border-radius: 8px;
    width: 100%;
}

/* ✅ Hover Effects */
.modal-button:hover {
    transform: scale(1.05);
}

/* ✅ Close Button */
.modal-close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 20px;
    font-weight: bold;
    color: #e63946;
    cursor: pointer;
}

/* ✅ Prevent background scrolling when modal is open */
body.modal-open {
    overflow: hidden;
}

/* ✅ Responsive Design */
@media (max-width: 768px) {
    #profileSelectionModal > div,
    #addClientModal > div {
        max-width: 90%;
    }
}

/* ✅ Center Modal & Enhance Appearance */
#addClientModal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 99999;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
}

/* ✅ Show Modal */
#addClientModal.flex {
    opacity: 1;
    visibility: visible;
}

/* ✅ Stylish Form Container */
#addClientModal > div {
    background: white;
    padding: 28px;
    border-radius: 15px;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3);
    max-width: 450px;
    text-align: center;
    transform: scale(0.9);
    transition: transform 0.3s ease-in-out;
}

/* ✅ Animate Modal Appearance */
#addClientModal.flex > div {
    transform: scale(1);
}

/* ✅ Improve Input & Select Fields */
#addClientModal input,
#addClientModal select {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    transition: border 0.2s ease-in-out;
}

/* ✅ Focus Effect on Inputs */
#addClientModal input:focus,
#addClientModal select:focus {
    border: 1px solid #ff4757;
    outline: none;
    box-shadow: 0 0 6px rgba(255, 71, 87, 0.2);
}

/* ✅ Submit Button Styling */
#addClientModal button[type="submit"] {
    padding: 12px;
    font-size: 16px;
    font-weight: bold;
    background-color: #28a745;
    color: white;
    border-radius: 8px;
    transition: background 0.3s ease-in-out;
}

#addClientModal button[type="submit"]:hover {
    background-color: #218838;
}

/* ✅ Responsive Design */
@media (max-width: 768px) {
    #addClientModal > div {
        max-width: 90%;
    }
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
        /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
        cursor: pointer;
    }

    .filter-dropdown:hover, .filter-dropdown:focus {
        border-color: #ff4757;
        /* box-shadow: 0 4px 8px rgba(255, 71, 87, 0.2); */
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

    /* ✅ Font Styles */
    .font-montserrat {
        font-family: 'Montserrat', sans-serif;
    }
    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }

    /* ✅ Animations */
    .animate-fade-in {
        animation: fadeIn 1.5s ease-in-out;
    }
    .animate-slide-up {
        animation: slideUp 1.2s ease-in-out;
    }
    .animate-bounce {
        animation: bounce 1.5s infinite;
    }
    .animate-pulse {
        animation: pulse 2s infinite;
    }

    /* ✅ Keyframes */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes slideUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

      /* ✅ Elegant Fonts */
    .font-montserrat {
        font-family: 'Montserrat', sans-serif;
    }
    .font-dancing {
        font-family: 'Dancing Script', cursive;
    }
    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }

    /* ✅ Client Logo Styling */
    .client-logo {
        max-width: 150px;
        height: auto;
        opacity: 0.8;
        transition: transform 0.3s ease, opacity 0.3s ease;
    }

    .client-logo:hover {
        transform: scale(1.1);
        opacity: 1;
    }

    /* ✅ Auto Scrolling Animation for Mobile */
    @keyframes slide {
        0% { transform: translateX(0); }
        100% { transform: translateX(-100%); }
    }

    .animate-slide {
        display: flex;
        animation: slide 10s linear infinite;
    }

    /* ✅ Category Box Styling */
    .category-box {
        font-size: 1.25rem;
        font-weight: bold;
        text-transform: uppercase;
        padding: 16px;
        border-radius: 12px;
        transition: all 0.3s ease-in-out;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.1);
    }

    /* ✅ Unique Random Styling for Placement */
    .category-box:nth-child(odd) {
        transform: rotate(-3deg);
    }

    .category-box:nth-child(even) {
        transform: rotate(3deg);
    }

    .category-box:hover {
        transform: scale(1.05) rotate(0deg);
        box-shadow: 0px 6px 15px rgba(255, 255, 255, 0.2);
    }

    /* ✅ Responsive Fixes */
    @media (max-width: 768px) {
        .category-box {
            font-size: 1rem;
            padding: 12px;
        }

        .category-box:nth-child(odd),
        .category-box:nth-child(even) {
            transform: rotate(0);
        }
    }

    /* ✅ Social Media Icon Styling */
    .social-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        color: white;
        font-size: 1.2rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .social-icon:hover {
        transform: scale(1.1);
        box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.2);
    }

    /* ✅ Responsive Fixes */
    @media (max-width: 768px) {
        .grid-cols-4 {
            grid-template-columns: 1fr 1fr;
            text-align: center;
        }

        .flex.space-x-4 {
            justify-content: center;
        }
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


<!-- ✅ Stylish Add Profile Form Modal -->
<div id="addClientModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-lg max-h-[85vh] overflow-y-auto relative">
        <button onclick="closeAddClientForm()" class="absolute top-4 right-4 text-gray-600 hover:text-red-500 text-2xl font-bold">&times;</button>
        
        <h2 class="text-2xl font-bold mb-6 text-center text-red-600">Add Profile</h2>

        <!-- ✅ Form -->
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
                <label class="block text-sm font-medium text-gray-700">Upload Image</label>
                <input type="file" name="image" 
                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-300 focus:border-red-500" 
                       accept="image/*" required>
            </div>

            <div class="mt-6">
                <button type="submit" 
                        class="w-full py-3 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600">
                    Submit
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
<div class="relative w-full overflow-hidden">
    <div id="heroCarousel" class="flex transition-transform duration-700 ease-in-out">
        <img src="/images/Artist-images/slot-1/Ambika_Arora.png" class="hero-img">
        <img src="/images/Artist-images/slot-1/Anchal_Thakur.png" class="hero-img">
        <img src="/images/Artist-images/slot-1/Annupriya_singh.png" class="hero-img">
        <img src="/images/Artist-images/slot-1/Shereen_A_Bannsal.png" class="hero-img">
        <img src="/images/Artist-images/slot-1/Shivangi_Ghosh.png" class="hero-img">
        <img src="/images/Artist-images/slot-1/Vinuja.png" class="hero-img">
        <img src="/images/Artist-images/slot-2/Aishwarya_Sanglikar.png" class="hero-img">
        <img src="/images/Artist-images/slot-2/Arnav_Mathur.png" class="hero-img">
        <img src="/images/Artist-images/slot-2/Iris_Vatrana.png" class="hero-img">
        <img src="/images/Artist-images/slot-2/Manav_Mongia.png" class="hero-img">
        <img src="/images/Artist-images/slot-2/Manisha_sharma.png" class="hero-img">
        <img src="/images/Artist-images/slot-2/Moumita_Mukherjee.png" class="hero-img">
        <img src="/images/Artist-images/slot-2/Naveena_Kapoor.png" class="hero-img">
        <img src="/images/Artist-images/slot-2/Pooja_Singh.png" class="hero-img">
        <img src="/images/Artist-images/slot-2/Shambhavi_Sharma-2.png" class="hero-img">
    </div>

    <!-- ✅ Navigation Buttons -->
    <button id="prevHero" class="hero-btn left-4">❮</button>
    <button id="nextHero" class="hero-btn right-4">❯</button>
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
                // ✅ Set content conditionally based on professional type
                let additionalInfo = client.professional === "Employee"
                    ? `<p class="font-poppins">Age: <strong>${client.age}</strong></p>` // Only show age for Employee
                    : `<p class="font-poppins">Followers: <strong>${client.followers}</strong></p>`; // Show followers for Artist
                
                let hoverContent = `
                    <div class="absolute inset-0 bg-pink-600 bg-opacity-90 text-white flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 p-6 text-center hover-content">
                        <h3 class="font-montserrat">${client.name}</h3>
                        <p class="font-poppins mt-1">${client.category}</p>
                        ${client.professional === "Employee" ? "" : `<p class="font-poppins">Followers: <strong>${client.followers}</strong></p>`} 
                        <p class="font-poppins">Age: ${client.age} | ${client.gender}</p>
                        <p class="font-poppins">Languages: ${client.language}</p>
                        <p class="font-poppins">Profession: ${client.professional}</p>

                        <!-- ✅ Book Now Button -->
                        <div class="flex gap-4 mt-4">
                            <button class="px-5 py-2 bg-white text-pink-600 font-semibold rounded-lg hover:bg-gray-200 shadow-md btn-primary">
                                <i class="fas fa-user-check mr-2"></i> Book Now
                            </button>
                        </div>
                    </div>
                `;

                let clientCard = `
                    <div class="relative group overflow-hidden rounded-lg shadow-lg transition hover:shadow-xl bg-white">
                        <div class="relative">
                            <!-- ✅ Image -->
                            <img src="${client.image_url}" alt="${client.name}" class="w-full h-[450px] object-cover rounded-md">
                            
                            <!-- ✅ Hover Overlay -->
                            ${hoverContent}
                        </div>

                        <!-- ✅ Name, Category, and Conditional Info -->
                        <div class="p-4 text-center">
                            <h3 class="client-name font-montserrat">${client.name}</h3>
                            <p class="client-category font-poppins">${client.category}</p>
                            ${additionalInfo}
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
