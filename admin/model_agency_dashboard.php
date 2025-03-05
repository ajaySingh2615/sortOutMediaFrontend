<?php
// ✅ Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Ensure Correct Path for Database Connection
require_once __DIR__ . '/../includes/db_connect.php';

// ✅ Ensure Only Admins & Super Admins Can Access
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'super_admin')) {
    header("Location: ../auth/login.php");
    exit();
}

// ✅ Debugging: Check if session variables are set properly
// Uncomment this line if you need to debug session values
// echo "<pre>"; print_r($_SESSION); echo "</pre>"; exit();

// ✅ Fetch pending clients
$pendingQuery = "SELECT * FROM clients WHERE approval_status = 'pending'";
$pendingResult = mysqli_query($conn, $pendingQuery);

// ✅ Fetch approved clients
$approvedQuery = "SELECT * FROM clients WHERE approval_status = 'approved'";
$approvedResult = mysqli_query($conn, $approvedQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal Agency Dashboard</title>
    
    <!-- ✅ Bootstrap CSS for better styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        h1, h2 {
            text-align: center;
            margin-top: 20px;
            color: #d90429;
        }

        .table-container {
            width: 90%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background: #d90429;
            color: white;
        }

        tr:hover {
            background: #f1f1f1;
        }

        img {
            border-radius: 5px;
        }

        .btn-approve {
            background: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-reject {
            background: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-edit {
            background: #ffc107;
            color: black;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>

        <!-- ✅ Display Success or Error Message -->
<div class="container mt-3">
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?> <!-- Remove message after showing -->
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error']); ?> <!-- Remove error after showing -->
    <?php endif; ?>
</div>

    <h1>Modal Agency Dashboard</h1>

    <div class="table-container">
        <h2>Pending Approvals</h2>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Followers</th>
                <th>Category</th>
                <th>Language</th>
                <th>Professional</th>
                <th>Profile Image</th>
                <th>Actions</th>
                <th>Phone Number</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($pendingResult)) : ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= $row['age'] ?></td>
                    <td><?= $row['gender'] ?></td>
                    <td><?= htmlspecialchars($row['followers']) ?></td>
                    <td><?= htmlspecialchars($row['category']) ?></td>
                    <td><?= htmlspecialchars($row['language']) ?></td>
                    <td><?= $row['professional'] ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td>
                        <img src="../uploads/<?= htmlspecialchars($row['image_url']) ?>" width="50" height="50">
                    </td>
                    <td>
                        <a href="./approve_client.php?id=<?= $row['id'] ?>" class="btn-approve">Approve</a> |
                        <a href="./reject_client.php?id=<?= $row['id'] ?>" class="btn-reject">Reject</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div class="table-container">
        <h2>Approved Clients</h2>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Followers</th>
                <th>Category</th>
                <th>Language</th>
                <th>Professional</th>
                <th>Profile Image</th>
                <th>Actions</th>
                <th>Phone Number</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($approvedResult)) : ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= $row['age'] ?></td>
                    <td><?= $row['gender'] ?></td>
                    <td><?= htmlspecialchars($row['followers']) ?></td>
                    <td><?= htmlspecialchars($row['category']) ?></td>
                    <td><?= htmlspecialchars($row['language']) ?></td>
                    <td><?= $row['professional'] ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td>
                        <img src="../uploads/<?= htmlspecialchars($row['image_url']) ?>" width="50" height="50">
                    </td>
                    <td>
                        <a href="./edit_client.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a> |
                        <a href="./delete_client.php?id=<?= $row['id'] ?>" class="btn-delete">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <!-- ✅ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
