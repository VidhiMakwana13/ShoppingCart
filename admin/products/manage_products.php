<?php
$mysqli = new mysqli("localhost", "root", "", "shoppingcart");
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
}

// Query to get all products with categories
$result = $mysqli->query("SELECT products.*, categories.name AS category_name FROM products JOIN categories ON products.category_id = categories.id");
$products = []; // Array to hold products
while ($row = $result->fetch_assoc()) {
    $products[] = $row; // Add each product to the array
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
<style>
    /* style.css */

body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(to right, #e1f5fe, #bbdefb); /* Light gradient background */
    margin: 0;
    padding: 0;
    color: #333;
}

.container {
    max-width: 900px;
    margin: 50px auto; /* Center container */
    padding: 30px; /* Increased padding for a spacious feel */
    background-color: white;
    border-radius: 12px; /* More rounded corners */
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15); /* Deeper shadow for depth */
    text-align: center;
}

h1 {
    color: #3F51B5; /* Deep blue color for the header */
    margin-bottom: 25px; /* Increased margin for spacing */
    font-size: 2.5em; /* Larger header */
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1); /* Subtle text shadow */
}

.btn {
    display: inline-block;
    padding: 12px 25px; /* Increased padding */
    background: linear-gradient(to right, #4CAF50, #45a049); /* Gradient button color */
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin-bottom: 20px;
    transition: background-color 0.3s, transform 0.2s; /* Smooth transition for hover effect */
}

.btn:hover {
    background: linear-gradient(to right, #45a049, #4CAF50); /* Reverse gradient on hover */
    transform: translateY(-2px); /* Lift effect on hover */
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px; /* Spacing above the table */
}

th, td {
    padding: 15px; /* Increased padding for a spacious feel */
    border: 1px solid #ddd; /* Light grey border */
    text-align: left;
}

th {
    background-color: #f2f2f2; /* Light grey header */
    color: #333;
    font-weight: bold; /* Bold font for header */
}

tr:nth-child(even) {
    background-color: #f9f9f9; /* Alternate row color */
}

tr:hover {
    background-color: #e1f5fe; /* Light blue background on hover */
}

.action-btn {
    padding: 8px 12px;
    color: white;
    text-decoration: none;
    border-radius: 3px;
    transition: background-color 0.3s, transform 0.2s; /* Smooth transition for hover effect */
}

.action-btn:hover {
    opacity: 0.9; /* Slightly dim the button on hover */
}

.edit {
    background-color: #2196F3; /* Blue color for edit */
}

.edit:hover {
    background-color: #1976D2; /* Darker blue on hover */
}

.delete {
    background-color: #f44336; /* Red color for delete */
}

.delete:hover {
    background-color: #e53935; /* Darker red on hover */
}

.back {
    background-color: #2196F3; /* Blue color for back */
}

.back:hover {
    background-color: #1976D2; /* Darker blue on hover */
}

img {
    border-radius: 5px; /* Rounded corners for images */
    transition: transform 0.3s; /* Smooth image scaling on hover */
}

img:hover {
    transform: scale(1.1); /* Slightly enlarge image on hover */
}

</style>

</head>
<body>
    <div class="container">
        <h1>Manage Products</h1>
        <a href="add_product.php" class="btn">Add New Product</a>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= number_format($product['price'], 2) ?></td>
                        <td><?= htmlspecialchars($product['category_name']) ?></td>
                        <td><img src="../upload/product_images/<?= htmlspecialchars($product['image']) ?>" width="50" alt="<?= htmlspecialchars($product['name']) ?>" /></td>
                        <td>
                            <a href="edit_product.php?id=<?= $product['id'] ?>" class="action-btn edit">Edit</a>
                            <a href="delete_product.php?id=<?= $product['id'] ?>" class="action-btn delete">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="../dashboard.php" class="btn back">Back to Dashboard</a>
    </div>
</body>
</html>
