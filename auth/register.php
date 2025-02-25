<?php
require '../includes/db_connect.php';

$registrationSuccess = false;
$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // ✅ Strong Password Validation
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        $errorMsg = "❌ Password must have at least 8 characters, 1 uppercase, 1 lowercase, 1 number, and 1 special character.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        if (!in_array($role, ['admin', 'user'])) {
            die("❌ Invalid role selected.");
        }

        // ✅ New Admins Need Approval, Users Are Auto-Approved
        $status = ($role === 'admin') ? 'pending' : 'approved';

        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $hashed_password, $role, $status);

        if ($stmt->execute()) {
            $registrationSuccess = true;
        } else {
            $errorMsg = "❌ Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>

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
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* ✅ Password Strength Indicator */
        .password-strength {
            font-size: 0.9rem;
            margin-top: 5px;
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
            <img src="logo.png" alt="Logo" height="40" class="me-2">
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link text-white fw-semibold px-3" href="../index.php">🏠 Home</a></li>
                <li class="nav-item"><a class="nav-link text-white fw-semibold px-3" href="login.php">🔑 Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- ✅ Spacing for Navbar -->
<div style="height: 80px;"></div>

<!-- ✅ Signup Form -->
<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="form-container">
        <h2 class="text-center fw-bold mb-3">Create an Account</h2>
        <p class="text-center text-muted mb-4">Register with your details below.</p>

        <!-- ✅ Success Alert -->
        <?php if ($registrationSuccess): ?>
            <div class="alert alert-success text-center">
                🎉 Registration Successful! 
                <?php if ($role === 'admin'): ?>
                    Your account is pending approval by Super Admin.
                <?php else: ?>
                    You can now <a href="login.php" class="fw-bold">Login</a>.
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- ✅ Error Alert -->
        <?php if ($errorMsg): ?>
            <div class="alert alert-danger text-center"><?= $errorMsg; ?></div>
        <?php endif; ?>

        <form method="POST">
            <label class="form-label fw-semibold">Username:</label>
            <input type="text" name="username" class="form-control" required>

            <label class="form-label fw-semibold">Email:</label>
            <input type="email" name="email" class="form-control" required>

            <label class="form-label fw-semibold">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
            <small id="password-strength" class="password-strength text-muted"></small>

            <label class="form-label fw-semibold">Confirm Password:</label>
            <input type="password" id="confirm_password" class="form-control" required>
            <small id="password-match" class="password-strength text-muted"></small>

            <input type="checkbox" id="show-password" class="form-check-input">
            <label for="show-password" class="form-check-label">Show Password</label>

            <label class="form-label fw-semibold mt-3">Select Role:</label>
            <select name="role" class="form-select">
                <option value="user" selected>👤 User</option>
                <option value="admin">🔑 Admin</option>
            </select>

            <button type="submit" class="btn btn-primary w-100 mt-3">🚀 Register</button>
        </form>
    </div>
</div>

<!-- ✅ Footer -->
<footer>© 2025 Your Website | All Rights Reserved.</footer>

<!-- ✅ Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- ✅ JavaScript for Password Validation -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm_password");
    const passwordStrength = document.getElementById("password-strength");
    const passwordMatch = document.getElementById("password-match");
    const showPasswordCheckbox = document.getElementById("show-password");

    passwordInput.addEventListener("input", function() {
        const strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        passwordStrength.textContent = strongPasswordRegex.test(passwordInput.value) ? "✅ Strong Password" : "❌ Weak Password";
        passwordStrength.style.color = strongPasswordRegex.test(passwordInput.value) ? "green" : "red";
    });

    confirmPasswordInput.addEventListener("input", function() {
        passwordMatch.textContent = passwordInput.value === confirmPasswordInput.value ? "✅ Passwords match" : "❌ Passwords do not match";
        passwordMatch.style.color = passwordInput.value === confirmPasswordInput.value ? "green" : "red";
    });

    showPasswordCheckbox.addEventListener("change", function() {
        passwordInput.type = confirmPasswordInput.type = this.checked ? "text" : "password";
    });
});
</script>

</body>
</html>
