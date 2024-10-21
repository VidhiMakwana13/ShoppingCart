<?php
$mysqli = new mysqli("localhost", "root", "", "shoppingcart");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10; // Number of products per page
$offset = ($page - 1) * $limit;

// Fetch products based on category
$sql = "SELECT * FROM products WHERE category_id = ? LIMIT ? OFFSET ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("iii", $category_id, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Fetch total number of products for pagination
$total_sql = "SELECT COUNT(*) as total FROM products WHERE category_id = ?";
$total_stmt = $mysqli->prepare($total_sql);
$total_stmt->bind_param("i", $category_id);
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_products = $total_row['total'];

$response = [
    'products' => $products,
    'total_products' => $total_products,
    'total_pages' => ceil($total_products / $limit),
];

header('Content-Type: application/json');
echo json_encode($response);
?>
