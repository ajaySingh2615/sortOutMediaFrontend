<?php
require 'includes/db_connect.php';

header('Content-Type: application/json');

// ✅ Get Filters from AJAX Request
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$price_range = isset($_GET['price_range']) ? trim($_GET['price_range']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 12;
$start = ($page - 1) * $limit;

$query = "SELECT * FROM devices WHERE 1";
$params = [];
$types = "";

// ✅ Apply Filters
if (!empty($search)) {
    $query .= " AND device_name LIKE ?";
    $params[] = "%$search%";
    $types .= "s";
}
if (!empty($category)) {
    $query .= " AND category = ?";
    $params[] = $category;
    $types .= "s";
}
if (!empty($price_range)) {
    switch ($price_range) {
        case 'below_10000':
            $query .= " AND price < 10000";
            break;
        case '10000_30000':
            $query .= " AND price BETWEEN 10000 AND 30000";
            break;
        case '30000_50000':
            $query .= " AND price BETWEEN 30000 AND 50000";
            break;
        case 'above_50000':
            $query .= " AND price > 50000";
            break;
    }
}

// ✅ Pagination
$query .= " ORDER BY created_at DESC LIMIT ?, ?";
$params[] = $start;
$params[] = $limit;
$types .= "ii";

// ✅ Prepare & Execute Query
$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$devices = [];
while ($row = $result->fetch_assoc()) {
    $devices[] = $row;
}

// ✅ Get Total Devices Count
$countQuery = "SELECT COUNT(*) as total FROM devices WHERE 1";
$countStmt = $conn->prepare($countQuery);
$countStmt->execute();
$countResult = $countStmt->get_result();
$totalDevices = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalDevices / $limit);

// ✅ Send JSON Response
echo json_encode([
    'devices' => $devices,
    'totalPages' => $totalPages,
    'currentPage' => $page
]);
?>
