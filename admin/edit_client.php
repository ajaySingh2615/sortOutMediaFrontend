<?php
session_start();
require_once '../includes/db_connect.php'; // Database connection

// Check if the user is logged in and is an admin or superadmin
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'super_admin')) {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch client details
if (isset($_GET['id'])) {
    $client_id = intval($_GET['id']);
    $query = "SELECT * FROM clients WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $client_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $client = mysqli_fetch_assoc($result);

    if (!$client) {
        $_SESSION['error'] = "Client not found.";
        header("Location: model_agency_dashboard.php");
        exit();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $followers = $_POST['followers'];
    $category = $_POST['category'];
    $language = $_POST['language'];
    $professional = $_POST['professional'];

    // Update query
    $updateQuery = "UPDATE clients SET name=?, age=?, gender=?, followers=?, category=?, language=?, professional=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "sisssssi", $name, $age, $gender, $followers, $category, $language, $professional, $client_id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "Client profile updated successfully.";
        header("Location: model_agency_dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to update profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Client</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Edit Client Profile</h1>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($client['name']) ?>" required><br>

        <label>Age:</label>
        <input type="number" name="age" value="<?= $client['age'] ?>" required><br>

        <label>Gender:</label>
        <select name="gender" required>
            <option value="Male" <?= $client['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= $client['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
        </select><br>

        <label>Followers:</label>
        <input type="text" name="followers" value="<?= htmlspecialchars($client['followers']) ?>" required><br>

        <label>Category:</label>
        <input type="text" name="category" value="<?= htmlspecialchars($client['category']) ?>" required><br>

        <label>Language:</label>
        <input type="text" name="language" value="<?= htmlspecialchars($client['language']) ?>" required><br>

        <label>Professional:</label>
        <select name="professional" required>
            <option value="Artist" <?= $client['professional'] == 'Artist' ? 'selected' : '' ?>>Artist</option>
            <option value="Employee" <?= $client['professional'] == 'Employee' ? 'selected' : '' ?>>Employee</option>
        </select><br>

        <button type="submit">Update Client</button>
    </form>
</body>
</html>
