<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json'); // Ensure JSON response

require '../includes/db_connect.php';
require '../includes/config.php'; // Cloudinary config
require '../vendor/autoload.php';

use Cloudinary\Api\Upload\UploadApi;

$response = ["status" => "error", "message" => "Unknown error"];

try {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Invalid request method");
    }

    // ✅ Get form data safely
    $name = isset($_POST['name']) ? trim($_POST['name']) : "";
    $age = isset($_POST['age']) ? intval($_POST['age']) : 0;
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : "";
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : "";
    $category = isset($_POST['category']) ? trim($_POST['category']) : "";
    $languages = isset($_POST['language']) ? implode(", ", $_POST['language']) : "";
    $professional = isset($_POST['professional']) ? trim($_POST['professional']) : "";
    $followers = isset($_POST['followers']) ? trim($_POST['followers']) : "";
    $experience = isset($_POST['experience']) ? trim($_POST['experience']) : "";

    // ✅ Basic validation
    if (empty($name) || empty($category) || empty($professional)) {
        throw new Exception("Missing required fields: Name, Category, and Professional type are required.");
    }
    if ($age < 18 || $age > 99) {
        throw new Exception("Invalid age. Age must be between 18 and 99.");
    }

    // ✅ Ensure correct values for "Followers" and "Experience"
    if ($professional === "Employee") {
        $followers = ""; // Employees don't have followers
    } else {
        $experience = ""; // Artists don't have experience
    }

    // ✅ Handle Image Upload to Cloudinary
    $image_url = "";
    if (!empty($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
        try {
            $uploadApi = new UploadApi();
            $upload = $uploadApi->upload($_FILES['image']['tmp_name'], ['folder' => 'client_images']);
            $image_url = $upload['secure_url'];
        } catch (Exception $e) {
            throw new Exception("Cloudinary Upload Error: " . $e->getMessage());
        }
    }

    // ✅ Prepare SQL Query
    $query = "INSERT INTO clients (name, age, phone, gender, followers, experience, category, language, professional, image_url, approval_status) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "SQL Prepare Error: " . $conn->error]);
        exit();
    }

    // ✅ Bind Parameters
    $stmt->bind_param("sissssssss", $name, $age, $phone, $gender, $followers, $experience, $category, $languages, $professional, $image_url);

    // ✅ Execute Query
    if (!$stmt->execute()) {
        echo json_encode(["status" => "error", "message" => "Database Insert Error: " . $stmt->error]);
        exit();
    }

    // ✅ Success response
    $response = [
        "status" => "success",
        "message" => "Profile submitted successfully. It will be visible after admin approval."
    ];
} catch (Exception $e) {
    $response = ["status" => "error", "message" => $e->getMessage()];
}

// ✅ Send JSON response
echo json_encode($response);
exit;
