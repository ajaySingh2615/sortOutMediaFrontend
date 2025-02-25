<?php
require '../auth/auth.php';
require '../includes/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- ✅ Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* ✅ Dashboard Styling */
        body {
            background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(230,230,230,1) 100%);
            background-image: url("https://www.transparenttextures.com/patterns/cubes.png");
            background-repeat: repeat;
        }

        /* ✅ Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #d90429;
            color: white;
        }
        tr:hover {
            background: #f8d7da;
        }

        /* ✅ Filters */
        .filter-box {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .filter-box input, .filter-box select {
            max-width: 250px;
            flex-grow: 1;
        }

        /* ✅ Buttons */
        .btn-edit {
            background: #ffc107;
            color: black;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        .btn-edit:hover, .btn-delete:hover {
            opacity: 0.85;
        }

        /* ✅ Pagination */
        .pagination-container {
            background: #222;
            color: white;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            margin-top: 20px;
        }
        .pagination-btn {
            background: #555;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }
        .pagination-btn:hover {
            background: #777;
        }

        /* ✅ Footer */
        footer {
            background: black;
            color: white;
            padding: 30px 0;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- ✅ Navbar -->
<nav class="navbar navbar-expand-lg fixed-top" style="background: linear-gradient(135deg, #d90429, #ef233c); box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
    <div class="container">
        <a class="navbar-brand text-white fw-bold d-flex align-items-center" href="#">
            <img src="logo.png" alt="Logo" height="40" class="me-2">
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link text-white fw-semibold px-3" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link text-white fw-semibold px-3" href="add_blog.php">Add Blog</a></li>
                <li class="nav-item">
                    <a class="btn btn-light text-danger fw-bold px-4 rounded-pill shadow-sm" href="../auth/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ✅ Spacing for Navbar -->
<div style="height: 80px;"></div>

<!-- ✅ Dashboard Content -->
<div class="container my-5">
    <h2 class="text-center fw-bold text-danger mb-4">Admin Dashboard</h2>

    <!-- ✅ Filter Section -->
    <div class="filter-box mb-3">
        <input type="text" id="search" class="form-control" placeholder="🔎 Search by Title...">
        <select id="month" class="form-control">
            <option value="">📅 Filter by Month</option>
            <?php for ($m = 1; $m <= 12; $m++): ?>
                <option value="<?= $m; ?>"><?= date("F", mktime(0, 0, 0, $m, 1)); ?></option>
            <?php endfor; ?>
        </select>
        <button id="reset" class="btn btn-secondary">Reset</button>
    </div>

    <!-- ✅ Blog Table -->
    <div id="table-data">
        <!-- Data will be loaded dynamically here -->
    </div>
    
</div>

<!-- ✅ Footer -->
<footer>© 2025 Admin Panel | All Rights Reserved.</footer>

<!-- ✅ Bootstrap & jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
    function loadData(page = 1, search = '', month = '') {
        $.ajax({
            url: "fetch_blogs.php",
            type: "GET",
            data: { page: page, search: search, month: month },
            success: function (response) {
                $("#table-data").html(response);
            }
        });
    }

    // ✅ Load Initial Data
    loadData();

    // ✅ Search Event
    $("#search").on("keyup", function () {
        loadData(1, $(this).val(), $("#month").val());
    });

    // ✅ Month Filter
    $("#month").on("change", function () {
        loadData(1, $("#search").val(), $(this).val());
    });

    // ✅ Reset Filters
    $("#reset").on("click", function () {
        $("#search").val('');
        $("#month").val('');
        loadData(1, '', '');
    });

    // ✅ Pagination Click Event
    $(document).on("click", ".pagination-link", function (e) {
        e.preventDefault();
        let page = $(this).data("page");
        loadData(page, $("#search").val(), $("#month").val());
    });

    // ✅ Handle Delete Confirmation Modal (Attach Dynamically)
    let deleteId = null;
    
    $(document).on("click", ".delete-btn", function () {
        deleteId = $(this).data("id"); // Store the ID
        $("#deleteModal").modal("show"); // Show the modal
    });

    // ✅ Confirm Delete Button Click (Fix: Event Delegation)
    $(document).on("click", "#confirmDelete", function () {
        if (deleteId) {
            $.ajax({
                url: "delete_blog.php",
                type: "POST",
                data: { id: deleteId },
                success: function (response) {
                    $("#deleteModal").modal("hide"); // Hide modal after delete
                    loadData(); // Refresh Table
                }
            });
        }
    });
});


</script>

</body>
</html>
