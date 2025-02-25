<?php
require '../includes/db_connect.php';
session_start();

$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    $stmt = $conn->prepare("SELECT id, username, password, role, status FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password, $role, $status);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            if ($role == 'admin' && $status == 'pending') {
                $errorMsg = "❌ Your admin account is pending approval. Please wait for the Super Admin to approve it.";
            } else {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                if ($role == 'admin' || $role == 'super_admin') {
                    header("Location: ../admin/dashboard.php");
                } else {
                    header("Location: ../index.php");
                }
                
                exit();
            }
        } else {
            $errorMsg = "❌ Invalid password.";
        }
    } else {
        $errorMsg = "❌ No user found with this email.";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- ✅ Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ✅ Background Design */
        body {
            background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(240,240,240,1) 100%);
            background-image: url("https://www.transparenttextures.com/patterns/cubes.png");
            background-repeat: repeat;
        }

        /* ✅ Form Styling */
        .form-container {
            max-width: 450px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* ✅ Navbar */
        .navbar {
            background: linear-gradient(135deg, #d90429, #ef233c);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
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
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand text-white fw-bold d-flex align-items-center" href="#">
            <img src="logo.png" alt="Logo" height="40" class="me-2"> <span class="fs-4">Login</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link text-white fw-semibold px-3" href="../index.php">🏠 Home</a></li>
                <li class="nav-item"><a class="nav-link text-white fw-semibold px-3" href="register.php">📝 Register</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- ✅ Spacing for Navbar -->
<div style="height: 80px;"></div>

<!-- ✅ Login Form -->
<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="form-container">
        <h2 class="text-center fw-bold mb-3">Login</h2>
        <p class="text-center text-muted mb-4">Enter your credentials to access your account.</p>

        <!-- ✅ Error Alert -->
        <?php if ($errorMsg): ?>
            <div class="alert alert-danger text-center"><?= $errorMsg; ?></div>
        <?php endif; ?>

        <form method="POST" class="row g-3">
            <div class="col-12">
                <label class="form-label fw-semibold">Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold">Password:</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <div class="col-12 text-center">
                <p><a href="forgot_password.php" class="text-danger fw-bold">Forgot Password?</a></p>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">🔓 Login</button>
            </div>

            <div class="col-12 text-center">
                <p>Don't have an account? <a href="register.php" class="text-danger fw-bold">Register Here</a></p>
            </div>
        </form>
    </div>
</div>

<!-- ✅ Footer -->
<footer>© 2025 Your Website | All Rights Reserved.</footer>

<!-- ✅ Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
