<?php
require '../includes/db_connect.php';  // Database connection

header('Content-Type: application/json'); // Ensure JSON output

// ✅ Handle filters from the frontend
$category = isset($_GET['category']) ? trim($_GET['category']) : "";
$gender = isset($_GET['gender']) ? trim($_GET['gender']) : "";
$age_group = isset($_GET['age_group']) ? trim($_GET['age_group']) : "";
$language = isset($_GET['language']) ? trim($_GET['language']) : "";
$professional = isset($_GET['professional']) ? trim($_GET['professional']) : "";
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 16;
$offset = ($page - 1) * $limit;

// ✅ Build SQL Query with Filters (Only Fetch Approved Clients)
$sql = "SELECT id, name, age, gender, followers, experience, category, language, professional, image_url 
        FROM clients 
        WHERE approval_status = 'approved'";  // ✅ Ensure only approved clients are shown

if (!empty($category)) $sql .= " AND category = ?";
if (!empty($gender)) $sql .= " AND gender = ?";
if (!empty($language)) $sql .= " AND FIND_IN_SET(?, language)";
if (!empty($professional)) $sql .= " AND professional = ?";

if ($age_group == "18-25") $sql .= " AND age BETWEEN 18 AND 25";
if ($age_group == "26-35") $sql .= " AND age BETWEEN 26 AND 35";
if ($age_group == "36-45") $sql .= " AND age BETWEEN 36 AND 45";
if ($age_group == "46+") $sql .= " AND age >= 46";

$sql .= " ORDER BY id DESC LIMIT ? OFFSET ?";

// ✅ Prepare and Bind Parameters
$stmt = $conn->prepare($sql);
$types = "";
$params = [];

if (!empty($category)) { $types .= "s"; $params[] = $category; }
if (!empty($gender)) { $types .= "s"; $params[] = $gender; }
if (!empty($language)) { $types .= "s"; $params[] = $language; }
if (!empty($professional)) { $types .= "s"; $params[] = $professional; }
$types .= "ii"; // Page limit & offset
$params[] = $limit;
$params[] = $offset;

$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$clients = [];
while ($row = $result->fetch_assoc()) {
    // ✅ Show Experience for Employees, Followers for Artists
    if ($row['professional'] === 'Employee') {
        $row['followers'] = null;
    } else {
        $row['experience'] = null;
    }
    $clients[] = $row;
}

// ✅ Get Total Clients Count for Pagination (Only Approved Clients)
$total_clients_query = "SELECT COUNT(id) as total FROM clients WHERE approval_status = 'approved'";

if (!empty($category)) $total_clients_query .= " AND category = '$category'";
if (!empty($gender)) $total_clients_query .= " AND gender = '$gender'";
if (!empty($language)) $total_clients_query .= " AND FIND_IN_SET('$language', language)";
if (!empty($professional)) $total_clients_query .= " AND professional = '$professional'";
if ($age_group == "18-25") $total_clients_query .= " AND age BETWEEN 18 AND 25";
if ($age_group == "26-35") $total_clients_query .= " AND age BETWEEN 26 AND 35";
if ($age_group == "36-45") $total_clients_query .= " AND age BETWEEN 36 AND 45";
if ($age_group == "46+") $total_clients_query .= " AND age >= 46";

$total_clients_result = $conn->query($total_clients_query);
$total_clients_row = $total_clients_result->fetch_assoc();
$total_clients = $total_clients_row['total'];

echo json_encode(["clients" => $clients, "total_clients" => $total_clients]);
$conn->close();
?>
